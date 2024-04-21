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

    <title>Marcas - Dashboard</title>
</head>

<body style="background-color: #e6e6fa">

    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li>
                <a href="../controller/inicioAdminController.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../controller/usuariosAdminController.php">
                    <i class="fas fa-user"></i>
                    <span>Usuarios</span>
                </a>
            </li>
            <li>
                <a href="../controller/productosAdminController.php">
                    <i class="fas fa-briefcase"></i>
                    <span>Productos</span>
                </a>
            </li>
            <li>
                <a href="../controller/categoriasAdminController.php">
                    <i class="fas fa-list-alt"></i>
                    <span>Categorías</span>
                </a>
            </li>
            <li class="active">
                <a href="../controller/marcasAdminController.php">
                    <i class="fa-solid fa-flag"></i>
                    <span><b>Marcas</b></span>
                </a>
            </li>
        </ul>
    </div>

    <div class="container" style="max-width: 1600px;"><br><br>
        <nav class="navbar3">
            <img class="logo" src="../assets/img/genesis logo sin fondo favicon.png" alt="">
            <p class="parrafo-logo"><b>Genesis</b></p>
            <ul>
                <li>
                    <h3 style="margin-right: 50px;">Bienvenido
                        <?php
                        $resultado = $_SESSION['nombre_usuario'];
                        print "<b style='color: #8350f2;'>" . $resultado . "</b>";
                        ?>
                    </h3>
                </li>
                <li>
                    <form action='../controller/inicioController.php' method="POST">
                        <button class="btn btn-primary home-boton" style="margin-right: 50px; background-color: #8350F2; border-color: #8350F2; border-radius: 4px;"><i class="fas fa-home" style="color: white; margin-right: 8px;"></i><b>Ir a la web</b></button>
                    </form>
                </li>
                <li>
                    <form action='../controller/cerrarSesionController.php' method="POST">
                        <button class="btn btn-danger"><i class="fas fa-sign-out" style="color: white; margin-right: 8px;"></i><b>Cerrar Sesión</b></button>
                    </form>
                </li>
            </ul>
        </nav><br>
        <hr style="border-top: 2px solid #8350F2;"><br>

        <div class="navbar2">
            <ul>
                <li>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#insertarMarcaModal">
                        Insertar marca nueva
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

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Id</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Nombre de la Marca</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col"></th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($marcasPaginadas as $marca) {
                            echo "<tr style='align-items: center; background-color: gray;'>";
                            echo "<td style='padding-top: 14px;' scope='row'><b>{$marca['idmarca']}</b></td>";
                            echo "<td style='padding-top: 14px;'>{$marca['nombre_marca']}</td>";

                            // Botón para modificar
                            echo "<td>";
                            echo "<button data-bs-toggle='modal' data-bs-target='#modificarMarcaModal' data-id='{$marca['idmarca']}' data-nombre='" . htmlspecialchars($marca['nombre_marca'], ENT_QUOTES) . "' style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;'>";
                            echo "<i class='fas fa-edit fa-lg' style='color: #005eff;'></i>";
                            echo "</button>";
                            echo "</td>";

                            // Botón para eliminar
                            echo "<td>";
                            echo "<form id='formEliminar-{$marca['idmarca']}' method='POST' action='../controller/borrarMarcaController.php'>";
                            echo "<input type='hidden' name='idMarca' value='{$marca['idmarca']}'/>";
                            echo "<button style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;' type='button' onclick='mostrarModalEliminar(" . $marca['idmarca'] . ");'><i class='fa-solid fa-trash-alt fa-lg' style='color: red;'></i></button>";
                            echo "</form>";
                            echo "</td>";

                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <form method="POST" action="../controller/marcasAdminController.php">
                    <?php
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        echo "<button style='margin-left: 7px; margin-bottom: 25px; background-color: #8350F2; color: #fff; border-radius: 50%; width: 40px' name='Pag' value='$i' class='btn'>$i</button>";
                    }
                    ?>
                </form>
            </div>


        </div><br>
    </div>

    <!-- Modal Insertar Categoria -->
    <div class="modal fade" id="insertarMarcaModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalLabel" style="color: #8350F2;"><b>Insertar nueva marca</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va el formulario de inserción de categoria -->
                    <form method="POST" action="../controller/insertarMarcasAdminController.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="inputNombre" class="form-label"><b>Nombre de la Marca:</b></label>
                            <input type="text" class="form-control" name="inputNombre" required aria-describedby="emailHelp">
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit" value="Upload" style="background-color: #8350F2; border:#8350F2;">Insertar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modificar Categoria -->
    <div class="modal fade" id="modificarMarcaModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalLabel" style="color: #8350F2;"><b>Modificar marca</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va el formulario de modificacion de categoria -->
                    <form method="POST" action="../controller/modificarMarcaAdminController.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre_marca" class="form-label"><b>Nombre de la Categoría:</b></label>
                            <input type="text" class="form-control" name="nombre_marca" id="nombre_marca" value="" required>
                            <input type="hidden" name="idMarca" id="idMarca" value="">
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

    <script type='text/javascript'>
        //script para borrar lo que haya dentro del modal
        document.addEventListener("DOMContentLoaded", function() {
            // Selecciona el modal por su ID
            var modal = document.getElementById('insertarMarcaModal');

            // Escucha el evento 'hidden.bs.modal' que se dispara cuando el modal se ha cerrado
            modal.addEventListener('hidden.bs.modal', function(event) {
                // Encuentra el formulario dentro del modal y lo resetea
                modal.querySelector('form').reset();
            });
        });

        $('#modificarMarcaModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var idMarca = button.data('id');
            var nombreMarca = button.data('nombre');

            var modal = $(this);
            modal.find('[name="nombre_marca"]').val(nombreMarca);
            modal.find('[name="idMarca"]').val(idMarca);
        });

        function mostrarModalEliminar(idMarca) {
            var modal = new bootstrap.Modal(document.getElementById('confirmacionEliminarModal'));
            var botonEliminar = document.getElementById('confirmarEliminar');
            botonEliminar.onclick = function() {
                document.getElementById('formEliminar-' + idMarca).submit();
            };
            modal.show();
        }
    </script>

</body>

</html>