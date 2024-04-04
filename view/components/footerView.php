<?php

namespace views;
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/styles/css/style.css">
</head>

<body style="background-color: #e6e6fa">

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

</body>
</html>