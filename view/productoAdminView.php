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

    <nav class="navbar navbar-dark fixed-top" style="background-color: #8350f2;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="../controller/inicioAdminController.php" id="logo-sidebar"><img src="../assets/img/genesis Logo.png" style="width: 50px;">Genesis</a>
            <div class="dropdown">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8350f2; border-color: #8350f2; font-size: 18px;">
                    <?php
                    $resultado = $_SESSION['nombre_usuario'];
                    echo "<b style='color: #fff;'>$resultado</b>";
                    ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                    <li>
                        <form action="../controller/inicioController.php" method="POST">
                            <button class="dropdown-item">
                                <i class="fas fa-home"></i> Ir a la web
                            </button>
                        </form>
                    </li>
                    <hr>
                    <li>
                        <form action="../controller/cerrarSesionController.php" method="POST">
                            <button class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel" style="visibility: visible; background-color: #8350f2;">
                <div class="offcanvas-header">
                    <h3 class="offcanvas-title" id="offcanvasDarkNavbarLabel" style="color: white; margin-left: 20px;">
                        <img src="../assets/img/genesis Logo.png" style="width: 80px; margin-right: 5px; margin-left: -20px;"><b>Menu</b>
                    </h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <hr style="color: #fff;">
                <div class="offcanvas-body">
                    <ul class="navbar-nav flex-grow-1 pe-3" style="margin-left: 20px;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../controller/inicioAdminController.php"><i class="fas fa-tachometer-alt fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Inicio</span></a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link active" href="../controller/usuariosAdminController.php"><i class="fas fa-user fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Usuarios</span></a>
                        </li>
                        <li class="nav-item mt-4" id="active">
                            <a class="nav-link active" href="../controller/productosAdminController.php"><i class="fas fa-briefcase fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Productos</span></a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link active" href="../controller/categoriasAdminController.php"><i class="fas fa-list-alt fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Categorías</span></a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link active" href="../controller/marcasAdminController.php"><i class="fa-solid fa-flag fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Marcas</span></a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link active" href="../controller/pedidosAdminController.php"><i class="fas fa-shipping-fast fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">pedidos</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5" style="max-width: 1600px;"><br><br>
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
        <div class="row" style="margin: 0;">
            <div class="col-lg-12 col-sm-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Id Producto</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Nombre</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Precio</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Categoria</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Marca</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Stock</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Estado</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col"></th>
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
                            print("<a href='#' class='text-primary' data-bs-toggle='modal' data-bs-target='#productoDetalleModal' data-idproducto='" . $datosProducto['idproducto'] . "'>");
                            print(htmlspecialchars(truncarTexto($datosProducto["nombre"], 20)));
                            print("</a>");
                            print("</td>\n");
                            //Precio
                            print("<td style='padding-top: 14px;'>" . $datosProducto["precio"] . "€</td>\n");
                            //Categoria
                            print("<td style='padding-top: 14px;'>" . $nombreCategoria . "</td>\n");
                            print("<td style='padding-top: 14px;'>" . $nombreMarca . "</td>\n");
                            //Stock
                            print("<td style='padding-top: 14px;'>" . $datosProducto["stock"] . "</td>\n");
                            //Estado
                            $estadoTexto = $datosProducto["estado"] == 0 ? 'Disponible' : 'Oculto';
                            print("<td style='padding-top: 14px;'>" . $estadoTexto . "</td>\n");

                            // Ocultar producto
                            echo "<td style='text-align: end/*  */;'>";
                            echo "<form method='POST' action='../controller/ocultarProductoController.php'>";
                            echo "<input type='hidden' name='idProducto' value='{$datosProducto['idproducto']}'/>";
                            // Añade clases para centrar verticalmente y ajusta con estilos si es necesario
                            echo "<button type='submit' class='btn btn-link p-0 align-middle' style='vertical-align: middle;'>";
                            echo ($datosProducto['estado'] == 1 ? '<i class="fas fa-eye fa-lg text-secondary"></i>' : '<i class="fas fa-eye-slash fa-lg text-primary"></i>');
                            echo "</button>";
                            echo "</form>";
                            echo "</td>";

                            // Botón para eliminar
                            echo "<td style='text-align: center;'>";
                            echo "<form id='formEliminar-{$datosProducto['idproducto']}' method='POST' action='../controller/borrarProductoController.php'>";
                            echo "<input type='hidden' name='idProducto' value='{$datosProducto['idproducto']}'/>";
                            echo "<button class='btn btn-link p-0 align-middle' style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;' type='button' onclick='mostrarModalEliminar(" . $datosProducto['idproducto'] . ");'><i class='fa-solid fa-trash-alt fa-lg' style='color: red;'></i></button>";
                            echo "</form>";
                            echo "</td>";

                            echo "<td>";
                            echo "<button class='btn btn-link p-0 align-middle' data-bs-toggle='modal' data-bs-target='#modificarProductoModal'"
                                . " data-id='" . htmlspecialchars($datosProducto['idproducto'], ENT_QUOTES) . "'"
                                . " data-nombre='" . htmlspecialchars($datosProducto['nombre'], ENT_QUOTES) . "'"
                                . " data-precio='" . htmlspecialchars($datosProducto['precio'], ENT_QUOTES) . "'"
                                . " data-stock='" . htmlspecialchars($datosProducto['stock'], ENT_QUOTES) . "'"
                                . " data-categoria='" . htmlspecialchars($datosProducto['id_categoria'], ENT_QUOTES) . "'"
                                . " data-marca='" . htmlspecialchars($datosProducto['id_marca'], ENT_QUOTES) . "'"
                                . " data-descripcion='" . htmlspecialchars($datosProducto['descripcion'], ENT_QUOTES) . "'"
                                . " data-especificacion='" . htmlspecialchars($datosProducto['especificacion'], ENT_QUOTES) . "'"
                                /* . " data-estado='" . htmlspecialchars($datosProducto['estado'], ENT_QUOTES) . "'" */
                                . " data-imagenes='" . htmlspecialchars($datosProducto['ruta_imagen'], ENT_QUOTES) . "'"
                                . " style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;'>"
                                . "<i class='fas fa-edit fa-lg' style='color: #005eff;'></i>"
                                . "</button>";
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
                            <textarea class="form-control" name="inputDescripcion" rows="10" style="resize: none;"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label"><b>Especificacion:</b></label>
                            <textarea class="form-control" name="inputEspecificacion" rows="10" style="resize: none;"></textarea>
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

    <!-- Modal Modificar Producto -->
    <div class="modal fade" id="modificarProductoModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalLabel" style="color: #8350F2;">Modificar producto</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../controller/modificarProductoController.php" enctype="multipart/form-data">
                        <input type="hidden" name="idproducto" id="idproducto" value="<?php echo $producto['idproducto']; ?>">

                        <div class="mb-3">
                            <label for="nombre" class="form-label"><b>Nombre:</b></label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="precio" class="form-label"><b>Precio:</b></label>
                                <input type="number" step="0.01" class="form-control" id="precio" name="precio">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stock" class="form-label"><b>Stock:</b></label>
                                <input type="number" class="form-control" id="stock" name="stock">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="selectCategoria" class="form-label"><b>Categoria:</b></label>
                                <select class="form-select" name="id_categoria" id="selectCategoria">
                                    <option value="" selected disabled>Elija una categoría</option>
                                    <?php foreach ($categorias as $categoria) : ?>
                                        <option value="<?= $categoria['idcategoria'] ?>"><?= htmlspecialchars($categoria['nombre_categoria']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="selectMarca" class="form-label"><b>Marca:</b></label>
                                <select class="form-select" name="id_marca" id="selectMarca">
                                    <option value="" selected disabled>Elija una marca</option>
                                    <?php foreach ($marcas as $marca) : ?>
                                        <option value="<?= $marca['idmarca'] ?>"><?= htmlspecialchars($marca['nombre_marca']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label"><b>Descripción:</b></label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="especificacion" class="form-label"><b>Especificacion:</b></label>
                            <textarea class="form-control" id="especificacion" name="especificacion" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="inputImagen" class="form-label"><b>Inserta las imágenes:</b></label>
                            <input type="file" class="form-control" id="inputImagen" name="inputImagen[]" multiple>
                            <div id="currentImagesContainer" style="margin-top: 20px;"></div>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit" value="Upload" style="background-color: #8350F2; border:#8350F2;">Modificar</button>
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
                    <h3 class="modal-title" id="productoDetalleLabel" style="color: #8350F2;">Detalles del Producto</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p style="color: #8350F2;">Nombre:</p>
                    <span id="detalle_nombre"></span>
                    <hr>
                    <p style="color: #8350F2;">Precio:</p>
                    <span id="detalle_precio"></span>€
                    <hr>
                    <p style="color: #8350F2;">Categoría:</p>
                    <span id="detalle_categoria"></span>
                    <hr>
                    <div style="white-space: pre-wrap; margin-top: -45px; margin-bottom: -45px;">
                        <p style="color: #8350F2;">Descripcion:</p>
                        <span id="detalle_descripcion" style="margin-top: -45px;"></span>
                    </div>
                    <hr>
                    <div style="white-space: pre-wrap; margin-top: -45px; margin-bottom: -45px;">
                        <p style="color: #8350F2;">Especificacion:</p>
                        <span id="detalle_especificacion" style="margin-top: -45px;"></span>
                    </div>
                    <hr>
                    <p style="color: #8350F2;">Marca:</p>
                    <span id="detalle_marca"></span>
                    <hr>
                    <p style="color: #8350F2;">Stock:</p>
                    <span id="detalle_stock"></span>
                    <hr>
                    <p style="color: #8350F2;">Imágenes:</p>
                    <span id="detalle_imagenes"></span>
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

        //modificar producto       
        $('#modificarProductoModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var id = button.data('id');
            var nombre = button.data('nombre');
            var precio = button.data('precio');
            var stock = button.data('stock');
            var categoria = button.data('categoria');
            var marca = button.data('marca');
            var descripcion = button.data('descripcion');
            var especificacion = button.data('especificacion');
            var estado = button.data('estado');
            var imagenes = button.data('imagenes').split(',');
            var imagesContainer = $('#currentImagesContainer');
            imagesContainer.empty();

            var modal = $(this);
            modal.find('#idproducto').val(id);
            modal.find('#nombre').val(nombre);
            modal.find('#precio').val(precio);
            modal.find('#stock').val(stock);
            modal.find('#selectCategoria').val(categoria);
            modal.find('#selectMarca').val(marca);
            modal.find('#descripcion').val(descripcion);
            modal.find('#especificacion').val(especificacion);
            modal.find('#estado').val(estado);

            imagenes.forEach(function(imagen) {
                var imgHtml = $('<img>').attr('src', imagen.trim()).css('max-width', '100px').css('margin-right', '5px').css('margin-bottom', '5px');
                imagesContainer.append(imgHtml);
            });
        });

        // Actualizar visualización de imágenes al seleccionar nuevas
        function updateImageDisplay(files) {
            var imagesContainer = $('#currentImagesContainer');
            imagesContainer.empty();
            if (files.length > 0) {
                Array.from(files).forEach(file => {
                    var imgElement = document.createElement('img');
                    imgElement.style.maxWidth = '100px';
                    imgElement.style.marginRight = '5px';
                    imgElement.style.marginBottom = '5px';
                    imgElement.src = URL.createObjectURL(file);
                    imagesContainer.append(imgElement);
                });
            }
        }

        //detalles producto
        $('#productoDetalleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var idProducto = button.data('idproducto');

            $.ajax({
                url: '../controller/detalleProductoAdminController.php',
                type: 'POST',
                data: {
                    idProducto: idProducto
                },
                dataType: 'json',
                success: function(producto) {
                    if (producto && !producto.error) {
                        $('#detalle_nombre').text(producto.nombre || 'No disponible');
                        $('#detalle_precio').text(producto.precio || 'No disponible');
                        $('#detalle_categoria').text(producto.categoria || 'No disponible');
                        $('#detalle_descripcion').text(producto.descripcion || 'No disponible');
                        $('#detalle_especificacion').text(producto.especificacion || 'No disponible');
                        $('#detalle_marca').text(producto.marca || 'No disponible');
                        $('#detalle_stock').text(producto.stock || 'No disponible');

                        // Suponiendo que las imágenes están separadas por comas
                        var imagenesHtml = '';
                        var imagenes = producto.ruta_imagen.split(',');
                        imagenes.forEach(function(imagen) {
                            imagenesHtml += '<img src="' + imagen.trim() + '" class="img-fluid" style="max-width: 100px; margin-right: 5px;">';
                        });
                        $('#detalle_imagenes').html(imagenesHtml);

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