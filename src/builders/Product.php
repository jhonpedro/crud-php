<?php
  require_once('../model/Product.php');

  class ProductBuilder {
    function getProduct($newProduct) {
      if(!isset($newProduct->name)){
        throw new  Exception('missing "name" on product creation');
      }
      if(!isset($newProduct->price)){
        throw new  Exception('missing "price" on product creation');
      }
      if(!isset($newProduct->distributor)){
        throw new  Exception('missing "distributor" on product creation');
      }

      return new Product($newProduct->id,$newProduct->name,$newProduct->price,$newProduct->distributor);
    }
  }
  