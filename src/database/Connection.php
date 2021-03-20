<?php

  Class Connection {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '12345';
    private $db = 'crud_products';

    public $connection;

    function __construct() {
      $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->db);
    }

    function createConnection(){
      if($this->connection == null){
        $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->db);
      }
      return $this->connection;
    }

    function endConnection(){
      mysqli_close($this->connection);
      $this->connection = null;
    }
  }