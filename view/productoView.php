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

  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />

  <title><?= $productos['nombre'] ?></title>
</head>

<body style="background-color: #e6e6fa" <?php if (isset($_SESSION['id_usuario'])) echo 'data-user-id="' . $_SESSION['id_usuario'] . '"'; ?>>
  <!--NAV DE LA PAGINA-->
  <?php include '../controller/navbarController.php'; ?>

  <div class="container sproduct mt-5">
    <div class="row">
      <div class="col-lg-5 col-md-12 col-12 mb-5">
        <?php $prueba = explode(",", $productos['ruta_imagen']); ?>
        <img class="img-fluid w-100" src="<?= $prueba[0] ?>" id="mainImg" alt="<?= $productos['nombre'] ?>">

        <div class="small-img-group pt-2">
          <div class="small-img-col selected">
            <img class="small-img" src="<?= $prueba[0] ?>" width="100%" alt="<?= $productos['nombre'] ?>">
          </div>
          <div class="small-img-col">
            <img class="small-img" src="<?= $prueba[1] ?>" width="100%" alt="<?= $productos['nombre'] ?>">
          </div>
          <div class="small-img-col">
            <img class="small-img" src="<?= $prueba[2] ?>" width="100%" alt="<?= $productos['nombre'] ?>">
          </div>
          <div class="small-img-col">
            <img class="small-img" src="<?= $prueba[3] ?>" width="100%" alt="<?= $productos['nombre'] ?>">
          </div>
        </div>
      </div>

      <div class="col-lg-1">
      </div>

      <div class="col-lg-6 col-md-12 col-12">
        <h3 class="nombre-producto"><b><?= $productos['nombre'] ?></b></h3>
        <div class="contenedor-info mt-4">
          <div class="estrellas">
            <?php
            $numeroEstrellas = round($mediaValoraciones);
            for ($i = 1; $i <= 5; $i++) { // Asegúrate siempre de mostrar hasta 5 estrellas
              if ($i <= $numeroEstrellas) {
                echo '<i class="fas fa-star"></i>'; // Estrella llena
              } else {
                echo '<i class="far fa-star"></i>'; // Estrella vacía
              }
            }
            ?>
          </div>
          <h6 class="stock"><b>
              <?php
              if ($productos['stock'] > 10) {
                echo '| <span>En stock</span> |';
              } elseif ($productos['stock'] > 0) {
                echo '| <span>Poco stock</span> |';
              } else {
                echo '| <span style="color: red;">Sin stock</span> |';
              }
              ?>
            </b></h6>
        </div>
        <h2 class="precio mt-4"><b><?= $productos['precio'] ?> €</b></h2>

        <div class="accordion accordion-flush mt-5" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne1" aria-expanded="false" aria-controls="flush-collapseOne1">
                <b>Descripción</b>
              </button>
            </h2>
            <div id="flush-collapseOne1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div style="white-space: pre-wrap;" class="accordion-body"><?= $productos['descripcion'] ?></div>
            </div>
          </div>
        </div>

        <div class="accordion accordion-flush mt-4" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne2" aria-expanded="false" aria-controls="flush-collapseOne2">
                <b>Especifiaciones</b>
              </button>
            </h2>
            <div id="flush-collapseOne2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div style="white-space: pre-wrap;" class="accordion-body"><?= $productos['especificacion'] ?></div>
            </div>
          </div>
        </div>

        <div id="alertPlaceholder" class="mt-5"></div>
        <?php if (isset($_SESSION['login']) && $_SESSION['login']) : ?>
          <!-- Usuario logueado, mostrar botones con funcionalidad normal -->
          <div class="row mt-5">
            <div class="col">
              <div class="d-flex align-items-center">
                <button class="boton-carrito" id="add-to-cart" data-id="<?= $productos['idproducto'] ?>" data-nombre="<?= $productos['nombre'] ?>" data-precio="<?= $productos['precio'] ?>" data-stock="<?= $productos['stock'] ?>">
                  Añadir al Carrito<i class="fas fa-shopping-cart" style="color: white; margin-left: 10px;"></i>
                </button>
                <button class="boton-fav ms-2" id="add-to-fav" data-id="<?= $productos['idproducto'] ?>" data-nombre="<?= htmlspecialchars($productos['nombre'], ENT_QUOTES) ?>" data-precio="<?= htmlspecialchars($productos['precio'], ENT_QUOTES) ?>" data-imagen="<?= htmlspecialchars($prueba[0], ENT_QUOTES) ?>">Añadir a Favorito<i class="fas fa-heart" style="color: white; margin-left: 10px;"></i></button>
              </div>
            </div>
          </div>
        <?php else : ?>
          <!-- Usuario no logueado, mostrar botones que redirigen al login -->
          <div class="row mt-5">
            <div class="col">
              <div class="d-flex align-items-center">
                <button class="boton-carrito" onclick="window.location.href='../controller/loginController.php'">Añadir al Carrito<i class="fas fa-shopping-cart" style="color: white; margin-left: 10px;"></i></button>
                <button class="boton-fav ms-2" onclick="window.location.href='../controller/loginController.php'">Añadir a Favorito<i class="fas fa-heart" style="color: white; margin-left: 10px;"></i></button>
              </div>
            </div>
          </div>
        <?php endif; ?>

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
    </div><br><br>

    <!-- Contenedor Principal de Comentarios y Valoraciones -->
    <div class="contenedor-comentarios mt-5">
      <h2 class="text-center mb-4" style="color: #ffa500;"><b>Comentarios y Valoraciones</b></h2>
      <div id="alertPlaceholder2"></div>
      <div class="row">
    <div class="col-12">
        <?php if ($productos['haComprado']) : ?>
            <button class="btn btn-primary mb-3 w-100" style="background-color: #8350f2; border-color:#8350f2;" data-bs-toggle="modal" data-bs-target="#reseñaModal">
                Realizar reseña
            </button>
        <?php else: ?>
            <div class="alert alert-warning text-center" role="alert">
                <b>Compra este producto para poder escribir una reseña.</b>
            </div>
        <?php endif; ?>
    </div>
</div>

      <!-- Mostrar reseñas del producto -->
      <div class="row row-cols-1 row-cols-lg-2 g-4">
        <?php foreach ($reseñas as $reseña) : ?>
          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title"><b><?= htmlspecialchars($reseña['nombre_usuario']) ?></b></h5>
                <div class="estrellas">
                  <?php if ($reseña['valoracion'] !== null) : ?>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                      <i class="<?= $i <= $reseña['valoracion'] ? 'fas' : 'far' ?> fa-star"></i>
                    <?php endfor; ?>
                  <?php endif; ?>
                </div>
                <p class="card-text mt-2"><?= htmlspecialchars($reseña['comentario']) ?></p>
              </div>
              <div class="card-footer">
                <small class="text-muted"><?= date('Y/m/d', strtotime($reseña['fecha_resena'])) ?></small>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Paginación horizontal con círculos -->
      <div class="pagination-container d-flex justify-content-center align-items-center my-4 mt-5">
        <?php if ($paginaActual > 1) : ?>
          <a href="?id=<?= $id ?>&pagina=<?= $paginaActual - 1 ?>" class="page-link circle"><i class="fa-solid fa-arrow-left"></i></a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
          <a href="?id=<?= $id ?>&pagina=<?= $i ?>" class="page-link circle <?= ($i == $paginaActual) ? 'active' : ''; ?>">
            <?= $i ?>
          </a>
        <?php endfor; ?>

        <?php if ($paginaActual < $totalPaginas) : ?>
          <a href="?id=<?= $id ?>&pagina=<?= $paginaActual + 1 ?>" class="page-link circle"><i class="fa-solid fa-arrow-right"></i></a>
        <?php endif; ?>
      </div>

    </div>
  </div>

  <br />

  <button onclick="scrollToTop()" id="btnSubir" title="Ir arriba"><i class="fa-solid fa-arrow-up fa-xl" style="color: #ffffff; align-items:center;"></i></button>

  <!--FOOTER-->
  <?php include '../controller/footerController.php'; ?>

  <!-- Modal para crear reseña -->
  <div class="modal fade" id="reseñaModal" tabindex="-1" aria-labelledby="reseñaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="reseñaModalLabel" style="color: #8350f2;"><b>Escribe tu reseña</b></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formReseña" action="../controller/insertarReseñaController.php" method="POST">
            <input type="hidden" name="idProducto" value="<?= $productos['idproducto'] ?>"> <!-- Asegúrate de tener el ID del producto aquí -->
            <div class="mb-3">
              <label for="valoracion" class="form-label">Valoración:</label>
              <select class="form-select" id="valoracion" name="valoracion" required>
                <option value="">Selecciona una valoración</option>
                <option value="0">0 Estrellas</option>
                <option value="1">1 Estrellas</option>
                <option value="2">2 Estrellas</option>
                <option value="3">3 Estrellas</option>
                <option value="4">4 Estrella</option>
                <option value="5">5 Estrellas</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="comentario" class="form-label">Comentario:</label>
              <textarea class="form-control" id="comentario" name="comentario" rows="8" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #8350f2; border-color: #8350f2;">Enviar Reseña</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="../assets/js/producto.js"></script>

  <script>
    $(document).ready(function() {
      $('#formReseña').submit(function(e) {
        e.preventDefault(); // Evitar el envío estándar del formulario
        var formData = $(this).serialize(); // Serializar los datos del formulario

        $.ajax({
          type: "POST",
          url: $(this).attr('action'),
          data: formData,
          success: function(response) {
            var jsonData = JSON.parse(response);
            if (jsonData.success) {
              // Guardar mensaje en localStorage
              localStorage.setItem('alertMessage', 'Reseña añadida con éxito!');
              localStorage.setItem('alertType', 'success');
            } else {
              // Guardar mensaje de error en localStorage
              localStorage.setItem('alertMessage', jsonData.message);
              localStorage.setItem('alertType', 'danger');
            }
            // Recargar la página para aplicar cambios
            location.reload();
          },
          error: function() {
            // Guardar mensaje de error en localStorage
            localStorage.setItem('alertMessage', 'Error al procesar la petición.');
            localStorage.setItem('alertType', 'danger');
            location.reload();
          }
        });
      });

      // Mostrar alerta después de recargar
      displayAlertFromLocalStorage();
    });

    function displayAlertFromLocalStorage() {
      var message = localStorage.getItem('alertMessage');
      var type = localStorage.getItem('alertType');

      if (message && type) {
        var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
          message +
          '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        $('#alertPlaceholder2').html(alertHtml);

        // Limpiar localStorage
        localStorage.removeItem('alertMessage');
        localStorage.removeItem('alertType');
      }
    }
  </script>

</body>

</html>