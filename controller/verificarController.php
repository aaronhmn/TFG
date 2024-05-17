<?php

namespace model;

use \model\utils;
use \model\Usuario;

require_once("../model/utils.php");
require_once("../model/usuarioModel.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header("Location: loginController.php");
    exit();
}

$conexPDO = utils::conectar();
$gestorUsu = new Usuario();
$correo = $_SESSION['email'];
$usuario = $gestorUsu->getUsuario($correo, $conexPDO);

if ($usuario) {
    $codigoActivacion = $usuario['activacion'];
    echo "<script>console.log('Código de activación: $codigoActivacion');</script>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inputCodigo'])) {
        $codigoIngresado = $_POST['inputCodigo'];
        validarCodigo($codigoIngresado, $codigoActivacion, $correo, $conexPDO);
    }
} else {
    $_SESSION['error'] = "Error al obtener información del usuario.";
}

function validarCodigo($codigoIngresado, $codigoActivacion, $correo, $conexPDO)
{
    if ($codigoIngresado == $codigoActivacion) {
        $gestorUsu = new Usuario();
        $gestorUsu->activarUsuario($correo, $conexPDO);
        header("Location: loginController.php");
        exit();
    } else {
        $_SESSION['error'] = "Código incorrecto. Intenta de nuevo.";
    }
}

include("../view/verificarView.php");
