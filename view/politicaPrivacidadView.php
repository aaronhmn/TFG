<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/css/style.css">
    <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <title>Política y privacidad - Genesis</title>
</head>
<body style="background-color: #E6E6FA;">
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
    <br><br><br><br><br>

      <div class="container">
      <h2>1. Responsable y fines de tratamiento. </h2><br>
      <p>De conformidad con lo establecido en el Reglamento (UE) 2016/679 General de Protección de Datos, se informa a todas las personas que se inscriban o presenten su candidatura (en adelante, "los Candidatos") a las ofertas de empleo de Genesis y Multimedia S.L.U. (en adelante, Genesis), que todos los datos personales facilitados por el Candidato serán objeto de tratamiento por parte de Genesis con las finalidades propias de un departamento de recursos humanos, es decir, de la gestión de su candidatura en los distintos procesos de selección.</p><br>

      <p>La cumplimentación de todos los datos solicitados es necesaria para lograr una óptima prestación de los servicios puestos a disposición del Candidato. De no facilitarse todos los datos, Genesis no garantiza que la información y los servicios solicitados puedan prestarse correctamente o se ajusten a las necesidades del Candidato.</p><br>

      <p>El Candidato garantiza que la información facilitada a Genesis es correcta y completa, y deberá mantenerla actualizada en todo momento, eximiendo a Genesis de las consecuencias y daños que la inexactitud de la misma pueda originar a otros y/o a terceros. Genesis se reserva el derecho de revisar los datos de los Candidatos.</p><br>

      <h2>2. Base jurídica para el tratamiento.</h2><br>
      <p>El Candidato consiente expresamente el tratamiento de sus datos personales según las finalidades descritas en esta Política de Privacidad; incluyendo la cesión de sus datos a las otras empresas dentro del mismo grupo empresarial de Genesis.</p><br>

      <h2>3. Derechos.</h2><br>
      <p>El Candidato podrá ejercer los derechos de acceso, rectificación, supresión y oposición, así como los de limitación y portabilidad previstos en el Reglamento (UE) 2016/679 General de Protección de Datos, mediante una comunicación escrita dirigida a C. Poeta Rafael Alberti, 8, 11500 El Puerto de Sta María, Cádiz; o bien mediante correo electrónico dirigido a soporte.genesis@gmail.com. En ambos casos, el Candidato deberá acompañar una copia de su documento nacional de identidad, pasaporte u otro documento válido que lo identifique.</p><br>

      <p>Tiene derecho igualmente a presentar una reclamación ante la Agencia Española de Protección de Datos.</p><br>

      <h2>4. Prohibición para menores.</h2><br>
      <p>Los servicios ofrecidos por Genesis están dirigidos a personas mayores de edad (18 años). El Candidato reconoce que es mayor de edad. De lo contrario, instamos al Candidato a abandonar el sitio web inmediatamente. Si Genesis tuviera conocimiento de la minoría de edad de un candidato, sus datos serán inmediatamente eliminados sin conservar información alguna del mismo.</p><br>

      <h2>5. Obligaciones del Candidato.</h2><br>
      <p>El Candidato se compromete a la veracidad y exactitud de los datos que suministra, mantenerlos actualizados y se hace responsable de comunicar a Genesis cualquier modificación de los mismos.</p><br>

      <p>El Candidato es responsable de los datos personales de terceros que puedan incluirse en los ficheros de Genesis. En este sentido, el Candidato deberá obtener su consentimiento previo y expreso, habiéndole informado de los términos contenidos en esta Política de privacidad. El Candidato se obliga a mantener indemne a Genesis ante cualquier posible reclamación, multa o sanción que pueda venir obligada a soportar como consecuencia del incumplimiento por parte del Candidato del deber descrito en este párrafo.</p><br>

      <p>El Candidato también se obliga a mantener indemne a Genesis ante cualquier posible reclamación, multa o sanción que pueda venir obligada a soportar como consecuencia del incumplimiento por parte del Candidato de la presente Política de privacidad.</p><br>

      <h2>6. Propiedad intelectual e industrial.</h2><br>
      <p>Todos los contenidos de este sitio web, entendiendo por estos a título meramente enunciativo, los textos, fotografías, gráficos, imágenes, iconos, tecnología, software, links y demás contenidos audiovisuales o sonoros, así como su diseño gráfico y códigos fuente (en adelante, los “Contenidos”), son propiedad intelectual de Genesis o de las empresas del grupo, sin que puedan entenderse cedidos al Candidato ninguno de los derechos de explotación reconocidos por la normativa vigente en materia de propiedad intelectual sobre los mismos, salvo aquellos que resulten estrictamente necesarios para el uso de este servicio de empleo.</p><br>

      <p>Las marcas, nombres comerciales o signos distintivos son titularidad de la Genesis o de las empresas del grupo, sin que pueda entenderse que el acceso a este servicio de empleo atribuya ningún derecho sobre las citadas marcas, nombres comerciales y/o signos distintivos</p><br>

      <p>Genesis se excluye por los daños y perjuicios de toda naturaleza causados a los usuarios por el uso de enlaces (links), directorios y herramientas de búsqueda, que permiten a los usuarios acceder a sitios Web pertenecientes y/o gestionados por terceros, así como de la presencia de virus u otros códigos maliciosos en los contenidos que puedan producir cualquier tipo de daños en el sistema informático, documentos electrónicos o ficheros de los usuarios.</p><br>

      <h2>7. Seguridad.</h2><br>
      <p>Genesis mantiene los niveles de seguridad de protección de datos personales conforme la normativa actual.</p><br>

      <h2>8. Modificación de la presente Política de Privacidad.</h2><br>
      <p>Genesis se reserva el derecho de modificar la presente Política de Privacidad para cualquier adaptación legal a futuras novedades legislativas o jurisprudenciales, así como prácticas de la industria.</p><br>

      <p>En cualquier caso, comunicaremos a los Candidatos mediante correo electrónico dicho cambios.</p><br>

      <h2>9. Empleo de cookies.</h2><br>
      <p>Las cookies son pequeños ficheros de datos o conjunto de caracteres que se almacenan en el disco duro o en la memoria temporal del ordenador del usuario cuando accede a las páginas de determinados sitios Web. Se utilizan para que el servidor accedido pueda conocer las preferencias del usuario al volver éste a conectarse.</p><br>

      <p>El acceso a este sitio Web puede implicar la utilización de cookies, que tendrán por finalidad el facilitar el proceso de compra online de los productos o servicios ofertados, y servir la publicidad o determinados contenidos o informaciones jurídicas de interés para el usuario. Las cookies utilizadas no pueden leer los archivos cookie creados por otros proveedores. El usuario tiene la posibilidad de configurar su navegador para ser avisado en pantalla de la recepción de cookies y para impedir la instalación de cookies en su disco duro.</p><br>

      <p>Para ello, el usuario debe consultar las instrucciones y manuales de su navegador para esta información alojados en siguiente link: https://www.Genesis.com/cookies. Ninguna cookie permite extraer información del disco duro del usuario o acceder a información personal. Simplemente asocian el navegador de un ordenador determinado a un código anónimo. La única manera de que la información privada de un usuario forme parte de un archivo cookie, es que el usuario dé personalmente esa información al servidor.</p>
    </div><br><br><br>


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
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>