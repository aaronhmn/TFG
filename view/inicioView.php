<?php
namespace views;
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../assets/styles/css/style.css">

    <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>

    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"/>

    <title>Página de Inicio - Genesis</title>
  </head>
  <body style="background-color: #e6e6fa">
    <!--NAV DE LA PAGINA-->
    <?php 
    session_start();
    if(isset($_SESSION['login'])){
      if($_SESSION['login'] == true) { ?>
            <nav>
            <input type="checkbox" name="" id="chk1" />
            <a href="../controller/inicioController.php"><img class="img-logo" src="../assets/img/genesis logo sin fondo favicon.png" alt="logo genesis"/></a>
            <div class="logo">
              <h1><b>Genesis</b></h1>
            </div>
      
            <div class="nav-busqueda">
              <form action="">
                <input type="search" name="busqueda" id="busqueda" placeholder="Buscar"/>
                <button type="submit" style="display: flex; align-items: center; justify-content: center;">
                  <i class="fas fa-search" style="color: #8350f2"></i>
                </button>
              </form>
            </div>
            <div class="menu">
              <label for="chk1">
                <i class="fa fa-bars" style="color: #8350f2"></i>
              </label>
            </div>
            <ul style="margin: auto; align-items: center;">
              <li>
                <a href="../controller/inicioController.php"><b>Inicio</b></a>
              </li>
              <li>
                <a href="../controller/tiendaController.php"><b>Tienda</b></a>
              </li>
              <li>
                <a href="../controller/contactoController.php"><b>Contacto</b></a>
              </li>
                <a href="../controller/carritoController.php"><i class="fas fa-shopping-cart fa-lg"></i></a>
                <a href="../controller/perfilController.php"><i class="fa-solid fa-user fa-lg"></i></a>
              <li>
                <form action='../controller/cerrarSesionController.php' method="POST">
                  <button class="boton-cs"><b>Cerrar Sesión</b></button>
                </form>
                <!--<a href="../controller/cerrarSesiónController.php"><i class="fas fa-sign-out-alt"></i></a>-->
              </li>
            </ul>
          </nav>

          <?php }} else { ?>

            <nav>
            <input type="checkbox" name="" id="chk1" />
            <a class="logo-link" href="../controller/inicioController.php"><img class="img-logo" src="../assets/img/genesis logo sin fondo favicon.png" alt="logo genesis"/></a>
            <div class="logo">
              <h1><b>Genesis</b></h1>
            </div>
      
            <div class="nav-busqueda">
              <form action="">
                <input
                  type="search"
                  name="busqueda"
                  id="busqueda"
                  placeholder="Buscar"
                />
                <button type="submit" style="display: flex; align-items: center; justify-content: center;">
                  <i class="fas fa-search" style="color: #8350f2"></i>
                </button>
              </form>
            </div>
            <div class="menu">
              <label for="chk1">
                <i class="fa fa-bars" style="color: #8350f2"></i>
              </label>
            </div>
            <ul style="margin: auto; align-items: center; padding-left: 0;">
              <li>
                <a href="../controller/inicioController.php"><b>Inicio</b></a>
              </li>
              <li>
                <a href="../controller/tiendaController.php"><b>Tienda</b></a>
              </li>
              <li>
                <a href="../controller/contactoController.php"><b>Contacto</b></a>
              </li>
              <li>
                <a href="../controller/loginController.php"><b>Iniciar Sesión</b></a>
              </li>
      
              <!--Si el usuario esta logueado esta opcion se ocultara y aparecera el icono del perfil que cuando este sin loguear estará oculto-->
              <a href="../controller/carritoController.php"><i class="fas fa-shopping-cart fa-lg"></i></a>
              <!--si el usuario esta logueado estara visible, si no, estara oculto-->
            </ul>
          </nav> 
          <?php 
          }
      
      ?>

    <br /><br /><br /><br /><br />

    <!--HEADER CON TEXTO -->
    <div class="container-fluid" style="width: 90%;">
    <div class="row align-items-center justify-content-center">

              <!-- Texto (col-12 en pantallas pequeñas y medianas, col-md-4 en tabletas y más grandes) -->
        <div class="col-12 col-md-4">
          <h3 class="mt-0">BIENVENIDO A GENESIS, LA MEJOR TIENDA ONLINE DE ORDENADORES Y HARDWARE</h3>
          <p style="font-size: 20px;" class="mt-5">La mejor tienda online de España para comprar productos tecnológicos</p>
          <h4 class="mt-5">¡PRODUCTOS CON LA MEJOR CALIDAD AL MEJOR PRECIO!</h4>
        </div>
        <!-- Carrusel (col-12 en pantallas pequeñas, col-md-8 en tabletas y más grandes) -->
        <div class="carrusel col-12 col-md-8 mb-4 d-none d-sm-block">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../assets/img/inicio4.jpg" class="d-block w-100" height="600" alt="img-1">
                    </div>
                    <div class="carousel-item">
                        <img src="../assets/img/inicio3.jpg" class="d-block w-100" height="600" alt="img-2">
                    </div>
                    <div class="carousel-item">
                        <img src="../assets/img/inicio.jpg" class="d-block w-100" height="600" alt="img-3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>

    <!--CARDS DE CATEGORIAS-->
    <div class="cards" style="margin-top: 15px;">
      <div class="cuadradito">
        <h3 style="margin-left:40px;"><b>Categorías</b></h3>
      </div>
      <h4 style="display: flex; flex: 1; left: 0; padding-left: 20px; margin-top: 15px;">
        <b>Busca productos por categorías</b>
      </h4>
      <div class="services" style="display: flex; flex-wrap: wrap;">
        <div class="content content-1">
          <div>
            <i class="fas fa-desktop fa-4x" style="margin-top: 15px; cursor: auto;"></i>
          </div>
          <h3 style="margin-top: 25px">Ordenadores</h3>
        </div>
        <div class="content content-1">
          <div>
            <i class="fa-solid fa-laptop fa-4x" style="margin-top: 15px; cursor: auto;"></i>
          </div>
          <h3 style="margin-top: 25px">Portátiles</h3>
        </div>
        <div class="content content-1">
          <div>
            <i class="fa-solid fa-microchip fa-4x" style="margin-top: 15px; cursor: auto;"></i>
          </div>
          <h3 style="margin-top: 25px">Componentes</h3>
        </div>
        <div class="content content-1">
          <div>
            <i class="fa-solid fa-headphones fa-4x" style="margin-top: 15px; cursor: auto;"></i>
          </div>
          <h3 style="margin-top: 25px">Hardware</h3>
        </div>
      </div>
      <br />
      <hr />
    </div>

    <!--MARCAS-->
    <div class="container mt-5">
      <div class="cuadradito" style="margin-left: 90px;">
        <h3 style="margin-left:40px;"><b>Marcas</b></h3>
      </div>
      <h4 style="margin-left: 90px; margin-top: 25px;"><b>Las marcas que componen nuestros productos</b></h4>
      
      <div class="row" style="margin-top: 70px">
        <div class="col-md-3 logo-container">
          <a
            href="https://www.logitech.com/es-es"
            style="display: flex; align-items: center; justify-content: center"
            target="_blank"
          >
            <img
              src="../assets/img/marcas/logitech 2.png"
              alt="Logitech"
              class="img-fluid"
          /></a>
        </div>
        <div class="col-md-3 logo-container">
          <a
            href="https://es.msi.com"
            style="display: flex; align-items: center; justify-content: center"
            target="_blank"
          >
            <img
              src="../assets/img/marcas/msi 2.png"
              alt="MSI"
              class="img-fluid"
          /></a>
        </div>
        <div class="col-md-3 logo-container">
          <a
            href="https://www.amd.com/es.html"
            style="display: flex; align-items: center; justify-content: center"
            target="_blank"
          >
            <img src="../assets/img/marcas/amd.png" alt="AMD" class="img-fluid"
          /></a>
        </div>
        <div class="col-md-3 logo-container">
          <a
            href="https://www.nvidia.com/es-es/"
            style="display: flex; align-items: center; justify-content: center"
            target="_blank"
          >
            <img
              src="../assets/img/marcas/nvidia.png"
              alt="NVIDIA"
              class="img-fluid"
          /></a>
        </div>
      </div>
      <div class="row" style="margin-top: 120px; margin-bottom: 100px">
        <div class="col-md-3 logo-container">
          <a
            href="https://www.intel.com/content/www/us/en/homepage.html"
            style="display: flex; align-items: center; justify-content: center"
            target="_blank"
          >
            <img
              src="../assets/img/marcas/intel.png"
              alt="Intel"
              class="img-fluid"
          /></a>
        </div>
        <div class="col-md-3 logo-container">
          <a
            href="https://es.marsgaming.eu/es/"
            style="display: flex; align-items: center; justify-content: center"
            target="_blank"
          >
            <img
              src="../assets/img/marcas/LOGO-MARS-GAMING-2.png"
              alt="Mars Gaming"
              class="img-fluid"
          /></a>
        </div>
        <div class="col-md-3 logo-container">
          <a
            href="https://zowie.benq.eu/es-es/index.html"
            style="display: flex; align-items: center; justify-content: center"
            target="_blank"
          >
            <img
              src="../assets/img/marcas/zowie.png"
              alt="Zowie"
              class="img-fluid"
          /></a>
        </div>
        <div class="col-md-3 logo-container">
          <a
            href="https://www.razer.com/es-es"
            style="display: flex; align-items: center; justify-content: center"
            target="_blank"
          >
            <img
              src="../assets/img/marcas/razer 3.png"
              alt="Razer"
              class="img-fluid"
          /></a>
        </div>
      </div>
      
    </div>
    <br /><br />

    <!--PROXIMOS PRODUCTOS-->
    <div class="container py-5">
      <div class="cuadradito" style="margin-left: 5px;">
        <h3 style="margin-left:40px;"><b>Productos</b></h3>
      </div>
      <h4 style="margin-left: 5px; margin-top: 25px;"><b>Los productos que proximamente estarán en la web</b></h4><br>
      <div class="row">
          <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
              <img src="../assets/img/Proximos productos/gpu.jpg" style="background-position: center; background-size:contain;" class="w-100 shadow-1-strong rounded mb-4" alt="" sizes="(max-width: 1080 px) 100vw, 1080px" width="1080" height="650px" loading="lazy">
          </div>

          <div class="col-lg-4 mb-4 mb-lg-0">
              <img src="../assets/img/Proximos productos/silla gamer.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" sizes="(max-width: 1080px) 100vw, 1080px" width="1080" height="313px" loading="lazy">

              <img src="../assets/img/Proximos productos/i9.webp" class="w-100 shadow-1-strong rounded mb-4" alt="" sizes="(max-width: 1080px) 100vw, 1080px" width="1080" height="313px" loading="lazy">
          </div>

          <div class="col-lg-4 mb-4 mb-lg-0">
              <img src="../assets/img/Proximos productos/lampara.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" sizes="(max-width: 1080px) 100vw, 1080px" width="1080" height="650px" loading="lazy">
          </div>
      </div>
  </div><br>

    <!--INFO-->
       <div class="container mt-5" style="margin-bottom: 100px;">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="circle mx-auto">
                    <div class="circle-small">
                        <i class="fas fa-truck fa-xl" style="cursor: auto;"></i>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <h4><b>ENTREGA RAPIDA</b></h4>
                    <p>Entrega gratuita a partir de 60€</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="circle mx-auto">
                    <div class="circle-small">
                        <i class="fas fa-headphones fa-xl" style="cursor: auto;"></i>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <h4><b>24/7h SERVICIO DE CONTACTO</b></h4>
                    <p>Todas las horas del día a su disposición</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="circle mx-auto">
                    <div class="circle-small">
                        <i class="fas fa-check fa-xl" style="cursor: auto;"></i>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <h4><b>REEMBOLSO GARANTIZADO</b></h4>
                    <p>Te devolvemos el dinero en menos de 30 días</p>
                </div>
            </div>
        </div>
    </div><br><br>

    <button onclick="scrollToTop()" id="btnSubir" title="Ir arriba"><i class="fa-solid fa-arrow-up fa-xl" style="color: #ffffff; align-items:center;"></i></button>

        <!--FOOTER-->
        <?php 
    if(isset($_SESSION['login'])){
      if($_SESSION['login'] == true) { ?>

  <footer class="text-light" style="background-color: black">
    <div class="container py-5" style="padding-bottom: 0!important;">
        <div class="row text-center">
            <!-- Columna 1 -->
            <div class="col-lg-6 col-md-12" style="margin-top: 10px; margin-bottom: 15px;">
                <div editable="rich">
                    <h2 style="color: #ffa500">Mapa</h2>
                </div>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1601.6967097106894!2d-6.242451692295364!3d36.59283271766964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dd021173d3f65%3A0x2d90da52b414124b!2sIES%20Mar%20de%20C%C3%A1diz!5e0!3m2!1ses!2ses!4v1698141254960!5m2!1ses!2ses"
                    width="300"
                    height="200"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>
            <!-- Columna 2 -->
            <div class="col-lg-6 col-md-12" style="margin-top: 10px; margin-bottom: 15px;">
                <!-- Soporte -->
                <div class="lc-block mb-4">
                    <div editable="rich">
                        <h2 style="color: #ffa500; margin-bottom: -12px;">Soporte</h2>
                    </div>
                </div>
                <div class="lc-block small">
                    <div editable="rich">
                        <p class="p-footer">
                            C. Poeta Rafael Alberti, 8, 11500 El Puerto de Sta María, Cádiz
                        </p>
                        <p class="p-footer">
                            soporte.genesis@gmail.com
                            <br />
                        </p>
                        <p class="p-footer">telefono: 956 81 67 23</p>
                    </div>
                </div>
            </div>
            <!-- Columna 3 -->
            <div class="col-lg-6 col-md-12" style="margin-top: 10px; margin-bottom: 15px;">
                <!-- Cuenta -->
                <div class="lc-block mb-4">
                    <div editable="rich">
                        <h2 style="color: #ffa500; margin-bottom: -12px;">Cuenta</h2>
                    </div>
                </div>
                <div class="lc-block small">
                    <div editable="rich">
                        <li class="li-footer">
                            <a class="link-footer" href="../controller/perfilController.php">Mi Perfil</a>
                        </li>
                        <li class="li-footer">
                            <a class="link-footer" href="../controller/loginController.php">Login</a>
                        </li>
                        <li class="li-footer">
                            <a class="link-footer" href="../controller/carritoController.php">Carrito</a>
                        </li>
                        <li class="li-footer">
                            <a class="link-footer" href="../controller/tiendaController.php">Tienda</a>
                        </li>
                        <li class="li-footer">
                            <a class="link-footer" href="../controller/misPedidosController.php">Mis Pedidos</a>
                        </li>
                    </div>
                </div>
            </div>
            <!-- Columna 4 -->
            <div class="col-lg-6 col-md-12" style="margin-top: 10px; margin-bottom: 15px;">
                <!-- Links -->
                <div class="lc-block mb-4">
                    <div editable="rich">
                        <h2 style="color: #ffa500; margin-bottom: -12px;">Links</h2>
                    </div>
                </div>
                <div class="lc-block small">
                    <div editable="rich">
                        <li class="li-footer">
                            <a class="link-footer" href="../controller/politicaPrivacidadController.php">Política de Privacidad</a>
                        </li>
                        <li class="li-footer">
                            <a class="link-footer" href="../controller/terminosUsoController.php">Terminos de uso</a>
                        </li>
                        <li class="li-footer">
                            <a class="link-footer" href="../controller/contactoController.php">Contacto</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-bar">
        <p>
            Copyright <i class="fa fa-copyright" aria-hidden="true"></i> Aarón Helices Martín-Niño 2023
        </p>
    </div>
</footer>

          <?php }} else { ?>

  <footer class="text-light" style="background-color: black">
    <div class="container py-5" style="padding-bottom: 0!important;">
        <div class="row text-center">
            <!-- Columna 1 -->
            <div class="col-lg-6 col-md-12" style="margin-top: 10px; margin-bottom: 15px;">
                <div editable="rich">
                    <h2 style="color: #ffa500">Mapa</h2>
                </div>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1601.6967097106894!2d-6.242451692295364!3d36.59283271766964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dd021173d3f65%3A0x2d90da52b414124b!2sIES%20Mar%20de%20C%C3%A1diz!5e0!3m2!1ses!2ses!4v1698141254960!5m2!1ses!2ses"
                    width="300"
                    height="200"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>
            <!-- Columna 2 -->
            <div class="col-lg-6 col-md-12" style="margin-top: 10px; margin-bottom: 15px;">
                <!-- Soporte -->
                <div class="lc-block mb-4">
                    <div editable="rich">
                        <h2 style="color: #ffa500; margin-bottom: -12px;">Soporte</h2>
                    </div>
                </div>
                <div class="lc-block small">
                    <div editable="rich">
                        <p class="p-footer">
                            C. Poeta Rafael Alberti, 8, 11500 El Puerto de Sta María, Cádiz
                        </p>
                        <p class="p-footer">
                            soporte.genesis@gmail.com
                            <br />
                        </p>
                        <p class="p-footer">telefono: 956 81 67 23</p>
                    </div>
                </div>
            </div>
            <!-- Columna 3 -->
            <div class="col-lg-6 col-md-12" style="margin-top: 10px; margin-bottom: 15px;">
                <!-- Cuenta -->
                <div class="lc-block mb-4">
                    <div editable="rich">
                        <h2 style="color: #ffa500; margin-bottom: -12px;">Cuenta</h2>
                    </div>
                </div>
                <div class="lc-block small">
                    <div editable="rich">
                        <li class="li-footer">
                            <a class="link-footer" href="../controller/loginController.php">Login</a>
                        </li>
                        <li class="li-footer">
                            <a class="link-footer" href="../controller/carritoController.php">Carrito</a>
                        </li>
                        <li class="li-footer">
                            <a class="link-footer" href="../controller/tiendaController.php">Tienda</a>
                        </li>
                    </div>
                </div>
            </div>
            <!-- Columna 4 -->
            <div class="col-lg-6 col-md-12" style="margin-top: 10px; margin-bottom: 15px;">
                <!-- Links -->
                <div class="lc-block mb-4">
                    <div editable="rich">
                        <h2 style="color: #ffa500; margin-bottom: -12px;">Links</h2>
                    </div>
                </div>
                <div class="lc-block small">
                    <div editable="rich">
                        <li class="li-footer">
                            <a class="link-footer" href="../controller/politicaPrivacidadController.php">Política de Privacidad</a>
                        </li>
                        <li class="li-footer">
                            <a class="link-footer" href="../controller/terminosUsoController.php">Terminos de uso</a>
                        </li>
                        <li class="li-footer">
                            <a class="link-footer" href="../controller/contactoController.php">Contacto</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-bar">
        <p>
            Copyright <i class="fa fa-copyright" aria-hidden="true"></i> Aarón Helices Martín-Niño 2023
        </p>
    </div>
</footer>
          <?php 
          }
      
      ?>

      
    <script src="../assets/js/main.js"></script>
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>

  </body>
</html>
