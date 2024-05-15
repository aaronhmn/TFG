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

    <title>Detalles del Pedido - Dashboard</title>
</head>

<body style="background-color: #e6e6fa">

    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>

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
            <li>
                <a href="../controller/marcasAdminController.php">
                    <i class="fa-solid fa-flag"></i>
                    <span>Marcas</span>
                </a>
            </li>
            <li class="active">
                <a href="../controller/pedidosAdminController.php">
                    <i class="fas fa-shipping-fast"></i>
                    <span><b>Pedidos</b></span>
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
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Id Detalle</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Id Pedido</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Nombre del Producto</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Precio</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Cantidad</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Precio Subtotal</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php foreach ($detalles as $detalle) : 
                            $nombreProducto = $productoModel->getProductoId($detalle['id_producto_dp'], $conexPDO)['nombre'];?>
                            <tr>
                                <td style='padding-top: 14px;'><?php echo htmlspecialchars($detalle['iddetalle_pedido']); ?></td>
                                <td style='padding-top: 14px;'><?php echo htmlspecialchars($detalle['id_pedido_dp']); ?></td>
                                <?php print("<td style='padding-top: 14px;'>" . $nombreProducto . "</td>\n"); ?>
                                <td style='padding-top: 14px;'><?php echo htmlspecialchars($detalle['precio']); ?>€</td>
                                <td style='padding-top: 14px;'><?php echo htmlspecialchars($detalle['cantidad']); ?></td>
                                <td style='padding-top: 14px;'><?php echo htmlspecialchars($detalle['precio_subtotal']); ?>€</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <form method="GET" action="../controller/detallesPedidosAdminController.php">
                    <?php
                    if (isset($totalPaginas)) {
                        for ($i = 1; $i <= $totalPaginas; $i++) {
                            echo "<button style='margin-left: 7px; margin-bottom: 25px; background-color: #8350F2; color: #fff; border-radius: 50%; width: 40px' name='Pag' value='$i' class='btn'>$i</button>";
                        }
                    }
                    ?>
                    <input type="hidden" name="idPedido" value="<?php echo htmlspecialchars($idPedido); ?>" />
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>

</html>
