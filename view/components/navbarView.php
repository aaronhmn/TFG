<?php

namespace views;

if (session_status() == PHP_SESSION_NONE) {
  session_start([
    'cookie_lifetime' => 86400, // 1 día, ajusta según necesidad
    'cookie_secure' => true,
    'cookie_httponly' => true
  ]);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/styles/css/navbar.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
          <form action="../controller/tiendaController.php" method="GET">
            <input type="search" name="busqueda" id="busqueda" placeholder="Buscar" required>
            <button type="submit">
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
              print "<b>" . $resultado . "</b>";
              ?>
            </a>
            <?php
            $rol = $_SESSION['rol'];
            if ($rol === 0) {
            ?>
              <ul class="dropdown-menu" aria-labelledby="userIcon" id="dropdownMenu">
                <li><a class="dropdown-item" href="../controller/perfilController.php"><i class="fa-solid fa-gear fa-sm" style="margin-right: 5px;"></i>Mi perfil</a></li>
                <li><a class="dropdown-item" href="../controller/misPedidosController.php" style="margin-top: 5px;"><i class="fa-solid fa-bag-shopping fa-sm" style="margin-right: 5px;"></i>Mis Pedidos</a></li>
                <li><a class="dropdown-item" href="../controller/favoritosController.php" style="margin-top: 5px;"><i class="fa-solid fa-heart fa-sm" style="margin-right: 5px;"></i>Lista de Favoritos</a></li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <form action='../controller/cerrarSesionController.php' method="POST">
                    <button class="dropdown-item btn btn-link"><i class="fa-solid fa-sign-out fa-sm" style="margin-right: 5px;"></i>Cerrar sesión</button>
                  </form>
                </li>
              </ul>
            <?php
            }
            if ($rol === 1) {
            ?>
              <ul class="dropdown-menu" aria-labelledby="userIcon" id="dropdownMenu">
                <li><a class="dropdown-item" href="../controller/perfilController.php"><i class="fa-solid fa-gear fa-sm" style="margin-right: 5px;"></i>Mi perfil</a></li>
                <li><a class="dropdown-item" href="../controller/misPedidosController.php" style="margin-top: 5px;"><i class="fa-solid fa-bag-shopping fa-sm" style="margin-right: 5px;"></i>Mis Pedidos</a></li>
                <li><a class="dropdown-item" href="../controller/favoritosController.php" style="margin-top: 5px;"><i class="fa-solid fa-heart fa-sm" style="margin-right: 5px;"></i>Lista de Favoritos</a></li>
                <li><a class='dropdown-item' href='../controller/inicioAdminController.php' style='margin-top: 5px;'><i class='fas fa-tachometer-alt' style='margin-right: 5px;'></i>Dashboard</a></li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <form action='../controller/cerrarSesionController.php' method="POST">
                    <button class="dropdown-item btn btn-link"><i class="fa-solid fa-sign-out fa-sm" style="margin-right: 5px;"></i>Cerrar sesión</button>
                  </form>
                </li>
              </ul>
            <?php
            }
            ?>
          </div>
          <a href="../controller/carritoController.php">
            <i class="fas fa-shopping-cart fa-lg"></i>
            <span id="cart-count" class="cart-count">0</span>
          </a>
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
        <form action="../controller/tiendaController.php" method="GET">
          <input type="search" name="busqueda" id="busqueda" placeholder="Buscar" required>
          <button type="submit">
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
      </ul>
    </nav>
  <?php
  }

  ?>

  <br /><br /><br /><br /><br />

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      actualizarContadorCarrito();
    });

    function actualizarContadorCarrito() {
      const carrito = JSON.parse(localStorage.getItem('carrito')) || {};
      const totalItems = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0);
      const contador = document.getElementById('cart-count');
      if (contador) contador.textContent = totalItems;
    }

    $(document).ready(function() {
    $('#formBusqueda').submit(function(event) {
        event.preventDefault();
        var query = $('#busqueda').val();
        if (query.length > 2) {
            $.ajax({
                url: "../controller/tiendaController.php",
                type: "GET",
                data: {
                    busqueda: query
                },
                dataType: 'html',
                success: function(data) {
                    if (data.includes('<!-- NO_RESULTS -->')) {
                        // Muestra la alerta, sin borrar los productos existentes
                        $('#alertContainer').html('<div class="alert alert-warning" role="alert">No se encontraron productos que coincidan con su búsqueda.</div>');
                    } else {
                        // Actualiza el contenedor con los nuevos productos
                        $('#productosContainer').html(data);
                        $('#alertContainer').empty(); // Limpia cualquier alerta previa
                    }
                },
                error: function() {
                    $('#productosContainer').html('<p>Error al procesar la búsqueda.</p>');
                }
            });
        } else {
            $('#productosContainer').html('<p>Introduce al menos 3 caracteres para buscar.</p>');
        }
    });
});
  </script>

</body>

</html>