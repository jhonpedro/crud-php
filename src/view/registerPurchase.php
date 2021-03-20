<!DOCTYPE html>
<html lang="pt">
  <?php
    require_once('./partials/head.php');
  ?>
<body>
  <?php
    require_once('./partials/navbar.php');
  ?>

  <h1><span>Cadastrar compras</span></h1>
  <form action="../process/registerPurchase.php" method="POST" id="formRegisterPurchase">
    <label>
      <span>Nome da compra </span>
      <input type="text" name="purchaseName">
    </label>
    <div class="informations">
      <strong>Produtos</strong>
      <button type="button" id="addProduct" class="btn-primary" >Adicionar produto</button>
    </div>
    <div id="products">
      <div id="product_1" class="product">
        <label>
          <span>Nome </span>
          <input type="text" name="product_1_name">
        </label>
        <label>
          <span>Preço </span>
          <input type="number" step="0.01" name="product_1_price">
        </label>
        <label>
          <span>Distribuidora </span>
          <input type="text" name="product_1_distributor">
        </label>
      </div>
    </div>

    <button type="submit" class="btn-primary">Enviar</button>
  </form>
</body>
<script type="text/javascript">
  const products = document.getElementById('products')

  function getCurrentProductId(){
    return Number(products.lastElementChild.id.split('_')[1])
  }

  function createLabel(currentName, type, innerTextInSpan){
    const labelForType = document.createElement('label')
    
    const spanForType = document.createElement('span')
    spanForType.innerText = innerTextInSpan

    const inputForType = document.createElement('input')
    if(type === 'price'){
      inputForType.type = 'number'
      inputForType.step = '0.01'
    } else {
      inputForType.type = "text"
    }
    inputForType.name = `${currentName}_${type}`

    labelForType.appendChild(spanForType)
    labelForType.appendChild(inputForType)

    return labelForType
  }

  document.getElementById('addProduct').addEventListener('click', function () {
    const currentProductName = `product_${getCurrentProductId() + 1}`
    const divWrapper = document.createElement('div')
    divWrapper.id = currentProductName
    divWrapper.classList = "product"

    const labelForName = createLabel(currentProductName, 'name', 'Nome ')
    const labelForPrice = createLabel(currentProductName, 'price', 'Preço ')
    const labelForDistributor = createLabel(currentProductName, 'distributor', 'Distribuidora ')

    divWrapper.appendChild(labelForName)
    divWrapper.appendChild(labelForPrice)
    divWrapper.appendChild(labelForDistributor)

    products.appendChild(divWrapper)
  })

</script>
</html>