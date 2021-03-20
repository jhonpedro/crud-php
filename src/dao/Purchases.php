<?php
  require_once('../database/Connection.php');
  require_once('../model/Purchase.php');
  require_once('Interface.php');

  class PurchasesDAO extends Connection implements MinimumRequerimentsDAO {
    public $connection;

    function stablishConnection(){
      $this->connection = parent::createConnection();
    }

    function endConnection() {
      parent::endConnection();
    }

    function findAll(){
      $rs = mysqli_query($this->connection, "SELECT * FROM purchases");

      $products = [];

      while($reg = mysqli_fetch_assoc($rs)){
        $product = new \stdClass();

        $id = $reg['id'];
        $name = $reg['name'];
        $created_at = $reg['created_at'];
        
        $product = new Purchase($id, $name, $created_at);

        array_push($products, $product);
      }
      $this->endConnection();
      return $products;
    }

    function findById($id){
      $rs = mysqli_query($this->connection, "SELECT * FROM purchases WHERE id = $id");

      $result = mysqli_fetch_assoc($rs);

      $id = $result['id'];
      $name = $result['name'];
      $created_at = $result['created_at'];

      $this->endConnection();

      return new Purchase($id, $name, $created_at);
    }

    function deleteById($id){
      $deleted = mysqli_query($this->connection, "DELETE FROM purchases WHERE id = $id");

      if(!$deleted){
        return mysqli_error($this->connection); 
      }

      $this->endConnection();

      return $deleted;
    }
  }