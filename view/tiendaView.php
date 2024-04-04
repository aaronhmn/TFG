<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/styles/css/tienda.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


  <title>Página de la Tienda - Genesis</title>
</head>

<body style="background-color: #e6e6fa">

  <!--NAV DE LA PAGINA-->
  <?php include '../controller/navbarController.php'; ?>

  <div class="container-fluid mt-5" style="max-width: 90%;">
    <div class="row">

      <!-- Botón para mostrar/ocultar la columna de filtros en dispositivos móviles y tabletas -->
      <div class="col-12 d-xl-none" id="contenedor-boton-filtro">
        <i class="fa-solid fa-sliders fa-rotate-90 fa-xl" style="color: #eb9901;"></i>
        <button class="btn btn-default mt-2 mb-2" id="toggleFiltrosBtn">Mostrar Filtros</button>
      </div>

      <!-- Columna de la izquierda con filtros -->
      <div class="col-xl-3 d-xl-block d-none" id="filtroColumna">
        <form>
          <!-- Filtros por categorías con checkboxes -->
          <div class="mb-4">
            <h3 class="titulo-check"><b>Categorías</b></h3>
            <div class="contenedor-check">
              <input class="check" type="checkbox" value="" id="ordenador">
              <label class="form-check-label" for="ordenador">Ordenadores</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" value="" id="portatil">
              <label class="form-check-label" for="portatil">Portátiles</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" value="" id="monitor">
              <label class="form-check-label" for="monitor">Monitores</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" value="" id="auricular">
              <label class="form-check-label" for="auricular">Auriculares</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" value="" id="teclado">
              <label class="form-check-label" for="teclado">Teclados</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" value="" id="raton">
              <label class="form-check-label" for="raton">Ratones</label>
            </div>
          </div>

          <!-- Filtro por precios con un select -->
          <div class="mb-4">
            <h3 class="titulo-check"><b>Precios</b></h3>
            <div class="select-menu">
              <div class="select-btn">
                <span class="selectBtn-texto">Selecciona el orden</span>
                <i class="fa-solid fa-angle-down" style="color: #8350F2;"></i>
              </div>

              <ul class="opciones">
                <li class="opcion">
                  <span class="opcion-texto">Por defecto</span>
                </li>
                <li class="opcion">
                  <span class="opcion-texto">De menor a mayor</span>
                </li>
                <li class="opcion">
                  <span class="opcion-texto">De mayor a menor</span>
                </li>
              </ul>
            </div><!--<br>-->

            <!--<label class="pb-2" for="rangoPrecio">Rango de precios:</label>
                        <input type="range" class="form-range" id="customRange" min="0" max="100" step="1" style="max-width: 70%;">-->
          </div>

          <!-- Filtros por marcas con checkboxes -->
          <div class="mb-4">
            <h3 class="titulo-check"><b>Marcas</b></h3>
            <div class="contenedor-check">
              <input class="check" type="checkbox" value="" id="logitech">
              <label class="form-check-label" for="logitech">Logitech</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" value="" id="msi">
              <label class="form-check-label" for="msi">MSI</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" value="" id="amd">
              <label class="form-check-label" for="amd">AMD</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" value="" id="nvidia">
              <label class="form-check-label" for="nvidia">Nvidia</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" value="" id="intel">
              <label class="form-check-label" for="intel">Intel</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" value="" id="asus">
              <label class="form-check-label" for="asus">Asus</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" value="" id="zowie">
              <label class="form-check-label" for="zowie">Zowie</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" value="" id="razer">
              <label class="form-check-label" for="razer">Razer</label>
            </div>
          </div>

          <button type="submit" class="boton1-filtro mb-3">Aplicar Filtros</button>
          <button type="submit" class="boton2-filtro">Quitar Filtros</button>
        </form>
      </div>

      <!-- Columna de la derecha con cards -->
      <div class="col-md-12 col-xl-9">
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-xl-4">
          <!-- Contenido de las tarjetas -->
          <!-- Card 1 -->
          <div class="col mb-4">
          <div class="tarjeta-producto">
              <a href="../controller/productoController.php"><img class="img-producto" src="" alt="producto"></a>
              <a href="../controller/productoController.php">
                <div class="contenedor-tarjeta">
                  <div class="contenedor-info">
                    <div class="estrellas">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <h3 class="precio"><b>57,99 €</b></h3>
                  </div>
                  <hr>
                  <a href="../controller/productoController.php">
                    <p class="nombre-producto">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, blanditiis!</p>
                  </a>
                </div>
              </a>   
            </div>
          </div>

          <!-- Card 2 -->
          <div class="col mb-4">
          <div class="tarjeta-producto">
              <a href="../controller/productoController.php"><img class="img-producto" src="" alt="producto"></a>
              <a href="../controller/productoController.php">
                <div class="contenedor-tarjeta">
                  <div class="contenedor-info">
                    <div class="estrellas">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <h3 class="precio"><b>57,99 €</b></h3>
                  </div>
                  <hr>
                  <a href="../controller/productoController.php">
                    <p class="nombre-producto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores nobis explicabo fugit?</p>
                  </a>
                </div>
              </a>   
            </div>
          </div>

          <!-- Card 3 -->
          <div class="col mb-4">
          <div class="tarjeta-producto">
              <a href="../controller/productoController.php"><img class="img-producto" src="" alt="producto"></a>
              <a href="../controller/productoController.php">
                <div class="contenedor-tarjeta">
                  <div class="contenedor-info">
                    <div class="estrellas">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <h3 class="precio"><b>57,99 €</b></h3>
                  </div>
                  <hr>
                  <a href="../controller/productoController.php">
                    <p class="nombre-producto">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores soluta quod vel tempora exercitationem illum! Ut facilis dolor ducimus impedit dolores.</p>
                  </a>
                </div>
              </a>   
            </div>
          </div>

          <!-- Card 4 -->
          <div class="col mb-4">
          <div class="tarjeta-producto">
              <a href="../controller/productoController.php"><img class="img-producto" src="" alt="producto"></a>
              <a href="../controller/productoController.php">
                <div class="contenedor-tarjeta">
                  <div class="contenedor-info">
                    <div class="estrellas">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <h3 class="precio"><b>57,99 €</b></h3>
                  </div>
                  <hr>
                  <a href="../controller/productoController.php">
                    <p class="nombre-producto">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores soluta quod vel tempora exercitationem illum! Ut facilis dolor ducimus impedit dolores.</p>
                  </a>
                </div>
              </a>   
            </div>
          </div>

          <!-- Card 5 -->
          <div class="col mb-4">
          <div class="tarjeta-producto">
              <a href="../controller/productoController.php"><img class="img-producto" src="" alt="producto"></a>
              <a href="../controller/productoController.php">
                <div class="contenedor-tarjeta">
                  <div class="contenedor-info">
                    <div class="estrellas">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <h3 class="precio"><b>57,99 €</b></h3>
                  </div>
                  <hr>
                  <a href="../controller/productoController.php">
                    <p class="nombre-producto">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores soluta quod vel tempora exercitationem illum! Ut facilis dolor ducimus impedit dolores.</p>
                  </a>
                </div>
              </a>   
            </div>
          </div>

          <!-- Repite este bloque para las tarjetas 5, 6, 7 y 8 -->
        </div>
      </div>
    </div>
  </div>

  <br /><br /><br /><br />

  <button onclick="scrollToTop()" id="btnSubir" title="Ir arriba"><i class="fa-solid fa-arrow-up fa-xl" style="color: #ffffff; align-items:center;"></i></button>

  <!--FOOTER-->
  <?php include '../controller/footerController.php'; ?>

  <script src="../assets/js/tienda.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>