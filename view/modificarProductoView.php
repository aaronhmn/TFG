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

          <!-- Margenes con mb mr ml mt -sm-distancia-->
          <!-- Misma linea -->
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="nombre" class="col-lg-3 col-form-label">Nombre:</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="nombre" name="nombre"
               value='<?=(isset($producto)?$producto["nombre"]:"") ?>' />
            </div>
          </div>

          <div class=" form-group row mb-sm-2 mt-sm-2 ">
            <label for="precio" class="col-lg-3 col-form-label">Precio:</label>
            <div class="col-lg-6">
               <input type="number" class="form-control" id="precio" name="precio" 
               value='<?=(isset($producto)?$producto["precio"]:"") ?>' />
            </div>
          </div>

          <div class=" form-group row mb-sm-2 mt-sm-2 ">
            <label for="categoria" class="col-lg-3 col-form-label">Categoria:</label>
            <div class="col-lg-6">
               <input type="text" class="form-control" id="categoria" name="categoria" 
               value='<?=(isset($producto)?$producto["categoria"]:"") ?>' />
            </div>
          </div>

          <div class=" form-group row mb-sm-2 mt-sm-2 ">
            <label for="sub_categoria" class="col-lg-3 col-form-label">Subategoria:</label>
            <div class="col-lg-6">
               <input type="text" class="form-control" id="sub_categoria" name="sub_categoria" 
               value='<?=(isset($producto)?$producto["sub_categoria"]:"") ?>' />
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="descripcion" class="col-lg-3 col-form-label">Descripción:</label>
            <div class="col-lg-6">
              <textarea class="form-control" id="descripcion" name="descripcion" rows="5"><?=$producto["descripcion"] = $_GET["descripcion"];?></textarea>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="especificacion" class="col-lg-3 col-form-label">Especificación:</label>
            <div class="col-lg-6">
              <textarea class="form-control" id="especificacion" name="especificacion" rows="5"><?=$producto["especificacion"] = $_GET["especificacion"];?></textarea>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="marca" class="col-lg-3 col-form-label">Marca:</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="marca" name="marca"
               value='<?=(isset($producto)?$producto["marca"]:"") ?>' />
            </div>
          </div>

          <div class=" form-group row mb-sm-2 mt-sm-2 ">
            <label for="stock" class="col-lg-3 col-form-label">Stock:</label>
            <div class="col-lg-6">
               <input type="number" class="form-control" id="stock" name="stock" 
               value='<?=(isset($producto)?$producto["stock"]:"") ?>' />
            </div>
          </div>

            <div class="mb-3">
                <label for="inputImagen" class="form-label">Imagen del producto: </label>
                <br>
                <?php echo '<img src="'.$producto['ruta_imagen'].'" width="200" height="200"/>'; ?>
                <br><br>
                <input type="file" class="form-control" id="inputImagen" name="inputImagen">
            </div>

          </div>
            
          <br>
          <input type="hidden" name="idProducto" value='<?=(isset($producto)?$producto["idproducto"]:"") ?>' />
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