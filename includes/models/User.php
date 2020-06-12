<?php 

$action = $_POST['action'];

if ($action === 'create') {

  // Codigo para crear usuarios
  $names = $_POST['names'];
  $lastname = $_POST['lastname'];
  $dni = $_POST['dni'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $cellphone = $_POST['cellphone'];
  $country = "Perú";
  $state = "Lima";

  // Hashear el password
  $opciones = array(
    'cost' => 12
  );
  $hash_pass = password_hash($pass, PASSWORD_BCRYPT, $opciones);

  // Importar conexion
  require_once('../functions/db_connection.php');

  try {

    $stmt = $conn->prepare("INSERT INTO users (names, lastnames, email, cellphone, dni, pass, country, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssissss', $names, $lastname, $email, $cellphone, $dni, $hash_pass, $country, $state);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response = array(
          'success' => 1,
          'inserted_id' => $stmt->insert_id,
          'action' => $action
        );
    }

    
    $stmt->close();
    $conn->close();

  } catch (Exception $e) {

    $response = array(
      'success' => 0,
      'error' => $e->getMessage()
    );

  }
  echo json_encode($response);

}

if ($action === 'login') {
  $email = $_POST['email'];
  $pass = $_POST['pass'];

  // Importar conexion
  require_once('../functions/db_connection.php');

  try {
    
    $stmt = $conn->prepare("SELECT idUsers, names, lastnames, email, cellphone, dni, pass, address, city, urlPhoto FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $stmt->bind_result($id_user, $name_user, $lastname_user, $email_user, $cellphone_user, $dni_user, $pass_user, $address_user, $city_user, $urlPhoto_user);
    $stmt->fetch();
    if ($email_user) {
      
      if ( password_verify($pass, $pass_user) ) {

        // Iniciar Sesion
        session_start();
        $_SESSION['id'] = $id_user;
        $_SESSION['name'] = $name_user;
        $_SESSION['lastname'] = $lastname_user;
        $_SESSION['email'] = $email_user;
        $_SESSION['cellphone'] = $cellphone_user;
        $_SESSION['dni'] = $dni_user;
        $_SESSION['address'] = $address_user;
        $_SESSION['city'] = $city_user;
        $_SESSION['urlPhoto'] = $urlPhoto_user;


        
        $response = array(
          'success' => 1,
          'id' => $id_user,
          'name' => $name_user,
          'lastname' => $lastname_user,
          'email' => $email_user,
          'cellphone' => $cellphone_user,
          'dni' => $dni_user,
          'pass' => $pass_user,
          'address' => $address_user,
          'city' => $city_user,
          'urlPhoto' => $urlPhoto_user,
          'action' => $action
        );
      } else {
        $response = array(
          'success' => 0,
          'error' => 'Usuario y/o contraseña incorrecta.'
        );
      }
    } else {
      $response = array(
        'success' => 0,
        'error' => 'Usuario y/o contraseña incorrecta.'
      );
    }

    $stmt->close();
    $conn->close();

  } catch (Exception $e) {

    $response = array(
      'success' => 0,
      'error' => $e->getMessage()
    );

  }
  echo json_encode($response);
}

if ($action === 'update') {

  $email = $_POST['email'];
  $name = $_POST['name'];
  $lastname = $_POST['lastname'];
  $cellphone = $_POST['cellphone'];
  $dni = $_POST['dni'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $id = $_POST['id'];

  // Importar conexion
  require_once('../functions/db_connection.php');

  try {
    
    $stmt = $conn->prepare("UPDATE users SET names = ?, lastnames = ?, email = ?, cellphone = ?, dni = ?, address = ?, city = ? WHERE idUsers = $id");
    $stmt->bind_param('sssissi', $name, $lastname, $email, $cellphone, $dni, $address, $city);
    $stmt->execute();

    if ($stmt->affected_rows == 1) {
      session_start();
      $_SESSION['name'] = $name;
      $_SESSION['lastname'] = $lastname;
      $_SESSION['email'] = $email;
      $_SESSION['cellphone'] = $cellphone;
      $_SESSION['dni'] = $dni;
      $_SESSION['address'] = $address;
      $_SESSION['city'] = $city;

    }

    $stmt->close();
    $conn->close();

    header("location:/proyectos/petstore/profile.php");

  } catch (Exception $e) {

    echo "Hubo un error: " . $e->getMessage();

  }
}

if ($action === "update_pass") {
  
  $oldpass = $_POST['oldpass'];
  $newpass = $_POST['newpass'];
  $id = $_POST['id'];

  // Hashear el password
  $opciones = array(
    'cost' => 12
  );
  $hash_pass = password_hash($newpass, PASSWORD_BCRYPT, $opciones);

  // Importar conexion
  require_once('../functions/db_connection.php');

  try {
    
    if (verifyPassword($conn, $id, $oldpass)) {

      $stmt = $conn->prepare("UPDATE users SET pass = ? WHERE idUsers = $id");
      $stmt->bind_param('s', $hash_pass);
      $stmt->execute();
  
      if ($stmt->affected_rows == 1) {
        $response = array(
          'success' => 1
        );
      } else {
        $response = array(
          'success' => 0
        );
      }
  
      $stmt->close();
      $conn->close();

    } else {
      $response = array(
        'success' => 0
      );
    }

  } catch (Exception $e) {
    $response = array(
      'success' => 0,
      'error' => $e->getMessage()
    );
  }

  echo json_encode($response);
}

function verifyPassword($conn ,$id, $pass_user) {
  try {
    $result = $conn->query("SELECT pass FROM users WHERE idUsers = $id");
    if ($result->num_rows > 0) {
      $result = $result->fetch_assoc();
      if (password_verify($pass_user, $result['pass'])) {
        return true;
      } else {
        return false;
      }
    }
  } catch (Exception $e) {
    return false;
  } 
}
