<!DOCTYPE html>
<html lang="pt">
  <?php
    require_once('./partials/head.php');
    require_once('../dao/Products.php');
    require_once('../dao/Purchases.php');
    require_once('../model/Product.php');

    $purchaseId = $_GET['id'];
  
    if(!isset($purchaseId)){
      header("Location: /FinalWork/src/view/listPurchases.php");
    }

    $productsDAO = new ProductsDAO();
    try {
      $products = $productsDAO->findByPurchaseId($purchaseId);
    } catch (\Throwable $th) {
      header("Location: /FinalWork/src/view/listPurchases.php");
      exit();
    }

    $purchasesDAO = new PurchasesDAO();
    $purchase = $purchasesDAO->findById($purchaseId);
  ?>
<body>
  <?php
    require_once('./partials/navbar.php');
  ?>

  <h1>Compra: <?php echo $purchase->getName(); ?></h1>
  <?php
    for($i = 0; $i < count($products); $i++){
      echo '<div class="productList">';
      echo '<a href=/FinalWork/src/view/editProduct.php?id=' . $products[$i]->getId() . '&' . 'purchaseId='. $purchase->getId() . '>';
      echo "<span>Nome: " . $products[$i]->getName() . "</span>";
      echo "<span>Preço: " . $products[$i]->getPrice() . "</span>";
      echo "<span>Distribuidora: " . $products[$i]->getDistributor() . "</span>";
      echo '</a>';
      echo '</div>';
    }
  ?>

</body>
</html>
