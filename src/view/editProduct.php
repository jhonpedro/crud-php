<!DOCTYPE html>
<html lang="pt">
  <?php
    require_once('./partials/head.php');
    require_once('../dao/Products.php');
    require_once('../dao/Purchases.php');
    require_once('../model/Product.php');

    $productId = $_GET['id'];

    if(!isset($productId)){
      header("Location: /FinalWork/src/view/listPurchases.php");
      exit();
    }
    
    $productsDAO = new ProductsDAO();
    try {
      $product = $productsDAO->findById($productId);
    } catch (\Throwable $th) {
      header("Location: /FinalWork/src/view/listPurchases.php");
      exit();
    }

  ?>
<body>
  <?php
    require_once('./partials/navbar.php');
  ?>
  <h1>Produto: <?php echo $product->getName(); ?></h1>
  

  <form action="../process/updateProduct.php" method="POST" id="formEditProduct">
    <input type="hidden" name="id" value="<?php echo $product->getId(); ?>">
    <input type="hidden" name="purchaseId" value="<?php echo $_GET['purchaseId']; ?>">
    <span>Id: <?php echo $product->getId(); ?></span>
    <label>
      <span>Nome</span>
      <input type="text" name="name" value="<?php echo $product->getName(); ?>">
    </label>
    <label>
      <span>Preço</span>
      <input type="text" name="price" value="<?php echo $product->getPrice(); ?>">
    </label>
    <label>
      <span>Distribuidora</span>
      <input type="text" name="distributor" value="<?php echo $product->getDistributor(); ?>">
    </label>
    <button type="submit" class="btn-primary">Atualizar produto</button>
    <a href="/FinalWork/src/process/deleteProduct.php?id=<?php echo $product->getId(); ?>&purchaseId=<?php echo $_GET['purchaseId']; ?>">
      <button type="button" class="btn-primary-dark">
        Deletar produto
      </button>
    </a>
  </form>

</body>
</html>
