<?php

include_once "../classes/dbh.class.php";

class ActivityModel extends Dbh{
  //CRUD for activity
  //create activity
  protected function insertActivity($username, $activity, $expiration_date = NULL){
    $sql = "INSERT INTO activities(username, activity, expiration_date) VALUES (?,?,?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$username, $activity, $expiration_date]);
    return $stmt->errorCode();
  }
  //get activity
  protected function getActivity($username, $activity){
    $sql = "SELECT * FROM activities WHERE username = ? AND activity = ? ORDER BY created DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$username, $activity]);
    $activity = $stmt->fetch();
    return $activity;
  }
  //get ALL activities
  protected function getActivities($username){
    $sql = "SELECT * FROM activities WHERE username = ? ORDER BY expiration_date ASC, priority DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$username]);
    $activities = $stmt->fetchAll();
    return $activities;
  }
  //update activity
  protected function updateActivity($username, $newActivity, $created){
    $sql = "UPDATE activities SET activity = ? WHERE username = ? AND created = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$newActivity, $username, $created]);
    return $stmt;
  }
  //update priority activity
  protected function updatePriorityActivity($username, $newPriority, $created){
    $sql = "UPDATE activities SET priority = ? WHERE username = ? AND created = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$newPriority, $username, $created]);
    return $stmt;
  }
  //update complete activity
  protected function updateCompleteActivity($username, $complete, $created){
    $sql = "UPDATE activities SET complete = ? WHERE username = ? AND created = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$complete, $username, $created]);
    return $stmt;
  }
  //delete activity
  protected function deleteActivity($username, $created){
    $sql = "DELETE FROM activities WHERE username = ? AND created = ?";
    $stmt = $this->connect()->prepare($sql);
    if($stmt->execute([$username, $created])){
      return true;
    }else{
      return false;
    }
  }
}
