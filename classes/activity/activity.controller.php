<?php
include_once "activity.model.php";

class ActivityController extends ActivityModel{
  //create activity
  public function create($username, $activity, $expiration_date = NULL){
    $response = NULL;
    if (trim($activity) !== "") {
      $response = $this->insertActivity($username, trim($activity), $expiration_date);
    }
    return $response;
  }
  //update activity and priority. Update activity or priority.
  public function update($username, $created, $newActivity = NULL, $newPriority = NULL, $complete = NULL){
    $result = NULL;
    if (isset($newPriority)) {
      $result = $this->updatePriorityActivity($username, $newPriority, $created);
    }
    else if (isset($newActivity)) {
      $result = $this->updateActivity($username, $newActivity, $created);
    }
    else if(isset($complete)){
      $result = $this->updateCompleteActivity($username, $complete, $created);
    }
    return $result;
  }
  //delete activity
  public function delete($username, $created){
    $result = $this->deleteActivity($username, $created);
    return $result;
  }
}
