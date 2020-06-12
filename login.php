<?php 

  include 'includes/templates/header.php'; 
  
  if (isset($_GET['logout'])) {
    $_SESSION = array();
  }

?>

<body id="auth">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">¡Bienvenido(a) de nuevo!</h1>
                    <div id="messages"></div>
                  </div>
                  <form id="loginForm" method="post" novalidate>
                    <div class="form-group">
                      <label class="form-label" for="email">Correo electrónico</label>
                      <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese su correo electrónico">
                    </div>
                    <div class="form-group">
                      <label class="form-label" for="pass">Contraseña</label>
                      <input type="password" name="pass" id="pass" class="form-control" placeholder="Ingrese su contraseña">
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="action" id="action" value="login">
                      <input type="submit" name="Submit" value="Iniciar Sesión" class="btn btn-primary btn-block">
                    </div>
                  </form>                 
                  <div class="text-center">
                    <a class="small" href="">Recuperar contraseña</a>
                    <hr>
                    <a href="register.php">¡Únete a la comunidad!</a>
                    <br>
                    <a href="products.php">Ir a la Tienda</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>

<?php include_once 'includes/templates/footer.php'; ?>
