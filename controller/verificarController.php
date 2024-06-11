<?php

namespace model;

use \model\utils;
use \model\Usuario;

require_once("../model/utils.php");
require_once("../model/usuarioModel.php");

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header("Location: loginController.php");
    exit();
}

// Conexión a la BD
$conexPDO = utils::conectar();
$gestorUsu = new Usuario();
// Obtiene el correo electrónico del usuario desde la sesión
$correo = $_SESSION['email'];
// Obtiene la información del usuario desde la base de datos
$usuario = $gestorUsu->getUsuario($correo, $conexPDO);

if ($usuario) {
    // Si el usuario existe, obtiene el código de activación del usuario
    $codigoActivacion = $usuario['activacion'];
    // Comprueba si la solicitud es POST y si se ha enviado el código de activación
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inputCodigo'])) {
        // Obtiene el código ingresado por el usuario
        $codigoIngresado = $_POST['inputCodigo'];
        // Llama a la función para validar el código de activación
        validarCodigo($codigoIngresado, $codigoActivacion, $correo, $conexPDO);
    }
} else {
    // Si no se pudo obtener la información del usuario, establece un mensaje de error en la sesión
    $_SESSION['error'] = "Error al obtener información del usuario.";
}

// Función para validar el código de activación
function validarCodigo($codigoIngresado, $codigoActivacion, $correo, $conexPDO)
{
    // Comprueba si el código ingresado coincide con el código de activación
    if ($codigoIngresado == $codigoActivacion) {
        // Si los códigos coinciden, crea una nueva instancia del gestor de usuarios
        $gestorUsu = new Usuario();
        // Activa el usuario en la base de datos
        $gestorUsu->activarUsuario($correo, $conexPDO);
        // Redirige al usuario al controlador de login
        header("Location: loginController.php");
        exit();
    } else {
        // Si los códigos no coinciden, establece un mensaje de error en la sesión
        $_SESSION['error'] = "Código incorrecto. Intenta de nuevo.";
    }
}

include("../view/verificarView.php");
