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

    <title>Categorías - Dashboard</title>
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
            <li class="active">
                <a href="../controller/categoriasAdminController.php">
                    <i class="fas fa-list-alt"></i>
                    <span><b>Categorías</b></span>
                </a>
            </li>
            <li>
                <a href="../controller/marcasAdminController.php">
                <i class="fa-solid fa-flag"></i>
                    <span>Marcas</span>
                </a>
            </li>
            <li>
                <a href="../controller/inicioController.php">
                    <i class="fas fa-home"></i>
                    <span>Web</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-sign-out" style="color: #2d2d2d;"></i>
                    <span>
                        <form action='../controller/cerrarSesionController.php' method="POST">
                            <button class="boton-CS" style="color: #2d2d2d; background-color: rgba(0, 0, 0, 0);"><b>Salir</b></button>
                        </form>
                    </span>
                </a>
            </li>
        </ul>
    </div>

    <div class="container" style="max-width: 1600px;"><br><br>
        <div class="navbar2">
            <ul>
                <li>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#insertarCategoriaModal">
                        Insertar categoria nueva
                    </button>
                </li>
                <li>
                    <h3 style="color: #8350F2;">Bienvenido
                        <?php
                        $resultado = $_SESSION['nombre_usuario'];
                        print "<b>" . $resultado . "</b>";
                        ?>
                    </h3>
                </li>
                <li>
                    <form action='../controller/cerrarSesionController.php' method="POST">
                        <button class="btn" style="background-color: #ec5353; color: #fff;"><b>Cerrar Sesión</b></button>
                    </form>
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
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Nombre de la Categoría</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col"></th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($categoriasPaginadas as $categoria) {
                            echo "<tr style='align-items: center; background-color: gray;'>";
                            echo "<td style='padding-top: 14px;' scope='row'><b>{$categoria['idcategoria']}</b></td>";
                            echo "<td style='padding-top: 14px;'>{$categoria['nombre_categoria']}</td>";

                            // Botón para modificar
                            echo "<td>";
                            echo "<button data-bs-toggle='modal' data-bs-target='#modificarCategoriaModal' data-id='{$categoria['idcategoria']}' data-nombre='" . htmlspecialchars($categoria['nombre_categoria'], ENT_QUOTES) . "' style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;'>";
                            echo "<i class='fas fa-edit fa-lg' style='color: #005eff;'></i>";
                            echo "</button>";
                            echo "</td>";

                            // Botón para eliminar
                            echo "<td>";
                            echo "<form id='formEliminar-{$categoria['idcategoria']}' method='POST' action='../controller/borrarCategoriaController.php'>";
                            echo "<input type='hidden' name='idCategoria' value='{$categoria['idcategoria']}'/>";
                            echo "<button style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;' type='button' onclick='mostrarModalEliminar(" . $categoria['idcategoria'] . ");'><i class='fa-solid fa-trash-alt fa-lg' style='color: red;'></i></button>";
                            echo "</form>";
                            echo "</td>";

                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <form method="POST" action="../controller/categoriasAdminController.php">
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
    <div class="modal fade" id="insertarCategoriaModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalLabel" style="color: #8350F2;"><b>Insertar nueva categoria</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va el formulario de inserción de categoria -->
                    <form method="POST" action="../controller/insertarCategoriasAdminController.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="inputNombre" class="form-label"><b>Nombre de la Categoría:</b></label>
                            <input type="text" class="form-control" name="inputNombre" aria-describedby="emailHelp">
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
    <div class="modal fade" id="modificarCategoriaModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalLabel" style="color: #8350F2;"><b>Modificar categoria</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va el formulario de modificacion de categoria -->
                    <form method="POST" action="../controller/modificarCategoriaAdminController.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre_categoria" class="form-label"><b>Nombre de la Categoría:</b></label>
                            <input type="text" class="form-control" name="nombre_categoria" id="nombre_categoria" value="">
                            <input type="hidden" name="idCategoria" id="idCategoria" value="">
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
                    <b>¿Estás seguro de que deseas eliminar esta categoría?</b>
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
            var modal = document.getElementById('insertarCategoriaModal');

            // Escucha el evento 'hidden.bs.modal' que se dispara cuando el modal se ha cerrado
            modal.addEventListener('hidden.bs.modal', function(event) {
                // Encuentra el formulario dentro del modal y lo resetea
                modal.querySelector('form').reset();
            });
        });

        $('#modificarCategoriaModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var idCategoria = button.data('id');
            var nombreCategoria = button.data('nombre');

            var modal = $(this);
            modal.find('[name="nombre_categoria"]').val(nombreCategoria);
            modal.find('[name="idCategoria"]').val(idCategoria);
        });

        function mostrarModalEliminar(idCategoria) {
            var modal = new bootstrap.Modal(document.getElementById('confirmacionEliminarModal'));
            var botonEliminar = document.getElementById('confirmarEliminar');
            botonEliminar.onclick = function() {
                document.getElementById('formEliminar-' + idCategoria).submit();
            };
            modal.show();
        }
    </script>

</body>

</html>