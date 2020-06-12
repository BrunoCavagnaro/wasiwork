<?php

$action = $_POST['action'];

if ($action === "pay") {

  // Recibimos los datos personales y de envio
  $id = $_POST['id'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $amount = $_POST['amount'];

  // Recibimos el metodo de pago
  $payment_method = $_POST['payment_method'];
  $cc_name = $_POST['cc_name'];
  $cc_number = $_POST['cc_number'];
  $cc_expiration = $_POST['cc_expiration'];
  $cc_cvv = $_POST['cc_cvv'];  

  // Procesar el pago (API) suponemos pago exitoso
  if ( procesarPago() ) {

    // Importar conexion
    require_once('../functions/db_connection.php');

    // Preparamos los datos a insertar
    $cc_lastnumbers = substr($cc_number, -4);
    $cc_expmonth = substr($cc_expiration, 0, 2);
    $cc_expyear = substr($cc_expiration, -4);

    // Llenar db de tarjetas
    try {

      $stmt = $conn->prepare("INSERT INTO cards (lastFourNumbers, cvv, expMonth, expYear, nameOnCard, type) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param('sssssi', $cc_lastnumbers, $cc_cvv, $cc_expmonth, $cc_expyear, $cc_name, $payment_method);
      $stmt->execute();
  
      if ($stmt->affected_rows > 0) {

          $inserted_cc_id = $stmt->insert_id;

          $invoice = generateInvoiceNumber($inserted_cc_id);

          date_default_timezone_set("America/Lima");
          $date = date('Y-m-d H:i:s');

          try {

            $stmtOrders = $conn->prepare("INSERT INTO orders (invoiceNumber, totalAmount, timestampPlaced, address, city, Users_idUsers, Cards_idCards) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmtOrders->bind_param('sdsssii', $invoice, $amount, $date, $address, $city, $id, $inserted_cc_id);
            $stmtOrders->execute();

            if ($stmtOrders->affected_rows > 0) {

              $inserted_order_id = $stmtOrders->insert_id;

              // Obtener datos del carrito
              session_start();
              $session_data = stripslashes($_SESSION['shopping_cart']);
              $cart_data = json_decode($session_data, true);

              $success = false;

              foreach($cart_data as $items => $item) {
                try {
                  $stmtOrderItems = $conn->prepare("INSERT INTO orderitems (quantity, price, Orders_idOrders, Products_idProducts) VALUES (?, ?, ?, ?)");
                  $stmtOrderItems->bind_param('idii', $item['qty'], $item['price'], $inserted_order_id, $item['id']);
                  $stmtOrderItems->execute();
      
                  if ($stmtOrderItems->affected_rows > 0) {
                    $success = true;
                  } else {
                    $success = false;
                  }
                  $stmtOrderItems->close();

                } catch (Exception $e) {
                  echo  $e->getMessage();
                }
              }
            }
            $stmtOrders->close();
  
          } catch (Exception $e) {
            echo  $e->getMessage();
          }

      }
  
      $stmt->close();
      $conn->close();

      if ($success) {
        // Limpiamos el carrito de compras
        unset($_SESSION['shopping_cart']);
        header("location:/proyectos/petstore/profile.php");
      }
  
    } catch (Exception $e) {
      echo  $e->getMessage();
    }

  }
}

function procesarPago() {
  return true;
}

function generateInvoiceNumber($number) {
  return date("Ydmhi") . $number;
}