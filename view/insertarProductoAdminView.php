<?php
namespace view;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Insertar Producto</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>

    <body>
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-md-4 p-5">
                <h2 class="text-center mb-4 text-primary">Insertar producto</h2>

                <form method="POST" action="../controller/insertarProductosAdminController.php" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="inputNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="inputNombre" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="inputEdad" class="form-label">Precio</label>
                        <input type="number" class="form-control" name="inputPrecio" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="inputSexo" class="form-label">Categoria</label>
                        <input type="text" class="form-control" name="inputCategoria" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="inputSexo" class="form-label">Subcategoria</label>
                        <input type="text" class="form-control" name="inputSubCategoria" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                        <textarea class="form-control" name="inputDescripcion" rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Especificacion</label>
                        <textarea class="form-control" name="inputEspecificacion" rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="inputNombre" class="form-label">Marca</label>
                        <input type="text" class="form-control" name="inputMarca" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="inputNombre" class="form-label">stock</label>
                        <input type="number" class="form-control" name="inputStock" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="inputImagen" class="form-label">Imagen</label>
                        <input type="file" class="form-control" name="inputImagen">
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit" value="Upload">Insertar</button>
                    </div>
                </form>
                <div class="mt-3">
                    <a href="../controller/productosAdminController.php" class="text-primary fw-bold">Volver a Mostrar Productos</a>
                </div>
        </div>
    </body>

</html>