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

    <title>Reseñas - Dashboard</title>
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
                        <li class="nav-item mt-4" id="active">
                            <a class="nav-link active" href="../controller/reseñasAdminController.php"><i class="fas fa-comments fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Reseñas</span></a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link active" href="../controller/almacenesAdminController.php"><i class="fa-solid fa-warehouse fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Almacenes</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5" style="max-width: 1600px;"><br><br><br>
        <div class="row mt-5" style="margin: 0;">
            <div class="col-lg-12 col-sm-12 table-responsive mt-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Id</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Fecha</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Usuario</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Nombre del producto</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Valoración</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Ver comentario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Tenemos que generar una fila tr para cada producto
                        //que tenga el array de datosProducto
                        function truncarTexto($texto, $maxCaracteres)
                        {
                            if (strlen($texto) > $maxCaracteres) {
                                $texto = substr($texto, 0, $maxCaracteres) . '...';
                            }
                            return $texto;
                        }

                        foreach ($reseñasPaginados as $datosReseña) {

                            $nombreUsuario = $gestorUsuarios->getUsuarioId($datosReseña["id_usuario_resena"], $conexPDO)['nombre_usuario'];
                            $nombreProducto = $gestorProductos->getProductoId($datosReseña["id_producto_resena"], $conexPDO)['nombre'];
                            //Comienzo de fila
                            print("<tr style='align-items: center; background-color: gray;'>\n");

                            //Id de reseña
                            print("<td scope='row'><b>" . $datosReseña["idresena"] . "</b></td>\n");
                            //Fecha pedido
                            print("<td>" . $datosReseña["fecha_resena"] . "</td>\n");
                            //Nombre usuario
                            print("<td>" . $nombreUsuario . "</td>\n");
                            //Nombre producto
                            print("<td>" . $nombreProducto . "</td>\n");
                            //Valoracion
                            print("<td>" . $datosReseña["valoracion"] . "</td>\n");
                            //Comentario
                            print "<td><button class='btn btn-link p-0 align-middle' style='vertical-align: middle;' title='Ver comentario' onclick='mostrarComentario(\"" . addslashes($datosReseña["comentario"]) . "\")'><i class='fas fa-eye fa-xl' style='color: #8350f2'></i></button></td>\n";
                        }
                        ?>
                    </tbody>
                </table>
                <form method="POST" action="../controller/reseñasAdminController.php">
                    <?php
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        echo "<button style='margin-left: 7px; margin-bottom: 25px; background-color: #8350F2; color: #fff; border-radius: 50%; width: 40px' name='Pag' value='$i' class='btn'>$i</button>";
                    }
                    ?>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="comentarioModal" tabindex="-1" aria-labelledby="comentarioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="comentarioModalLabel" style="color: #8350F2;"><b>Comentario</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí se añadirá el comentario -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        function mostrarComentario(comentario) {
            // Selecciona el elemento del cuerpo del modal donde se mostrará el comentario
            const modalBody = document.querySelector('#comentarioModal .modal-body');
            // Establece el texto del comentario en el cuerpo del modal, usando textContent para evitar inyección de HTML
            modalBody.textContent = comentario;
            // Inicializa y muestra el modal de Bootstrap con el ID 'comentarioModal'
            const modal = new bootstrap.Modal(document.getElementById('comentarioModal'));
            modal.show();
        }
    </script>

</body>

</html>