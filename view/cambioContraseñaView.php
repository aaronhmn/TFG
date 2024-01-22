<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/styles/css/perfil.css" />
    <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />

    <title>Cambiar contraseña - Genesis</title>
  </head>
  <body style="background-color: #e6e6fa">
    <!--NAV DE LA PAGINA-->
    <?php 
    session_start();
    if(isset($_SESSION['login'])){
      if($_SESSION['login'] == true) { ?>
            <nav>
            <input type="checkbox" name="" id="chk1" />
            <a href="../controller/inicioController.php"
              ><img
                class="img-logo"
                src="../assets/img/genesis logo sin fondo favicon.png"
                alt="logo genesis"
            /></a>
            <div class="logo">
              <h1><b>Genesis</b></h1>
            </div>
      
            <div class="nav-busqueda">
              <form action="">
                <input
                  type="text"
                  name="busqueda"
                  id="busqueda"
                  placeholder="...."
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
      
              <!--Si el usuario esta logueado esta opcion se ocultara y aparecera el icono del perfil que cuando este sin loguear estará oculto-->
              <li>
                <a href="../controller/carritoController.php"><i class="fas fa-shopping-cart"></i></a>
              </li>
              <li>
                <a href="../controller/perfilController.php"><i class="fa-solid fa-user"></i></a>
              </li>
              <li>
                <form action='../controller/cerrarSesionController.php' method="POST">
                  <button class="boton-cs"><b>Cerrar Sesión</b></button>
                </form>
                <!--<a href="../controller/cerrarSesiónController.php"><i class="fas fa-sign-out-alt"></i></a>-->
              </li> 
              <!--si el usuario esta logueado estara visible, si no, estara oculto-->
            </ul>
          </nav>

          <?php }} else { ?>

            <nav>
            <input type="checkbox" name="" id="chk1" />
            <a href="../controller/inicioController.php"
              ><img
                class="img-logo"
                src="../assets/img/genesis logo sin fondo favicon.png"
                alt="logo genesis"
            /></a>
            <div class="logo">
              <h1><b>Genesis</b></h1>
            </div>
      
            <div class="nav-busqueda">
              <form action="">
                <input
                  type="text"
                  name="busqueda"
                  id="busqueda"
                  placeholder="...."
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
              <li>
                <a href="../controller/carritoController.php"><i class="fas fa-shopping-cart"></i></a>
              </li>
              <!--si el usuario esta logueado estara visible, si no, estara oculto-->
            </ul>
          </nav> 
          <?php 
          }
      
      ?>

    <br /><br /><br /><br /><br />

    <div class="container" style="margin-top: 50px; margin-bottom: 100px">
      <div class="row" style="margin-right: 0px;">
        <div class="col-md-3 col-sm-12" style="background-color: #e6e6fa; margin: 10px">
            <div class="row" style="display: flex; align-items: center">
              <div class="col-auto" style="margin-top: 30px; margin-bottom: 10px;">
                <h3 style="color: #000"><b>Editar Perfil</b></h3>
              </div>
            </div>
            <div class="texto-izq">
              <a href="../controller/perfilController.php" style="margin-bottom: 15px;">Mi perfil</a>
              <a href="../controller/cambioContraseñaController.php">Cambiar contraseña</a>
            </div>
            <br />
            <div class="row" style="display: flex; align-items: center">
              <div class="col-auto" style="margin-top: 5px; margin-bottom: 10px;">
                <h3 style="color: #000"><b>Acciones</b></h3>
              </div>
            </div>
            <div class="texto-izq" style="margin-bottom: 20px;">
                <a href="../controller/misPedidosController.php">Mis Pedidos</a>
            </div>
          </div>

        <div class="col-md-8 col-sm-12" style="background-color: #fff; margin: 10px">
          <form class="row g-3" style="margin: 10px">
            <div class="col-6" style="display: flex; align-items: center;">
                <h2 style="color: #ffa500"><b>Cambio de contraseña</b></h2>
            </div>
            <div class="col-3" style="display: flex; align-items: center;">
                <h5>¡Bienvenido!</h5>
            </div>
            <div class="col-12">
              <label for="nombre" class="visually-hidden">Contraseña Actual</label>
              <input
                type="password"
                class="form-control"
                id="contraseña"
                placeholder="Contraseña actual"
              />
            </div>
            <div class="col-12">
                <label for="nombre" class="visually-hidden">Contraseña Nueva</label>
                <input
                  type="password"
                  class="form-control"
                  id="contraseñaNueva"
                  placeholder="Nueva contraseña"
                />
              </div>
              <div class="col-12">
                <label for="nombre" class="visually-hidden">Contraseña Nueva</label>
                <input
                  type="password"
                  class="form-control"
                  id="contraseñaNueva"
                  placeholder="Repetir nueva contraseña"
                />
              </div>

              <button
              class="btn btn-primary col-4"
              type="submit"
              style="background-color: rgb(168, 168, 168); margin-right: 15px; border: none;"
            >
              Cancelar
            </button>
            <button
              class="btn btn-primary col-4"
              type="submit"
              style="background-color: #8350f2; border: none;"
            >
              Guardar
            </button>
          </form>
        </div>
      </div>
    </div>

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

    <script
      defer
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
