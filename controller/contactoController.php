<?php

namespace model;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use \model\utils;
use \model\usuario;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
require '../config/PHPMailer/Exception.php';
require '../config/PHPMailer//PHPMailer.php';
require '../config/PHPMailer//SMTP.php';
$mensaje = null;

$usuarioModel = new Usuario();
$conexPDO = utils::conectar();

// Suponiendo que 'id_usuario' es guardado en la sesión al momento del login
$idUsuario = $_SESSION['email'] ?? null;

if (isset($_SESSION['id_usuario'])) {
    $datosUsuario = $usuarioModel->getUsuarioId($_SESSION['id_usuario'], $conexPDO);
    include("../view/contactoView.php");
} else {
    // Redirigir al login si no hay ID de usuario en la sesión
    header("Location: ../view/contactoView.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $primer_apellido = htmlspecialchars($_POST['primer_apellido']);
    $segundo_apellido = htmlspecialchars($_POST['segundo_apellido']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'aaronhelices@gmail.com'; // Correo del administrador para autenticación SMTP
        $mail->Password = 'tbof yhhl ebok fsqp'; // Contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    
        // Remitentes y destinatarios
        $mail->setFrom($email, $nombre); // Establecemos el correo del cliente como el remitente
        $mail->addReplyTo($email, $nombre); // Respuestas dirigidas al administrador
        $mail->addAddress('aaronhelices@gmail.com', 'Admin-Genesis'); // El administrador recibe el correo
    
        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto';
        $mail->Body = "<b>De:</b> $nombre $primer_apellido $segundo_apellido <br><b>Email:</b> $email<br><b>Mensaje:</b><br>$mensaje";
    
        $mail->send();
        echo 'El mensaje ha sido enviado';
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>