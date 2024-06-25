<?php

namespace model;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
require '../config/PHPMailer/Exception.php';
require '../config/PHPMailer/PHPMailer.php';
require '../config/PHPMailer/SMTP.php';

// Llamo a la libreria de phpmailer para que funcione el correo
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$usuarioModel = new Usuario();
// Conexión a la BD
$conexPDO = utils::conectar();

// Cargar los datos del usuario si está logueado
$idUsuario = $_SESSION['id_usuario'] ?? null; // Obtiene el ID del usuario de la sesión, si existe
$datosUsuario = []; // Inicializa el array de datos del usuario

if ($idUsuario) {
    // Si el usuario está logueado, obtiene sus datos de la base de datos
    $datosUsuario = $usuarioModel->getUsuarioId($idUsuario, $conexPDO);
} else {
    // Si el usuario no está logueado, inicializa con datos vacíos
    $datosUsuario = ['nombre' => '', 'primer_apellido' => '', 'segundo_apellido' => '', 'email' => ''];
}

// Comprueba si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escapa caracteres especiales en los datos recibidos por POST
    $nombre = htmlspecialchars($_POST['nombre']);
    $primer_apellido = htmlspecialchars($_POST['primer_apellido']);
    $segundo_apellido = htmlspecialchars($_POST['segundo_apellido']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Crea una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'aaronhelices@gmail.com'; // Tu dirección de correo
        $mail->Password = ''; // Tu contraseña de aplicación de correo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del correo electrónico
        $mail->setFrom($email, $nombre); // Remitente
        $mail->addReplyTo($email, $nombre); // Dirección de respuesta
        $mail->addAddress('aaronhelices@gmail.com', 'Admin-Genesis'); // Destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto';
        $mail->Body = "<b>De:</b> $nombre $primer_apellido $segundo_apellido <br><b>Email:</b> $email<br><b>Mensaje:</b><br>$mensaje";

        // Envía el correo
        $mail->send();
        // Mensaje de éxito en la sesión
        $_SESSION['message'] = "El mensaje ha sido enviado correctamente.";
        $_SESSION['message_type'] = "success";
    } catch (Exception $e) {
        // Mensaje de error en la sesión
        $_SESSION['message'] = "El mensaje no pudo ser enviado. Error: {$e->getMessage()}";
        $_SESSION['message_type'] = "danger";
    }

    // Redirige a la misma página para evitar reenvío del formulario al recargar
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

include("../view/contactoView.php");
