<!DOCTYPE html>
<html lang="pt">
  <?php
    require_once('./partials/head.php');
  ?>
<body>
  <?php
    require_once('./partials/navbar.php');
  ?>

  <h1><span>Listar compras</span></h1>
  <div class="purchaseListWrapper">
    <?php
      require_once('../dao/Purchases.php');

      $dao = new PurchasesDAO();

      $results = $dao->findAll();

      for($i = 0; $i < count($results); $i++){

        $id = $results[$i]->getId();
        $name = $results[$i]->getName();
        $created_at = $results[$i]->getCreatedAt();

        echo '<div class="purchaseList">';
        echo "<a href='/FinalWork/src/view/listProducts.php?id=$id'>";
        echo '<span>';
        echo $id;
        echo '</span>';
        echo '<span>';
        echo $name;
        echo '</span>';
        echo '<span>';
        echo $created_at;
        echo '</span>';
        echo '</a>';
        echo '</div>';

      }
    ?>
  </div>
</body>
</html>