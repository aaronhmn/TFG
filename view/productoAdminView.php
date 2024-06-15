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
                            <a class="nav-link active" href="../controller/pedidosAdminController.php"><i class="fas fa-shipping-fast fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Pedidos</span></a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link active" href="../controller/reseñasAdminController.php"><i class="fas fa-comments fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Reseñas</span></a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link active" href="../controller/almacenesAdminController.php"><i class="fa-solid fa-warehouse fa-xl" style="color: #fff; margin-right: 10px;"></i><span style="font-size: 20px;">Almacenes</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5"><br><br>
        <div class="navbar2 mt-5">
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
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Almacén</th>
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
                            $nombreAlmacen = $gestorAlmacenes->getAlmacenId($datosProducto["id_almacen"], $conexPDO)['nombre'];
                            //Comienzo de fila
                            print("<tr style='align-items: center; background-color: gray;'>\n");

                            //Id de producto
                            print("<td scope='row'><b>" . $datosProducto["idproducto"] . "</b></td>\n");
                            //Nombre
                            print("<td>");
                            print("<a href='#' class='text-primary' data-bs-toggle='modal' data-bs-target='#productoDetalleModal' data-idproducto='" . $datosProducto['idproducto'] . "'>");
                            print(htmlspecialchars(truncarTexto($datosProducto["nombre"], 20)));
                            print("</a>");
                            print("</td>\n");
                            //Precio
                            print("<td>" . $datosProducto["precio"] . "€</td>\n");
                            //Categoria
                            print("<td>" . $nombreCategoria . "</td>\n");
                            //Marca
                            print("<td>" . $nombreMarca . "</td>\n");
                            //Stock
                            print("<td>" . $datosProducto["stock"] . "</td>\n");
                            //Marca
                            print("<td>" . $nombreAlmacen . "</td>\n");
                            //Estado
                            $estadoTexto = $datosProducto["estado"] == 0 ? 'Disponible' : 'Oculto';
                            print("<td>" . $estadoTexto . "</td>\n");

                            // Ocultar producto
                            echo "<td style='text-align: end/*  */;'>";
                            echo "<form method='POST' action='../controller/ocultarProductoController.php'>";
                            echo "<input type='hidden' name='idProducto' value='{$datosProducto['idproducto']}'/>";
                            // Añade clases para centrar verticalmente y ajusta con estilos si es necesario
                            echo "<button type='submit' class='btn btn-link p-0 align-middle' style='vertical-align: middle;'>";
                            echo ($datosProducto['estado'] == 1 ? '<i title="Mostrar" class="fas fa-eye fa-lg text-secondary"></i>' : '<i title="Ocultar" class="fas fa-eye-slash fa-lg text-primary"></i>');
                            echo "</button>";
                            echo "</form>";
                            echo "</td>";

                            // Botón para eliminar
                            echo "<td style='text-align: center;'>";
                            echo "<form id='formEliminar-{$datosProducto['idproducto']}' method='POST' action='../controller/borrarProductoController.php'>";
                            echo "<input type='hidden' name='idProducto' value='{$datosProducto['idproducto']}'/>";
                            echo "<button title='Eliminar' class='btn btn-link p-0 align-middle' style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;' type='button' onclick='mostrarModalEliminar(" . $datosProducto['idproducto'] . ");'><i class='fa-solid fa-trash-alt fa-lg' style='color: red;'></i></button>";
                            echo "</form>";
                            echo "</td>";

                            echo "<td>";
                            if ($datosProducto['estado'] == 1) { // 1 representa 'Oculto'
                                echo "<button title='Modificar' class='btn btn-link p-0 align-middle disabled' aria-disabled='true' style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;'>";
                                echo "<i class='fas fa-edit fa-lg' style='color: grey;'></i>";
                                echo "</button>";
                            } else {
                                echo "<button title='Modificar' class='btn btn-link p-0 align-middle' data-bs-toggle='modal' data-bs-target='#modificarProductoModal'"
                                    . " data-id='" . htmlspecialchars($datosProducto['idproducto'], ENT_QUOTES) . "'"
                                    . " data-nombre='" . htmlspecialchars($datosProducto['nombre'], ENT_QUOTES) . "'"
                                    . " data-precio='" . htmlspecialchars($datosProducto['precio'], ENT_QUOTES) . "'"
                                    . " data-stock='" . htmlspecialchars($datosProducto['stock'], ENT_QUOTES) . "'"
                                    . " data-categoria='" . htmlspecialchars($datosProducto['id_categoria'], ENT_QUOTES) . "'"
                                    . " data-marca='" . htmlspecialchars($datosProducto['id_marca'], ENT_QUOTES) . "'"
                                    . " data-almacen='" . htmlspecialchars($datosProducto['id_almacen'], ENT_QUOTES) . "'"
                                    . " data-descripcion='" . htmlspecialchars($datosProducto['descripcion'], ENT_QUOTES) . "'"
                                    . " data-especificacion='" . htmlspecialchars($datosProducto['especificacion'], ENT_QUOTES) . "'"
                                    . " data-estado='" . htmlspecialchars($datosProducto['estado'], ENT_QUOTES) . "'"
                                    . " data-imagenes='" . htmlspecialchars($datosProducto['ruta_imagen'], ENT_QUOTES) . "'"
                                    . " style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;'>"
                                    . "<i class='fas fa-edit fa-lg' style='color: #005eff;'></i>"
                                    . "</button>";
                            }
                            echo "</td>";
                        }
                        ?>
                    </tbody>
                </table>
                <h6 style="color: #ffa500; margin-bottom: 15px;"><b>¡Recuerda que no puedes modificar un producto oculto!</b></h6>
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
                    <h3 class="modal-title" id="modalLabel" style="color: #8350F2;"><b>Insertar nuevo producto</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va el formulario de inserción de producto -->
                    <form method="POST" action="../controller/insertarProductosAdminController.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="inputNombre" class="form-label"><b>Nombre:</b></label>
                            <input type="text" class="form-control" name="inputNombre" aria-describedby="emailHelp" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="inputPrecio" class="form-label"><b>Precio:</b></label>
                                <input type="number" min=0 step="0.01" class="form-control" name="inputPrecio" aria-describedby="emailHelp" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="inputStock" class="form-label"><b>Stock:</b></label>
                                <input type="number" min=0 class="form-control" name="inputStock" aria-describedby="emailHelp" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="selectCategoria" class="form-label"><b>Categoria:</b></label>
                                <select class="form-select" name="inputCategoria" id="selectCategoria" required>
                                    <option value="" selected disabled>Elija una categoría</option>
                                    <?php foreach ($categorias as $categoria) : ?>
                                        <option value="<?= $categoria['idcategoria'] ?>"><?= htmlspecialchars($categoria['nombre_categoria']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="selectMarca" class="form-label"><b>Marca:</b></label>
                                <select class="form-select" name="inputMarca" id="selectMarca" required>
                                    <option value="" selected disabled>Elija una marca</option>
                                    <?php foreach ($marcas as $marca) : ?>
                                        <option value="<?= $marca['idmarca'] ?>"><?= htmlspecialchars($marca['nombre_marca']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="selectAlmacen" class="form-label"><b>Almacén:</b></label>
                            <select class="form-select" name="inputAlmacen" id="selectAlmacen" required>
                                <option value="" selected disabled>Elija un almacén</option>
                                <?php foreach ($almacenes as $almacen) : ?>
                                    <option value="<?= $almacen['idalmacen'] ?>"><?= htmlspecialchars($almacen['nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label"><b>Descripción:</b></label>
                            <textarea class="form-control" name="inputDescripcion" rows="10" style="resize: none;" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label"><b>Especificacion:</b></label>
                            <textarea class="form-control" name="inputEspecificacion" rows="10" style="resize: none;" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="inputImagen" class="form-label"><b>Inserta las imágenes:</b></label>
                            <input type="file" class="form-control" id="inputImagen" name="inputImagen[]" multiple required>
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
                    <h3 class="modal-title" id="modalLabel" style="color: #8350F2;"><b>Modificar producto</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../controller/modificarProductoController.php" enctype="multipart/form-data">
                        <input type="hidden" name="idproducto" id="idproducto" value="<?php echo $producto['idproducto']; ?>">

                        <div class="mb-3">
                            <label for="nombre" class="form-label"><b>Nombre:</b></label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="precio" class="form-label"><b>Precio:</b></label>
                                <input type="number" min=0 step="0.01" class="form-control" id="precio" name="precio" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stock" class="form-label"><b>Stock:</b></label>
                                <input type="number" min=0 class="form-control" id="stock" name="stock" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="selectCategoria" class="form-label"><b>Categoria:</b></label>
                                <select class="form-select" name="id_categoria" id="selectCategoria" required>
                                    <option value="" selected disabled>Elija una categoría</option>
                                    <?php foreach ($categorias as $categoria) : ?>
                                        <option value="<?= $categoria['idcategoria'] ?>"><?= htmlspecialchars($categoria['nombre_categoria']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="selectMarca" class="form-label"><b>Marca:</b></label>
                                <select class="form-select" name="id_marca" id="selectMarca" required>
                                    <option value="" selected disabled>Elija una marca</option>
                                    <?php foreach ($marcas as $marca) : ?>
                                        <option value="<?= $marca['idmarca'] ?>"><?= htmlspecialchars($marca['nombre_marca']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- Desplegable para el estado -->
                            <div class="cole-md-6 mb-3">
                                <label for="estado" class="form-label"><b>Estado:</b></label>
                                <select class="form-select" id="estado" name="estado">
                                    <option value="0" <?= $datosProducto['estado'] == 0 ? 'selected' : '' ?>>Disponible</option>
                                    <option value="1" <?= $datosProducto['estado'] == 1 ? 'selected' : '' ?>>Oculto</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="selectAlmacen" class="form-label"><b>Almacén:</b></label>
                            <select class="form-select" name="id_almacen" id="selectAlmacen" required>
                                <option value="" selected disabled>Elija un almacén</option>
                                <?php foreach ($almacenes as $almacen) : ?>
                                    <option value="<?= $almacen['idalmacen'] ?>"><?= htmlspecialchars($almacen['nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label"><b>Descripción:</b></label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="10" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="especificacion" class="form-label"><b>Especificacion:</b></label>
                            <textarea class="form-control" id="especificacion" name="especificacion" rows="10" required></textarea>
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
                    <p style="color: #8350F2;">Almacén:</p>
                    <span id="detalle_almacen"></span>
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

        // Función para mostrar el modal de confirmación de eliminación
        function mostrarModalEliminar(idProducto) {
            var modal = new bootstrap.Modal(document.getElementById('confirmacionEliminarModal')); // Crear una nueva instancia del modal
            var botonEliminar = document.getElementById('confirmarEliminar'); // Obtener el botón de confirmación de eliminación
            botonEliminar.onclick = function() {
                document.getElementById('formEliminar-' + idProducto).submit(); // Enviar el formulario de eliminación
            };
            modal.show(); // Mostrar el modal
        }

        // Evento al mostrar el modal de modificación de producto
        $('#modificarProductoModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var id = button.data('id'); // Obtener el ID del producto
            var nombre = button.data('nombre'); // Obtener el nombre del producto
            var precio = button.data('precio'); // Obtener el precio del producto
            var stock = button.data('stock'); // Obtener el stock del producto
            var categoria = button.data('categoria'); // Obtener la categoría del producto
            var marca = button.data('marca'); // Obtener la marca del producto
            var almacen = button.data('almacen'); // Obtener el almacén del producto
            var descripcion = button.data('descripcion'); // Obtener la descripción del producto
            var especificacion = button.data('especificacion'); // Obtener la especificación del producto
            var estado = button.data('estado'); // Obtener el estado del producto
            var imagenes = button.data('imagenes').split(','); // Obtener las imágenes del producto
            var imagesContainer = $('#currentImagesContainer'); // Contenedor de imágenes
            imagesContainer.empty(); // Vaciar el contenedor de imágenes

            var modal = $(this); // Obtener el modal actual
            modal.find('#idproducto').val(id); // Establecer el ID del producto en el campo correspondiente
            modal.find('#nombre').val(nombre); // Establecer el nombre en el campo correspondiente
            modal.find('#precio').val(precio); // Establecer el precio en el campo correspondiente
            modal.find('#stock').val(stock); // Establecer el stock en el campo correspondiente
            modal.find('#selectCategoria').val(categoria); // Establecer la categoría en el campo correspondiente
            modal.find('#selectMarca').val(marca); // Establecer la marca en el campo correspondiente
            modal.find('#selectAlmacen').val(almacen); // Establecer el almacén en el campo correspondiente
            modal.find('#descripcion').val(descripcion); // Establecer la descripción en el campo correspondiente
            modal.find('#especificacion').val(especificacion); // Establecer la especificación en el campo correspondiente
            modal.find('#estado').val(estado); // Establecer el estado en el campo correspondiente

            // Añadir las imágenes al contenedor de imágenes
            imagenes.forEach(function(imagen) {
                var imgHtml = $('<img>').attr('src', imagen.trim()).css('max-width', '100px').css('margin-right', '5px').css('margin-bottom', '5px');
                imagesContainer.append(imgHtml);
            });
        });

        // Función para actualizar la visualización de imágenes al seleccionar nuevas
        function updateImageDisplay(files) {
            var imagesContainer = $('#currentImagesContainer'); // Contenedor de imágenes
            imagesContainer.empty(); // Vaciar el contenedor de imágenes
            if (files.length > 0) {
                Array.from(files).forEach(file => {
                    var imgElement = document.createElement('img'); // Crear un nuevo elemento img
                    imgElement.style.maxWidth = '100px'; // Establecer el ancho máximo de la imagen
                    imgElement.style.marginRight = '5px'; // Establecer el margen derecho de la imagen
                    imgElement.style.marginBottom = '5px'; // Establecer el margen inferior de la imagen
                    imgElement.src = URL.createObjectURL(file); // Establecer la fuente de la imagen
                    imagesContainer.append(imgElement); // Añadir la imagen al contenedor
                });
            }
        }

        // Evento al mostrar el modal de detalles del producto
        $('#productoDetalleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var idProducto = button.data('idproducto'); // Obtener el ID del producto

            // Solicitud AJAX para obtener los detalles del producto
            $.ajax({
                url: '../controller/detalleProductoAdminController.php', // URL del controlador para obtener los detalles del producto
                type: 'POST', // Método HTTP POST
                data: {
                    idProducto: idProducto // Datos enviados: ID del producto
                },
                dataType: 'json', // Tipo de datos esperados: JSON
                success: function(producto) {
                    if (producto && !producto.error) {
                        // Actualizar los detalles del producto en el modal
                        $('#detalle_nombre').text(producto.nombre || 'No disponible'); // Nombre del producto
                        $('#detalle_precio').text(producto.precio || 'No disponible'); // Precio del producto
                        $('#detalle_categoria').text(producto.categoria || 'No disponible'); // Categoría del producto
                        $('#detalle_descripcion').text(producto.descripcion || 'No disponible'); // Descripción del producto
                        $('#detalle_especificacion').text(producto.especificacion || 'No disponible'); // Especificación del producto
                        $('#detalle_marca').text(producto.marca || 'No disponible'); // Marca del producto
                        $('#detalle_stock').text(producto.stock || 'No disponible'); // Stock del producto
                        $('#detalle_almacen').text(producto.almacen || 'No disponible'); // Almacén del producto

                        // Suponiendo que las imágenes están separadas por comas
                        var imagenesHtml = '';
                        var imagenes = producto.ruta_imagen.split(','); // Obtener las rutas de las imágenes
                        imagenes.forEach(function(imagen) {
                            imagenesHtml += '<img src="' + imagen.trim() + '" class="img-fluid" style="max-width: 100px; margin-right: 5px;">'; // Generar el HTML de las imágenes
                        });
                        $('#detalle_imagenes').html(imagenesHtml); // Actualizar el contenedor de imágenes
                    } else {
                        console.error('No se pudo cargar la información del producto.'); // Error si no se pudieron cargar los detalles
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX: ' + error); // Error en la solicitud AJAX
                }
            });
        });
    </script>

</body>

</html>