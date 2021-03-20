<?php
  require_once('Connection.php');

  $connection = mysqli_connect('localhost', 'root','12345');

  $success = mysqli_query($connection, "CREATE DATABASE IF NOT EXISTS crud_products;");

  if(!$success){
    echo "An error ocurred: " . mysqli_error($connection);
    exit();
  }
  
  echo 'Database created successfuly';

  mysqli_close($connection);
