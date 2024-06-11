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

    <title>Almacenes - Dashboard</title>
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
                        <li class="nav-item mt-4">
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
                            <a class="nav-link active" href="../controller/pedidosAdminController.php"><i class="fas fa-shipping-fast fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Pedidos</span></a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link active" href="../controller/reseñasAdminController.php"><i class="fas fa-comments fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Reseñas</span></a>
                        </li>
                        <li class="nav-item mt-4" id="active">
                            <a class="nav-link active" href="../controller/almacenesAdminController.php"><i class="fa-solid fa-warehouse fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Almacenes</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5"><br><br>

        <div class="navbar2 mt-5">
            <ul>
                <li>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#insertarAlmacenModal">
                        Insertar almacén nuevo
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

        <div class="row" style="margin-right: 0;">
            <div class="col-lg-12 col-sm-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Id</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Nombre del almacén</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Teléfono</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Código postal</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Calle</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Número del bloque</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Piso</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($AlmacenesPaginadas as $almacen) {
                            echo "<tr>";
                            echo "<td><b>{$almacen['idalmacen']}</b></td>";
                            echo "<td>{$almacen['nombre']}</td>";
                            echo "<td>{$almacen['telefono']}</td>";
                            echo "<td>{$almacen['codigo_postal']}</td>";
                            echo "<td>{$almacen['calle']}</td>";
                            echo "<td>{$almacen['numero_bloque']}</td>";
                            $pisoDisplay = empty($almacen['piso']) ? "No tiene" : $almacen['piso'];
                            echo "<td>{$pisoDisplay}</td>";

                            // Acciones
                            echo "<td>";
                            echo "<div style='display: flex; justify-content: flex-end; align-items: center; margin-right: 20px;'>"; // Flex container para los botones

                            // Botón Modificar
                            echo "<button class='btn btn-link p-0 align-middle' title='Modificar' data-bs-toggle='modal' data-bs-target='#modificarAlmacenModal' ";
                            echo "data-id='{$almacen['idalmacen']}' ";
                            echo "data-nombre='" . htmlspecialchars($almacen['nombre'], ENT_QUOTES) . "' ";
                            echo "data-telefono='{$almacen['telefono']}' ";
                            echo "data-codigo_postal='{$almacen['codigo_postal']}' ";
                            echo "data-calle='" . htmlspecialchars($almacen['calle'], ENT_QUOTES) . "' ";
                            echo "data-numero_bloque='{$almacen['numero_bloque']}' ";
                            echo "data-piso='" . htmlspecialchars($almacen['piso'], ENT_QUOTES) . "' ";
                            echo "style='margin-right: 25px; background-color: transparent;'>";
                            echo "<i class='fas fa-edit fa-lg' style='color: #005eff;'></i>";
                            echo "</button>";

                            // Botón Eliminar
                            echo "<form id='formEliminar-{$almacen['idalmacen']}' method='POST' action='../controller/borrarAlmacenController.php'>";
                            echo "<input type='hidden' name='idAlmacen' value='{$almacen['idalmacen']}'/>";
                            echo "<button class='btn btn-link p-0 align-middle' title='Eliminar' type='button' onclick='mostrarModalEliminar(" . $almacen['idalmacen'] . ");' style='background-color: transparent;'>";
                            echo "<i class='fa-solid fa-trash-alt fa-lg' style='color: red;'></i>";
                            echo "</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <form method="POST" action="../controller/almacenesAdminController.php">
                    <?php
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        echo "<button style='margin-left: 7px; margin-bottom: 25px; background-color: #8350F2; color: #fff; border-radius: 50%; width: 40px' name='Pag' value='$i' class='btn'>$i</button>";
                    }
                    ?>
                </form>
            </div>


        </div><br>
    </div>

    <!-- Modal Insertar Almacen -->
    <div class="modal fade" id="insertarAlmacenModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalLabel" style="color: #8350F2;"><b>Insertar nuevo almacén</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va el formulario de inserción de categoria -->
                    <form method="POST" action="../controller/insertarAlmacenesAdminController.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="inputNombre" class="form-label"><b>Nombre del almacen:</b></label>
                            <input type="text" class="form-control" name="inputNombre" required aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="inputTelefono" class="form-label"><b>Teléfono:</b></label>
                            <input type="number" class="form-control" name="inputTelefono" digitsonly="true" required aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="inputCP" class="form-label"><b>Código postal:</b></label>
                            <input type="number" class="form-control" name="inputCP" digitsonly="true" required aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="inputCalle" class="form-label"><b>Calle:</b></label>
                            <input type="text" class="form-control" name="inputCalle" required aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="inputNB" class="form-label"><b>Número del bloque:</b></label>
                            <input type="number" class="form-control" name="inputNB" digitsonly="true" required aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="inputPiso" class="form-label"><b>Piso:</b></label>
                            <input type="text" class="form-control" name="inputPiso" aria-describedby="emailHelp">
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit" value="Upload" style="background-color: #8350F2; border:#8350F2;">Insertar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modificar Almacen -->
    <div class="modal fade" id="modificarAlmacenModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalLabel" style="color: #8350F2;"><b>Modificar almacén</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va el formulario de modificacion de categoria -->
                    <form method="POST" action="../controller/modificarAlmacenController.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label"><b>Nombre del almacén:</b></label>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="" required>
                            <input type="hidden" name="idAlmacen" id="idAlmacen" value="">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label"><b>Teléfono:</b></label>
                            <input type="number" class="form-control" name="telefono" id="telefono" value="" required digitsonly="true">
                            <input type="hidden" name="idAlmacen" id="idAlmacen" value="">
                        </div>
                        <div class="mb-3">
                            <label for="codigo_postal" class="form-label"><b>Código postal:</b></label>
                            <input type="number" class="form-control" name="codigo_postal" id="codigo_postal" value="" required digitsonly="true">
                            <input type="hidden" name="idAlmacen" id="idAlmacen" value="">
                        </div>
                        <div class="mb-3">
                            <label for="calle" class="form-label"><b>Calle:</b></label>
                            <input type="text" class="form-control" name="calle" id="calle" value="" required>
                            <input type="hidden" name="idAlmacen" id="idAlmacen" value="">
                        </div>
                        <div class="mb-3">
                            <label for="numero_bloque" class="form-label"><b>Número del bloque:</b></label>
                            <input type="number" class="form-control" name="numero_bloque" id="numero_bloque" value="" required digitsonly="true">
                            <input type="hidden" name="idAlmacen" id="idAlmacen" value="">
                        </div>
                        <div class="mb-3">
                            <label for="piso" class="form-label"><b>Piso:</b></label>
                            <input type="text" class="form-control" name="piso" id="piso" value="">
                            <input type="hidden" name="idAlmacen" id="idAlmacen" value="">
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit" value="Upload" style="background-color: #8350F2; border:#8350F2;">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="confirmacionEliminarModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalLabel" style="color: #8350F2;"><b>Confirmar Eliminación</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <b>¿Estás seguro de que deseas eliminar esta marca?</b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmarEliminar">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../assets/js/almacenAdmin.js"></script>

    <script type='text/javascript'>
        //script para borrar lo que haya dentro del modal
        document.addEventListener("DOMContentLoaded", function() {
            // Selecciona el modal por su ID
            var modal = document.getElementById('insertarAlmacenModal');

            // Escucha el evento 'hidden.bs.modal' que se dispara cuando el modal se ha cerrado
            modal.addEventListener('hidden.bs.modal', function(event) {
                // Encuentra el formulario dentro del modal y lo resetea
                modal.querySelector('form').reset();
            });
        });

        $('#modificarAlmacenModal').on('show.bs.modal', function(event) {
            // Obtiene el botón que desencadenó el evento
            var button = $(event.relatedTarget);
            // Extrae datos del botón utilizando data attributes
            var idAlmacen = button.data('id'); // Obtiene el id del almacén
            var nombre = button.data('nombre'); // Obtiene el nombre del almacén
            var telefono = button.data('telefono'); // Obtiene el teléfono del almacén
            var codigo_postal = button.data('codigo_postal'); // Obtiene el código postal del almacén
            var calle = button.data('calle'); // Obtiene la calle del almacén
            var numero_bloque = button.data('numero_bloque'); // Obtiene el número de bloque del almacén
            var piso = button.data('piso'); // Obtiene el piso del almacén
            
            // Obtiene el modal actual
            var modal = $(this);
            // Asigna los valores extraídos a los campos correspondientes del modal
            modal.find('[name="nombre"]').val(nombre);
            modal.find('[name="telefono"]').val(telefono);
            modal.find('[name="codigo_postal"]').val(codigo_postal);
            modal.find('[name="calle"]').val(calle);
            modal.find('[name="numero_bloque"]').val(numero_bloque);
            modal.find('[name="piso"]').val(piso);
            modal.find('[name="idAlmacen"]').val(idAlmacen);

        });

        function mostrarModalEliminar(idAlmacen) {
            var modal = new bootstrap.Modal(document.getElementById('confirmacionEliminarModal'));
            var botonEliminar = document.getElementById('confirmarEliminar');
            botonEliminar.onclick = function() {
                document.getElementById('formEliminar-' + idAlmacen).submit();
            };
            modal.show();
        }
    </script>

</body>

</html>