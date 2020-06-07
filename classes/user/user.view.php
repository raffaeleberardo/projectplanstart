<?php
include_once 'user.model.php';
class UserView extends UserModel{
  //prendo i dati di un solo utente (qui posso manipolarli per renderli al front-end)
  public function read($username, $pwd){
    $username = $this->getUser($username, $pwd);
    if (isset($username)) {
      session_start();
      $_SESSION['username'] = $username;
      header("Location: ../public/activities.php");
    }else{
      header("Location: ../?error=password+o+utente+errati");
    }
  }
  //prendo i dati di tutti gli utenti (qui posso manipolarli per renderli al front-end)
  public function readAll(){
    $users = $this->getUsers();
    return $users;
  }
}
