<?php
  include_once '../classes/dbh.class.php';

  class UserModel extends Dbh{
    //CRUD for user
    //create user
    protected function insertUser($username, $pwd){
      $sql = "INSERT INTO users(username, pwd) VALUES ( ?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$username, $pwd]);
      return $stmt;
    }

    //get a single user
    protected function getUser($username, $pwd){
      $sql = "SELECT * FROM users WHERE username = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$username]);
      if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();
        if (password_verify($pwd, $user['pwd'])) {
          $username = $user['username'];
          return $username;
        }
      }
      return NULL;
    }

    //ritorna tutti gli utenti del database
    protected function getUsers(){
      $sql = "SELECT * FROM users";
      $stmt = $this->connect()->query($sql);
      $result = $stmt->fetchAll();
      return $result;
    }

    //update user
    protected function updateUser($newUsername, $username){
      $sql = "UPDATE users SET username = ? WHERE username = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$newUsername, $username]);
      return $stmt;
    }

    protected function deleteUser($username){
      $sql = "DELETE FROM users WHERE username = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$username]);
      return $stmt;
    }

  }
