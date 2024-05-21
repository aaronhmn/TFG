<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/styles/css/pedidos.css" />
  <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />

  <title>Mis Pedidos - Genesis</title>
</head>

<body style="background-color: #e6e6fa" data-user-id="<?php echo $_SESSION['id_usuario']; ?>">
  <!--NAV DE LA PAGINA-->
  <?php include '../controller/navbarController.php'; ?>

  <div class="container" style="margin-top: 50px; margin-bottom: 100px">
  <h2 class="mb-4" style="color: #ffa500;"><b>Mis Pedidos</b></h2>
        <?php if (!empty($pedidos)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="background-color: #8350F2; color: #fff;">Pedidos</th>
                            <th style="background-color: #8350F2; color: #fff;">Fecha Pedido</th>
                            <th style="background-color: #8350F2; color: #fff;">Precio Total</th>
                            <th style="background-color: #8350F2; color: #fff; text-align:center;">Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = ($paginaActual - 1) * $registrosPorPagina + 1; foreach ($pedidos as $pedido): ?>
                        <tr>
                        <td><b><?php echo $contador++; ?></b></td>
                            <td><?php echo htmlspecialchars($pedido['fecha_pedido']); ?></td>
                            <td><?php echo htmlspecialchars($pedido['precio_total']); ?>€</td>
                            <td style="text-align: center;"><a href="../controller/misDetallesPedidoController.php?idPedido=<?php echo $pedido['idpedido']; ?>"><i class='fas fa-eye fa-xl' style='color: #8350f2'></i></a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                No hay pedidos para mostrar.
            </div>
        <?php endif; ?>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <li class="page-item <?= ($i == $paginaActual) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>" style="background-color:#8350F2; border-color:#8350F2; margin-right: 7px; color: #fff;"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
  </div>

  <button onclick="scrollToTop()" id="btnSubir" title="Ir arriba"><i class="fa-solid fa-arrow-up fa-xl" style="color: #ffffff; align-items:center;"></i></button>

  <!--FOOTER-->
  <?php include '../controller/footerController.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="../assets/js/main.js"></script>
</body>

</html>