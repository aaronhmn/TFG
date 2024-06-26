<?php

namespace views;
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/styles/css/contacto.css" />
  <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />

  <title>Página de Contacto - Genesis</title>
</head>

<body style="background-color: #e6e6fa" data-user-id="<?php echo isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 'usuario-no-logueado'; ?>">
  <!--NAV DE LA PAGINA-->
  <?php include '../controller/navbarController.php'; ?>

  <div class="container" style="margin-top: 50px; margin-bottom: 100px;">
    <div class="row" style="margin-right: 0px;">
      <div class="col-xl-8 col-sm-12" style="background-color: #fff; margin: 6px; border-radius: 12px;">
        <form class="row g-3" action="../controller/contactoController.php" method="post" style="margin: 10px">
              <!-- Alertas de Bootstrap -->
      <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
          <?php echo $_SESSION['message']; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          <!-- <span aria-hidden="true">&times;</span> -->
          </button>
        </div>
        <?php
        // Limpiar los mensajes de la sesión para no mostrarlos después de refrescar
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        ?>
      <?php endif; ?>
          <h2 style="color: #8350f2; display:flex; justify-content:center;"><b>Contacto</b></h2>
          <div class="col-12">
            <label for="nombre" class="form-label"><b>Nombre:</b></label>
            <input type="text" class="form-control input-contacto" id="nombre" name="nombre" value="<?php echo htmlspecialchars($datosUsuario['nombre'] ?? ''); ?>" required placeholder="Nombre" />
          </div>
          <div class="col-12">
            <label for="primer_apellido" class="form-label"><b>Primer Apellido:</b></label>
            <input type="text" class="form-control input-contacto" id="primer_apellido" name="primer_apellido" value="<?php echo htmlspecialchars($datosUsuario['primer_apellido'] ?? ''); ?>" required placeholder="Primer apellido" />
          </div>
          <div class="col-12">
            <label for="segundo_apellido" class="form-label"><b>Segundo Apellido:</b></label>
            <input type="text" class="form-control input-contacto" id="segundo_apellido" name="segundo_apellido" value="<?php echo htmlspecialchars($datosUsuario['segundo_apellido'] ?? ''); ?>" required placeholder="Segundo apellido" />
          </div>
          <div class="col-12">
            <label for="email" class="form-label"><b>Email:</b></label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($datosUsuario['email'] ?? ''); ?>" required placeholder="Email" />
          </div>
          <div class="mb-3">
            <label for="mensaje" class="form-label"><b>Mensaje:</b></label>
            <textarea class="form-control" placeholder="Escribe tu mensaje" id="mensaje" name="mensaje" rows="12" required></textarea>
          </div>
          <button class="btn btn-primary" type="submit" style="background-color: #8350f2; border-color: #8350f2; margin-bottom:10px;">Enviar Mensaje</button>
        </form>
      </div><br><br>

      <div class="col-xl-3 col-sm-12" style="background-color: #fff; margin: 6px; border-radius: 12px;">
        <div class="row" style="display: flex; align-items: center; justify-content:center;">
          <div class="col-auto" style="margin-top: 30px;">
            <i class="fa-solid fa-phone fa-2x" style="color: #ffa500; cursor: auto;"></i>
          </div>
          <div class="col-auto" style="margin-top: 30px">
            <h3 style="color: #ffa500"><b>Llámanos</b></h3>
          </div>
        </div>
        <div class="texto-izq">
          <p>Disponibles 24/7 horas a la semana</p>
          <p>Teléfono: +34 956 54 67 23</p>
        </div>
        <br />
        <hr />
        <div class="row" style="display: flex; align-items: center; justify-content:center;">
          <div class="col-auto" style="margin-top: 40px; margin-left: 30px">
            <i class="fa-solid fa-envelope fa-2x" style="color: #ffa500; cursor: auto;"></i>
          </div>
          <div class="col-auto" style="margin-top: 40px">
            <h3 style="color: #ffa500"><b>Escríbenos</b></h3>
          </div>
        </div>
        <div class="texto-izq">
          <p>Si nos escribes te responderemos en 24 horas.</p>
          <p>soporte.genesis@gmail.com</p><br>
        </div>
      </div>
    </div>
  </div>

  <button onclick="scrollToTop()" id="btnSubir" title="Ir arriba"><i class="fa-solid fa-arrow-up fa-xl" style="color: #ffffff; align-items:center;"></i></button>

  <!--FOOTER-->
  <?php include '../controller/footerController.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="../assets/js/main.js"></script>
</body>

</html>