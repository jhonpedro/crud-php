<?php

  class Purchase {
    private $id;
    private $name;
    private $created_at;

    function __construct($id, $name, $created_at) {
      $this->id = $id;
      $this->name = $name;
      $this->created_at = $created_at;
    }

    function getId(){
      return $this->id;
    }

    function getName(){
      return $this->name;
    }

    function getCreatedAt(){
      return $this->created_at;
    }

  }