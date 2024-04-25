<?php

namespace model;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use \model\utils;
use \model\usuario;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
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

?>