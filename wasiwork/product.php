<?php

  include 'includes/functions/functions.php';
  include 'includes/templates/header.php';

  $idProduct = filter_var($_GET['id'], FILTER_VALIDATE_INT);

  if (!$idProduct) {
    die(header("Location: 404.html"));
  }

  $result = getProduct($idProduct);

  if ($result->num_rows) {
    $product = $result->fetch_assoc();
  } else {
    die(header("Location: 404.html"));
  }  

?>

  <!-- Products -->
  <section class="products">
    <div class="container">
      <div class="goback">
        <a href="products.php" class="goback__link">
          <i class="fas fa-chevron-left"></i>
          Ver todos los productos
        </a>
      </div>
      <div class="product-main">
        <div class="row">
          <div class="col-md-12 col-lg-7">
            <ul class="thumb-ul">
              <li class="thumb-li">
                <a class="thumb-link stretched-link" href="<?php echo $product['urlPhoto']; ?>" target="img-box">
                  <img src="<?php echo $product['urlPhoto']; ?>" alt="<?php echo $product['name']; ?>">
                </a>
              </li>
            </ul>

            <div class="img-box">
              <img src="<?php echo $product['urlPhoto']; ?>" alt="">
            </div>
          </div>
          <div class="col-md-12 col-lg-5">
            <div class="product-info">
              <h4 class="product-info__title"><?php echo $product['name']; ?></h4>
              <p class="product-info__description">
              <?php echo $product['description']; ?>
              </p>
              <div class="product-info__actions">

                <p class="product-info__price">Precio: <span>S/ <?php echo $product['price']; ?></span></p>

                <form class="add-form" method="POST" action="includes/models/ShoppingCart.php">
                  <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
                  <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                  <input type="hidden" name="urlphoto" value="<?php echo $product['urlPhoto']; ?>">
                  <input type="hidden" name="id" value="<?php echo $product['idProducts']; ?>">
                  <input type="hidden" name="action" value="add">
                  <button type="submit" class="btn btn-sm btn-primary">Agregar a carrito</button>
                </form>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php include_once 'includes/templates/footer.php'; ?>