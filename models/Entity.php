<?php

class Entity {
  private $connection;
  private $host;
  private $user;
  private $password;
  private $database;

  public function __construct() {
    $this->host = 'localhost';
    $this->user = 'root';
    $this->password = 'root';
    $this->database = 'spreadsheet';
    $this->connect();
  }
  public function connect() {
    $this->connection = new mysqli($this->host, $this->user , $this->password, $this->database) or die("Problemas al conectar al servidor.");
  }

  public function connection() {
    return $this->connection;
  }
}
?>