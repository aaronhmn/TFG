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

    <title>Usuarios - Dashboard</title>
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
            <li class="active">
                <a href="../controller/usuariosAdminController.php">
                    <i class="fas fa-user"></i>
                    <span><b>Usuarios</b></span>
                </a>
            </li>
            <li>
                <a href="../controller/productosAdminController.php">
                    <i class="fas fa-briefcase"></i>
                    <span>Productos</span>
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

    <!--<div class="main-content">-->
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
          print("<form method='GET' action='../controller/insertarUsuariosAdminController.php'>");
          print("<button class='btn btn-success'>Insertar usuario nuevo</button>");
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
                <th style="background-color: #8350F2; color: #fff;" scope="col">Id</th>
                <th style="background-color: #8350F2; color: #fff;" scope="col">Nombre de Usuario</th>
                <th style="background-color: #8350F2; color: #fff;" scope="col">Nombre</th>
                <th style="background-color: #8350F2; color: #fff;" scope="col">Primer Apellido</th>
                <th style="background-color: #8350F2; color: #fff;" scope="col">Segundo Apellido</th>
                <th style="background-color: #8350F2; color: #fff;" scope="col">DNI</th>
                <th style="background-color: #8350F2; color: #fff;" scope="col">Correo Electrónico</th>
                <th style="background-color: #8350F2; color: #fff;" scope="col">Dirección</th>
                <th style="background-color: #8350F2; color: #fff;" scope="col">Teléfono</th>
                <th style="background-color: #8350F2; color: #fff;" scope="col">Activación</th>
                <th style="background-color: #8350F2; color: #fff;" scope="col">Activo</th>
                <th style="background-color: #8350F2; color: #fff;" scope="col">Rol</th>
                <th style="background-color: #8350F2; color: #fff;" scope="col"></th>
                <th style="background-color: #8350F2; color: #fff;" scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              //Tenemos que generar una fila tr para cada cliente
              //que tenga el array de datosClientes
              foreach ($usuariosPaginados as $producto) {
                //Comienzo de fila
                print("<tr style='align-items: center; background-color: gray;'>\n");

                //Id de cliente
                print("<td style=' padding-top: 14px;' scope='row'><b>" . $producto["idusuario"] . "</b></td>\n");
                                //Nombr de Usuario
                                print("<td style=' padding-top: 14px;'>" . $producto["nombre_usuario"] . "</td>\n");
                //Nombre
                print("<td style=' padding-top: 14px;'>" . $producto["nombre"] . "</td>\n");
                //Primer Apellido
                print("<td style=' padding-top: 14px;'>" . $producto["primer_apellido"] . "</td>\n");
                //Segundo Apellido
                print("<td style=' padding-top: 14px;'>" . $producto["segundo_apellido"] . "</td>\n");
                //DNI
                print("<td style=' padding-top: 14px;'>" . $producto["dni"] . "</td>\n");
                //Email
                print("<td style=' padding-top: 14px;'>" . $producto["email"] . "</td>\n");
                //Direccion
                print("<td style=' padding-top: 14px;'>" . $producto["direccion"] . "</td>\n");
                //Telefono
                print("<td style=' padding-top: 14px;'>" . $producto["telefono"] . "</td>\n");
                //Estado de activación
                print("<td style=' padding-top: 14px;'>" . $producto["activacion"] . "</td>\n");
                //Activo
                print("<td style=' padding-top: 14px;'>" . $producto["activo"] . "</td>\n");
                //Rol
                print("<td style=' padding-top: 14px;'>" . $producto["rol"] . "</td>\n");

                //Para cada cliente creamos un boton para eliminarlo
                //que llamara al controlador borrarCliente y le pasara el id
                print("<td>\n");
                print("<form method='POST' action='../controller/borrarUsuarioController.php'>");
                print("<input type='hidden' name='idUsuario' value='" . $producto["idusuario"] . "'/>");
                print("<button name= 'eliminar' style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;'><i class='fas fa-trash-alt fa-lg' style='color: #f00505;'></i></button>");
                print("</form>");
                print("</td>\n");

                print("<td>\n");
                print("<form method='GET' action='../controller/modificarUsuarioController.php'>");
                print("<input type='hidden' name='idUsuario' value='" . $producto["idusuario"] . "'/>");
                print("<input type='hidden' name='nombre_usuario' value='" . $producto["nombre_usuario"] . "'/>");
                print("<input type='hidden' name='nombre' value='" . $producto["nombre"] . "'/>");
                print("<input type='hidden' name='primer_apellido' value='" . $producto["primer_apellido"] . "'/>");
                print("<input type='hidden' name='segundo_apellido' value='" . $producto["segundo_apellido"] . "'/>");
                print("<input type='hidden' name='dni' value='" . $producto["dni"] . "'/>");
                print("<input type='hidden' name='email' value='" . $producto["email"] . "'/>");
                print("<input type='hidden' name='direccion' value='" . $producto["direccion"] . "'/>");
                print("<input type='hidden' name='telefono' value='" . $producto["telefono"] . "'/>");
                print("<input type='hidden' name='activacion' value='" . $producto["activacion"] . "'/>");
                print("<input type='hidden' name='activo' value='" . $producto["activo"] . "'/>");
                print("<input type='hidden' name='rol' value='" . $producto["rol"] . "'/>");

                print("<button name='modificar' value='false' style='background-color: rgba(0, 0, 0, 0); padding-top: 7px;'><i class='fas fa-edit fa-lg' style='color: #005eff;'></i></button>");
                print("</form>");
                print("</td>\n");
                //Final de fila
                print("</tr>\n");
              }
              ?>
            </tbody>
          </table>
          <form method="POST" action="../controller/usuariosAdminController.php">
                <?php
                for ($i = 1; $i <= $totalPaginas; $i++) {
                    echo "<button style='margin-left: 7px; margin-bottom: 25px; background-color: #8350F2; color: #fff; border-radius: 50%; width: 40px' name='Pag' value='$i' class='btn'>$i</button>";
                }
                ?>
            </form>
        </div>
        

      </div><br>
  </div>

  <div class="modal fade" id="empModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Detalles del Usuario</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body"> </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  <!--</div>-->

  <script type='text/javascript'> 
    $(document).ready(function(){
      $('.ID-REF').click(function()
        {
          var userId = $(this).data('id');
          $.ajax({
            url: '../controller/detallesUsuarioController.php',
            type: 'post',
            data:{userId: userId},
            success: function(response)
            {
              $('.modal-body').html(response);
              $('#empModal').modal('show');
            }
          });
        });
      });
  </script>

  <div class="mt-3">
  <p class="mb-0  text-center">¿Volver al menú? <a href="../controller/usuariosAdminController.php" class="text-primary fw-bold">Menú </a></p>
  </div>
    </div>

</body>
</html>