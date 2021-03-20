<?php
  require_once('Connection.php');

  $connection = (new Connection('localhost','root', '12345', 'crud_products'))->connection;
  
  $success = mysqli_query($connection, "
  CREATE TABLE purchases (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
  );");
  
  if(!$success){
    echo "An error ocurred: " . mysqli_error($connection);
    exit();
  }
  
  $success = mysqli_query($connection, "
  CREATE TABLE products (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    purchase_id INT(6) UNSIGNED NOT NULL,
    name VARCHAR(70) NOT NULL,
    price FLOAT NOT NULL,
    distributor VARCHAR(40) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (purchase_id) REFERENCES purchases(id)
  );");
  
  if(!$success){
    echo "An error ocurred: " . mysqli_error($connection);
    exit();
  }
  
  echo 'Tables created successfuly';

  mysqli_close($connection);
