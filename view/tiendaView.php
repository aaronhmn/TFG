<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/styles/css/tienda.css" />
  <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
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
              <input class="check" type="checkbox" value="ordenador" id="ordenador">
              <label class="form-check-label" for="ordenador">Ordenadores</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" data-tipo="categoria" value="portatil" id="portatil">
              <label class="form-check-label" for="portatil">Portátiles</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" data-tipo="categoria" value="monitor" id="monitor">
              <label class="form-check-label" for="monitor">Monitores</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" data-tipo="categoria" value="auricular" id="auricular">
              <label class="form-check-label" for="auricular">Auriculares</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" data-tipo="categoria" value="teclado" id="teclado">
              <label class="form-check-label" for="teclado">Teclados</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" data-tipo="categoria" value="raton" id="raton">
              <label class="form-check-label" for="raton">Ratones</label>
            </div>
          </div>

          <!-- Filtro por precios con un select -->
          <div class="mb-4">
            <h3 class="titulo-check"><b>Precios</b></h3>
            <select name="ordenPrecio" class="form-select" aria-label="Ordenar precios">
    <option value="porDefecto" <?php echo (isset($_GET['ordenPrecio']) && $_GET['ordenPrecio'] == 'porDefecto') ? 'selected' : ''; ?>>Selecciona el orden</option>
    <option value="menorMayor" <?php echo (isset($_GET['ordenPrecio']) && $_GET['ordenPrecio'] == 'menorMayor') ? 'selected' : ''; ?>>De menor a mayor</option>
    <option value="mayorMenor" <?php echo (isset($_GET['ordenPrecio']) && $_GET['ordenPrecio'] == 'mayorMenor') ? 'selected' : ''; ?>>De mayor a menor</option>
</select>
          </div>

          <!-- Filtros por marcas con checkboxes -->
          <div class="mb-4">
            <h3 class="titulo-check"><b>Marcas</b></h3>
            <div class="contenedor-check">
              <input class="check" type="checkbox" data-tipo="marca" value="logitech" id="logitech">
              <label class="form-check-label" for="logitech">Logitech</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" data-tipo="marca" value="msi" id="msi">
              <label class="form-check-label" for="msi">MSI</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" data-tipo="marca" value="amd" id="amd">
              <label class="form-check-label" for="amd">AMD</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" data-tipo="marca" value="nvidia" id="nvidia">
              <label class="form-check-label" for="nvidia">Nvidia</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" data-tipo="marca" value="intel" id="intel">
              <label class="form-check-label" for="intel">Intel</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" data-tipo="marca" value="asus" id="asus">
              <label class="form-check-label" for="asus">Asus</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" data-tipo="marca" value="zowie" id="zowie">
              <label class="form-check-label" for="zowie">Zowie</label>
            </div>
            <div class="contenedor-check">
              <input class="check" type="checkbox" data-tipo="marca" value="razer" id="razer">
              <label class="form-check-label" for="razer">Razer</label>
            </div>
          </div>

          <button type="submit" class="boton1-filtro mb-3">Aplicar Filtros</button>
          <button type="submit" class="boton2-filtro">Quitar Filtros</button>
        </form>
      </div>

      <!-- Columna de la derecha con cards -->
      <div class="col-md-12 col-xl-9">
        <?php if (!empty($mensajeAlerta)) : ?>
          <div class="alert alert-warning alert-dismissible fade show alerta-sobre-productos" role="alert">
            <?php echo $mensajeAlerta; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
        <div id="productosContainer" class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-xl-4">
          <!-- Iterar sobre cada producto y mostrar su información en una tarjeta -->
          <?php if (isset($productos) && is_array($productos)) : ?>
            <?php foreach ($productos as $producto) : ?>
              <div class="col mb-4">
                <div class="tarjeta-producto" data-categoria="<?= $producto['id_categoria'] ?>" data-marca="<?= $producto['id_marca'] ?>" data-precio="<?= $producto['precio'] ?>">
                  <?php $prueba = explode(",", $producto['ruta_imagen']); ?>
                  <a href="../controller/productoController.php?id=<?= $producto['idproducto'] ?>"><img class="img-producto" src="<?= $prueba[0] ?>" alt="<?= $producto['nombre'] ?>"></a>
                  <a href="../controller/productoController.php?id=<?= $producto['idproducto'] ?>">
                    <div class="contenedor-tarjeta">
                      <div class="contenedor-info">
                        <div class="estrellas">
                          <!-- Aquí podrías poner la lógica para mostrar las estrellas basadas en las reseñas, por ejemplo -->
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </div>
                        <h3 class="precio"><b><?= $producto['precio'] ?> €</b></h3>
                      </div>
                      <hr>
                      <p class="nombre-producto"><?= $producto['nombre'] ?></p>
                    </div>
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <p>No se encontraron productos.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <br /><br /><br /><br />

  <button onclick="scrollToTop()" id="btnSubir" title="Ir arriba"><i class="fa-solid fa-arrow-up fa-xl" style="color: #ffffff; align-items:center;"></i></button>

  <!--FOOTER-->
  <?php include '../controller/footerController.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="../assets/js/tienda.js"></script>
</body>

</html>