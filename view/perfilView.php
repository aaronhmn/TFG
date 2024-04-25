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

<body style="background-color: #e6e6fa">
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
          <a href="../controller/perfilController.php" style="margin-bottom: 15px;">Mi perfil</a>
          <a href="../controller/cambioContraseñaController.php">Cambiar contraseña</a>
        </div>
        <br />
        <div class="row" style="display: flex; align-items: center">
          <div class="col-auto" style="margin-top: 5px; margin-bottom: 10px;">
            <h3 style="color: #000"><b>Acciones</b></h3>
          </div>
        </div>
        <div class="texto-izq" style="margin-bottom: 20px;">
          <a href="../controller/misPedidosController.php">Mis Pedidos</a>
        </div>
      </div>

      <div class="col-md-8 col-sm-12" style="background-color: #fff; margin: 10px">
        <h5 style="margin-top: 15px;">Bienvenido <?php
                        print "<b style='color: #8350f2;'>" . $datosUsuario['nombre_usuario']  . "</b>";
                        ?></h5>
        
          <div class="col-9" style="display: flex; align-items: center;">
            <h2 style="color: #ffa500"><b>Edita tu perfil</b></h2>
          </div>
          <form class="row g-3" style="margin: 10px; margin-right: 0px; margin-left: -5px;" method="POST" action="../controller/modificarPerfilController.php">
          <div class="col-6">
            <label for="nombre"><b>Nombre:</b></label>
            <input type="text" class="form-control input-contacto" id="nombre" name="nombre" value="<?php echo htmlspecialchars($datosUsuario['nombre'] ?? ''); ?>" placeholder="Nombre" />
          </div>
          <div class="col-6">
            <label for="nombre"><b>Nombre de usuario:</b></label>
            <input type="text" class="form-control" id="nombreUsuario" value="<?php echo htmlspecialchars($datosUsuario['nombre_usuario'] ?? ''); ?>" placeholder="Nombre usuario" />
          </div>
          <div class="col-6">
            <label for="primer apellido"><b>Primer Apellido:</b></label>
            <input type="text" class="form-control" id="primerApellido" value="<?php echo htmlspecialchars($datosUsuario['primer_apellido'] ?? ''); ?>" placeholder="1º Apellido" />
          </div>
          <div class="col-6">
            <label for="segundo apellido"><b>Segundo Apellido:</b></label>
            <input type="text" class="form-control" id="segundoApellido" value="<?php echo htmlspecialchars($datosUsuario['segundo_apellido'] ?? ''); ?>" placeholder="2º Apellido" />
          </div>
          <div class="col-6">
            <label for="dni"><b>DNI:</b></label>
            <input type="text" class="form-control" id="dni" value="<?php echo htmlspecialchars($datosUsuario['dni'] ?? ''); ?>" placeholder="dni" />
          </div>
          <div class="col-6">
            <label for="telefono"><b>Telefono:</b></label>
            <input type="tel" class="form-control" id="telefono" value="<?php echo htmlspecialchars($datosUsuario['telefono'] ?? ''); ?>" placeholder="telefono" />
          </div>
          <div class="col-6">
            <label for="codigo_postal"><b>Codigo Postal:</b></label>
            <input type="number" class="form-control" id="codigo_postal" value="<?php echo htmlspecialchars($datosUsuario['codigo_postal'] ?? ''); ?>" placeholder="codigo_postal" />
          </div>
          <div class="col-6">
            <label for="calle"><b>Calle:</b></label>
            <input type="text" class="form-control" id="calle" value="<?php echo htmlspecialchars($datosUsuario['calle'] ?? ''); ?>" placeholder="calle" />
          </div>
          <div class="col-6">
            <label for="numero_bloque"><b>Numero de bloque:</b></label>
            <input type="number" class="form-control" id="numero_bloque" value="<?php echo htmlspecialchars($datosUsuario['numero_bloque'] ?? ''); ?>" placeholder="numero_bloque" />
          </div>
          <div class="col-6">
            <label for="piso"><b>Piso:</b></label>
            <input type="text" class="form-control" id="piso" value="<?php echo htmlspecialchars($datosUsuario['piso'] ?? ''); ?>" placeholder="piso" />
          </div>
          <div class="col-12">
            <label for="email"><b>Email:</b></label>
            <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($datosUsuario['email'] ?? ''); ?>" placeholder="Email" />
          </div>

          <button class="btn btn-primary col-4" type="submit" style="background-color: rgb(168, 168, 168); margin-right: 15px; border: none;">Cancelar</button>
          <button class="btn btn-primary col-4" type="submit" style="background-color: #8350f2; border: none;">Guardar</button>
        </form>
      </div>
    </div>
  </div>

  <!--FOOTER-->
  <?php include '../controller/footerController.php'; ?>

  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>