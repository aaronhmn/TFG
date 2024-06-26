<?php

namespace view;
?>
<!DOCTYPE html>
<html>

<head>
  <title>Modificar Producto</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <form method="POST" action="../controller/modificarProductoController.php" enctype="multipart/form-data">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-sm-9">
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="nombre" class="col-lg-3 col-form-label">Nombre:</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="nombre" name="nombre" value='<?= (isset($producto) ? $producto["nombre"] : "") ?>' />
            </div>
          </div>

          <div class=" form-group row mb-sm-2 mt-sm-2 ">
            <label for="precio" class="col-lg-3 col-form-label">Precio:</label>
            <div class="col-lg-6">
              <input type="number" step="0.01" class="form-control" id="precio" name="precio" value='<?= (isset($producto) ? $producto["precio"] : "") ?>' />
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="selectCategoria" class="col-lg-3 form-label">Categoria:</label>
            <div class="col-lg-6">
              <select class="form-select" name="id_categoria" id="selectCategoria">
                <?php foreach ($categorias as $categoria) : ?>
                  <option value="<?= $categoria['idcategoria'] ?>" <?= ($categoria['idcategoria'] == $producto['id_categoria']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($categoria['nombre_categoria']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="descripcion" class="col-lg-3 col-form-label">Descripción:</label>
            <div class="col-lg-6">
              <textarea class="form-control" id="descripcion" name="descripcion" rows="5"><?= $producto["descripcion"]; ?></textarea>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="especificacion" class="col-lg-3 col-form-label">Especificación:</label>
            <div class="col-lg-6">
              <textarea class="form-control" id="especificacion" name="especificacion" rows="5"><?= $producto["especificacion"]; ?></textarea>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="selectMarca" class="col-lg-3 form-label">Marca:</label>
            <div class="col-lg-6">
              <select class="form-select" name="id_marca" id="selectMarca">
                <?php foreach ($marcas as $marca) : ?>
                  <option value="<?= $marca['idmarca'] ?>" <?= ($marca['idmarca'] == $producto['id_marca']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($marca['nombre_marca']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class=" form-group row mb-sm-2 mt-sm-2 ">
            <label for="stock" class="col-lg-3 col-form-label">Stock:</label>
            <div class="col-lg-6">
              <input type="number" class="form-control" id="stock" name="stock" value='<?= (isset($producto) ? $producto["stock"] : "") ?>' />
            </div>
          </div>

          <div class="mb-3">
            <label for="inputImagen" class="form-label">Imágenes del producto: </label>
            <br>
            <?php
            $prueba = explode(",", $producto['ruta_imagen']);
            echo '<img src="' . $prueba[0] . '" width="200" height="200"/>';
            echo '<img src="' . $prueba[1] . '" width="200" height="200"/>';
            echo '<img src="' . $prueba[2] . '" width="200" height="200"/>';
            echo '<img src="' . $prueba[3] . '" width="200" height="200"/>';
            ?>
            <br><br>
            <input type="file" class="form-control" id="inputImagen" name="inputImagen[]" multiple>
          </div>
          <!-- Agregar el campo oculto para la ruta de la imagen para que no se borre cada vez que se modifique algo -->
          <input type="hidden" name="ruta_imagen" value='<?= (isset($producto) ? $producto["ruta_imagen"] : "") ?>' />

        </div>

        <br>
        <input type="hidden" name="idProducto" value='<?= (isset($producto) ? $producto["idproducto"] : "") ?>' />
        <button type="submit" name="modificar" value="true" class="btn btn-primary">Modificar</button>
        <div class="mt-3">
          <a href="../controller/productosAdminController.php" class="text-primary fw-bold"> Mostrar productos</a>
        </div>
      </div>
    </div>
    </div>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>