<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles/css/login.css" />
    <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
    <title>Cambio de Contraseña - Genesis</title>
</head>

<body style="background-color: #e6e6fa">
    <div class="wrapper">
        <div class="form-box login">
            <div class="encabezado">
                <h2 style="color: #8350f2;"><b>Recuperar cuenta</b></h2>
            </div><br><br>
            <div class="alert-container">
                <?php if (isset($_SESSION['mensaje'])) : ?>
                    <div class="alert alert-<?php echo $_SESSION['tipo_mensaje']; ?> alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($_SESSION['mensaje']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']);
                endif; ?>
            </div><br>
            <form method="POST" action="../controller/recuperarContraseñaController.php" id="recuperarForm" style="margin-top:-40px;">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>">
                <div class="input-box">
                    <input type="password" id="contrasena" name="contrasena" required placeholder="Nueva contraseña">
                </div>
                <div class="input-box">
                    <input type="password" id="contrasena2" name="contrasena2" required placeholder="Repetir contraseña">
                </div>
                <button type="submit" class="btn">Cambiar</button>
                <div class="registrarse">
                    <p><a href="../controller/loginController.php">Volver al login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/recuperarContraseña.js"></script>
</body>

</html>