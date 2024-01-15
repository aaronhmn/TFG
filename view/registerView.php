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
                    <label></label>
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Primer Apellido" id="primer_apellido" name="primer_apellido" autocomplete="nope">
                    <label></label>
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Segundo Apellido" id="segundo_apellido" name="segundo_apellido" autocomplete="nope">
                    <label></label>
                </div>
                <div class="input-box">
                    <input type="tel" required placeholder="Teléfono" id="telefono" name="telefono" autocomplete="nope">
                    <label></label>
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="DNI" id="dni" name="dni" autocomplete="nope">
                    <label></label>
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Dirección" id="direccion" name="direccion" autocomplete="nope">
                    <label></label>
                </div>
                <div class="input-box">
                    <input type="email" required placeholder="Email" id="email" name="email" autocomplete="nope">
                    <label></label>
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Nombre de usuario" id="nombre_usuario" name="nombre_usuario" autocomplete="nope">
                    <label></label>
                </div>
                <div class="input-box">
                    <input type="password" required placeholder="Contraseña" id="contrasena" name="contrasena">
                    <label></label>
                </div>
                <div class="input-box">
                    <input type="password" required placeholder="Repetir Contraseña" id="contrasena" name="contrasena">
                    <label></label>
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
  </body>
</html>
