<?php 

  include_once 'includes/templates/header.php'; 
  
  
?>

  <section class="cart-section">
    <div class="jumbotron jumbotron-fluid">
      <div class="container text-center">
        <div class="bigcart"></div>
        <h3>Tu Carrito de Compras</h3>
      </div>
    </div>
    <div class="container summary-container">
      <div class="row shopping-cart">

        <?php
          if (isset($_SESSION["shopping_cart"])) {
        ?>

        <div class="col-md-12 col-lg-8">

          <?php

            $total = 0;
            $subtotal = 0;
            $session_data = stripslashes($_SESSION['shopping_cart']);
            $cart_data = json_decode($session_data, true);

            foreach($cart_data as $keys => $values) {
          
          ?>

          <div class="shopping-card">
            <div class="shopping-card__img">
              <img src="<?php echo $values['urlphoto']; ?>" alt="producto img">
            </div>

            <div class="shopping-card__info">
              <div class="shopping-card__name"><?php echo $values['name']; ?></div>
              <div class="shopping-card__price">S/ <?php echo $values['price']; ?></div>
            </div>

            <div class="shopping-card__extra">
              <form class="shopping-card__update" action="includes/models/ShoppingCart.php" method="POST">
                <input type="number" min="1" class="form-control form-control-sm shopping-card__input" name="qty" value="<?php echo $values['qty']; ?>">
                <input type="hidden" name="id" value="<?php echo $values['id']; ?>">
                <input type="hidden" name="action" value="add">
                <button type="submit" class="btn btn-sm btn-link">Actualizar</button>
              </form>
              <form class="shopping-card__update" action="includes/models/ShoppingCart.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $values['id']; ?>">
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="btn btn-link text-danger">Eliminar</button>
              </form>
            </div>
          </div>
          
          <?php 
              $subtotal = $subtotal + ($values["qty"] * ($values["price"]/1.18));
              $total = $total + ($values["qty"] * $values["price"]);
            }
          ?>

          <form action="includes/models/ShoppingCart.php" method="post">
            <input type="hidden" name="action" value="clear">
            <button type="submit" class="btn btn-warning">Limpiar carrito</button>
          </form>

        </div>

        <div class="col-md-12 col-lg-4">
          <div class="summary">
            <h3>Resumen</h3>
            <div class="summary-item">
              <span class="text font-weight-normal">Subtotal</span>
              <span class="price">S/ <?php echo number_format($subtotal, 2); ?></span>
            </div>
            <div class="summary-item">
              <span class="text font-weight-normal">IGV</span>
              <span class="price">S/ <?php echo number_format($total - $subtotal, 2); ?></span>
            </div>
            <div class="summary-item">
              <span class="text">Total</span>
              <span class="price font-weight-bold">S/ <?php echo number_format($total, 2); ?></span>
            </div>

            <a href="checkout.php" class="btn btn-primary btn-block">Checkout</a>

          </div>
        </div>

        <?php } else { ?>

          <div class="container text-center">
            <div class='alert alert-info'>
              <h3>No has agregado ningún producto</h3>
              <br>
              <h4 class="font-weight-light"><a href="products.php" class="text-info"><b>Regresa a la tienda</b></a> para poder agregar los mejores productos para tus mascotas</h4>
            </div>
          </div>
            
          
        <?php } ?>

      </div>
    </div>
  </section>

<?php include_once 'includes/templates/footer.php'; ?>