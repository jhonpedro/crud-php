<!DOCTYPE html>
<html lang="pt">
<?php
  require_once('../view/partials/head.php')
?>
<body>
  <?php
    require_once('../database/Connection.php');

    $purchaseName = $_POST['purchaseName'];

    $productsArr = [];

    $i = 1;
    while(true){
      if(!isset($_POST['product_' . "$i" . '_name'])){
        break;
      }

      if($_POST['product_' . "$i" . '_name'] &&
      $_POST['product_' . "$i" . '_price'] &&
      $_POST['product_' . "$i" . '_distributor']){
        $productObj = new \stdClass();
        $productObj->name = $_POST['product_' . "$i" . '_name'];
        $productObj->price = $_POST['product_' . "$i" . '_price'];
        $productObj->distributor = $_POST['product_' . "$i" . '_distributor'];

        array_push($productsArr, $productObj);

        $i++;
      }
    }

    $connection = (new Connection('localhost','root', '12345', 'crud_products'))->connection;

    $purchaseInserted = mysqli_query($connection, "INSERT INTO purchases (name) VALUES ('$purchaseName')");

    if(!$purchaseInserted){
      echo "Error in purchase creation!!!";
      echo mysqli_error($connection);
      exit();
    }

    $rs = mysqli_query($connection, "SELECT LAST_INSERT_ID()");

    if(!$rs){
      echo "Error in get last id";
      exit();
    }

    $result = mysqli_fetch_assoc($rs);

    $lastId = $result['LAST_INSERT_ID()'];

    $values = '';

    $productsArrLen = count($productsArr);

    for($i = 0; $i < $productsArrLen; $i++){
      if($i == $productsArrLen - 1){
        $values .= "( '" . $productsArr[$i]->name . "', '" . $productsArr[$i]->price . "', '" . $productsArr[$i]->distributor . "', '". $lastId . "')";
        continue;
      }
      $values .= "( '" . $productsArr[$i]->name . "', '" . $productsArr[$i]->price . "', '" . $productsArr[$i]->distributor . "', '". $lastId . "'),";
    }

    $productsInserted = mysqli_query($connection, "INSERT INTO products (name, price, distributor, purchase_id) VALUES $values");

    if(!$productsInserted){
      echo "<div class='error'>Error in products insertion: " . mysqli_error($connection) . "</div>";
    } else {
      echo "<div class='success'>Success</div";
    }

    mysqli_close($connection);
  ?>
  
</body>
<script type="text/javascript">
  <?php
    echo "
      (async function (){
        location.assign('http://localhost/FinalWork/src/view/listPurchases.php')
      })()
    ";
  ?>
</script>
</html>