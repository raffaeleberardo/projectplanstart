<?php
include_once "user.model.php";
class UserController extends UserModel{

  public function create($username, $password, $confirm_pwd){
    $response = NULL;
    if (preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      if ($password === $confirm_pwd) {
        $pwd = password_hash($password, PASSWORD_DEFAULT);
        $response = $this->insertUser($username, $pwd);
      }
    }
    return $response;
  }

  public function update($newUsername, $username){
    $this->updateUser($newUsername, $username);
  }

  public function delete($username){
    $this->deleteUser($username);
  }
}
