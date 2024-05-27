<?php
namespace model;

require_once("../model/usuarioModel.php");
require_once("../model/utils.php");

use \model\Usuario;
use \model\utils;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$usuarioModel = new Usuario();
$conexPDO = utils::conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? null; // Recuperamos el email del formulario
    $contrasenaNueva = $_POST['contrasena'];
    $contrasenaConfirmar = $_POST['contrasena2'];

    if (!$email) {
        $_SESSION['mensaje'] = "No se ha proporcionado un correo electrónico válido.";
        $_SESSION['tipo_mensaje'] = "danger";
    } elseif ($contrasenaNueva !== $contrasenaConfirmar) {
        $_SESSION['mensaje'] = "Las nuevas contraseñas no coinciden.";
        $_SESSION['tipo_mensaje'] = "danger";
    } else {
        $nuevaSalt = utils::generar_salt(16);
        $nuevaContrasena = crypt($contrasenaNueva, '$6$rounds=5000$' . $nuevaSalt . '$');
        $resultado = $usuarioModel->cambiarContraseña($email, $nuevaContrasena, $nuevaSalt, $conexPDO);

        if ($resultado) {
            $_SESSION['mensaje'] = "La contraseña ha sido modificada correctamente.";
            $_SESSION['tipo_mensaje'] = "success";
            header("Location: ../view/loginView.php");
            exit();
        } else {
            $_SESSION['mensaje'] = "Error al modificar la contraseña.";
            $_SESSION['tipo_mensaje'] = "danger";
        }
    }
    header("Location: ../view/recuperarContraseñaView.php?email=" . urlencode($email));
    exit();
}

header("Location: ../view/recuperarContraseñaView.php");
exit();
?>
