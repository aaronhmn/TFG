<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/styles/css/perfil.css" />
    <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />

    <title>Perfil - Genesis</title>
  </head>
  <body style="background-color: #e6e6fa">
    <!--NAV DE LA PAGINA-->
    <?php include '../controller/navbarController.php'; ?>

    <div class="container" style="margin-top: 50px; margin-bottom: 100px">
      <div class="row" style="margin-right: 0px;">
        <div class="col-md-3 col-sm-12" style="background-color: #e6e6fa; margin: 10px">
            <div class="row" style="display: flex; align-items: center">
              <div class="col-auto" style="margin-top: 30px; margin-bottom: 10px;">
                <h3 style="color: #000"><b>Editar Perfil</b></h3>
              </div>
            </div>
            <div class="texto-izq">
              <a href="../controller/perfilController.php" style="margin-bottom: 15px;">Mi perfil</a>
              <a href="../controller/cambioContraseñaController.php">Cambiar contraseña</a>
            </div>
            <br />
            <div class="row" style="display: flex; align-items: center">
              <div class="col-auto" style="margin-top: 5px; margin-bottom: 10px;">
                <h3 style="color: #000"><b>Acciones</b></h3>
              </div>
            </div>
            <div class="texto-izq" style="margin-bottom: 20px;">
                <a href="../controller/misPedidosController.php">Mis Pedidos</a>
            </div>
          </div>

        <div class="col-md-8 col-sm-12" style="background-color: #fff; margin: 10px">
        <h5 style="margin-top: 15px;">Bienvenido <?php //nombre del usuario ?></h5>
          <form class="row g-3" style="margin: 10px; margin-right: 0px; margin-left: -5px;">
            <div class="col-9" style="display: flex; align-items: center;">
                <h2 style="color: #ffa500"><b>Edita tu perfil</b></h2>
            </div>
  
            <div class="col-6">
              <label for="nombre" class="visually-hidden">Nombre</label>
              <input
                type="text"
                class="form-control input-contacto"
                id="nombre"
                placeholder="Nombre"
              />
            </div>
            <div class="col-6">
              <label for="nombre" class="visually-hidden">Nombre de usuario</label>
              <input
                type="text"
                class="form-control"
                id="nombreUsuario"
                placeholder="Nombre usuario"
              />
            </div>
            <div class="col-6">
              <label for="primer apellido" class="visually-hidden">Primer Apellido</label>
              <input
                type="text"
                class="form-control"
                id="primerApellido"
                placeholder="1º Apellido"
              />
            </div>
            <div class="col-6">
                <label for="segundo apellido" class="visually-hidden">Segundo Apellido</label>
                <input
                  type="text"
                  class="form-control"
                  id="segundoApellido"
                  placeholder="2º Apellido"
                />
              </div>
              <div class="col-6">
                <label for="email" class="visually-hidden">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  placeholder="Email"
                />
              </div>
              <div class="col-6">
                <label for="direccion" class="visually-hidden">Dirección</label>
                <input
                  type="text"
                  class="form-control"
                  id="direccion"
                  placeholder="Dirección"
                />
              </div>
              <button class="btn btn-primary col-4" type="submit" style="background-color: rgb(168, 168, 168); margin-right: 15px; border: none;">Cancelar</button>
              <button class="btn btn-primary col-4" type="submit" style="background-color: #8350f2; border: none;">Guardar</button>
          </form>
        </div>
      </div>
    </div>

        <!--FOOTER-->
        <?php include '../controller/footerController.php'; ?>

    <script
      defer
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
