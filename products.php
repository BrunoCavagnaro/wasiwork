<?php 

  include 'includes/functions/functions.php';
  include_once 'includes/templates/header.php'; 

?>

  <!-- Hero -->
  <header class="hero hero-2 text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1>PRODUCTOS</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- Products -->
  <section class="products">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 filter-sidebar mb-3 mb-lg-0">

          <div class="filter-sidebar__content">

            <form class="filter-sidebar__form">
              <h5 class="filter-sidebar__title">Filtros</h5>
              <hr>
              <div class="filter-sidebar__group">
                <h6 class="filter-sidebar__title">Talla</h6>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" value="pet-dog" id="pet-dog">
                    <label class="custom-control-label" for="pet-dog">
                      Mediano
                    </label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" value="pet-cat" id="pet-cat">
                    <label class="custom-control-label" for="pet-cat">
                      Grande
                    </label>
                  </div>
              </div>
              <hr>
              <div class="filter-sidebar__group">
                <h6 class="filter-sidebar__title">Productos</h6>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" value="pro-clean" id="pro-clean">
                    <label class="custom-control-label" for="pro-clean">
                      Sillas
                    </label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" value="pro-health" id="pro-health">
                    <label class="custom-control-label" for="pro-health">
                      Escritorios & Mesas
                    </label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" value="pro-food" id="pro-food">
                    <label class="custom-control-label" for="pro-food">
                      Soportes para Laptop
                    </label>
                  </div>
              </div>
              <hr>
              <button type="submit" class="btn btn-block btn-primary">Filtrar</button>
            </form>
            
          </div>

        </div>
  
        <div class="col-lg-9">

          <div class="row">

            <?php 
            
            $productos = getProducts();

            if ($productos->num_rows > 0) {
              foreach($productos as $producto) {
            ?>
              
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="product-card">

                <div class="product-card__petsfor">
                  <?php
                    if ($producto['isSizeMedium']) {
                      echo "<div class='product-card__icon'>
                              <i class='fas fa-dog'></i>
                            </div>";
                    }
                    if ($producto['isSizeBig']) {
                      echo "<div class='product-card__icon'>
                              <i class='fas fa-cat'></i>
                            </div>";
                    }
                  ?>
                </div>
                  <div class="product-card__header">
                    <img src="<?php echo $producto['urlPhoto']; ?>" alt="">
                  </div>
                  <div class="product-card__body card-body">
                    <h6 class="product-card__title">
                      <a href="product.php?id=<?php echo $producto['idProducts']; ?>">
                        <?php echo $producto['name']; ?>
                      </a>
                    </h6>
                    <div class="product-card__footer">
                      <h6 class="product-card__price">S/ <?php echo $producto['price']; ?></h6>
                      <div class="product-card__actions">
                        <form class="add-form" method="POST" action="includes/models/ShoppingCart.php">
                          <input type="hidden" name="name" value="<?php echo $producto['name']; ?>">
                          <input type="hidden" name="price" value="<?php echo $producto['price']; ?>">
                          <input type="hidden" name="urlphoto" value="<?php echo $producto['urlPhoto']; ?>">
                          <input type="hidden" name="id" value="<?php echo $producto['idProducts']; ?>">
                          <input type="hidden" name="action" value="add">
                          <button type="submit" class="btn btn-sm btn-outline-primary">Añadir a carrito</button>
                        </form>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

            <?php
              }
            } else {
                echo "0 results";
            }
            ?>
  
            </div>
        </div>
    
      </div>
    </div>
  </section>

<?php include_once 'includes/templates/footer.php'; ?>