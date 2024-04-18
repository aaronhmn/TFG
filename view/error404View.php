<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Error 404 - Página no encontrada</title>
    <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Montserrat", sans-serif;
        }

        body {
            background-color: #e6e6fa;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            text-align: center;
        }

        h1 {
            color: red;
        }

        .boton {
            width: 150px;
            height: 45px;
            background: #8350f2;
            color: white;
            border: none;
            outline: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 500;
        }

        .boton:hover {
            background: #5916e8;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="display-1">Error 404</h1><br>
        <p class="fs-5">Página no encontrada :(</p><br>
        <a href="../controller/inicioController.php"><button  class="boton">Volver al inicio</button></a>
    </div>
</body>

</html>