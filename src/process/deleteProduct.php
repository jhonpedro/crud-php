<?php
  require_once('../dao/Products.php');

  $idToDelete = $_GET['id'];

  $productDAO = new ProductsDAO();

  $resultDelete = $productDAO->deleteById($idToDelete);


  if($resultDelete == TRUE){
    echo 'Success in delete';
  } else {
    echo 'Failed to delete: ' . $resultDelete;
  }

  $purchaseId = $_GET['purchaseId'];

  echo "
    <script type='text/javascript'>
      location.assign('http://localhost/FinalWork/src/view/listProducts.php?id=$purchaseId')
    </script>
  ";