<?php

namespace views;
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

  <link rel="stylesheet" href="../assets/styles/css/style.css">

  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />

  <title>Página de Inicio - Genesis</title>
</head>

<body style="background-color: #e6e6fa" <?php if (isset($_SESSION['id_usuario'])) echo 'data-user-id="' . $_SESSION['id_usuario'] . '"'; ?>>

  <!--NAV DE LA PAGINA-->
  <?php include '../controller/navbarController.php'; ?>

  <!--HEADER CON TEXTO -->
  <div class="container-fluid" style="width: 90%;">
    <div class="row align-items-center justify-content-center" style="margin-top: 70px;">
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
  <div class="container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="cuadradito">
      <h3 style="margin-left:40px;"><b>Categorías</b></h3>
    </div>
    <h4 style="display: flex; flex: 1; left: 0; margin-top: 15px; margin-bottom: 50px;">
      <b>Busca productos por categorías</b>
    </h4>
    <div class="row">
      <div class="col-lg-4 col-md-6 mb-3">
        <div class="content content-1 text-center">
          <i class="fas fa-computer fa-4x mb-3" style="cursor: auto;"></i>
          <h3>Ordenadores</h3>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-3">
        <div class="content content-1 text-center">
          <i class="fa-solid fa-laptop fa-4x mb-3" style="cursor: auto;"></i>
          <h3>Portátiles</h3>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-3">
        <div class="content content-1 text-center">
          <i class="fa-solid fa-desktop fa-4x mb-3" style="cursor: auto;"></i>
          <h3>Monitores</h3>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-3">
        <div class="content content-1 text-center">
          <i class="fa-solid fa-headphones fa-4x mb-3" style="cursor: auto;"></i>
          <h3>Auriculares</h3>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-3">
        <div class="content content-1 text-center">
          <i class="fa-solid fa-keyboard fa-4x mb-3" style="cursor: auto;"></i>
          <h3>Teclados</h3>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-3">
        <div class="content content-1 text-center">
          <i class="fa-solid fa-mouse fa-4x mb-3" style="cursor: auto;"></i>
          <h3>Ratones</h3>
        </div>
      </div>
    </div><br><br>
    <hr />
  </div>

  <!--MARCAS-->
  <div class="container mt-5" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
    <div class="cuadradito" style="margin-left: 5px;">
      <h3 style="margin-left:40px;"><b>Marcas</b></h3>
    </div>
    <h4 style="margin-left: 5px; margin-top: 25px;"><b>Las marcas que componen nuestros productos</b></h4>

    <div class="contenedor-marcas">
      <div class="row" id="marcas">
        <div class="col-md-6 col-lg-3" style="margin-bottom: 40px;">
          <a class="logo-container" href="https://www.logitech.com/es-es" target="_blank">
            <img src="../assets/img/marcas/logitech 2.png" alt="Logitech" class="img-fluid">
          </a>
        </div>
        <div class="col-md-6 col-lg-3" style="margin-bottom: 40px;">
          <a href="https://es.msi.com" class="logo-container" target="_blank">
            <img src="../assets/img/marcas/msi 2.png" alt="MSI" class="img-fluid">
          </a>
        </div>
        <div class="col-md-6 col-lg-3" style="margin-bottom: 40px;">
          <a href="https://www.amd.com/es.html" class="logo-container" target="_blank">
            <img src="../assets/img/marcas/amd3.png" alt="AMD" class="img-fluid">
          </a>
        </div>
        <div class="col-md-6 col-lg-3" style="margin-bottom: 40px;">
          <a href="https://www.nvidia.com/es-es/" class="logo-container" target="_blank">
            <img src="../assets/img/marcas/nvidia2.png" alt="NVIDIA" class="img-fluid">
          </a>
        </div>
      </div>

      <div class="row" id="marcas">
        <div class="col-md-6 col-lg-3 logo-container" style="margin-bottom: 40px;">
          <a href="https://www.intel.com/content/www/us/en/homepage.html" class="logo-container" target="_blank">
            <img src="../assets/img/marcas/intel.png" alt="Intel" class="img-fluid">
          </a>
        </div>
        <div class="col-md-6 col-lg-3" style="margin-bottom: 40px;">
          <a href="https://www.asus.com/es/" class="logo-container" target="_blank">
            <img src="../assets/img/marcas/asus.png" alt="Asus" class="img-fluid">
          </a>
        </div>
        <div class="col-md-6 col-lg-3" style="margin-bottom: 40px;">
          <a href="https://zowie.benq.eu/es-es/index.html" class="logo-container" target="_blank">
            <img src="../assets/img/marcas/zowie2.png" alt="Zowie" class="img-fluid">
          </a>
        </div>
        <div class="col-md-6 col-lg-3">
          <a href="https://www.razer.com/es-es" class="logo-container" target="_blank">
            <img src="../assets/img/marcas/razer 3.png" alt="Razer" class="img-fluid">
          </a>
        </div>
      </div>
    </div><br>
    <hr>
  </div>

  <!--PROXIMOS PRODUCTOS-->
  <div class="container py-5" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
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
    </div><br><br><br><br>
    <hr>
  </div><br>

  <!--INFO-->
  <div class="container mt-5" style="margin-bottom: 100px;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
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
  <?php include '../controller/footerController.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
  <script src="../assets/js/main.js"></script>

  <script>
  AOS.init();
</script>
</body>

</html>