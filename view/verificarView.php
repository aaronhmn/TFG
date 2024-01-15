<?php
namespace views;
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verificar</title>
        <link rel="stylesheet" href="../assets/styles/css/login.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />
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
                    <input type="number" name="inputCodigo" aria-describedby="codigoHelp" placeholder="Código de activación" autocomplete="nope">
                    <label></label>
                </div>
                <button type="submit" class="btn">Enviar</button>
                <div class="registrarse">
                    <p><a href="../controller/inicioController.php"> Volver a inicio</a></p>
                </div>
            </form>
        </div>
    </div>

    </body>

</html>