<?php

namespace model;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
require '../config/PHPMailer/Exception.php';
require '../config/PHPMailer/PHPMailer.php';
require '../config/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$usuarioModel = new Usuario();
$conexPDO = utils::conectar();

// Cargar los datos del usuario si está logueado
$idUsuario = $_SESSION['id_usuario'] ?? null;
$datosUsuario = [];

if ($idUsuario) {
    $datosUsuario = $usuarioModel->getUsuarioId($idUsuario, $conexPDO);
} else {
    $datosUsuario = ['nombre' => '', 'primer_apellido' => '', 'segundo_apellido' => '', 'email' => ''];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $primer_apellido = htmlspecialchars($_POST['primer_apellido']);
    $segundo_apellido = htmlspecialchars($_POST['segundo_apellido']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'aaronhelices@gmail.com';
        $mail->Password = 'tbof yhhl ebok fsqp';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($email, $nombre);
        $mail->addReplyTo($email, $nombre);
        $mail->addAddress('aaronhelices@gmail.com', 'Admin-Genesis');

        // Mark the email as important
        $mail->Priority = 1;
        $mail->AddCustomHeader("X-Priority: 1");
        $mail->AddCustomHeader("X-MSMail-Priority: High");
        $mail->AddCustomHeader("Importance: High");

        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto';
        $mail->Body = "<b>De:</b> $nombre $primer_apellido $segundo_apellido <br><b>Email:</b> $email<br><b>Mensaje:</b><br>$mensaje";

        $mail->send();
        $_SESSION['message'] = "El mensaje ha sido enviado correctamente.";
        $_SESSION['message_type'] = "success";
    } catch (Exception $e) {
        $_SESSION['message'] = "El mensaje no pudo ser enviado. Error: {$e->getMessage()}";
        $_SESSION['message_type'] = "danger";
    }

    header("Location: ".$_SERVER['REQUEST_URI']);
    exit();
}

include("../view/contactoView.php");
?>
