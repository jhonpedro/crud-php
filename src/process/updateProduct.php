<?php
  require_once('../builders/Product.php');
  require_once('../dao/Products.php');

  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $distributor = $_POST['distributor'];

  $newProduct = new \stdClass();
  $newProduct->id = $id;
  $newProduct->name = $name;
  $newProduct->price = $price;
  $newProduct->distributor = $distributor;

  $productBuilder = new ProductBuilder();
  $product = $productBuilder->getProduct($newProduct);

  $productDAO = new ProductsDAO();

  $resultUpdate = $productDAO->update($product);

  if($resultUpdate == TRUE){
    echo 'Sucesso na edição';
  } else {
    echo 'Falha na edição, motivo: ' . $resultUpdate;
  }

  $purchaseId = $_POST['purchaseId'];

  echo "
    <script type='text/javascript'>
        location.assign('http://localhost/FinalWork/src/view/listProducts.php?id=$purchaseId')
    </script>
  ";
