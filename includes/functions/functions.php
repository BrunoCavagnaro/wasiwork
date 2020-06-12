<?php

function getProducts() {
  include 'db_connection.php';
  try {
    
    return $conn->query("SELECT * FROM products");
    
  } catch (Exception $e) {
    echo "Error!!" . $e->getMessage() . "<br>";
    return false;
  }
}

function getProduct($id) {
  include 'db_connection.php';
  try {
    
    return $conn->query("SELECT * FROM products WHERE idProducts = $id");
    
  } catch (Exception $e) {
    echo "Error!!" . $e->getMessage() . "<br>";
    return false;
  }
}

function getNameCity($code) {
  switch ($code) {
    case '381': return 'Ate'; break;
    case '379': return 'Barranco'; break;
    case '382': return 'Bellavista'; break;
    case '326': return 'Breña'; break;
    case '383': return 'Callao'; break;
    case '385': return 'Carmen de la Legua'; break;
    case '330': return 'Cercado de Lima'; break;
    case '347': return 'Chorrillos'; break;
    case '388': return 'Comas'; break;
    case '389': return 'El Agustino'; break;
    case '342': return 'Independencia'; break;
    case '327': return 'Jesus Maria'; break;
    case '329': return 'La Molina'; break;
    case '390': return 'La Perla'; break;
    case '391': return 'La Punta'; break;
    case '328': return 'La Victoria'; break;
    case '331': return 'Lince'; break;
    case '340': return 'Los Olivos'; break;
    case '332': return 'Magdalena del Mar'; break;
    case '321': return 'Miraflores'; break;
    case '395': return 'Pucusana'; break;
    case '334': return 'Pueblo Libre'; break;
    case '397': return 'Punta Hermosa'; break;
    case '398': return 'Punta Negra'; break;
    case '343': return 'Rimac'; break;
    case '399': return 'San Bartolo'; break;
    case '335': return 'San Borja'; break;
    case '324': return 'San Isidro'; break;
    case '400': return 'San Juan de Lurigancho'; break;
    case '344': return 'San Juan de Miraflores'; break;
    case '378': return 'San Luis'; break;
    case '341': return 'San Martin de Porres'; break;
    case '337': return 'San Miguel'; break;
    case '401': return 'Santa Anita'; break;
    case '402': return 'Santa Maria'; break;
    case '338': return 'Santiago de Surco'; break;
    case '339': return 'Surquillo'; break;
    case '345': return 'Villa Maria del Triunfo'; break;
    case '346': return 'Villa el Salvador'; break;
  }
}

function getCitiesArray() {
  
  $cities = [
    '381' => 'Ate',
    '379' => 'Barranco',
    '382' => 'Bellavista',
    '326' => 'Breña',
    '383' => 'Callao',
    '385' => 'Carmen de la Legua',
    '330' => 'Cercado de Lima',
    '347' => 'Chorrillos',
    '388' => 'Comas',
    '389' => 'El Agustino',
    '342' => 'Independencia',
    '327' => 'Jesus Maria',
    '329' => 'La Molina',
    '390' => 'La Perla',
    '391' => 'La Punta',
    '328' => 'La Victoria',
    '331' => 'Lince',
    '340' => 'Los Olivos',
    '332' => 'Magdalena del Mar',
    '321' => 'Miraflores',
    '395' => 'Pucusana',
    '334' => 'Pueblo Libre',
    '397' => 'Punta Hermosa',
    '398' => 'Punta Negra',
    '343' => 'Rimac',
    '399' => 'San Bartolo',
    '335' => 'San Borja',
    '324' => 'San Isidro',
    '400' => 'San Juan de Lurigancho',
    '344' => 'San Juan de Miraflores',
    '378' => 'San Luis',
    '341' => 'San Martin de Porres',
    '337' => 'San Miguel',
    '401' => 'Santa Anita',
    '402' => 'Santa Maria',
    '338' => 'Santiago de Surco',
    '339' => 'Surquillo',
    '345' => 'Villa Maria del Triunfo',
    '346' => 'Villa el Salvador'
  ];

  return $cities;

}

function getOrdersByCustomer($id) {
  include 'db_connection.php';
  try {
    
    return $conn->query("SELECT * FROM orders WHERE Users_idUsers = $id");
    
  } catch (Exception $e) {
    echo "Error!!" . $e->getMessage() . "<br>";
    return false;
  }
}

function getOrder($id) {
  include 'db_connection.php';
  try {
    
    return $conn->query("SELECT * FROM orders WHERE idOrders = $id");
    
  } catch (Exception $e) {
    echo "Error!!" . $e->getMessage() . "<br>";
    return false;
  }
}

function getCard($id) {
  include 'db_connection.php';
  try {
    
    return $conn->query("SELECT * FROM cards WHERE idCards = $id");
    
  } catch (Exception $e) {
    echo "Error!!" . $e->getMessage() . "<br>";
    return false;
  }
}

function getOrderDetail($id) {
  include 'db_connection.php';
  try {
    
    return $conn->query("SELECT * FROM orderitems WHERE Orders_idOrders = $id");
    
  } catch (Exception $e) {
    echo "Error!!" . $e->getMessage() . "<br>";
    return false;
  }
}