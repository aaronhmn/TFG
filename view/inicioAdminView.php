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

    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li class="active">
                <a href="../controller/inicioAdminController.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span><b>Dashboard</b></span>
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

        <div class="row g-5 justify-content-center">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
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
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
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
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
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
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
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
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                <a href="#" class="enlace-cards">
                    <div class="card" style="width: 14rem; text-align: center; margin: auto; border: 2px solid #8350F2;">
                        <div class="icon-container" style="font-size: 4rem; margin-top: 20px;">
                            <i class="fas fa-shipping-fast" style="color: #8350F2;"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><b>Pedidos</b></h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>

</body>

</html>