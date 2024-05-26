<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de verificacion - Genesis</title>
    <link rel="stylesheet" href="../assets/styles/css/login.css" />
    <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        .input-box {
            margin-bottom: 20px;
        }
    </style>
</head>

<body style="background-color: #e6e6fa">
    <div class="wrapper">
        <div class="form-box login">
            <div class="encabezado">
                <h2 style="color: #8350f2;">Activar cuenta</h2>
                <img class="logo" src="../assets/img/genesis logo sin fondo.png" alt="logo">
            </div>
            <form method="POST" action="../controller/verificarController.php" style="margin-top:-40px;">
                <div class="input-box">
                    <input type="text" name="inputCodigo" id="inputCodigo" aria-describedby="codigoHelp" placeholder="Código de activación" autocomplete="off" pattern="\d*" maxlength="4">
                    <span id="errorCodigo" class="error-message">
                        <?php if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        } ?>
                    </span>
                </div><br>
                <button type="submit" class="btn">Enviar</button>
                <div class="registrarse">
                    <p><a href="../controller/inicioController.php"> Volver a inicio</a></p>
                </div>
                <h4 style="color: #ffa500; margin-top: 40px;">¡Código de activación enviado a tu correo!</h4>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const inputCodigo = document.getElementById('inputCodigo');
            const errorCodigo = document.getElementById('errorCodigo');

            // Evento para limpiar el mensaje de error cuando se modifique el input
            inputCodigo.addEventListener('input', function() {
                errorCodigo.textContent = ''; // Limpiar el mensaje de error cuando el usuario empiece a escribir
                // Validar que solo se ingresen números
                this.value = this.value.replace(/\D/g, '');
            });

            form.addEventListener('submit', function(event) {
                let valid = true;
                errorCodigo.textContent = ''; // Limpiar el mensaje de error anterior

                // Validar que el código tenga exactamente 4 dígitos
                if (!/^\d{4}$/.test(inputCodigo.value)) {
                    errorCodigo.textContent = 'El código debe ser de 4 dígitos.';
                    valid = false;
                }

                if (!valid) {
                    event.preventDefault(); // Evitar que el formulario se envíe
                }
            });
        });
    </script>
</body>

</html>