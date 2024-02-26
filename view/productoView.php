<?php

namespace views;
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/styles/css/producto.css" />
  <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />

  <title>Detalle de Producto - Genesis</title>
</head>

<body style="background-color: #e6e6fa">
  <!--NAV DE LA PAGINA-->
  <?php
  session_start();
  if (isset($_SESSION['login'])) {
    if ($_SESSION['login'] == true) { ?>
      <nav>
        <input type="checkbox" name="" id="chk1" />
        <a href="../controller/inicioController.php"><img class="img-logo" src="../assets/img/genesis logo sin fondo favicon.png" alt="logo genesis" /></a>
        <div class="logo">
          <h1><b>Genesis</b></h1>
        </div>

        <div class="nav-busqueda">
          <form action="">
            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" />
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
        <ul style="margin: auto; align-items:center;">
          <li>
            <a href="../controller/inicioController.php"><b>Inicio</b></a>
          </li>
          <li>
            <a href="../controller/tiendaController.php"><b>Tienda</b></a>
          </li>
          <li>
            <a href="../controller/contactoController.php"><b>Contacto</b></a>
          </li>

          <!--Si el usuario esta logueado esta opcion se ocultara y aparecera el icono del perfil que cuando este sin loguear estará oculto-->
          <a href="../controller/carritoController.php"><i class="fas fa-shopping-cart fa-lg"></i></a>
          <a href="../controller/perfilController.php"><i class="fa-solid fa-user fa-lg"></i></a>
          <li>
            <form action='../controller/cerrarSesionController.php' method="POST">
              <button class="boton-cs"><b>Cerrar Sesión</b></button>
            </form>
            <!--<a href="../controller/cerrarSesiónController.php"><i class="fas fa-sign-out-alt"></i></a>-->
          </li>
          <!--si el usuario esta logueado estara visible, si no, estara oculto-->
        </ul>
      </nav>

    <?php }
  } else { ?>

    <nav>
      <input type="checkbox" name="" id="chk1" />
      <a href="../controller/inicioController.php"><img class="img-logo" src="../assets/img/genesis logo sin fondo favicon.png" alt="logo genesis" /></a>
      <div class="logo">
        <h1><b>Genesis</b></h1>
      </div>

      <div class="nav-busqueda">
        <form action="">
          <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" />
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

  <div class="container sproduct mt-5">
    <div class="row">
      <div class="col-lg-5 col-md-12 col-12 mb-5">
        <img class="img-fluid w-100 pb-2" src="../assets/img/productos/perifericos/auriculares/Auricular 2/img-1.webp" alt="">

        <div class="small-img-group">
          <div class="small-img-col">
            <img class="small-img" src="../assets/img/productos/perifericos/auriculares/Auricular 2/img-1.webp" width="100%" alt="">
          </div>
          <div class="small-img-col">
            <img class="small-img" src="../assets/img/productos/perifericos/auriculares/Auricular 2/img-2.webp" width="100%" alt="">
          </div>
          <div class="small-img-col">
            <img class="small-img" src="../assets/img/productos/perifericos/auriculares/Auricular 2/img-3.webp" width="100%" alt="">
          </div>
          <div class="small-img-col">
            <img class="small-img" src="../assets/img/productos/perifericos/auriculares/Auricular 2/img-4.webp" width="100%" alt="">
          </div>
        </div>
      </div>

      <div class="col-lg-1">
      </div>

      <div class="col-lg-6 col-md-12 col-12">
        <h2 class="nombre-producto"><b>Logitech G533 Auriculares Gaming Inalámbricos DTS 7.1</b></h2>
        <div class="contenedor-info mt-4">
          <div class="estrellas">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <h6 class="stock"><b>| En stock |</b></h6>
        </div>
        <h2 class="precio mt-4"><b>59,99 €</b></h2>

        <div class="accordion accordion-flush mt-5" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <b>Descripción</b>
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Logitech G533 Wireless Gaming Headset dispone de transductores de audio Pro-G pendientes de patente y de tecnología de sonido envolvente DTS Headphone:X 7.1 con la extraordinaria habilidad de recrear los efectos ambientales de los juegos y el audio posicional que los diseñadores de los juegos pretendían que oyeras. Disfruta de un radio de acción de hasta 15 metros con transmisión de audio digital sin pérdida y una duración de batería de hasta 15 horas. Con las técnicas de fabricación y los materiales más recientes e innovadores, G533 se ha diseñado para ser unos auriculares con micrófono resistentes pero ligeros al mismo tiempo que puedes llevar durante horas. También dispone de un micrófono con supresión de ruido en una varilla plegable, un control de volumen giratorio muy accesible y un botón para silenciar el micrófono. Usa Logitech Gaming Software para personalizar o ajustar con precisión el audio.</div>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col">
            <div class="d-flex align-items-center">
              <input class="mas-productos" type="number" value="1" min="1">
              <button class="boton-carrito ms-3">Añadir al Carrito</button>
              <button class="boton-like ms-3"><i class="fas fa-heart" style="color: white;"></i></button>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col">
            <table class="table tabla-iconos">
              <tbody>
                <tr>
                  <td class="text-center align-middle"><i class="fa-solid fa-truck fa-lg" style="color: #8350f2; cursor: default;"></i></td>
                  <td>
                    <h5 class="texto-1"><b>Envío Gratis</b></h5>
                    <p class="texto-2" style="margin-bottom: 0;">Envío gratis a partir de 50€.</p>
                  </td>
                </tr>
                <tr>
                  <td class="text-center align-middle"><i class="fa-solid fa-rotate-left fa-xl" style="color: #8350f2; cursor: default;"></i></td>
                  <td>
                    <h5 class="texto-1"><b>Devolución</b></h5>
                    <p class="texto-2" style="margin-bottom: 0;">Devolución antes de 30 días.</p>
                  </td>
                </tr>
                <tr>
                  <td class="text-center align-middle"><i class="fa-solid fa-circle-check fa-xl" style="color: #8350f2; cursor: default;"></i></td>
                  <td>
                    <h5 class="texto-1"><b>Garantía</b></h5>
                    <p class="texto-2" style="margin-bottom: 0;">Garantía de 2 años.</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="info-producto">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-descripcion-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Características</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-especificacion-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Especificación</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-comentario-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Comentarios</button>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="background-color: white;">1</div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" style="background-color: white;">2</div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" style="background-color: white;">3</div>
      </div>
    </div>
  </div>

  <br />
  <!--FOOTER-->
  <?php
  if (isset($_SESSION['login'])) {
    if ($_SESSION['login'] == true) { ?>

      <footer class="text-light" style="background-color: black">
        <div class="container py-5" style="padding-bottom: 0!important;">
          <div class="row text-center">
            <!-- Columna 1 -->
            <div class="col-lg-6 col-md-12" id="mapa" style="margin-top: 10px; margin-bottom: 15px;">
              <div editable="rich">
                <h2 style="color: #ffa500">Mapa</h2>
              </div>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1601.6967097106894!2d-6.242451692295364!3d36.59283271766964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dd021173d3f65%3A0x2d90da52b414124b!2sIES%20Mar%20de%20C%C3%A1diz!5e0!3m2!1ses!2ses!4v1698141254960!5m2!1ses!2ses" width="300" height="200" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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

    <?php }
  } else { ?>

    <footer class="text-light" style="background-color: black">
      <div class="container py-5" style="padding-bottom: 0!important;">
        <div class="row text-center">
          <!-- Columna 1 -->
          <div class="col-lg-6 col-md-12" id="mapa" style="margin-top: 10px; margin-bottom: 15px;">
            <div editable="rich">
              <h2 style="color: #ffa500">Mapa</h2>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1601.6967097106894!2d-6.242451692295364!3d36.59283271766964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dd021173d3f65%3A0x2d90da52b414124b!2sIES%20Mar%20de%20C%C3%A1diz!5e0!3m2!1ses!2ses!4v1698141254960!5m2!1ses!2ses" width="300" height="200" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  <script src="../assets/js/producto.js"></script>
</body>

</html>