<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/css/admin.css">
    <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />

    <title>Productos - Dashboard</title>
</head>

<body style="background-color: #e6e6fa">

    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>

    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li>
                <a href="../controller/inicioAdminController.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../controller/usuariosAdminController.php">
                    <i class="fas fa-user"></i>
                    <span>Usuarios</span>
                </a>
            </li>
            <li class="active">
                <a href="../controller/productosAdminController.php">
                    <i class="fas fa-briefcase"></i>
                    <span><b>Productos</b></span>
                </a>
            </li>
            <li>
                <a href="../controller/categoriasAdminController.php">
                    <i class="fas fa-list-alt"></i>
                    <span>Categorías</span>
                </a>
            </li>
            <li>
                <a href="../controller/marcasAdminController.php">
                    <i class="fa-solid fa-flag"></i>
                    <span>Marcas</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="container" style="max-width: 1600px;"><br><br>
        <nav class="navbar3">
            <img class="logo" src="../assets/img/genesis logo sin fondo favicon.png" alt="">
            <p class="parrafo-logo"><b>Genesis</b></p>
            <ul>
                <li>
                    <h3 style="margin-right: 50px;">Bienvenido
                        <?php
                        $resultado = $_SESSION['nombre_usuario'];
                        print "<b style='color: #8350f2;'>" . $resultado . "</b>";
                        ?>
                    </h3>
                </li>
                <li>
                    <form action='../controller/inicioController.php' method="POST">
                        <button class="btn btn-primary home-boton" style="margin-right: 50px; background-color: #8350F2; border-color: #8350F2; border-radius: 4px;"><i class="fas fa-home" style="color: white; margin-right: 8px;"></i><b>Ir a la web</b></button>
                    </form>
                </li>
                <li>
                    <form action='../controller/cerrarSesionController.php' method="POST">
                        <button class="btn btn-danger"><i class="fas fa-sign-out" style="color: white; margin-right: 8px;"></i><b>Cerrar Sesión</b></button>
                    </form>
                </li>
            </ul>
        </nav><br>
        <hr style="border-top: 2px solid #8350F2;"><br>
        <div class="navbar2">
            <ul>
                <li>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#insertarProductoModal">
                        Insertar producto nuevo
                    </button>
                </li>
            </ul>
        </div>
        <br>
        <?php
        if (isset($_SESSION['mensaje'])) {
            echo "<div class='alert alert-{$_SESSION['tipo_mensaje']} alert-dismissible fade show' role='alert'>
            {$_SESSION['mensaje']}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            // Limpia los mensajes después de mostrarlos
            unset($_SESSION['mensaje']);
            unset($_SESSION['tipo_mensaje']);
        }
        ?>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Id Producto</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Nombre</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Precio</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Categoria</th>
                            <!--<th style="text-align: center;" scope="col">Descripcion</th>-->
                            <!--<th style="text-align: center;" scope="col">Especificacion</th>-->
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Marca</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Stock</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col"></th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Tenemos que generar una fila tr para cada producto
                        //que tenga el array de datosProducto
                        function truncarTexto($texto, $maxCaracteres)
                        {
                            if (strlen($texto) > $maxCaracteres) {
                                $texto = substr($texto, 0, $maxCaracteres) . '...';
                            }
                            return $texto;
                        }

                        foreach ($productosPaginados as $datosProducto) {

                            $nombreMarca = $gestorMarcas->getMarcaId($datosProducto["id_marca"], $conexPDO)['nombre_marca'];
                            $nombreCategoria = $gestorCategorias->getCategoriaId($datosProducto["id_categoria"], $conexPDO)['nombre_categoria'];
                            //Comienzo de fila
                            print("<tr style='align-items: center; background-color: gray;'>\n");

                            //Id de producto
                            print("<td style='padding-top: 14px;' scope='row'><b>" . $datosProducto["idproducto"] . "</b></td>\n");
                            //Nombre
                            print("<td style='padding-top: 14px;'>");
                            print("<a href='#' class='text-primary' data-bs-toggle='modal' data-bs-target='#productoDetalleModal' data-idusuario='" . $datosProducto['idproducto'] . "'>");
                            print(htmlspecialchars(truncarTexto($datosProducto["nombre"], 20)));
                            print("</a>");
                            print("</td>\n");
                            /* print("<td style='padding-top: 14px;'>" . truncarTexto($datosProducto["nombre"], 20) . "</td>\n"); */
                            //Precio
                            print("<td style='padding-top: 14px;'>" . $datosProducto["precio"] . "€</td>\n");
                            //Categoria
                            print("<td style='padding-top: 14px;'>" . $nombreCategoria . "</td>\n");
                            //Descripcion
                            //print("<td style='padding-top: 14px;'>" . $datosProducto[$i]["descripcion"] . "</td>\n");
                            //Especificacion
                            //print("<td style='padding-top: 14px;'>" . $datosProducto[$i]["especificacion"] . "</td>\n");
                            //Marca
                            print("<td style='padding-top: 14px;'>" . $nombreMarca . "</td>\n");
                            //Stock
                            print("<td style='padding-top: 14px;'>" . $datosProducto["stock"] . "</td>\n");


                            // Botón para eliminar
                            echo "<td>";
                            echo "<form id='formEliminar-{$datosProducto['idproducto']}' method='POST' action='../controller/borrarProductoController.php'>";
                            echo "<input type='hidden' name='idProducto' value='{$datosProducto['idproducto']}'/>";
                            echo "<button style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;' type='button' onclick='mostrarModalEliminar(" . $datosProducto['idproducto'] . ");'><i class='fa-solid fa-trash-alt fa-lg' style='color: red;'></i></button>";
                            echo "</form>";
                            echo "</td>";

                            // Botón para modificar
                            /* print("<td>\n");
                            print("<form method='GET' action='../controller/modificarProductoController.php'>");
                            print("<input type='hidden' name='idProducto' value='" . $datosProducto["idproducto"] . "'/>");
                            print("<input type='hidden' name='nombre' value='" . $datosProducto["nombre"] . "'/>");
                            print("<input type='hidden' name='precio' value='" . $datosProducto["precio"] . "'/>");
                            print("<input type='hidden' name='id_categoria' value='" . $nombreCategoria . "'/>");
                            print("<input type='hidden' name='descripcion' value='" . $datosProducto["descripcion"] . "'/>");
                            print("<input type='hidden' name='especificacion' value='" . $datosProducto["especificacion"] . "'/>");
                            print("<input type='hidden' name='id_marca' value='" . $nombreMarca . "'/>");
                            print("<input type='hidden' name='stock' value='" . $datosProducto["stock"] . "'/>");
                            print("<input type='hidden' name='ruta_imagen' value='" . $datosProducto["ruta_imagen"] . "'/>");

                            print("<button name='modificar' style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;' value='false' ><i class='fas fa-edit fa-lg' style='color: #005eff;'></i></button>");
                            print("</form>");
                            print("</td>\n"); */
                            //Final de fila
                            /* print("</tr>\n"); */

                            echo "<td>";
                            echo "<button data-bs-toggle='modal' data-bs-target='#modificarProductoModal'";
                            echo " data-id='" . htmlspecialchars($datosProducto['idproducto'], ENT_QUOTES) . "'";
                            echo " data-nombre='" . htmlspecialchars($datosProducto['nombre'], ENT_QUOTES) . "'";
                            echo " data-precio='" . htmlspecialchars($datosProducto['precio'], ENT_QUOTES) . "'";
                            /* echo " data-segundoapellido='" . htmlspecialchars($datosProducto['segundo_apellido'], ENT_QUOTES) . "'"; */
                            echo " data-descripcion='" . htmlspecialchars($datosProducto['descripcion'], ENT_QUOTES) . "'";
                            echo " data-especificacion='" . htmlspecialchars($datosProducto['especificacion'], ENT_QUOTES) . "'";
                            /* echo " data-nombreusuario='" . htmlspecialchars($datosProducto['nombre_usuario'], ENT_QUOTES) . "'"; */
                            echo " data-stock='" . htmlspecialchars($datosProducto['stock'], ENT_QUOTES) . "'";
                            echo " data-ruta_imagen='" . htmlspecialchars($datosProducto['ruta_imagen'], ENT_QUOTES) . "'";
                            echo " style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;'>";
                            echo "<i class='fas fa-edit fa-lg' style='color: #005eff;'></i>";
                            echo "</button>";
                            echo "</td>";
                        }
                        ?>
                    </tbody>
                </table>
                <form method="POST" action="../controller/productosAdminController.php">
                    <?php
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        echo "<button style='margin-left: 7px; margin-bottom: 25px; background-color: #8350F2; color: #fff; border-radius: 50%; width: 40px' name='Pag' value='$i' class='btn'>$i</button>";
                    }
                    ?>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal Insertar Producto -->
    <div class="modal fade" id="insertarProductoModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalLabel" style="color: #8350F2;">Insertar nuevo producto</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va el formulario de inserción de producto -->
                    <form method="POST" action="../controller/insertarProductosAdminController.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="inputNombre" class="form-label"><b>Nombre:</b></label>
                            <input type="text" class="form-control" name="inputNombre" aria-describedby="emailHelp">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="inputPrecio" class="form-label"><b>Precio:</b></label>
                                <input type="number" step="0.01" class="form-control" name="inputPrecio" aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="inputStock" class="form-label"><b>Stock:</b></label>
                                <input type="number" class="form-control" name="inputStock" aria-describedby="emailHelp">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="selectCategoria" class="form-label"><b>Categoria:</b></label>
                                <select class="form-select" name="inputCategoria" id="selectCategoria">
                                    <option value="" selected disabled>Elija una categoría</option>
                                    <?php foreach ($categorias as $categoria) : ?>
                                        <option value="<?= $categoria['idcategoria'] ?>"><?= htmlspecialchars($categoria['nombre_categoria']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="selectMarca" class="form-label"><b>Marca:</b></label>
                                <select class="form-select" name="inputMarca" id="selectMarca">
                                    <option value="" selected disabled>Elija una marca</option>
                                    <?php foreach ($marcas as $marca) : ?>
                                        <option value="<?= $marca['idmarca'] ?>"><?= htmlspecialchars($marca['nombre_marca']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label"><b>Descripción:</b></label>
                            <textarea class="form-control" name="inputDescripcion" rows="5"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label"><b>Especificacion:</b></label>
                            <textarea class="form-control" name="inputEspecificacion" rows="5"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="inputImagen" class="form-label"><b>Inserta las imágenes:</b></label>
                            <input type="file" class="form-control" id="inputImagen" name="inputImagen[]" multiple>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit" value="Upload" style="background-color: #8350F2; border:#8350F2;">Insertar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detalles Usuario -->
    <div class="modal fade" id="productoDetalleModal" tabindex="-1" aria-labelledby="productoDetalleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productoDetalleLabel" style="color: #8350F2;">Detalles del Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre:</strong> <span id="detalle_nombre"></span></p>
                    <p><strong>Precio:</strong> <span id="detalle_precio"></span></p>
                    <p><strong>Segundo Apellido:</strong> <span id="detalle_segundo_apellido"></span></p>
                    <p><strong>Descripcion:</strong> <span id="detalle_descripcion"></span></p>
                    <p><strong>Especificacion:</strong> <span id="detalle_especificacion"></span></p>
                    <p><strong>Código Postal:</strong> <span id="detalle_codigo_postal"></span></p>
                    <p><strong>Stock:</strong> <span id="detalle_stock"></span></p>
                    <p><strong>Ruta de Imagen:</strong> <span id="detalle_ruta_imagen"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="confirmacionEliminarModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalLabel" style="color: #8350F2;"><b>Confirmar Eliminación</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <b>¿Estás seguro de que deseas eliminar este producto?</b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmarEliminar">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script>
        //script para borrar lo que haya dentro del modal
        document.addEventListener("DOMContentLoaded", function() {
            // Selecciona el modal por su ID
            var modal = document.getElementById('insertarProductoModal');

            // Escucha el evento 'hidden.bs.modal' que se dispara cuando el modal se ha cerrado
            modal.addEventListener('hidden.bs.modal', function(event) {
                // Encuentra el formulario dentro del modal y lo resetea
                modal.querySelector('form').reset();
            });
        });

        function mostrarModalEliminar(idProducto) {
            var modal = new bootstrap.Modal(document.getElementById('confirmacionEliminarModal'));
            var botonEliminar = document.getElementById('confirmarEliminar');
            botonEliminar.onclick = function() {
                document.getElementById('formEliminar-' + idProducto).submit();
            };
            modal.show();
        }

        //detalles producto
        $('#productoDetalleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var idProducto = button.data('idProducto'); // Asegúrate de que este data-attribute está definido correctamente en el HTML

            $.ajax({
                url: '../controller/detalleProductoAdminController.php', // Asegúrate de que este endpoint está correctamente definido y apunta al script correcto en el servidor
                type: 'POST',
                data: {
                    idProducto: idProducto
                },
                dataType: 'json', // Esperamos una respuesta en formato JSON
                success: function(producto) {
                    if (producto && !producto.error) {
                        $('#detalle_nombre').text(producto.nombre || 'No disponible');
                        $('#detalle_precio').text(producto.precio || 'No disponible');
                        $('#detalle_segundo_apellido').text(producto.segundo_apellido || 'No disponible');
                        $('#detalle_descipcion').text(producto.descripcion || 'No disponible');
                        $('#detalle_especificacion').text(producto.especificacion || 'No disponible');
                        $('#detalle_codigo_postal').text(producto.codigo_postal || 'No disponible');
                        $('#detalle_stock').text(producto.stock || 'No disponible');
                        $('#detalle_ruta_imagen').text(producto.ruta_imagen || 'No disponible');

                    } else {
                        console.error('No se pudo cargar la información del producto.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX: ' + error);
                }
            });
        });
    </script>

</body>

</html>