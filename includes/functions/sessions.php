<?php 

function auth_user() {
  if ( !user_exists() ) {
    header('Location:login.php');
    exit();
  }
}

function user_exists() {
  return isset($_SESSION['name']);
}

function auth_cart() {
  if ( !cart_exists() ) {
    header('Location:cart.php');
    exit();
  }
}


function cart_exists() {
  return isset($_SESSION['shopping_cart']);
}

session_start();