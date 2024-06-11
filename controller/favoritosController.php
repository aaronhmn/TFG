<?php
namespace model;

use \model\utils;
use \model\usuario;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
$mensaje=null;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la BD
$conexPDO = utils::conectar();

$idUsuario = $_SESSION['id_usuario'];

$usuarioModel = new Usuario();

// Si no hay un usuario identificado, redirigir a la página de login
if (!$idUsuario) {
    header('Location: ../controller/loginController.php');
    exit();
}

// Obtener datos del usuario
$datosUsuario = $usuarioModel->getUsuarioId($idUsuario, $conexPDO);

include("../view/favoritosView.php");
?>
