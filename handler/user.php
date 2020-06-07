<?php
//PROCEDURAL PHP IN CUI ISTANZIO CONTROLLER E VIEW PER USER
  include_once "../classes/user/user.controller.php";
  include_once "../classes/user/user.view.php";

  $controller = new UserController();
  $view = new UserView();

  //registrazione utente
  if(isset($_POST['registraUtente'])){
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $confirm_pwd = $_POST['confirm_pwd'];
    $register = $controller->create($username, $pwd, $confirm_pwd);
    if (isset($register)) {
      $view->read($username, $pwd);
    }else{
      $message = "Password diverse";
      header("Location: ../public/registration.php?error=" . $message);
    }
  }
  //accesso utente
  if (isset($_POST['accessoUtente'])) {
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $view->read($username, $pwd);
  }
//logout utente
if (isset($_POST['logout'])) {
  session_start();
  session_destroy();
  echo json_encode("../");
}
//delete account
if (isset($_POST['delete_account']) && isset($_POST['username'])) {
  $username = $_POST['username'];
  $controller->delete($username);
  echo json_encode("../public/registration.php");
}
