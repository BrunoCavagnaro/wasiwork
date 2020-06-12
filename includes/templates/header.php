<?php  include 'includes/functions/sessions.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="favicon-wa-32x32.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-wa-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon-wa-32x32.png">
  <link rel="manifest" href="site.webmanifest">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/main.css">
  <!-- GoogleFonts -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <?php
    $file = basename($_SERVER['PHP_SELF']);
    $page = str_replace(".php", "", $file);
    if ($page != "index") {
      echo '<title>WasiWork - ' . ucfirst($page) . '</title>';
    } else {
        echo '<title>WasiWork</title>';
    }
  ?>

</head>
<body>

  <?php  if($page != "login" && $page != "register") { ?>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand navbar-light bg-light shadow">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="img/logowa.png" alt="logo" width="240">
      </a>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="btn btn-link" href="products.php">
            <i class="fas fa-store-alt"></i>
            <span class="nav-link-text">&nbsp;Ir a la tienda</span> 
          </a>
        </li>

        <li class="ml-2 nav-item">
          
          <?php if ( isset($_SESSION['name']) ) { ?>


          <div class="btn-group" role="group" >
            <a class="btn btn-outline-success" href="profile.php">
              <i class="fas fa-user"></i>
              <span class="nav-link-text">&nbsp;<?php echo $_SESSION['name'] ?></span> 
            </a>
            <a class="btn btn-outline-success" href="login.php?logout=true">
              <i class="fas fa-sign-out-alt"></i>
            </a>
          </div>
          

          <?php } else { ?>

          <a class="btn btn-outline-success" href="login.php">
            <i class="fas fa-user"></i>
            <span class="nav-link-text">&nbsp;Iniciar Sesión</span> 
          </a>

          <?php } ?>

        </li>
        
        <li class="ml-2 nav-item">
          <a class="btn btn-outline-primary" href="cart.php">
            <i class="fas fa-shopping-cart"></i>
            <span class="nav-link-text">&nbsp;Carrito</span> 
          </a>
        </li>
      </ul>

    </div>
  </nav>

  <?php } ?>