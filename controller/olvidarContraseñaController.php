<?php
// Namespace y dependencias
namespace model;

require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
require '../config/PHPMailer/PHPMailer.php';
require '../config/PHPMailer/SMTP.php';
// Recoger la libreria de phpmailer para los correos
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use \model\Usuario;
use \model\utils;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar método POST y existencia de email
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];
    // Conexión a la BD
    $conexPDO = utils::conectar();
    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->getUsuario($email, $conexPDO);

    if ($usuario) {
        // Si el usuario existe, guarda el correo en la sesión para la recuperación
        $_SESSION['email_usuario_recuperacion'] = $email;
        // Construye la URL para la página de recuperación de contraseña
        $url = "http://localhost/tfg%201.0/view/recuperarContrase%C3%B1aView.php?email=$email";
        // Crea una nueva instancia de PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuración de PHPMailer para el envío de correo
            $mail->isSMTP(); // Utiliza el protocolo SMTP
            $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
            $mail->SMTPAuth = true; // Habilita la autenticación SMTP
            $mail->Username = 'aaronhelices@gmail.com'; // Nombre de usuario SMTP
            $mail->Password = 'tbof yhhl ebok fsqp'; // Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encriptación TLS
            $mail->Port = 587; // Puerto SMTP

            // Configuración del remitente y destinatario del correo
            $mail->setFrom('aaronhelices@gmail.com', 'Admin-Genesis'); // Remitente
            $mail->addAddress($email); // Destinatario

            // Configuración del contenido del correo
            $mail->isHTML(true); // Establece el formato del correo a HTML
            $mail->Subject = 'Recuperacion de cuenta'; // Asunto del correo
            // Cuerpo del correo con un enlace para cambiar la contraseña
            $mail->Body = "Hola, para cambiar tu contraseña por favor haz clic en el siguiente enlace: <a href=\"$url\">Cambiar contraseña</a>";

            // Envía el correo
            $mail->send();
            // Mensaje de éxito
            $_SESSION['mensaje'] = '<div class="alert alert-success" role="alert">Mensaje de recuperación enviado con éxito.</div>';
        } catch (Exception $e) {
            // Manejo de errores al enviar el correo
            $_SESSION['mensaje'] = '<div class="alert alert-danger" role="alert">El mensaje no pudo ser enviado. Mailer Error: ' . $mail->ErrorInfo . '</div>';
        }
    } else {
        // Si el usuario no existe, muestra un mensaje de advertencia
        $_SESSION['mensaje'] = '<div class="alert alert-warning" role="alert">No existe un usuario con ese correo electrónico.</div>';
    }
    header("Location: ../view/olvidarContraseñaView.php");
    exit();
}

// Incluir la vista de olvido de contraseña si no se hace POST
include("../view/olvidarContraseñaView.php");
