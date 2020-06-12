<?php include_once 'includes/templates/header.php'; ?>

  <!-- Hero -->
  <header class="hero hero-2 text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1>Contáctanos</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- Contact -->
  <section class="contact">
    <div class="container">
      <div class="row">

        <div class="col-md-5 bg-img pr-5"></div>

        <div class="col-md-7 pl-md-4 pl-lg-5">
          <div class="mb-4">
            <h3>Cuéntanos sobre ti</h3>
            <p>Si tiene preguntas o simplemente quiere saludarnos, contáctenos.</p>
          </div>
        
          <form class="contact-form">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="form-label" for="">Tu nombre <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="" placeholder="Juan Perez">
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="">Tu correo electrónico <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="" placeholder="juanperez@gmail.com">
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="">Asunto <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="" placeholder="Servicio de baño">
              </div>
              <div class="form-group col-md-6">
                <label class="form-label" for="">Tu número de celular</label>
                <input type="tel" class="form-control" id="" placeholder="932 201 210">
              </div>
              <div class="form-group col-12">
                <label class="form-label" for="">¿Cómo podemos ayudarte? <span class="text-danger">*</span></label>
                <textarea rows="5" cols="100" class="form-control" id="message" required placeholder="Hola, quisiera..." maxlength="999"></textarea>
              </div>
            </div>
            <div id="success"></div>
            <!-- For success/fail messages -->
            
          </form>
          <div class="text-right">
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Enviar mensaje</button>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php include_once 'includes/templates/footer.php'; ?>