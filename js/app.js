document.addEventListener('DOMContentLoaded', function() {
  let linkPicDiv = document.getElementsByClassName('thumb-link');

  for (let i = 0; i < linkPicDiv.length; i++) {
    linkPicDiv[i].addEventListener('click', function(e) {
      e.preventDefault();
      // Obtener el link de la imagen
      const link = linkPicDiv[i].getAttribute('href');

      // Obtener el img element del imgBox div
      const imgBox = document
        .getElementsByClassName('img-box')[0]
        .getElementsByTagName('img')[0];

      // Camibar el atributo src
      imgBox.setAttribute('src', link);
    });
  }

  // Formularios de Login y Registro

  if (document.querySelector('#loginForm')) {
    loginUsers();
  }
  if (document.querySelector('#registerForm')) {
    createUsers();
  }
  if (document.querySelector('#updatePassForm')) {
    updatePassword();
  }

  function createUsers() {
    document
      .querySelector('#registerForm')
      .addEventListener('submit', function(e) {
        e.preventDefault();

        // Validar el registro
        let names = document.querySelector('#names').value,
          lastname = document.querySelector('#lastname').value,
          cellphone = document.querySelector('#cellphone').value,
          dni = document.querySelector('#dni').value,
          email = document.querySelector('#email').value,
          pass = document.querySelector('#pass').value,
          repass = document.querySelector('#repass').value;
        action = document.querySelector('#action').value;

        let messages = [];

        // Todos los campos llenos
        if (
          pass.trim() == '' ||
          names.trim() == '' ||
          lastname.trim() == '' ||
          cellphone.trim() == '' ||
          dni.trim() == '' ||
          email.trim() == '' ||
          repass.trim() == ''
        ) {
          messages.push('Todos los campos son obligatorios');
        }
        if (pass !== repass) {
          messages.push('Las contraseñas no coinciden.');
        }
        if (!validateEmail(email)) {
          messages.push('Formato de correo electrónico es inválido.');
        }
        if (!validateDni(dni)) {
          messages.push('El DNI debe tener 8 dígitos');
        }
        if (!validateCellphone(cellphone)) {
          messages.push('El celular debe tener 9 dígitos');
        }
        if (!validatePassword(pass)) {
          messages.push(
            'La contraseña debe tener 1 número, 1 letra mayúscula, 1 letra minúscula y debe medir entre 7 a 20 caracteres.'
          );
        }

        if (messages.length > 0) {
          document.querySelector('#messages').innerHTML = `<div id='messages'>
              <div class="alert alert-danger text-left" role="alert">
                <ul id="ul-messages" class="m-0">
                </ul>
              </div> 
            </div>`;

          for (let i = 0; i < messages.length; i++) {
            let li = document.createElement('li');
            var node = document.createTextNode(messages[i]);
            li.appendChild(node);
            document.querySelector('#ul-messages').appendChild(li);
          }
        } else {
          // Data que se envia al servidor
          let data = new FormData();
          data.append('names', names);
          data.append('lastname', lastname);
          data.append('cellphone', cellphone);
          data.append('dni', dni);
          data.append('email', email);
          data.append('pass', pass);
          data.append('action', action);

          // EJECUTAR AJAX
          // 1) Crear llamado a Ajax
          let xhr = new XMLHttpRequest();

          // 2) Abrir la conexion
          xhr.open('POST', 'includes/models/User.php', true);

          // 3) Retorno de datos
          xhr.onload = function() {
            if (this.status === 200) {
              let response = JSON.parse(xhr.responseText);

              // Si la respuesta es correcta
              if (response.success === 1) {
                document.querySelector(
                  '#messages'
                ).innerHTML = `<div id='messages'>
                <div class="alert alert-success" role="alert">
                  Usuario creado correctamente.
                </div> 
              </div>`;

                setTimeout(function() {
                  window.location.href = 'login.php';
                }, 2000);
              }
            }
          };

          // 4) Enviar la peticion
          xhr.send(data);
        }
      });
  }

  function loginUsers() {
    document
      .querySelector('#loginForm')
      .addEventListener('submit', function(e) {
        e.preventDefault();

        // Validar el registro
        let email = document.querySelector('#email').value,
          pass = document.querySelector('#pass').value,
          action = document.querySelector('#action').value;

        // Todos los campos llenos
        if (pass.trim() == '' || email.trim() == '') {
          document.querySelector('#messages').innerHTML = `<div id='messages'>
            <div class="alert alert-danger" role="alert">
              Todos los campos son obligatorios.
            </div> 
          </div>`;
        } else {
          // Data que se envia al servidor
          let data = new FormData();
          data.append('email', email);
          data.append('pass', pass);
          data.append('action', action);

          // EJECUTAR AJAX
          // 1) Crear llamado a Ajax
          let xhr = new XMLHttpRequest();

          // 2) Abrir la conexion
          xhr.open('POST', 'includes/models/User.php', true);

          // 3) Retorno de datos
          xhr.onload = function() {
            if (this.status === 200) {
              let response = JSON.parse(xhr.responseText);

              // Si la respuesta es correcta
              if (response.success === 1) {
                window.location.href = 'products.php';
              } else {
                document.querySelector(
                  '#messages'
                ).innerHTML = `<div id='messages'>
                <div class="alert alert-danger" role="alert">
                  ${response.error}
                </div> 
              </div>`;
              }
            }
          };

          // 4) Enviar la peticion
          xhr.send(data);
        }
      });
  }

  function updatePassword() {
    document
      .querySelector('#updatePassForm')
      .addEventListener('submit', function(e) {
        e.preventDefault();

        // Validar el registro
        let oldpass = document.querySelector('#oldpass').value,
          newpass = document.querySelector('#newpass').value,
          repnewpass = document.querySelector('#repnewpass').value,
          id = document.querySelector('#id_pass').value,
        action = document.querySelector('#action_pass').value;

        let messages = [];

        if (newpass !== repnewpass) {
          messages.push('Las contraseñas no coinciden.');
        }
        if (!validatePassword(newpass)) {
          messages.push(
            'La nueva contraseña debe tener 1 número, 1 letra mayúscula, 1 letra minúscula y debe medir entre 7 a 20 caracteres.'
          );
        }

        if (messages.length > 0) {
          document.querySelector('#messages').innerHTML = `<div id='messages'>
              <div class="alert alert-danger text-left" role="alert">
                <ul id="ul-messages" class="m-0">
                </ul>
              </div> 
            </div>`;

          for (let i = 0; i < messages.length; i++) {
            let li = document.createElement('li');
            var node = document.createTextNode(messages[i]);
            li.appendChild(node);
            document.querySelector('#ul-messages').appendChild(li);
          }
        } else {
          document.querySelector('#messages').innerHTML = `<div id='messages'></div>`;
          // Data que se envia al servidor
          let data = new FormData();
          data.append('oldpass', oldpass);
          data.append('newpass', newpass);
          data.append('id', id);
          data.append('action', action);

          // EJECUTAR AJAX
          // 1) Crear llamado a Ajax
          let xhr = new XMLHttpRequest();

          // 2) Abrir la conexion
          xhr.open('POST', 'includes/models/User.php', true);

          // 3) Retorno de datos
          xhr.onload = function() {
            if (this.status === 200) {
              let response = JSON.parse(xhr.responseText);

              // Si la respuesta es correcta
              if (response.success === 1) {
                document.querySelector(
                  '#messages'
                ).innerHTML = `<div id='messages'>
                <div class="alert alert-success" role="alert">
                  Contraseña actualizada.
                </div> 
              </div>`;

                document.querySelector('#updatePassForm').reset();
                
              } else {
                document.querySelector(
                  '#messages'
                ).innerHTML = `<div id='messages'>
                <div class="alert alert-danger" role="alert">
                  Contraseña actual es incorrecta.
                </div> 
              </div>`;
              }
            }
          };

          // 4) Enviar la peticion
          xhr.send(data);
        }
      });
  }


  function validateEmail(email) {
    let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }
  function validateDni(dni) {
    let re = /^\d{8}$/;
    return re.test(dni);
  }
  function validateCellphone(cellphone) {
    let re = /^\d{9}$/;
    return re.test(cellphone);
  }
  function validatePassword(pass) {
    let re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
    return re.test(pass);
  }

});
