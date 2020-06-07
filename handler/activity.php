<?php
//PROCEDURAL PHP IN CUI ISTANZIO CONTROLLER E VIEW PER ACTIVITY
include_once "../classes/activity/activity.controller.php";
include_once "../classes/activity/activity.view.php";
include_once "../classes/security/security.class.php";

session_start();

$controller = new ActivityController();
$view = new ActivityView();
$security = new Security();

$username = $_SESSION['username'];
//load activities
if (isset($_POST['username'])) {
  $activities = $view->readAll($username);
  for ($i=0; $i < count($activities); $i++) {
    $activities[$i]['activity'] = $security->decryptMessage($activities[$i]['activity']);
  }
  echo json_encode($activities);
}
//add activity
if (isset($_POST['add_activity_submit'])) {
  $added_activity = false;
  $activity = trim($_POST['add_activity_input']);
  $activity = strip_tags ($activity);
  $expiration_date = $_POST['expiration_date'];
  if ($expiration_date === "") {
    $expiration_date = NULL;
  }
  if ($activity !== "" && $activity !=="Inserisci attività") {
    if ($controller->create($username, $security->encryptMessage($activity), $expiration_date) === '00000') {
      $added_activity = $view->read($username, $security->encryptMessage($activity));
      $added_activity['activity'] = $security->decryptMessage($added_activity['activity']);
    }
    echo json_encode($added_activity);
  }
}

//update priority
if (isset($_POST['newPriority']) && isset($_POST['created'])) {
  $newPriority = $_POST['newPriority'];
  $created = $_POST['created'];
  $updatePriority = $controller->update($username, $created, NULL, $newPriority);
}
//update activity
if (isset($_POST['newActivity']) && isset($_POST['created'])) {
  $newActivity = trim($_POST['newActivity']);
  $created = $_POST['created'];
  if ($newActivity !== "") {
    $updateActivity = $controller->update($username, $created, $security->encryptMessage($newActivity));
    echo json_encode($newActivity);
  }
}
//update complete/uncomplete
if (isset($_POST['complete']) && isset($_POST['created'])) {
  $complete = $_POST['complete'];
  $created = $_POST['created'];
  $updateComplete = $controller->update($username, $created, NULL, NULL, $complete);
}
//delete
if (isset($_POST['delete']) && isset($_POST['created'])) {
  $created = $_POST['created'];
  $delete = $controller->delete($username, $created);
  echo json_encode($delete);
}
