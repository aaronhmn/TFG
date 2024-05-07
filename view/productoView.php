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

<body style="background-color: #e6e6fa">
    <!--NAV DE LA PAGINA-->
    <?php include '../controller/navbarController.php'; ?>

  <div class="container sproduct mt-5">
    <div class="row">
      <div class="col-lg-5 col-md-12 col-12 mb-5">
      <?php $prueba = explode(",", $productos['ruta_imagen']); ?>
        <img class="img-fluid w-100" src="<?= $prueba[0] ?>"  id="mainImg" alt="<?= $productos['nombre'] ?>">

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
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <h6 class="stock"><b>| En stock |</b></h6>
        </div>
        <h2 class="precio mt-4"><b><?= $productos['precio'] ?> €</b></h2>

        <div class="accordion accordion-flush mt-5" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <b>Descripción</b>
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body"><?= $productos['descripcion'] ?></div>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col">
            <div class="d-flex align-items-center">
              <!-- <input class="mas-productos" type="number" value="1" min="1"> -->
              <button class="boton-carrito" id="add-to-cart" data-id="<?= $productos['idproducto'] ?>" data-nombre="<?= $productos['nombre'] ?>" data-precio="<?= $productos['precio'] ?>">Añadir al Carrito<i class="fas fa-shopping-cart" style="color: white; margin-left: 10px;"></i></button>
              <button class="boton-fav ms-2">Añadir a Favorito<i class="fas fa-heart" style="color: white; margin-left: 10px;"></i></button>
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
          <button class="nav-link active" id="pills-especificacion-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" style="color: #8350f2;"><b>Especificación</b></button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-comentario-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" style="color: #8350f2;"><b>Comentarios</b></button>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" style="background-color: white;"><?= $productos['especificacion'] ?></div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" style="background-color: white;">Comentarios y valoracion de prueba.</div>
      </div>
    </div>
  </div>

  <br />

  <button onclick="scrollToTop()" id="btnSubir" title="Ir arriba"><i class="fa-solid fa-arrow-up fa-xl" style="color: #ffffff; align-items:center;"></i></button>

  <!--FOOTER-->
  <?php include '../controller/footerController.php'; ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="../assets/js/producto.js"></script>
  
</body>

</html>