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

    <title>Pedidos - Dashboard</title>
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
            <li>
                <a href="../controller/productosAdminController.php">
                    <i class="fas fa-briefcase"></i>
                    <span>Productos</span>
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
            <li class="active">
                <a href="../controller/pedidosAdminController.php">
                    <i class="fas fa-shipping-fast"></i>
                    <span><b>Pedidos</b></span>
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
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Id Pedido</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Nombre de Usuario</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Fecha de pedido</th>
                            <th style="background-color: #8350F2; color: #fff;" scope="col">Precio Total</th>
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

                        foreach ($pedidosPaginados as $datosPedido) {

                            $nombreUsuario = $gestorUsuarios->getUsuarioId($datosPedido["id_usuario_pedido"], $conexPDO)['nombre_usuario'];
                            /* $nombreCategoria = $gestorCategorias->getCategoriaId($datosProducto["id_categoria"], $conexPDO)['nombre_categoria']; */
                            //Comienzo de fila
                            print("<tr style='align-items: center; background-color: gray;'>\n");

                            //Id de pedido
                            print("<td style='padding-top: 14px;' scope='row'><b>" . $datosPedido["idpedido"] . "</b></td>\n");
                            //Nombre usuario
                            print("<td style='padding-top: 14px;'>" . $nombreUsuario . "</td>\n");
                            //Fecha pedido
                            print("<td style='padding-top: 14px;'>" . $datosPedido["fecha_pedido"] . "</td>\n");
                            //Precio total
                            print("<td style='padding-top: 14px;'>" . $datosPedido["precio_total"] . "€</td>\n");


                            echo "<td>";
                            echo "<a href='../controller/detallesPedidosAdminController.php?idPedido=" . htmlspecialchars($datosPedido['idpedido'], ENT_QUOTES) . "' class='btn btn-info' style='color: white;'>";
                            echo "<i class='fas fa-eye'></i> Ver Detalles";
                            echo "</a>";
                            echo "</td>";
                        }
                        ?>
                    </tbody>
                </table>
                <form method="POST" action="../controller/pedidosAdminController.php">
                    <?php
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        echo "<button style='margin-left: 7px; margin-bottom: 25px; background-color: #8350F2; color: #fff; border-radius: 50%; width: 40px' name='Pag' value='$i' class='btn'>$i</button>";
                    }
                    ?>
                </form>

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
                    <p style="color: #8350F2;">Descripcion:</p>
                    <span id="detalle_descripcion"></span>
                    <hr>
                    <p style="color: #8350F2;">Especificacion:</p>
                    <span id="detalle_especificacion"></span>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script>
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