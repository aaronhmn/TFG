<?php

namespace views;
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/styles/css/navbar.css">
</head>

<body style="background-color: #e6e6fa">
  <!--NAV DE LA PAGINA-->
  <?php
  if (isset($_SESSION['login'])) {
    if ($_SESSION['login'] == true) { ?>
      <nav>
        <input type="checkbox" name="" id="chk1" />
        <a href="../controller/inicioController.php"><img class="img-logo" src="../assets/img/genesis logo sin fondo favicon.png" alt="logo genesis" /></a>
        <div class="logo">
          <h1><b>Genesis</b></h1>
        </div>

        <div class="nav-busqueda">
          <form action="">
            <input type="search" name="busqueda" id="busqueda" placeholder="Buscar" />
            <button type="submit" style="display: flex; align-items: center; justify-content: center;">
              <i class="fas fa-search" style="color: #8350f2"></i>
            </button>
          </form>
        </div>
        <div class="menu">
          <label for="chk1">
            <i class="fa fa-bars" style="color: #8350f2"></i>
          </label>
        </div>
        <ul style="margin: auto; align-items: center;">
          <li>
            <a href="../controller/inicioController.php"><b>Inicio</b></a>
          </li>
          <li>
            <a href="../controller/tiendaController.php"><b>Tienda</b></a>
          </li>
          <li>
            <a href="../controller/contactoController.php"><b>Contacto</b></a>
          </li>
          <!-- Menú desplegable -->
          <div class="dropdown">
            <!-- Icono de usuario -->
            <a class="nav-link dropdown-toggle" href="#" id="userIcon" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-user fa-lg" style="margin-right: 5px;"></i>
              <?php
              $resultado = $_SESSION['nombre_usuario'];
              print "<b>" .$resultado. "</b>";
              ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="userIcon" id="dropdownMenu">
              <li><a class="dropdown-item" href="../controller/perfilController.php"><i class="fa-solid fa-gear fa-sm" style="margin-right: 5px;"></i>Mi perfil</a></li>
              <li><a class="dropdown-item" href="../controller/misPedidosController.php" style="margin-top: 5px;"><i class="fa-solid fa-bag-shopping fa-sm" style="margin-right: 5px;"></i>Mis Pedidos</a></li>
              <li><a class="dropdown-item" href="../controller/favoritosController.php" style="margin-top: 5px;"><i class="fa-solid fa-heart fa-sm" style="margin-right: 5px;"></i>Lista de Favoritos</a></li>
              <?php 
                $rol = $_SESSION['rol'];
                if($rol === 1){
                  print "<li><a class='dropdown-item' href='../controller/inicioAdminController.php' style='margin-top: 5px;'><i class='fas fa-tachometer-alt' style='margin-right: 5px;'></i>Dashboard</a></li>";
                } 
              ?>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <form action='../controller/cerrarSesionController.php' method="POST">
                  <button class="dropdown-item btn btn-link"><i class="fa-solid fa-sign-out fa-sm" style="margin-right: 5px;"></i>Cerrar sesión</button>
                </form>
              </li>
            </ul>
          </div>
          <a href="../controller/carritoController.php"><i class="fas fa-shopping-cart fa-lg"></i></a>
        </ul>
      </nav>

    <?php }
  } else { ?>

    <nav>
      <input type="checkbox" name="" id="chk1" />
      <a class="logo-link" href="../controller/inicioController.php"><img class="img-logo" src="../assets/img/genesis logo sin fondo favicon.png" alt="logo genesis" /></a>
      <div class="logo">
        <h1><b>Genesis</b></h1>
      </div>

      <div class="nav-busqueda">
        <form action="">
          <input type="search" name="busqueda" id="busqueda" placeholder="Buscar" />
          <button type="submit" style="display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-search" style="color: #8350f2"></i>
          </button>
        </form>
      </div>
      <div class="menu">
        <label for="chk1">
          <i class="fa fa-bars" style="color: #8350f2"></i>
        </label>
      </div>
      <ul style="margin: auto; align-items: center; padding-left: 0;">
        <li>
          <a href="../controller/inicioController.php"><b>Inicio</b></a>
        </li>
        <li>
          <a href="../controller/tiendaController.php"><b>Tienda</b></a>
        </li>
        <li>
          <a href="../controller/contactoController.php"><b>Contacto</b></a>
        </li>
        <li>
          <a href="../controller/loginController.php"><b>Iniciar Sesión</b></a>
        </li>

        <!--Si el usuario esta logueado esta opcion se ocultara y aparecera el icono del perfil que cuando este sin loguear estará oculto-->
        <a href="../controller/carritoController.php"><i class="fas fa-shopping-cart fa-lg"></i></a>
        <!--si el usuario esta logueado estara visible, si no, estara oculto-->
      </ul>
    </nav>
  <?php
  }

  ?>

  <br /><br /><br /><br /><br />

</body>

</html>