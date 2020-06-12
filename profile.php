<?php 

    include 'includes/functions/functions.php';
    include 'includes/templates/header.php';
    auth_user();

?>

  <!-- Products -->
  <section class="profile">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 order-lg-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Perfil</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#history" data-toggle="tab" class="nav-link">Historial</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Editar</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#settings" data-toggle="tab" class="nav-link">Configuración</a>
                </li>
            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                    <h5 class="mb-3">Perfil de Usuario</h5>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Nombre completo</h6>
                            <p><?php echo $_SESSION['name'] . " " . $_SESSION['lastname']; ?></p>
                            <h6>Correo electrónico</h6>
                            <p><?php echo $_SESSION['email']; ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6>Celular</h6>
                            <p><?php echo $_SESSION['cellphone']; ?></p>
                          <h6>DNI</h6>
                          <p><?php echo $_SESSION['dni']; ?></p>
                        </div>
                    </div>
                    <h5>Dirección de Envío</h5>
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Dirección</h6>
                        <p><?php echo $_SESSION['address'] ? ucfirst($_SESSION['address']) : "N/A"; ?></p>
                      </div>
                      <div class="col-md-6">
                        <h6>Distrito</h6>
                        <p><?php echo $_SESSION['city'] ? getNameCity($_SESSION['city']) : "N/A"; ?></p>
                      </div>
                    </div>
                </div>
                <div class="tab-pane" id="history">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col"># Órden</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $orders = getOrdersByCustomer($_SESSION['id']);
                        if ($orders->num_rows > 0) {
                            foreach($orders as $order) {

                                $timestamp = strtotime($order['timestampPlaced']);
                                $date = date("d/m/Y", $timestamp);

                                echo "<tr>";
                                echo "<td>" . sprintf('%06d', $order['idOrders']) . "</td>";
                                echo "<td>S/ " . $order['totalAmount'] . "</td>";
                                echo "<td>" . $date . "</td>";
                                if ($order['status'] == '1') {
                                    echo "<td class='text-warning'>Pendiente</td>";
                                } elseif ($order['status'] == '2') {
                                    echo "<td class='text-success'>Entregado</td>";
                                } elseif ($order['status'] == '3') {
                                    echo "<td class='text-danger'>Cancelado</td>";
                                }
                                echo "<td><a href='order.php?number=" . $order['idOrders'] . "'>" . "<i class='fas fa-info-circle'></i></a></td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                    </tbody>
                  </table>

                </div>
                <div class="tab-pane" id="edit">
                    <form role="form" id="updateForm" method="post" action="includes/models/User.php">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Nombres</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="name" id="name" value="<?php echo $_SESSION['name']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Apellidos</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="lastname" id="lastname" value="<?php echo $_SESSION['lastname']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Correo electrónico</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="email" name="email" id="email" value="<?php echo $_SESSION['email']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Celular</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="tel" name="cellphone" id="cellphone" value="<?php echo $_SESSION['cellphone']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">DNI/CE</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="dni" id="dni" value="<?php echo $_SESSION['dni']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Dirección</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="address" id="address" value="<?php echo $_SESSION['address']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Distrito</label>
                            <div class="col-lg-3">
                                <select class="custom-select d-block w-100" name="city" id="city">
                                    <?php
                                        $cities = getCitiesArray();
                                        if (isset($_SESSION['city'])) {
                                            foreach ($cities as $key => $value) {
                                                if ($_SESSION['city'] == $key) {
                                                    echo "<option value='" . $key . "' selected>". $value ."</option>";
                                                } else {
                                                    echo "<option value='" . $key . "'>". $value ."</option>";
                                                }
                                            }
                                        } else {
                                            echo "<option value='' selected>---- Escoge ----</option>";
                                            foreach ($cities as $key => $value) {
                                                echo "<option value='" . $key . "'>". $value ."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
                                <input type="hidden" name="action" id="action" value="update">
                                <input type="reset" class="btn btn-secondary" value="Cancelar">
                                <input type="submit" class="btn btn-primary" value="Guardar Cambios">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="settings">
                    <div id="messages"></div>
                    <form role="form" method="post" action="includes/models/User.php" id="updatePassForm">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Contraseña actual</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" id="oldpass" name="oldpass" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Nueva contraseña</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" id="newpass" name="newpass" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Confirmar nueva contraseña</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" id="repnewpass" name="repnewpass" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="hidden" name="id" id="id_pass" value="<?php echo $_SESSION['id']; ?>">
                                <input type="hidden" name="action" id="action_pass" value="update_pass">
                                <input type="reset" class="btn btn-secondary" value="Cancelar">
                                <input type="submit" class="btn btn-primary" value="Cambiar Contraseña">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-lg-1 text-center">
            <img src="<?php echo $_SESSION['urlPhoto']; ?>" class="mx-auto img-fluid img-circle d-block" alt="avatar">
            <h6 class="mt-2">Sube una foto</h6>
            <label class="custom-file text-left">
                <input type="file" id="file" class="custom-file-input" lang="es">
                <span class="custom-file-label" for="file">Seleccionar una foto...</span>
            </label>
        </div>
    </div>
    </div>
  </section>

<?php include_once 'includes/templates/footer.php'; ?>