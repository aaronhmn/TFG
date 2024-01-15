<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/css/admin.css">
    <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"/>

    <title>Productos - Dashboard</title>
</head>
<body style="background-color: #e6e6fa">

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
            <li class="home">
                <a href="../controller/inicioController.php">
                    <i class="fas fa-home"></i>
                    <span>Web</span>
                </a>
            </li>
        </ul>
    </div>

        
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

        <div class="container" style="max-width: 1600px;"><br><br>
        <div class="navbar2">
      <ul>
        <li>
        <?php
          print("<form method='GET' action='../controller/insertarProductosAdminController.php'>");
          print("<button class='btn btn-success'>Insertar producto nuevo</button>");
          print("</form>");
          ?>
        </li>
        <li><h3 style="color: #8350F2;">Bienvenido <b>ADMIN</b></h3></li>
        <li>
          <form action='../controller/cerrarSesionController.php' method="POST">
              <button class="btn" style="background-color: #ec5353; color: #fff;"><b>Cerrar Sesión</b></button>
          </form>
        </li>
      </ul>
    </div>
    <br>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
            <table class="table">
                <thead>
                <tr>
                    <th style="background-color: #8350F2; color: #fff;" scope="col">Id Producto</th>
                    <th style="background-color: #8350F2; color: #fff;" scope="col">Nombre</th>
                    <th style="background-color: #8350F2; color: #fff;" scope="col">Precio</th>
                    <th style="background-color: #8350F2; color: #fff;" scope="col">Categoria</th>
                    <th style="background-color: #8350F2; color: #fff;" scope="col">Sub Categoria</th>
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

                foreach ($productosPaginados as $datosProducto) {
                    //Comienzo de fila
                    print("<tr style='align-items: center; background-color: gray;'>\n");

                    //Id de producto
                    print("<td style='padding-top: 14px;' scope='row'><b>" . $datosProducto["idproducto"] . "</b></td>\n");
                    //Nombre
                    print("<td style='padding-top: 14px;'>" . "<a href='../controller/detallesProductoAdminController.php' class='ID-REF' data-id='" . $datosProducto["idproducto"] . "'>" . $datosProducto["nombre"] . "</a>" . "</td>\n");
                    //Precio
                    print("<td style='padding-top: 14px;'>" . $datosProducto["precio"] . "€</td>\n");
                    //Categoria
                    print("<td style='padding-top: 14px;'>" . $datosProducto["categoria"] . "</td>\n");
                    //Sub Categoria
                    print("<td style='padding-top: 14px;'>" . $datosProducto["sub_categoria"] . "</td>\n");
                    //Descripcion
                    //print("<td style='padding-top: 14px;'>" . $datosProducto[$i]["descripcion"] . "</td>\n");
                    //Especificacion
                    //print("<td style='padding-top: 14px;'>" . $datosProducto[$i]["especificacion"] . "</td>\n");
                    //Marca
                    print("<td style='padding-top: 14px;'>" . $datosProducto["marca"] . "</td>\n");
                    //Stock
                    print("<td style='padding-top: 14px;'>" . $datosProducto["stock"] . "</td>\n");
                    

                    //Para cada producto creamos un boton para eliminarlo
                    //que llamara al controlador borrarProducto y le pasara el id
                    print("<td>\n");
                    print("<form method='POST' action='../controller/borrarProductoController.php'>");
                    print("<input type='hidden' name='idProducto' value='" . $datosProducto["idproducto"] . "'/>");
                    print("<button name= 'eliminar' style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;'><i class='fas fa-trash-alt fa-lg' style='color: #f00505;'></i></button>");
                    print("</form>");
                    print("</td>\n");

                    print("<td>\n");
                    print("<form method='GET' action='../controller/modificarProductoController.php'>");
                    print("<input type='hidden' name='idProducto' value='" . $datosProducto["idproducto"] . "'/>");
                    print("<input type='hidden' name='nombre' value='" . $datosProducto["nombre"] . "'/>");
                    print("<input type='hidden' name='precio' value='" . $datosProducto["precio"] . "'/>");
                    print("<input type='hidden' name='categoria' value='" . $datosProducto["categoria"] . "'/>");
                    print("<input type='hidden' name='sub_categoria' value='" . $datosProducto["sub_categoria"] . "'/>");
                    print("<input type='hidden' name='descripcion' value='" . $datosProducto["descripcion"] . "'/>");
                    print("<input type='hidden' name='especificacion' value='" . $datosProducto["especificacion"] . "'/>");
                    print("<input type='hidden' name='marca' value='" . $datosProducto["marca"] . "'/>");
                    print("<input type='hidden' name='stock' value='" . $datosProducto["stock"] . "'/>");
                    print("<input type='hidden' name='ruta_imagen' value='" . $datosProducto["ruta_imagen"] . "'/>");

                    print("<button name='modificar' style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;' value='false' ><i class='fas fa-edit fa-lg' style='color: #005eff;'></i></button>");
                    print("</form>");
                    print("</td>\n");
                    //Final de fila
                    print("</tr>\n");
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

        <div class="modal fade" id="empModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detalles del Producto</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                 <div class="modal-body"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


    <script type='text/javascript'> 
    $(document).ready(function(){
      $('.ID-REF').click(function()
        {
          var productoId = $(this).data('id');
          $.ajax({
            url: '../controller/detallesProductoAdminController.php',
            type: 'post',
            data:{productoId: productoId},
            success: function(response)
            {
              $('.modal-body').html(response);
              $('#empModal').modal('show');
            }
          });
        });
      });
  </script>
</body>
</html>