<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/vnd.icon" href="assets/img/genesis logo sin fondo favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Bienvenido a Genesis</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Montserrat', sans-serif;
        }

        .bg-image {
            background-image: url('assets/img/inicio5.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .bg-image::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            /* backdrop-filter: blur(4px); */
        }

        .content {
            color: white;
            text-align: center;
            padding: 15px;
            max-width: 900px;
        }

        p {
            font-size: 22px;
        }

        a,
        a:hover {
            color: #ffa500;
            text-decoration: none;
        }

        .btn-primary {
            margin-top: 20px;
            background-color: #8350f2;
            border-color: #8350f2;
        }

        .btn-primary:hover {
            background-color: #8350f2;
            border-color: #8350f2;
        }

        .logo {
            height: 100px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 80px;
            padding-top: 10px;
            padding-bottom: 10px;
            border-bottom: 3px solid #8350f2;
            border-top: 3px solid #8350f2;
        }

        a{
            padding: 7px;
        }

        @media (max-width: 768px) {

            /* Para tabletas */
            h1 {
                font-size: 50px;
            }

            .content {
                padding: 10px;
            }

            .btn-primary {
                width: 50%;
            }
        }

        @media (max-width: 480px) {

            /* Para móviles */
            h1 {
                font-size: 40px;
            }

            .content {
                padding: 5px;
            }

            .btn-primary {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="bg-image"></div>
    <div class="content" data-aos="fade-up" data-aos-duration="1000">
        <h1 style="color:#8350f2;" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500"><b>Bienvenido a Genesis</b></h1><br>
        <!-- <img class="logo" src="assets/img/genesis logo sin fondo favicon.png" alt="logo"> -->
        <p class="mt-4" data-aos="fade-up" data-aos-delay="500"><b>Para comprar los productos y poder usar al completo la web debes de tener una cuenta registrada. <a href="controller/registerController.php">Regístrate aquí </a> :)</b></p>
        <a class="btn btn-primary mt-4 w-50" href="controller/inicioController.php" style="padding: 15px; font-size: 18px;" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000"><i class="fas fa-home fa-lg" style="margin-right: 10px;"></i><b>Ir a la web</b></a>
        <p class="mt-5" style="color: #ffa500; font-size: 19px;" data-aos="fade" data-aos-anchor-placement="top-bottom"><b>Usamos cookies de sesiones necesarias para poder mantener las sesiones de los clientes.</b></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>