<?php

$action = $_POST['action'];
session_start();

if ($action === 'add') {

  if (isset($_SESSION["shopping_cart"])) {
    $session_data = stripslashes($_SESSION['shopping_cart']);
    $cart_data = json_decode($session_data, true);
  } else {
    $cart_data = array();
  }

  $item_id_list = array_column($cart_data, 'id');


  if ( in_array( $_POST["id"], $item_id_list ) ) {

    foreach($cart_data as $keys => $values) {

      if ($cart_data[$keys]["id"] == $_POST["id"]) {
        if ( isset($_POST['qty']) ) {
          $cart_data[$keys]["qty"] = $_POST["qty"];
        } else {
          $cart_data[$keys]["qty"] = $cart_data[$keys]["qty"] + 1;
        }
      }
    }

  } else {

    $item = array(
      'id' => $_POST['id'],
      'name' => $_POST['name'],
      'price' => $_POST['price'],
      'urlphoto' => $_POST['urlphoto'],
      'qty' => 1
    );

    array_push($cart_data, $item);

  }

  $item_data = json_encode($cart_data);
  $_SESSION["shopping_cart"] = $item_data;

  header("location:/proyectos/petstore/cart.php");

}

if ($action === "delete") {

  $session_data = stripslashes($_SESSION['shopping_cart']);
  $cart_data = json_decode($session_data, true);

  foreach($cart_data as $keys => $values) {
    if ( $cart_data[$keys]['id'] == $_POST["id"] ) {

      unset($cart_data[$keys]);

      if ( empty($cart_data) ) {
        unset($_SESSION['shopping_cart']);
      } else {
        $item_data = json_encode($cart_data);
        $_SESSION['shopping_cart'] = $item_data;
      }

      header("location:/proyectos/petstore/cart.php");

    }
  }

}

if ($action === "clear") {
  unset($_SESSION['shopping_cart']);
  header("location:/proyectos/petstore/cart.php");
}