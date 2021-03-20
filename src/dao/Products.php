<?php
  require_once('../database/Connection.php');
  require_once('../builders/Product.php');
  require_once('../dao/Purchases.php');
  require_once('Interface.php');

  class ProductsDAO extends Connection implements MinimumRequerimentsDAO {
    public $connection;

    function __construct() {
      parent::__construct('localhost','root', '12345', 'crud_products');
      $this->stablishConnection();
    } 

    function stablishConnection(){
      $this->connection = parent::createConnection();
    }

    function endConnection() {
      parent::endConnection();
    }

    function findById($id){
      $rs = mysqli_query($this->connection, "SELECT * FROM products WHERE id = $id");
      $this->endConnection();

      $reg = mysqli_fetch_assoc($rs);

      $productBuilder = new ProductBuilder();

      $newProduct = new \stdClass();
      $newProduct->id = $reg['id'];
      $newProduct->name = $reg['name'];
      $newProduct->price = $reg['price'];
      $newProduct->distributor = $reg['distributor'];

      $product = $productBuilder->getProduct($newProduct);

      return $product;
    }

    function findByPurchaseId($id) {
      $rs = mysqli_query($this->connection, "SELECT * FROM products WHERE purchase_id = $id");
      $this->endConnection();
      
      $products = [];

      while($reg = mysqli_fetch_assoc($rs)){
        $productBuilder = new ProductBuilder();

        $newProduct = new \stdClass();
        $newProduct->id = $reg['id'];
        $newProduct->name = $reg['name'];
        $newProduct->price = $reg['price'];
        $newProduct->distributor = $reg['distributor'];

        $product = $productBuilder->getProduct($newProduct);
        array_push($products, $product);
      }

      if(count($products) == 0){
        $purchasesDAO = new PurchasesDAO();
        $purchasesDAO->deleteById($id);
        header("Location: /FinalWork/src/view/listPurchases.php");
        return;
      }
      
      return $products;
    }

    function update($product){
      $id = $product->getId();
      $name = $product->getName();
      $price = $product->getPrice();
      $distributor = $product->getDistributor();

      $sql = "UPDATE products SET name = " . '"' . $name . '"' .  ", price = " . '"' . $price . '"' .  ", distributor = " . '"' . $distributor . '"' .  " WHERE id = $id";
      
      $success = mysqli_query($this->connection, $sql);

      if(!$success){
        return mysqli_error($this->connection);
      }

      $this->endConnection();

      return $success;
    }

    function deleteById($id){
      $deleted = mysqli_query($this->connection, "DELETE FROM products WHERE id = $id");
      
      if(!$deleted){
        return mysqli_error($this->connection);
      }
      $this->endConnection();

      return $deleted;
    }
  }