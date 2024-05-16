<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/css/style.css">
    <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <title>Términos de uso - Genesis</title>
</head>

<body style="background-color: #E6E6FA;" <?php if (isset($_SESSION['id_usuario'])) echo 'data-user-id="' . $_SESSION['id_usuario'] . '"'; ?>>
    <!--NAV DE LA PAGINA-->
    <?php include '../controller/navbarController.php'; ?>

    <div class="container">
        <br>
        <h2>Condiciones de Uso </h2><br>
        <p>Estos términos y condiciones (“Términos y Condiciones”) se aplican a cada pedido que el usuario realice. Si el usuario tiene alguna duda o no quiere aceptar los términos y condiciones, nuestro servicio de atención al cliente estará siempre disponible para solventar las dudas o problemas.</p><br>

        <h3>Datos de compra</h3><br>
        <p>El cliente asegura que todos los datos facilitados por él durante el registro o el pedido (por ejemplo, nombre, dirección, dirección de correo electrónico, DNI) son correctos y que no ha utilizado datos de terceros. El cliente se compromete a informar inmediatamente al proveedor de cualquier cambio en los datos. El cliente es responsable del uso indebido de los datos de acceso por parte de terceros, en la medida en que sea responsable de ello. Esto también puede dar lugar a que se le obligue a pagar tasas de uso por productos que no ha pedido él mismo.</p><br>

        <h3>Devolución (Cancelación durante las primeras 24 horas desde que se recibe el producto)</h3><br>
        <p>El cliente tendrá 24 horas para avisar al servicio de atención al cliente (https://www.genesis.com/contacto) para solicitar la cancelación del producto. Se contemplan como posibles situaciones las siguientes:</p><br>

        <p>1. El producto no funciona como debería. En este caso, el cliente deberá contactar con el Centro de Soporte para:</p><br>

        <p>1) Indicar el número de pedido, su nombre completo y datos de contacto (por ejemplo teléfono móvil)</p><br>

        <p>2)Enviar una fotografía o vídeo del producto</p><br>

        <p>3) Indicar las causas de por qué no funciona</p><br>

        <p>4) Indicar la dirección donde desea que le recojan el producto</p><br>

        <p>Nos pondremos en contacto con el cliente para recoger el producto en la dirección indicada y lo enviaremos a nuestros almacenes. Allí se realizará un chequeo de calidad del producto devuelto y, si se confirma que el producto no funciona, se reembolsará el 100% del importe abonado en un periodo de tiempo de 5 días desde que se canceló.</p><br>

        <p>2. El producto no es el que el cliente había solicitado. (ídem)</p><br>

        <p>3. El cliente decide cancelar el pedido sin razón justificada. En este caso, deberá informar al Centro de Soporte como en el caso anterior. El cliente, siempre y cuando el email de cancelación se haya realizado en las primeras 24 horas desde que el cliente recibió el producto, recibirá un reembolso del 50% del importe abonado.</p><br>

        <h3>Pagos</h3><br>
        <p>El pago se procesa por paypal.</p><br>

    </div><br><br><br>

    <button onclick="scrollToTop()" id="btnSubir" title="Ir arriba"><i class="fa-solid fa-arrow-up fa-xl" style="color: #ffffff; align-items:center;"></i></button>

    <!--FOOTER-->
    <?php include '../controller/footerController.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>