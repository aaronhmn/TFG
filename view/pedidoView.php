<?php

namespace views;
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../assets/styles/css/pedidos.css" />
  <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />

  <title>Página de Pedido - Genesis</title>

<body style="background-color: #e6e6fa">

  <!--NAV DE LA PAGINA-->
  <?php include '../controller/navbarController.php'; ?>

  <div class="container-fluid mt-4 mb-5" style="max-width: 80%;">
    <div class="row">
      <!-- Columna del formulario para ingresar datos -->
      <div class="col-12 col-xl-5 mb-5 px-xl-5">
        <form class="mt-4">
          <h4 style="color: #8350F2;"><b>Detalles de tus datos</b></h4>
          <!-- Tus campos de formulario aquí -->
          <div class="col-12 mt-3">
            <label for="nombre"><b>Nombre:</b></label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo htmlspecialchars($datosUsuario['nombre'] ?? ''); ?>" />
          </div>
          <div class="col-12 mt-3">
            <label for="primerApellido"><b>Primer Apellido:</b></label>
            <input type="text" class="form-control" id="primerApellido" name="primer_apellido" value="<?php echo htmlspecialchars($datosUsuario['primer_apellido'] ?? ''); ?>" placeholder="1º Apellido" />
          </div>
          <div class="col-12 mt-3">
            <label for="segundoApellido"><b>Segundo Apellido:</b></label>
            <input type="text" class="form-control" id="segundoApellido" name="segundo_apellido" value="<?php echo htmlspecialchars($datosUsuario['segundo_apellido'] ?? ''); ?>" placeholder="2º Apellido" />
          </div>
          <div class="col-12 mt-3">
            <label for="dni"><b>DNI:</b></label>
            <input type="text" class="form-control" id="dni" name="dni" value="<?php echo htmlspecialchars($datosUsuario['dni'] ?? ''); ?>" placeholder="DNI" />
          </div>
          <div class="col-12 mt-3">
            <label for="telefono"><b>Telefono:</b></label>
            <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($datosUsuario['telefono'] ?? ''); ?>" placeholder="Telefono" />
          </div>
          <div class="col-12 mt-3">
            <label for="codigo_postal"><b>Codigo Postal:</b></label>
            <input type="number" class="form-control" id="codigo_postal" name="codigo_postal" value="<?php echo htmlspecialchars($datosUsuario['codigo_postal'] ?? ''); ?>" placeholder="Codigo Postal" />
          </div>
          <div class="col-12 mt-3">
            <label for="calle"><b>Calle:</b></label>
            <input type="text" class="form-control" id="calle" name="calle" value="<?php echo htmlspecialchars($datosUsuario['calle'] ?? ''); ?>" placeholder="Calle" />
          </div>
          <div class="col-12 mt-3">
            <label for="numero_bloque"><b>Numero de bloque:</b></label>
            <input type="number" class="form-control" id="numero_bloque" name="numero_bloque" value="<?php echo htmlspecialchars($datosUsuario['numero_bloque'] ?? ''); ?>" placeholder="Numero de bloque" />
          </div>
          <div class="col-12 mt-3">
            <label for="piso"><b>Piso:</b></label>
            <input type="text" class="form-control" id="piso" name="piso" value="<?php echo htmlspecialchars($datosUsuario['piso'] ?? ''); ?>" placeholder="Piso" />
          </div>
        </form>
      </div>

      <!-- Columna de información del carrito -->
      <div class="col-12 col-xl-7 px-xl-5">
        <div class="table-responsive mt-4" id="carrito-detalles">
        <h4 class="mb-4" style="color: #8350F2;"><b>Detalles del pedido</b></h4>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Producto</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Subtotal</th>
              </tr>
            </thead>
            <tbody id="carrito-body"></tbody>
          </table>
        </div>
        <div class="mb-3" id="pagination-container"></div>
          <div class="precio-total"><b>Total: </b><span id="precio-total">0 €</span></div>
          <div class="mt-4" id="paypal-button-container"></div>
      </div>
    </div>
  </div><br>

  <!--FOOTER-->
  <?php include '../controller/footerController.php'; ?>

  <script src="https://www.paypal.com/sdk/js?client-id=AfJjZTOU8jNeTFumpGdD9neSc0abzt9CrEPcA_BH35PQw6jwuceoOePiex5FD_WQoiXNPgpSqMLu9_Jw&components=buttons&currency=EUR&disable-funding=credit,card"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/pedido.js"></script>
</body>

</html>