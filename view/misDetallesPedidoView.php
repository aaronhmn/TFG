<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/styles/css/detallesPedidos.css" />
    <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
    <title>Detalle de Pedido - Genesis</title>
</head>

<body style="background-color: #e6e6fa" data-user-id="<?php echo $_SESSION['id_usuario']; ?>">
    <?php include '../controller/navbarController.php'; ?>

    <div class="container-fluid mt-5" style="max-width: 80%;">
        <h2 class="mb-3" style="color: #ffa500;"><b>Detalles del Pedido</b></h2><br>
        <div class="navbar2">
            <ul>
                <li>
                    <a href="../controller/misPedidosController.php" class="btn btn-info" style="color: white; background-color: #8350F2; border-color: #8350F2;">
                        <i class="fas fa-arrow-left" style="margin-right: 3px;"></i> Volver atrás
                    </a>
                </li>
            </ul>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="background-color: #8350f2; color: #fff;">Productos</th>
                        <!-- <th style="background-color: #8350f2; color: #fff;">ID Pedido</th> -->
                        <th style="background-color: #8350f2; color: #fff;">Nombre del Producto</th>
                        <th style="background-color: #8350f2; color: #fff;">Precio</th>
                        <th style="background-color: #8350f2; color: #fff;">Cantidad</th>
                        <th style="background-color: #8350f2; color: #fff;">Precio Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $contador = ($paginaActual - 1) * $itemsPorPagina + 1;
                    foreach ($detalles as $detalle) :
                        $nombreProducto = $productoModel->getProductoIdAdmin($detalle['id_producto_dp'], $conexPDO)['nombre']; ?>
                        <tr>
                            <td><b><?php echo $contador++; ?></b></td>
                            <!-- <td><?php echo htmlspecialchars($detalle['id_pedido_dp']); ?></td> -->
                            <td><?php echo $nombreProducto; ?></td>
                            <td><?php echo htmlspecialchars($detalle['precio']); ?> €</td>
                            <td><?php echo htmlspecialchars($detalle['cantidad']); ?></td>
                            <td><?php echo htmlspecialchars($detalle['precio_subtotal']); ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form method="GET" action="../controller/misDetallesPedidoController.php">
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
    </div><br><br><br>

    <button onclick="scrollToTop()" id="btnSubir" title="Ir arriba"><i class="fa-solid fa-arrow-up fa-xl" style="color: #ffffff; align-items:center;"></i></button>

    <?php include '../controller/footerController.php'; ?>

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>