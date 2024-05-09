<?php
namespace model;

use \model\utils;
use \model\carrito;
use \model\productoModel;
use \model\usuarioModel;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/carritoModel.php");
require_once("../model/productoModel.php");
require_once("../model/usuarioModel.php");
$mensaje=null;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$idUsuario = $_SESSION['id_usuario'] ?? null;

// Si no hay un usuario identificado, redirigir a la página de login
if (!$idUsuario) {
    header('Location: ../controller/loginController.php'); // Asegúrate de que esta ruta sea correcta
    exit();
}

include("../view/carritoView.php");
?>
