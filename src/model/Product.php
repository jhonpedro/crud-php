<?php

  class Product {
    private $id;
    private $name;
    private $price;
    private $distributor;

    function __construct($id, $name, $price, $distributor) {
      $this->id = $id;
      $this->name = $name;
      $this->price = $price;
      $this->price = $price;
      $this->distributor = $distributor;
    }

    function getId(){
      return $this->id;
    }

    function getName(){
      return $this->name;
    }

    function setName($name){
      $this->name = $name;
    }

    function getPrice(){
      return $this->price;
    }

    function setPrice($price){
      $this->price = $price;
    }

    function getDistributor(){
      return $this->distributor;
    }

  }