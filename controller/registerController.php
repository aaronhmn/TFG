<?php

namespace model;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use \model\utils;
use \model\usuario;
// Recoger la libreria de phpmailer para los correos
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
require '../config/PHPMailer/PHPMailer.php';
require '../config/PHPMailer/SMTP.php';
$mensaje = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aplicar trim a todos los valores de entrada para limpiarlos
    $_POST = array_map('trim', $_POST);

    $nombre = $_POST['nombre'];
    $primerApellido = $_POST['primer_apellido'];
    $segundoApellido = $_POST['segundo_apellido'];
    $telefono = $_POST['telefono'];
    $dni = $_POST['dni'];
    $codigoPostal = $_POST['codigo_postal'];
    $calle = $_POST['calle'];
    $numeroBloque = $_POST['numero_bloque'];
    $piso = $_POST['piso'];
    $email = $_POST['email'];
    $nombreUsuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contrasena'];

    $gestorUsu = new Usuario();
    // Conexión a la BD
    $conexPDO = utils::conectar();

    // Verificar si el email ya existe
    if ($gestorUsu->existeEmail($email, $conexPDO)) {
        $_SESSION['error'] = 'Este email ya está registrado.';
        header("Location: ../view/registerView.php");
        exit();
    }

    // Verificar si el nombre de usuario ya existe
    if ($gestorUsu->existeNombreUsuario($nombreUsuario, $conexPDO)) {
        $_SESSION['error'] = 'Este nombre de usuario ya está en uso.';
        header("Location: ../view/registerView.php");
        exit();
    }

    // Verificar si el telefono de usuario ya existe
    if ($gestorUsu->existeTelefono($telefono, $conexPDO)) {
        $_SESSION['error'] = 'Este telefono ya está en uso.';
        header("Location: ../view/registerView.php");
        exit();
    }

    // Verificar si el dni de usuario ya existe
    if ($gestorUsu->existeDni($dni, $conexPDO)) {
        $_SESSION['error'] = 'Este DNI ya está en uso.';
        header("Location: ../view/registerView.php");
        exit();
    }

    // Validación del número de teléfono
    if (!preg_match('/^\d{9}$/', $telefono)) {
        $mensaje = 'El número de teléfono es inválido. Debe tener 9 dígitos.';
        echo $mensaje;
        return; // Detener la ejecución si hay error
    }

    // Validación del DNI
    if (!preg_match('/^\d{8}[A-Za-z]$/', $dni)) {
        $mensaje = 'El DNI es inválido. Debe tener 8 dígitos seguidos de una letra.';
        echo $mensaje;
        return; // Detener la ejecución si hay error
    }

    // Validación del codigo postal
    if (!preg_match('/^\d{5}$/', $codigoPostal)) {
        $mensaje = 'El código postal es inválido. Debe tener 5 dígitos.';
        echo $mensaje;
        return; // Detener la ejecución si hay error
    }

    // Validación de la contraseña
    if (strlen($contraseña) < 6) {
        $mensaje = 'La contraseña debe tener al menos 6 caracteres.';
        echo $mensaje;
        return; // Detener la ejecución si hay error
    }

    // Limpieza de datos
    $usuario = array();
    $usuario["rol"] = 0;
    $usuario["nombre"] = utils::limpiar_datos($nombre);
    $usuario["primer_apellido"] = utils::limpiar_datos($primerApellido);
    $usuario["segundo_apellido"] = utils::limpiar_datos($segundoApellido);
    $usuario["telefono"] = utils::limpiar_datos($telefono);
    $usuario["dni"] = utils::limpiar_datos($dni);
    $usuario["codigo_postal"] = utils::limpiar_datos($codigoPostal);
    $usuario["calle"] = utils::limpiar_datos($calle);
    $usuario["numero_bloque"] = utils::limpiar_datos($numeroBloque);
    $usuario["piso"] = utils::limpiar_datos($piso);
    $usuario["email"] = utils::limpiar_datos($email);
    $usuario["nombre_usuario"] = utils::limpiar_datos($nombreUsuario);

    // Generamos una salt de 16 posiciones
    $salt = utils::generar_salt(16); // Llama a la función para generar una salt de 16 caracteres
    $usuario["salt"] = $salt; // Asigna la salt generada al array de datos del usuario
    $usuario["contrasena"] = crypt($contraseña, '$6$rounds=5000$' . $salt . '$'); // Crea un hash de la contraseña usando SHA-512 y la salt generada

    $usuario["activo"] = 0; // Establece el estado del usuario como inactivo

    $usuario["activacion"] = utils::generar_codigo_activacion(); // Genera un código de activación y lo asigna al usuario

    $resultado = $gestorUsu->addUsuario($usuario, $conexPDO); // Añade el usuario a la base de datos

    if ($resultado) {
        // Si el usuario se añadió correctamente, envía un correo con el código de activación
        $mail = new PHPMailer(true); // Crea una nueva instancia de PHPMailer
        try {
            $mail->isSMTP(); // Configura el correo para usar SMTP
            $mail->Host = 'smtp.gmail.com'; // Establece el servidor SMTP
            $mail->SMTPAuth = true; // Habilita la autenticación SMTP
            $mail->Username = 'aaronhelices@gmail.com'; // Nombre de usuario para la autenticación SMTP
            $mail->Password = 'tbof yhhl ebok fsqp'; // Contraseña para la autenticación SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilita encriptación TLS
            $mail->Port = 587; // Puerto TCP para la conexión SMTP

            $mail->setFrom('aaronhelices@gmail.com', 'Admin-Genesis'); // Establece el remitente del correo
            $mail->addAddress($usuario["email"], $usuario["nombre"]); // Añade el destinatario del correo

            $mail->isHTML(true); // Configura el correo para enviar en formato HTML
            $mail->Subject = 'Codigo de Activacion de Cuenta'; // Establece el asunto del correo
            $mail->Body    = "Hola {$usuario["nombre"]},<br>Gracias por registrarte en <strong>Genesis</strong>. Tu codigo de activacion es: <strong>{$usuario["activacion"]}</strong>. Por favor, introduce este codigo en nuestra pagina para activar tu cuenta."; // Cuerpo del correo

            $mail->send(); // Envía el correo
            echo 'Mensaje de verificación enviado'; // Mensaje de éxito
            header("Location: ../controller/loginController.php"); // Redirige al controlador de login
            exit();
        } catch (Exception $e) {
            // Si hay un error al enviar el correo, muestra un mensaje de error
            echo 'El mensaje no pudo ser enviado. Error: ' . $mail->ErrorInfo;
        }
    } else {
        // Si hubo un fallo al acceder a la base de datos, muestra un mensaje de error
        $mensaje = "Ha habido un fallo al acceder a la Base de Datos";
        echo ($mensaje);
    }
}

include("../view/registerView.php");
