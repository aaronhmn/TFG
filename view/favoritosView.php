<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/styles/sass/fav.css" />
    <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />

    <title>Lista de Favoritos - Genesis</title>
</head>

<body style="background-color: #e6e6fa;" <?php if (isset($_SESSION['id_usuario'])) echo 'data-user-id="' . $_SESSION['id_usuario'] . '"'; ?>>
    <!--NAV DE LA PAGINA-->
    <?php include '../controller/navbarController.php'; ?>

    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <h3 style="color: #ffa500;"><b>Mi lista de favoritos</b></h3><br>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="background-color: #8350f2; color: white;" scope="col">Imagen</th>
                        <th style="background-color: #8350f2; color: white;" scope="col">Nombre del producto</th>
                        <th style="background-color: #8350f2; color: white;" scope="col">Precio</th>
                        <th style="background-color: #8350f2; color: white;" scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody id="carrito-body">
                </tbody>
            </table>
        </div>
        <div id="pagination-container"></div>
    </div><br><br>

    <!--FOOTER-->
    <?php include '../controller/footerController.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/listaFav.js"></script>
</body>

</html>