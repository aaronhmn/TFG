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

    <title>Pedidos - Dashboard</title>
</head>

<body style="background-color: #e6e6fa">

<nav class="navbar navbar-dark fixed-top" style="background-color: #8350f2;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
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
                    <li><form action="../controller/inicioController.php" method="POST">
                        <button class="dropdown-item">
                            <i class="fas fa-home"></i> Ir a la web
                        </button>
                    </form></li><hr>
                    <li><form action="../controller/cerrarSesionController.php" method="POST">
                        <button class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </button>
                    </form></li>
                </ul>
            </div>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel" style="visibility: visible; background-color: #8350f2;">
                <div class="offcanvas-header">
                    <h3 class="offcanvas-title" id="offcanvasDarkNavbarLabel" style="color: white; margin-left: 20px;">
                    <img src="../assets/img/genesis Logo.png" style="width: 80px; margin-right: 5px; margin-left: -20px;"><b>Menu</b>
                    </h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div><hr style="color: #fff;">
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
                        <li class="nav-item mt-4" id="active">
                            <a class="nav-link active" href="../controller/pedidosAdminController.php"><i class="fas fa-shipping-fast fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">pedidos</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5" style="max-width: 1600px;"><br><br><br>
        <div class="row" style="margin: 0;">
            <div class="col-lg-12 col-sm-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Id Pedido</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Nombre de Usuario</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Fecha de pedido</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Precio Total</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col"></th>
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

                        foreach ($pedidosPaginados as $datosPedido) {

                            $nombreUsuario = $gestorUsuarios->getUsuarioId($datosPedido["id_usuario_pedido"], $conexPDO)['nombre_usuario'];
                            /* $nombreCategoria = $gestorCategorias->getCategoriaId($datosProducto["id_categoria"], $conexPDO)['nombre_categoria']; */
                            //Comienzo de fila
                            print("<tr style='align-items: center; background-color: gray;'>\n");

                            //Id de pedido
                            print("<td style='padding-top: 14px;' scope='row'><b>" . $datosPedido["idpedido"] . "</b></td>\n");
                            //Nombre usuario
                            print("<td style='padding-top: 14px;'>" . $nombreUsuario . "</td>\n");
                            //Fecha pedido
                            print("<td style='padding-top: 14px;'>" . $datosPedido["fecha_pedido"] . "</td>\n");
                            //Precio total
                            print("<td style='padding-top: 14px;'>" . $datosPedido["precio_total"] . "€</td>\n");


                            echo "<td>";
                            echo "<a href='../controller/detallesPedidoAdminController.php?idPedido=" . htmlspecialchars($datosPedido['idpedido'], ENT_QUOTES) . "' class='btn btn-info' style='color: white;'>";
                            echo "<i class='fas fa-eye'></i> Ver Detalles";
                            echo "</a>";
                            echo "</td>";
                        }
                        ?>
                    </tbody>
                </table>
                <form method="POST" action="../controller/pedidosAdminController.php">
                    <?php
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        echo "<button style='margin-left: 7px; margin-bottom: 25px; background-color: #8350F2; color: #fff; border-radius: 50%; width: 40px' name='Pag' value='$i' class='btn'>$i</button>";
                    }
                    ?>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</body>

</html>