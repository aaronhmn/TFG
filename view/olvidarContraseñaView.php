
<?php if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/styles/css/login.css" />
  <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
  <title>Recuperar Contraseña - Genesis</title>
</head>

<body style="background-color: #e6e6fa">
  <div class="wrapper">
    <div class="form-box login">
      <div class="encabezado">
        <h2 style="color: #8350f2;">Recuperar Contraseña</h2>
      </div>
      <br>
      <?php
      if (isset($_SESSION['mensaje'])) {
        echo $_SESSION['mensaje'];
        unset($_SESSION['mensaje']); // Limpiar la variable de sesión después de mostrar el mensaje
      }
      ?>
      <br>
      <form method="POST" action="../controller/olvidarContraseñaController.php" style="margin-top:-40px;">
        <div class="input-box">
          <input type="email" id="email" name="email" required placeholder="Email" autocomplete="nope">
          <label></label>
        </div>
        <button type="submit" class="btn">Enviar</button>
        <div class="registrarse">
          <p><a href="../controller/loginController.php"> Volver al login</a></p>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>