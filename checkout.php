<?php

  include 'includes/functions/functions.php';
  include 'includes/templates/header.php';
  auth_user();
  auth_cart();
?>

  <section class="cart-section">
    <div class="jumbotron jumbotron-fluid">
      <div class="container text-center">
        <div class="bigcart"></div>
        <h3>Checkout</h3>
      </div>
    </div>
    <div class="container summary-container">
      <div class="row shopping-cart">

        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Resumen</span>
            <?php

              $total = 0;
              $session_data = stripslashes($_SESSION['shopping_cart']);
              $cart_data = json_decode($session_data, true);
              $count =  count($cart_data);

            ?>
            <span class="badge badge-success badge-pill"><?php echo $count; ?></span>
          </h4>

          <ul class="list-group mb-3">
          <?php 

            foreach($cart_data as $keys => $values) {

          ?>
          
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?php echo $values['name']; ?></h6>
                <small class="text-muted">Cantidad: <?php echo $values['qty']; ?></small>
                <br>
                <small class="text-muted">P. unidad: S/ <?php echo $values['price']; ?></small>
              </div>
              <span class="text-muted">S/ <?php echo number_format($values["qty"] * $values["price"],2 ); ?></span>
            </li>

          <?php
              $total = $total + ($values["qty"] * $values["price"]);
            }

          ?>
            <li class="list-group-item d-flex justify-content-between">
              <span class="font-weight-bold">Total (PEN)</span>
              <strong>S/ <?php echo number_format($total, 2); ?></strong>
            </li>
          </ul>
        </div>

        <div class="col-md-8 order-md-1">
          <div class="summary">
            <h4 class="mb-3">Datos personales</h4>
            <form method="post" action="includes/models/Checkout.php">
              <div class="row">
                <div class="col-md-6 mb-2">
                  <label class="form-label" for="name">Nombres</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['name']; ?>" disabled>
                </div>
                <div class="col-md-6 mb-2">
                  <label class="form-label" for="lastName">Apellidos</label>
                  <input type="text" class="form-control" id="lastName" name="lastname" value="<?php echo $_SESSION['lastname']; ?>" disabled>
                </div>
            
                <div class="col-md-8 mb-2">
                  <label class="form-label" for="email">Correo electrónico</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" disabled>
                </div>
                <div class="col-md-4 mb-2">
                  <label class="form-label" for="dni">DNI/CE</label>
                  <input type="text" class="form-control" id="dni" name="id" value="<?php echo $_SESSION['dni']; ?>" disabled>
                </div>
              </div>
              <small class="text-muted">*Para cambiar tus datos personales, debes ir a tu perfil.</small>

              <hr class="mb-4">
              <h4 class="mb-3">Dirección de envío</h4>

              <div class="row">
                <div class="col-md-8 mb-2">
                  <label class="form-label" for="address">Dirección</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="<?php echo $_SESSION['address']; ?>" required>
                </div>
              
                <div class="col-md-4 mb-2">
                  <label class="form-label" for="country">Distrito*</label>
                  <select class="custom-select d-block w-100" id="city" name="city" required>
                  <?php
                      $cities = getCitiesArray();
                      if (isset($_SESSION['city'])) {
                          foreach ($cities as $key => $value) {
                              if ($_SESSION['city'] == $key) {
                                  echo "<option value='" . $key . "' selected>". $value ."</option>";
                              } else {
                                  echo "<option value='" . $key . "'>". $value ."</option>";
                              }
                          }
                      } else {
                          echo "<option value='' selected>---- Escoge ----</option>";
                          foreach ($cities as $key => $value) {
                              echo "<option value='" . $key . "'>". $value ."</option>";
                          }
                      }
                  ?>
                  </select>
                </div>
              </div>

              <span>*Por el momento solo enviamos a todo Lima.</span>

              <hr class="mb-4">
              <h4 class="mb-3">Pago</h4>

              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="credit" name="payment_method" type="radio" class="custom-control-input" checked required>
                  <label class="custom-control-label" for="credit" value="1">Tarjeta de crédito</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="debit" name="payment_method" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="debit" value="2">Tarjeta de débito</label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-lg-6 mb-2">
                  <label class="form-label" for="cc_name">Nombre en la tarjeta</label>
                  <input type="text" class="form-control" id="cc_name" name="cc_name" placeholder="John Ja" required>
                  <small class="text-muted">*Nombre completo que aparece en la tarjeta</small>
                </div>
                <div class="col-md-12 col-lg-6 mb-2">
                  <label class="form-label" for="cc_number">Número de tarjeta</label>
                  <input type="text" class="form-control" id="cc_number" name="cc_number" placeholder="1234 1234 1234 1234" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-lg-4 mb-2">
                  <label class="form-label" for="cc_expiration">Fecha de expiración</label>
                  <input type="text" class="form-control" id="cc_expiration" name="cc_expiration" placeholder="12/2022" required>
                </div>
                <div class="col-md-6 col-lg-3 mb-2">
                  <label class="form-label" for="cc_cvv">CVV</label>
                  <input type="text" class="form-control" id="cc_cvv" name="cc_cvv" placeholder="123" required>
                </div>
              </div>
              <hr class="mb-4">
              <input type="hidden" name="amount" id="amount" value="<?php echo $total; ?>">
              <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
              <input type="hidden" name="action" id="action" value="pay">
              <button class="btn btn-primary btn-lg btn-block" type="submit">Realizar pago</button>
              <hr class="mb-4">
              <a href="cart.php" class="btn btn-secondary btn-lg btn-block" >Volver al carrito</a>
            </form>

          </div>
        </div>

      </div>
    </div>
  </section>

<?php include_once 'includes/templates/footer.php'; ?>