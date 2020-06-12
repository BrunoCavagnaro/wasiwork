<?php include_once 'includes/templates/header.php'; ?>

<body id="auth">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
              <div class="col-lg-7">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">¡Regístrate!</h1>
                    <div id="messages"></div>
                  </div>
                  <form id="registerForm" method="post" novalidate>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label class="form-label" for="names">Nombres <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="names" id="names">
                      </div>
                      <div class="form-group col-md-6">
                        <label class="form-label" for="lastname">Apellidos <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="lastname" id="lastname">
                      </div>
                      <div class="form-group col-md-6">
                        <label class="form-label" for="cellphone">Celular <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" name="cellphone" id="cellphone">
                      </div>
                      <div class="form-group col-md-6">
                        <label class="form-label" for="dni">DNI <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="dni" id="dni">
                      </div>
                      <div class="form-group col-md-12">
                        <label class="form-label" for="email">Correo electrónico <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email">
                      </div>
                      <div class="form-group col-md-6">
                        <label class="form-label" for="pass">Contraseña <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="pass" id="pass">
                      </div>
                      <div class="form-group col-md-6">
                        <label class="form-label" for="repass">Repetir contraseña <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="repass" id="repass">
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="action" id="action" value="create">
                      <input type="submit" name="submit" value="Regístrate" class="btn btn-primary btn-block">
                    </div>
                  </form>                 
                  <hr>
                  <div class="text-center">
                    <a href="login.php">¿Ya tienes cuenta?</a>
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
