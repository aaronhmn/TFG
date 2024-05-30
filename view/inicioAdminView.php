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

    <title>Inicio - Dashboard</title>
</head>

<body style="background-color: #e6e6fa">
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>

    <nav class="navbar navbar-dark fixed-top" style="background-color: #8350f2;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#" id="logo-sidebar"><img src="../assets/img/genesis Logo.png" style="width: 50px;">Genesis</a>
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
                    </li><hr>
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
                        <li class="nav-item" id="active">
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
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-5"><br><br>

        <div class="row g-5 justify-content-center" style="margin: 0;">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                <a href="../controller/usuariosAdminController.php" class="enlace-cards">
                    <div class="card" style="width: 14rem; text-align: center; margin: auto; border: 2px solid #8350F2;">
                        <div class="icon-container" style="font-size: 4rem; margin-top: 20px;">
                            <i class="fas fa-user" style="color: #8350F2;"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><b>Usuarios</b> <span class="badge badge-custom"><?= $usuarios ?></span></h5>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                <a href="../controller/productosAdminController.php" class="enlace-cards">
                    <div class="card" style="width: 14rem; text-align: center; margin: auto; border: 2px solid #8350F2;">
                        <div class="icon-container" style="font-size: 4rem; margin-top: 20px;">
                            <i class="fas fa-briefcase" style="color: #8350F2;"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><b>Productos</b> <span class="badge badge-custom"><?= $productos ?></span></h5>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                <a href="../controller/categoriasAdminController.php" class="enlace-cards">
                    <div class="card" style="width: 14rem; text-align: center; margin: auto; border: 2px solid #8350F2;">
                        <div class="icon-container" style="font-size: 4rem; margin-top: 20px;">
                            <i class="fas fa-list-alt" style="color: #8350F2;"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><b>Categorías</b> <span class="badge badge-custom"><?= $categorias ?></span></h5>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                <a href="../controller/marcasAdminController.php" class="enlace-cards">
                    <div class="card" style="width: 14rem; text-align: center; margin: auto; border: 2px solid #8350F2;">
                        <div class="icon-container" style="font-size: 4rem; margin-top: 20px;">
                            <i class="fa-solid fa-flag" style="color: #8350F2;"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><b>Marcas</b> <span class="badge badge-custom"><?= $marcas ?></span></h5>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2" style="margin-bottom: 60px;">
                <a href="../controller/pedidosAdminController.php" class="enlace-cards">
                    <div class="card" style="width: 14rem; text-align: center; margin: auto; border: 2px solid #8350F2;">
                        <div class="icon-container" style="font-size: 4rem; margin-top: 20px;">
                            <i class="fas fa-shipping-fast" style="color: #8350F2;"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><b>Pedidos</b> <span class="badge badge-custom"><?= $pedidos ?></span></h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2" style="margin-bottom: 60px;">
                <a href="../controller/reseñasAdminController.php" class="enlace-cards">
                    <div class="card" style="width: 14rem; text-align: center; margin: auto; border: 2px solid #8350F2;">
                        <div class="icon-container" style="font-size: 4rem; margin-top: 20px;">
                            <i class="fas fa-comments" style="color: #8350F2;"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><b>Reseñas</b> <span class="badge badge-custom"><?= $reseñas ?></span></h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>