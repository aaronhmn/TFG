<?php
namespace model;

use \model\utils;
use \model\Usuario;

require_once("../model/utils.php");
require_once("../model/usuarioModel.php");

session_start();
// Verifica si el usuario está logueado con un email en sesión
if (!isset($_SESSION['email'])) {
    header("Location: loginController.php");  // Redirecciona si no hay email en sesión
    exit();
}

$mensaje = null;
$conexPDO = utils::conectar();
$gestorUsu = new Usuario(); 
$correo = $_SESSION['email'];

// Obtener datos del usuario usando el correo de la sesión
$usuario = $gestorUsu->getUsuario($correo, $conexPDO);

if ($usuario) {
    $codigoActivacion = $usuario['activacion'];
    echo "<script>console.log('Código de activación: $codigoActivacion');</script>";

    // Procesar el formulario cuando se envía
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inputCodigo'])) {
        $codigoIngresado = $_POST['inputCodigo'];
        validarCodigo($codigoIngresado, $codigoActivacion, $correo, $conexPDO);
    }
} else {
    $mensaje = "Error al obtener información del usuario.";
    // Considera manejar este error de manera adecuada
}

function validarCodigo($codigoIngresado, $codigoActivacion, $correo, $conexPDO) {
    if ($codigoIngresado == $codigoActivacion) {
        // Activar el usuario si el código es correcto
        $gestorUsu = new Usuario();
        $gestorUsu->activarUsuario($correo, $conexPDO);
        header("Location: loginController.php");
        exit();
    } else {
        echo "<script>alert('Código incorrecto. Intenta de nuevo.');</script>";
    }
}

include("../view/verificarView.php");
?>