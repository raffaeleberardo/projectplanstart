<?php
  class Dbh{
    /*inserire parametri connessione a database*/
    private $host = ""; //inserire QUI host database;
    private $user = ""; //inserire QUI username database
    private $pwd = ""; //inserire QUI password database
    private $dbName = ""; //inserire QUI nome database

    protected function connect(){
      $dsn = "pgsql:host=" . $this->host . ';dbname=' . $this->dbName;
      $pdo = new PDO($dsn, $this->user, $this->pwd);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      return $pdo;
    }
  }
