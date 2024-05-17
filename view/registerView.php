<?php
namespace views;
?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/styles/css/register.css" />
    <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />

    <title>Registro de Usuario - Genesis</title>
  </head>
  <body style="background-color: #e6e6fa">
   
    <div class="wrapper">
        <div class="form-box login">
            <div class="encabezado">
                <h2 style="color: #8350f2;">Crear una cuenta</h2>
                <img class="logo" src="../assets/img/genesis logo sin fondo.png" alt="logo">
            </div>
            <form method="POST" action="../controller/registerController.php" style="margin-top:-40px;">
                <div class="input-box">
                    <input type="text" required placeholder="Nombre" id="nombre" name="nombre" autocomplete="nope">
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Primer Apellido" id="primer_apellido" name="primer_apellido" autocomplete="nope">
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Segundo Apellido" id="segundo_apellido" name="segundo_apellido" autocomplete="nope">
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Teléfono (9 dígitos)" id="telefono" name="telefono" digitsonly="true" autocomplete="nope">
                    <span id="errorTelefono" class="error-message"></span>
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="DNI (8 dígitos y una letra)" id="dni" name="dni" autocomplete="nope">
                    <span id="errorDNI" class="error-message"></span>
                </div>
                <div class="input-box">
                <input type="text" required placeholder="Código Postal" id="codigo_postal" name="codigo_postal" digitsonly="true" autocomplete="nope">
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Nombre de la calle o avenida" id="calle" name="calle" autocomplete="nope">
                </div>
                <div class="input-box">
                <input type="text" required placeholder="Número del bloque o casa" id="numero_bloque" name="numero_bloque" digitsonly="true" autocomplete="nope">
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Piso" id="piso" name="piso" autocomplete="nope">
                </div>
                <div class="input-box">
                    <input type="email" required placeholder="Email" id="email" name="email" autocomplete="nope">
                    <span id="errorEmail" class="error-message"></span>
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Nombre de usuario" id="nombre_usuario" name="nombre_usuario" autocomplete="nope">
                    <span id="errorNombre_usuario" class="error-message"></span>
                </div>
                <div class="input-box">
                    <input type="password" required placeholder="Contraseña (mínimo 6 carácteres)" id="contrasena" name="contrasena">
                    <span id="errorContrasena" class="error-message"></span>
                </div>
                <div class="input-box">
                    <input type="password" required placeholder="Repetir Contraseña" id="contrasena2" name="contrasena2">
                    <span id="errorContrasena2" class="error-message"></span>
                </div>
                <button type="submit" class="btn">Registrarse</button>
                <div class="registrarse">
                    <p>¿Ya tienes una cuenta?<a href="../controller/loginController.php" class="register"> Iniciar Sesión</a></p>
                </div>
                <div class="registrarse">
                    <p><a href="../controller/inicioController.php"> Volver a inicio</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/js/register.js"></script>
  </body>
</html>
