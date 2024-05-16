<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/styles/css/perfil.css" />
  <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />

  <title>Perfil - Genesis</title>
</head>

<body style="background-color: #e6e6fa" data-user-id="<?php echo $_SESSION['id_usuario']; ?>">
  <!--NAV DE LA PAGINA-->
  <?php include '../controller/navbarController.php'; ?>

  <div class="container" style="margin-top: 50px; margin-bottom: 100px">
    <div class="row" style="margin-right: 0px;">
      <div class="col-md-3 col-sm-12" style="background-color: #e6e6fa; margin: 10px">
        <div class="row" style="display: flex; align-items: center">
          <div class="col-auto" style="margin-top: 30px; margin-bottom: 10px;">
            <h3 style="color: #000"><b>Editar Perfil</b></h3>
          </div>
        </div>
        <div class="texto-izq">
          <a href="../controller/perfilController.php" style="margin-bottom: 15px;">Mi cuenta</a>
          <a href="../controller/cambioContraseñaController.php">Cambiar contraseña</a>
        </div>
      </div>

      <div class="col-md-8 col-sm-12" style="background-color: #fff; margin: 5px">
        <form class="row g-3" style="margin: 10px; margin-right: 0px; margin-left: -5px;" method="POST" action="../controller/perfilController.php">
        <?php
    if (isset($_SESSION['mensaje'])) {
      echo "<div class='alert alert-{$_SESSION['tipo_mensaje']} alert-dismissible fade show' role='alert'>
            {$_SESSION['mensaje']}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
      // Limpia los mensajes después de mostrarlos
      unset($_SESSION['mensaje']);
      unset($_SESSION['tipo_mensaje']);
    }
    ?>
    <div id="alertContainer"></div>
        <div class="col-9" style="display: flex; align-items: center;">
          <h2 style="color: #ffa500;"><b>Edita tu perfil</b></h2>
        </div>
          <div class="col-6">
            <label for="nombre" class="form-label"><b>Nombre:</b></label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($datosUsuario['nombre'] ?? ''); ?>" placeholder="Nombre" />
          </div>
          <div class="col-6">
            <label for="nombreUsuario" class="form-label"><b>Nombre de usuario:</b></label>
            <input type="text" class="form-control" id="nombreUsuario" name="nombre_usuario" value="<?php echo htmlspecialchars($datosUsuario['nombre_usuario'] ?? ''); ?>" placeholder="Nombre usuario" />
          </div>
          <div class="col-6">
            <label for="primerApellido" class="form-label"><b>Primer Apellido:</b></label>
            <input type="text" class="form-control" id="primerApellido" name="primer_apellido" value="<?php echo htmlspecialchars($datosUsuario['primer_apellido'] ?? ''); ?>" placeholder="1º Apellido" />
          </div>
          <div class="col-6">
            <label for="segundoApellido" class="form-label"><b>Segundo Apellido:</b></label>
            <input type="text" class="form-control" id="segundoApellido" name="segundo_apellido" value="<?php echo htmlspecialchars($datosUsuario['segundo_apellido'] ?? ''); ?>" placeholder="2º Apellido" />
          </div>
          <div class="col-6">
            <label for="dni" class="form-label"><b>DNI:</b></label>
            <input type="text" class="form-control" id="dni" name="dni" value="<?php echo htmlspecialchars($datosUsuario['dni'] ?? ''); ?>" placeholder="DNI" />
          </div>
          <div class="col-6">
            <label for="telefono" class="form-label"><b>Telefono:</b></label>
            <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($datosUsuario['telefono'] ?? ''); ?>" placeholder="Telefono" />
          </div>
          <div class="col-6">
            <label for="codigo_postal" class="form-label"><b>Codigo Postal:</b></label>
            <input type="number" class="form-control" id="codigo_postal" name="codigo_postal" value="<?php echo htmlspecialchars($datosUsuario['codigo_postal'] ?? ''); ?>" placeholder="Codigo Postal" />
          </div>
          <div class="col-6">
            <label for="calle" class="form-label"><b>Calle:</b></label>
            <input type="text" class="form-control" id="calle" name="calle" value="<?php echo htmlspecialchars($datosUsuario['calle'] ?? ''); ?>" placeholder="Calle" />
          </div>
          <div class="col-6">
            <label for="numero_bloque" class="form-label"><b>Numero de bloque:</b></label>
            <input type="number" class="form-control" id="numero_bloque" name="numero_bloque" value="<?php echo htmlspecialchars($datosUsuario['numero_bloque'] ?? ''); ?>" placeholder="Numero de bloque" />
          </div>
          <div class="col-6">
            <label for="piso" class="form-label"><b>Piso:</b></label>
            <input type="text" class="form-control" id="piso" name="piso" value="<?php echo htmlspecialchars($datosUsuario['piso'] ?? ''); ?>" placeholder="Piso" />
          </div>
          <div class="col-12">
            <label for="email" class="form-label"><b>Email:</b></label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($datosUsuario['email'] ?? ''); ?>" placeholder="Email" />
          </div>

          <button class="btn btn-primary col-4" id="cancelButton" type="reset" style="background-color: rgb(168, 168, 168); margin-right: 15px; border: none;">Cancelar</button>
          <button class="btn btn-primary col-4" type="submit" style="background-color: #8350f2; border: none;">Guardar</button>
        </form>
      </div>
    </div>
  </div>
  <button onclick="scrollToTop()" id="btnSubir" title="Ir arriba"><i class="fa-solid fa-arrow-up fa-xl" style="color: #ffffff; align-items:center;"></i></button>

  <!--FOOTER-->
  <?php include '../controller/footerController.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../assets/js/main.js"></script>

  <script>
document.getElementById('cancelButton').addEventListener('click', function() {
    var alertContainer = document.getElementById('alertContainer');
    var alertHTML = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                    'La modificación ha sido cancelada correctamente.' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>';
    alertContainer.innerHTML = alertHTML;
});
</script>
</body>
</html>