<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/styles/css/register.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />

    <title>Registro de Usuario - Genesis</title>
</head>

<body style="background-color: #e6e6fa">
    <div class="wrapper">
        <div class="form-box login">
            <div class="encabezado">
                <h2 style="color: #8350f2;"><b>Crear una cuenta</b></h2>
                <img class="logo" src="../assets/img/genesis logo sin fondo.png" alt="logo">
            </div>
            <?php if (session_status() == PHP_SESSION_NONE) {
                session_start();
            } ?>
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?><br>
            <form method="POST" action="../controller/registerController.php" style="margin-top:-40px;">
                <!-- Campos ocultos para engañar al autocompletado -->
                <div style="display: none;">
                    <input type="text" autocomplete="username">
                    <input type="password" autocomplete="new-password">
                </div>
                <!-- Campos reales del formulario -->
                <div class="input-box">
                    <input type="text" required placeholder="Nombre *" id="nombre" name="nombre" autocomplete="off">
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Primer Apellido *" id="primer_apellido" name="primer_apellido" autocomplete="off">
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Segundo Apellido *" id="segundo_apellido" name="segundo_apellido" autocomplete="off">
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Teléfono (9 dígitos) *" id="telefono" name="telefono" digitsonly="true" autocomplete="off">
                    <span id="errorTelefono" class="error-message"></span>
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="DNI (8 dígitos y una letra) *" id="dni" name="dni" autocomplete="off">
                    <span id="errorDNI" class="error-message"></span>
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Código Postal *" id="codigo_postal" name="codigo_postal" digitsonly="true" autocomplete="off">
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Nombre de la calle o avenida *" id="calle" name="calle" autocomplete="off">
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Número del bloque o casa *" id="numero_bloque" name="numero_bloque" digitsonly="true" autocomplete="off">
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Piso" id="piso" name="piso" autocomplete="off">
                </div>
                <div class="input-box">
                    <input type="email" required placeholder="Email *" id="email" name="email" autocomplete="off">
                    <span id="errorEmail" class="error-message"></span>
                </div>
                <div class="input-box">
                    <input type="text" required placeholder="Nombre de usuario *" id="nombre_usuario" name="nombre_usuario" autocomplete="off">
                    <span id="errorNombre_usuario" class="error-message"></span>
                </div>
                <div class="input-box">
                    <input type="password" required placeholder="Contraseña (mínimo 6 caracteres) *" id="contrasena" name="contrasena" autocomplete="new-password">
                    <span id="errorContrasena" class="error-message"></span>
                </div>
                <div class="input-box">
                    <input type="password" required placeholder="Repetir Contraseña *" id="contrasena2" name="contrasena2" autocomplete="new-password">
                    <span id="errorContrasena2" class="error-message"></span>
                </div>
                <button type="submit" class="btn">Registrarse</button>
                <div class="registrarse">
                    <p>¿Ya tienes una cuenta?<a href="../controller/loginController.php" class="register"> Iniciar Sesión</a></p>
                </div>
                <div class="registrarse">
                    <p><a href="../controller/inicioController.php"> Volver a inicio</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../assets/js/register.js"></script>
</body>

</html>