<?php
namespace view;
?>

<!DOCTYPE html>
<html>

<head>
  <title>Detalles del producto</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

   <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

<body>

  <div id="aviso" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Aviso</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><?= $mensaje ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    <div>
      <div>
        <div>
          <table>
              <tr>
                <td style="padding:20px">
                  <p>Id de producto: <?php echo $datosProducto["idproducto"] ?></p>
                  <p>Nombre: <?php echo $datosProducto["nombre"] ?></p>
                  <p>Precio: <?php echo $datosProducto["precio"] . "€" ?></p>
                  <p>Categoria: <?php echo $datosProducto["categoria"] ?></p>
                  <p>Sub Categoria: <?php echo $datosProducto["sub_categoria"] ?></p>
                  <p>Descripcion: <?php echo $datosProducto["descripcion"] ?></p>
                  <p>Especificación: <?php echo $datosProducto["especificacion"] ?></p>
                  <p>Marca: <?php echo $datosProducto["marca"] ?></p>
                  <p>Stock: <?php echo $datosProducto["stock"] ?></p>

                  <?php echo '<img src="'.$datosProducto['ruta_imagen'].'" width="200" height="200"/>'; ?>
                </td>
              </tr>
          </table>
        </div>
      </div>
  </div>
</body>
</html>