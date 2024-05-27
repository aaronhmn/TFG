<?php
// Namespace y dependencias
namespace model;

require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
require '../config/PHPMailer/PHPMailer.php';
require '../config/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use \model\Usuario;
use \model\utils;

session_start();

// Verificar método POST y existencia de email
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];
    $conexPDO = utils::conectar();
    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->getUsuario($email, $conexPDO);

    if ($usuario) {
        $_SESSION['email_usuario_recuperacion'] = $email;  // Guardar correo en sesión
        $url = "http://localhost/tfg%201.0/view/recuperarContrase%C3%B1aView.php?email=$email";
        $mail = new PHPMailer(true);

        try {
            // Configuración de PHPMailer
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'aaronhelices@gmail.com';
            $mail->Password = 'tbof yhhl ebok fsqp';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('aaronhelices@gmail.com', 'Admin-Genesis');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Recuperacion de cuenta';
            $mail->Body = "Hola, para cambiar tu contraseña por favor haz clic en el siguiente enlace: <a href=\"$url\">Cambiar contraseña</a>";

            $mail->send();
            $_SESSION['mensaje'] = '<div class="alert alert-success" role="alert">Mensaje de recuperación enviado con éxito.</div>';
        } catch (Exception $e) {
            $_SESSION['mensaje'] = '<div class="alert alert-danger" role="alert">El mensaje no pudo ser enviado. Mailer Error: ' . $mail->ErrorInfo . '</div>';
        }
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-warning" role="alert">No existe un usuario con ese correo electrónico.</div>';
    }
    header("Location: ../view/olvidarContraseñaView.php");
    exit();
}

// Incluir la vista de olvido de contraseña si no se hace POST
include("../view/olvidarContraseñaView.php");
?>
