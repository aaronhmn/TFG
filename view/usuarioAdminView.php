<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/styles/css/admin.css">
  <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />

  <title>Usuarios - Dashboard</title>
</head>

<body style="background-color: #e6e6fa">

  <nav class="navbar navbar-dark fixed-top" style="background-color: #8350f2;">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="../controller/inicioAdminController.php" id="logo-sidebar"><img src="../assets/img/genesis Logo.png" style="width: 50px;">Genesis</a>
      <div class="dropdown">
        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8350f2; border-color: #8350f2; font-size: 18px;">
          <?php
          $resultado = $_SESSION['nombre_usuario'];
          echo "<b style='color: #fff;'>$resultado</b>";
          ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
          <li>
            <form action="../controller/inicioController.php" method="POST">
              <button class="dropdown-item">
                <i class="fas fa-home"></i> Ir a la web
              </button>
            </form>
          </li>
          <hr>
          <li>
            <form action="../controller/cerrarSesionController.php" method="POST">
              <button class="dropdown-item">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
              </button>
            </form>
          </li>
        </ul>
      </div>
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel" style="visibility: visible; background-color: #8350f2;">
        <div class="offcanvas-header">
          <h3 class="offcanvas-title" id="offcanvasDarkNavbarLabel" style="color: white; margin-left: 20px;">
            <img src="../assets/img/genesis Logo.png" style="width: 80px; margin-right: 5px; margin-left: -20px;"><b>Menu</b>
          </h3>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <hr style="color: #fff;">
        <div class="offcanvas-body">
          <ul class="navbar-nav flex-grow-1 pe-3" style="margin-left: 20px;">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../controller/inicioAdminController.php"><i class="fas fa-tachometer-alt fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Inicio</span></a>
            </li>
            <li class="nav-item mt-4" id="active">
              <a class="nav-link active" href="../controller/usuariosAdminController.php"><i class="fas fa-user fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Usuarios</span></a>
            </li>
            <li class="nav-item mt-4">
              <a class="nav-link active" href="../controller/productosAdminController.php"><i class="fas fa-briefcase fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Productos</span></a>
            </li>
            <li class="nav-item mt-4">
              <a class="nav-link active" href="../controller/categoriasAdminController.php"><i class="fas fa-list-alt fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Categorías</span></a>
            </li>
            <li class="nav-item mt-4">
              <a class="nav-link active" href="../controller/marcasAdminController.php"><i class="fa-solid fa-flag fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Marcas</span></a>
            </li>
            <li class="nav-item mt-4">
              <a class="nav-link active" href="../controller/pedidosAdminController.php"><i class="fas fa-shipping-fast fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">pedidos</span></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!--<div class="main-content">-->
  <div id="aviso" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Aviso</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><?= $mensaje ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5" style="max-width: 1600px;"><br><br>
    <div class="navbar2">
      <ul>
        <li>
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#insertarUsuarioModal">
            Insertar usuario nuevo
          </button>
        </li>
      </ul>
    </div>
    <br>
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
    <div class="row" style="margin: 0;">
      <div class="col-lg-12 col-sm-12 table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="background-color: #8350F2; color: #fff;" scope="col">Id</th>
              <th style="background-color: #8350F2; color: #fff;" scope="col">Nombre de Usuario</th>
              <th style="background-color: #8350F2; color: #fff;" scope="col">Nombre</th>
              <th style="background-color: #8350F2; color: #fff;" scope="col">Primer Apellido</th>
              <th style="background-color: #8350F2; color: #fff;" scope="col">Segundo Apellido</th>
              <th style="background-color: #8350F2; color: #fff;" scope="col">DNI</th>
              <th style="background-color: #8350F2; color: #fff;" scope="col">Correo Electrónico</th>
              <!-- <th style="background-color: #8350F2; color: #fff;" scope="col">Código Postal</th> -->
              <!-- <th style="background-color: #8350F2; color: #fff;" scope="col">Calle</th>
              <th style="background-color: #8350F2; color: #fff;" scope="col">Número Bloque</th>
              <th style="background-color: #8350F2; color: #fff;" scope="col">Piso</th> -->
              <!-- <th style="background-color: #8350F2; color: #fff;" scope="col">Teléfono</th> -->
              <!-- <th style="background-color: #8350F2; color: #fff;" scope="col">Activación</th> -->
              <th style="background-color: #8350F2; color: #fff;" scope="col">Activo</th>
              <th style="background-color: #8350F2; color: #fff;" scope="col">Rol</th>
              <th style="background-color: #8350F2; color: #fff;" scope="col">Estado</th>
              <th style="background-color: #8350F2; color: #fff;" scope="col"></th>
              <th style="background-color: #8350F2; color: #fff;" scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($usuariosPaginados as $producto) {
              //Comienzo de fila
              print("<tr style='align-items: center; background-color: gray;'>\n");

              //Id de cliente
              print("<td style=' padding-top: 14px;' scope='row'><b>" . $producto["idusuario"] . "</b></td>\n");
              //Nombre de Usuario
              print("<td style='padding-top: 14px;'>");
              print("<a href='#' class='text-primary' data-bs-toggle='modal' data-bs-target='#usuarioDetalleModal' data-idusuario='" . $producto['idusuario'] . "'>");
              print(htmlspecialchars($producto["nombre_usuario"]));
              print("</a>");
              print("</td>\n");
              //Nombre
              print("<td style=' padding-top: 14px;'>" . $producto["nombre"] . "</td>\n");
              //Primer Apellido
              print("<td style=' padding-top: 14px;'>" . $producto["primer_apellido"] . "</td>\n");
              //Segundo Apellido
              print("<td style=' padding-top: 14px;'>" . $producto["segundo_apellido"] . "</td>\n");
              //DNI
              print("<td style=' padding-top: 14px;'>" . $producto["dni"] . "</td>\n");
              //Email
              print("<td style=' padding-top: 14px;'>" . $producto["email"] . "</td>\n");
              //Activo
              echo "<td style='padding-top: 14px;'>" . ($producto["activo"] == 1 ? 'Sí' : 'No') . "</td>";
              //Rol
              echo "<td style='padding-top: 14px;'>" . ($producto["rol"] == 1 ? 'Admin' : 'Cliente') . "</td>";
              //Estado
              echo "<td style='padding-top: 14px;'>" . ($producto["estado"] == 1 ? 'Baneado' : 'Habilitado') . "</td>";

              // Botón para modificar
              echo "<td>";
              echo "<button data-bs-toggle='modal' data-bs-target='#modificarUsuarioModal'";
              echo " data-id='" . htmlspecialchars($producto['idusuario'], ENT_QUOTES) . "'";
              echo " data-nombre='" . htmlspecialchars($producto['nombre'], ENT_QUOTES) . "'";
              echo " data-primerapellido='" . htmlspecialchars($producto['primer_apellido'], ENT_QUOTES) . "'";
              echo " data-segundoapellido='" . htmlspecialchars($producto['segundo_apellido'], ENT_QUOTES) . "'";
              echo " data-dni='" . htmlspecialchars($producto['dni'], ENT_QUOTES) . "'";
              echo " data-email='" . htmlspecialchars($producto['email'], ENT_QUOTES) . "'";
              echo " data-nombreusuario='" . htmlspecialchars($producto['nombre_usuario'], ENT_QUOTES) . "'";
              echo " data-codigopostal='" . htmlspecialchars($producto['codigo_postal'], ENT_QUOTES) . "'";
              echo " data-calle='" . htmlspecialchars($producto['calle'], ENT_QUOTES) . "'";
              echo " data-numerobloque='" . htmlspecialchars($producto['numero_bloque'], ENT_QUOTES) . "'";
              echo " data-piso='" . htmlspecialchars($producto['piso'], ENT_QUOTES) . "'";
              echo " data-telefono='" . htmlspecialchars($producto['telefono'], ENT_QUOTES) . "'";
              echo " data-activacion='" . htmlspecialchars($producto['activacion'], ENT_QUOTES) . "'";
              echo " data-activo='" . htmlspecialchars($producto['activo'], ENT_QUOTES) . "'";
              echo " data-rol='" . htmlspecialchars($producto['rol'], ENT_QUOTES) . "'";
              echo " data-estado='" . htmlspecialchars($producto['estado'], ENT_QUOTES) . "'";
              /* echo " data-contrasena='" . htmlspecialchars($producto['contrasena'], ENT_QUOTES) . "'"; */
              echo " style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;'>";
              echo "<i class='fas fa-edit fa-lg' style='color: #005eff;'></i>";
              echo "</button>";
              echo "</td>";

              // Botón para eliminar
              echo "<td>";
              echo "<form id='formEliminar-{$producto['idusuario']}' method='POST' action='../controller/banearUsuarioController.php'>";
              echo "<input type='hidden' name='idUsuario' value='{$producto['idusuario']}'/>";
              echo "<button style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;' type='button' onclick='mostrarModalEliminar(" . $producto['idusuario'] . ");'><i class='fa-solid fa-ban fa-lg' style='color: red;'></i></button>";
              echo "</form>";
              echo "</td>";

              //Final de fila
              print("</tr>\n");
            }
            ?>
          </tbody>
        </table>
        <form method="POST" action="../controller/usuariosAdminController.php">
          <?php
          for ($i = 1; $i <= $totalPaginas; $i++) {
            echo "<button style='margin-left: 7px; margin-bottom: 25px; background-color: #8350F2; color: #fff; border-radius: 50%; width: 40px' name='Pag' value='$i' class='btn'>$i</button>";
          }
          ?>
        </form>
      </div>


    </div><br>
  </div>

  <!-- Modal Insertar Usuario -->
  <div class="modal fade" id="insertarUsuarioModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="modalLabel" style="color: #8350F2;">Insertar nuevo usuario</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Formulario de inserción con campos ocultos -->
          <form method="POST" action="../controller/insertarUsuariosAdminController.php" enctype="multipart/form-data">
            <div style="display:none">
              <input type="text" autocomplete="username">
              <input type="password" autocomplete="new-password">
            </div>
            <div class="mb-3">
              <label style="color: #000;" for="inputNombre" class="form-label"><b>Nombre:</b></label>
              <input type="text" class="form-control" name="inputNombre" autocomplete="off" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
              <label style="color: #000;" for="inputPrimerApellido" class="form-label"><b>Primer Apellido:</b></label>
              <input type="text" class="form-control" name="inputPrimerApellido" autocomplete="off" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
              <label style="color: #000;" for="inputSegundoApellido" class="form-label"><b>Segundo Apellido:</b></label>
              <input type="text" class="form-control" name="inputSegundoApellido" autocomplete="off" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
              <label style="color: #000;" for="inputTelefono" class="form-label"><b>Telefono:</b></label>
              <input type="tel" class="form-control" name="inputTelefono" autocomplete="off" aria-describedby="emailHelp" digitsonly="true" required>
            </div>
            <div class="mb-3">
              <label style="color: #000;" for="inputDNI" class="form-label"><b>DNI:</b></label>
              <input type="text" class="form-control" name="inputDNI" autocomplete="off" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
              <label style="color: #000;" for="inputCodigoPostal" class="form-label"><b>Código Postal:</b></label>
              <input type="number" min=0 class="form-control" name="inputCodigoPostal" autocomplete="off" aria-describedby="emailHelp" digitsonly="true" required>
            </div>
            <div class="mb-3">
              <label style="color: #000;" for="inputCalle" class="form-label"><b>Nombre de la calle o avenida:</b></label>
              <input type="text" class="form-control" name="inputCalle" autocomplete="off" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
              <label style="color: #000;" for="inputNumeroBloque" class="form-label"><b>Número del bloque o de la casa:</b></label>
              <input type="number" min=0 class="form-control" name="inputNumeroBloque" autocomplete="off" aria-describedby="emailHelp" digitsonly="true" required>
            </div>
            <div class="mb-3">
              <label style="color: #000;" for="inputPiso" class="form-label"><b>Piso:</b></label>
              <input type="text" class="form-control" name="inputPiso" autocomplete="off" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label style="color: #000;" for="inputEmail" class="form-label"><b>Email:</b></label>
              <input type="email" class="form-control" name="inputEmail" autocomplete="off" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
              <label style="color: #000;" for="inputUsuario" class="form-label"><b>Nombre de usuario:</b></label>
              <input type="text" class="form-control" name="inputUsuario" autocomplete="new-username" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
              <label for="inputActivo" class="form-label"><b>Activo:</b></label>
              <select class="form-select" id="inputActivo" name="inputActivo">
                <option value="" selected disabled>Elige una opción</option>
                <option value="0">No</option>
                <option value="1">Sí</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="inputRol" class="form-label"><b>Rol:</b></label>
              <select class="form-select" id="inputRol" name="inputRol">
              <option value="" selected disabled>Elige una opción</option>
                <option value="0">Cliente</option>
                <option value="1">Admin</option>
              </select>
            </div>
            <div class="mb-3">
              <label style="color: #000;" for="inputPassword" class="form-label"><b>Contraseña:</b></label>
              <input type="password" class="form-control" name="inputPassword" autocomplete="new-password" required>
            </div>
            <div class="mb-3">
              <label style="color: #000;" for="inputPassword2" the form-label"><b>Repetir Contraseña:</b></label>
              <input type="password" class="form-control" name="inputPassword2" autocomplete="new-password" required>
            </div>
            <div class="d-grid">
              <button style="background-color: #8350F2; color: #fff" class="btn" type="submit">Insertar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Modificar Usuario -->
  <div class="modal fade" id="modificarUsuarioModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="modalLabel" style="color: #8350F2;"><b>Modificar usuario</b></h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Formulario de modificación de usuario con campos ocultos -->
          <form method="POST" action="../controller/modificarUsuarioController.php" enctype="multipart/form-data">
            <div style="display:none">
              <input type="text" autocomplete="username">
              <input type="password" autocomplete="new-password">
            </div>
            <div class="mb-3">
              <label for="nombre_usuario" class="form-label"><b>Nombre de usuario:</b></label>
              <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="nombre" class="form-label"><b>Nombre:</b></label>
              <input type="text" class="form-control" id="nombre" name="nombre" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="primer_apellido" class="form-label"><b>Primer Apellido:</b></label>
              <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="segundo_apellido" class="form-label"><b>Segundo Apellido:</b></label>
              <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="dni" class="form-label"><b>DNI:</b></label>
              <input type="text" class="form-control" id="dni" name="dni" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label"><b>Email:</b></label>
              <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="codigo_postal" class="form-label"><b>Código Postal:</b></label>
              <input type="number" min=0 class="form-control" id="codigo_postal" name="codigo_postal" digitsonly="true" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="calle" class="form-label"><b>Calle:</b></label>
              <input type="text" class="form-control" id="calle" name="calle" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="numero_bloque" class="form-label"><b>Número de bloque o casa:</b></label>
              <input type="number" min=0 class="form-control" id="numero_bloque" name="numero_bloque" digitsonly="true" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="piso" class="form-label"><b>Piso:</b></label>
              <input type="text" class="form-control" id="piso" name="piso" autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="telefono" class="form-label"><b>Teléfono:</b></label> 
              <input type="tel" class="form-control" id="telefono" name="telefono" digitsonly="true" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="activacion" class="form-label"><b>Activación:</b></label>
              <input type="number" class="form-control" id="activacion" name="activacion" autocomplete="off">
            </div>
            <!-- Desplegable para Activo -->
            <div class="mb-3">
              <label for="activo" class="form-label"><b>Activo:</b></label>
              <select class="form-select" id="activo" name="activo">
                <option value="0" <?= $producto['activo'] == 0 ? 'selected' : '' ?>>No</option>
                <option value="1" <?= $producto['activo'] == 1 ? 'selected' : '' ?>>Sí</option>

              </select>
            </div>
            <!-- Desplegable para Rol -->
            <div class="mb-3">
              <label for="rol" class="form-label"><b>Rol:</b></label>
              <select class="form-select" id="rol" name="rol">
                <option value="0" <?= $producto['rol'] == 0 ? 'selected' : '' ?>>Cliente</option>
                <option value="1" <?= $producto['rol'] == 1 ? 'selected' : '' ?>>Admin</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="contrasenaNueva" class="form-label"><b>Nueva Contraseña:</b></label>
              <input type="password" class="form-control" id="contrasenaNueva" name="contrasenaNueva" autocomplete="new-password">
            </div>
            <div class="mb-3">
              <label for="contrasenaConfirmar" class="form-label"><b>Confirmar Nueva Contraseña:</b></label>
              <input type="password" class="form-control" id="contrasenaConfirmar" name="contrasenaConfirmar" autocomplete="new-password">
            </div>
            <input type="hidden" name="idUsuario" id="idUsuario">
            <div class="d-grid">
              <button class="btn btn-primary" type="submit" value="Upload" style="background-color: #8350F2; border:#8350F2;">Modificar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Detalles Usuario -->
  <div class="modal fade" id="usuarioDetalleModal" tabindex="-1" aria-labelledby="usuarioDetalleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="usuarioDetalleLabel" style="color: #8350F2;">Detalles del Usuario</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p style="color: #8350F2;">Nombre de usuario:</p>
          <span id="detalle_nombre_usuario"></span>
          <hr>
          <p style="color: #8350F2;">Nombre:</p>
          <span id="detalle_nombre"></span>
          <hr>
          <p style="color: #8350F2;">Primer Apellido:</p>
          <span id="detalle_primer_apellido"></span>
          <hr>
          <p style="color: #8350F2;">Segundo Apellido:</p>
          <span id="detalle_segundo_apellido"></span>
          <hr>
          <p style="color: #8350F2;">DNI:</p>
          <span id="detalle_dni"></span>
          <hr>
          <p style="color: #8350F2;">Email:</p>
          <span id="detalle_email"></span>
          <hr>
          <p style="color: #8350F2;">Código Postal:</p>
          <span id="detalle_codigo_postal"></span>
          <hr>
          <p style="color: #8350F2;">Calle:</p>
          <span id="detalle_calle"></span>
          <hr>
          <p style="color: #8350F2;">Número Bloque:</p>
          <span id="detalle_numero_bloque"></span>
          <hr>
          <p style="color: #8350F2;">Piso:</p>
          <span id="detalle_piso"></span>
          <hr>
          <p style="color: #8350F2;">Teléfono:</p>
          <span id="detalle_telefono"></span>
          <hr>
          <p style="color: #8350F2;">Activación:</p>
          <span id="detalle_activacion"></span>
          <hr>
          <p style="color: #8350F2;">Activo:</p>
          <span id="detalle_activo"></span>
          <hr>
          <p style="color: #8350F2;">Rol:</p>
          <span id="detalle_rol"></span>
          <hr>
          <p style="color: #8350F2;">Estado:</p>
          <span id="detalle_estado"></span>
          <hr>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de baneo de usuario -->
  <div class="modal fade" id="confirmacionBanearModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="modalLabel" style="color: #8350F2;"><b>Confirmar el baneo / desbaneo</b></h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <b>¿Estás seguro de que deseas banear o desbanear este usuario?</b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="confirmarEliminar">Confirmar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="../assets/js/usuarioAdmin.js"></script>

  <script>
    //script para borrar lo que haya dentro del modal
    document.addEventListener("DOMContentLoaded", function() {
      // Selecciona el modal por su ID
      var modal = document.getElementById('insertarUsuarioModal');

      // Escucha el evento 'hidden.bs.modal' que se dispara cuando el modal se ha cerrado
      modal.addEventListener('hidden.bs.modal', function(event) {
        // Encuentra el formulario dentro del modal y lo resetea
        modal.querySelector('form').reset();
      });
    });

    //modificar un usuario
    $('#modificarUsuarioModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget); // Botón que disparó el modal
      var id = button.data('id'); // Extraer información del atributo data-*
      var nombre = button.data('nombre');
      var primerApellido = button.data('primerapellido');
      var segundoApellido = button.data('segundoapellido');
      var dni = button.data('dni');
      var email = button.data('email');
      var nombreUsuario = button.data('nombreusuario');
      var codigoPostal = button.data('codigopostal');
      var calle = button.data('calle');
      var numeroBloque = button.data('numerobloque');
      var piso = button.data('piso');
      var telefono = button.data('telefono');
      var activacion = button.data('activacion');
      var activo = button.data('activo');
      var rol = button.data('rol');
      var estado = button.data('estado');
      /* var contrasena = button.data('contrasena'); */

      var modal = $(this);
      modal.find('[name="idUsuario"]').val(id);
      modal.find('[name="nombre"]').val(nombre);
      modal.find('[name="primer_apellido"]').val(primerApellido);
      modal.find('[name="segundo_apellido"]').val(segundoApellido);
      modal.find('[name="dni"]').val(dni);
      modal.find('[name="email"]').val(email);
      modal.find('[name="nombre_usuario"]').val(nombreUsuario);
      modal.find('[name="codigo_postal"]').val(codigoPostal);
      modal.find('[name="codigo_postal"]').val(codigoPostal);
      modal.find('[name="calle"]').val(calle);
      modal.find('[name="numero_bloque"]').val(numeroBloque);
      modal.find('[name="piso"]').val(piso);
      modal.find('[name="telefono"]').val(telefono);
      modal.find('[name="activacion"]').val(activacion);
      modal.find('[name="activo"]').val(activo);
      modal.find('[name="rol"]').val(rol);
      modal.find('[name="estado"]').val(estado);
      /* modal.find('[name="contrasena"]').val(contrasena); */
    });

    //para banear un usuario
    function mostrarModalEliminar(idUsuario) {
      var modal = new bootstrap.Modal(document.getElementById('confirmacionBanearModal'));
      var botonEliminar = document.getElementById('confirmarEliminar');
      botonEliminar.onclick = function() {
        document.getElementById('formEliminar-' + idUsuario).submit();
      };
      modal.show();
    }

    //detalles usuario
    $('#usuarioDetalleModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var idUsuario = button.data('idusuario'); // Asegúrate de que este data-attribute está definido correctamente en el HTML

      $.ajax({
        url: '../controller/detalleUsuarioAdminController.php', // Asegúrate de que este endpoint está correctamente definido y apunta al script correcto en el servidor
        type: 'POST',
        data: {
          idUsuario: idUsuario
        },
        dataType: 'json', // Esperamos una respuesta en formato JSON
        success: function(usuario) {
          if (usuario && !usuario.error) {
            $('#detalle_nombre_usuario').text(usuario.nombre_usuario || 'No disponible');
            $('#detalle_nombre').text(usuario.nombre || 'No disponible');
            $('#detalle_primer_apellido').text(usuario.primer_apellido || 'No disponible');
            $('#detalle_segundo_apellido').text(usuario.segundo_apellido || 'No disponible');
            $('#detalle_dni').text(usuario.dni || 'No disponible');
            $('#detalle_email').text(usuario.email || 'No disponible');
            $('#detalle_codigo_postal').text(usuario.codigo_postal || 'No disponible');
            $('#detalle_calle').text(usuario.calle || 'No disponible');
            $('#detalle_numero_bloque').text(usuario.numero_bloque || 'No disponible');
            $('#detalle_piso').text(usuario.piso || 'No disponible');
            $('#detalle_telefono').text(usuario.telefono || 'No disponible');
            $('#detalle_activacion').text(usuario.activacion || 'No disponible');
            $('#detalle_activo').text(usuario.activo == 1 ? 'Sí' : 'No');
            $('#detalle_rol').text(usuario.rol == 1 ? 'Admin' : 'Cliente');
            $('#detalle_estado').text(usuario.estado == 1 ? 'Baneado' : 'Habilitado');;

          } else {
            console.error('No se pudo cargar la información del usuario.');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error en la solicitud AJAX: ' + error);
        }
      });
    });
  </script>
</body>

</html>