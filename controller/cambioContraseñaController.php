<?php

namespace model;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use \model\utils;
use \model\usuario;

require_once("../model/usuarioModel.php");
require_once("../model/utils.php");

$mensaje = null;

$usuarioModel = new Usuario();
$utils = new Utils();
$conexPDO = utils::conectar();

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    // Redirigir al login si no hay ID de usuario en la sesión
    header("Location: ../view/loginView.php");
    exit();
}

// Verificar si se envió una solicitud POST para cambiar la contraseña
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recuperar los datos del formulario
    $contrasenaActual = $_POST['contrasenaActual'];
    $contrasenaNueva = $_POST['contrasenaNueva'];
    $contrasenaConfirmar = $_POST['contrasenaConfirmar'];

    // Verificar si la nueva contraseña y la confirmación coinciden
    if ($contrasenaNueva !== $contrasenaConfirmar) {
        $_SESSION['mensaje'] = "Las nuevas contraseñas no coinciden";
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: ../controller/cambioContraseñaController.php");
        exit();
    }

    // Obtener la información del usuario actual
    $usuarioActual = $usuarioModel->getUsuario($_SESSION['email'], $conexPDO);

    // Obtener la salt del usuario actual
    $salt = $usuarioActual['salt'];

    // Hashear la contraseña actual proporcionada por el usuario
    $hashContrasenaActual = crypt($contrasenaActual, '$6$rounds=5000$' . $salt . '$');

    // Comparar la contraseña actual almacenada con la proporcionada por el usuario
    if ($hashContrasenaActual !== $usuarioActual['contrasena']) {
        // La contraseña actual proporcionada no coincide con la almacenada en la base de datos
        $_SESSION['mensaje'] = "La contraseña actual es incorrecta.";
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: ../controller/cambioContraseñaController.php");
        exit();
    }

    // Generar una nueva salt y hashear la nueva contraseña
    $nuevaSalt = utils::generar_salt(16);
    $nuevaContrasena = crypt($contrasenaNueva, '$6$rounds=5000$' . $nuevaSalt . '$');

    // Cambiar la contraseña del usuario en la base de datos
    $resultado = $usuarioModel->cambiarContraseña($_SESSION['email'], $nuevaContrasena, $nuevaSalt, $conexPDO);

    if ($resultado) {
        $_SESSION['mensaje'] = "La contraseña ha sido modificada correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
        header("Location: ../controller/cambioContraseñaController.php");
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al modificar la contraseña.";
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: ../controller/cambioContraseñaController.php");
        exit();
    }
}

// Incluir la vista que presenta el formulario para cambiar la contraseña
include("../view/cambioContraseñaView.php");
?>
