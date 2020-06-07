<?php
include_once "activity.model.php";

class ActivityView extends ActivityModel{
  //get single activity from database
  public function read($username, $activity){
    $activity = $this->getActivity($username, $activity);
    return $activity;
  }
  //get all the activities
  public function readAll($username){
    $activities = $this->getActivities($username);
    return $activities;
  }
}
