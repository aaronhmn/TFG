<?php

namespace controller;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
require_once("../model/productoModel.php");

use \model\utils;
use model\Usuario;
use model\Producto;

// Inicializar la conexión a la base de datos
$conexPDO = utils::conectar();

// Obtener el ID del usuario desde la sesión
$idUsuario = $_SESSION['id_usuario'];

$usuarioModel = new Usuario();
$productoModel = new Producto();

// Si no hay un usuario identificado, redirigir a la página de login
if (!$idUsuario) {
    header('Location: ../controller/loginController.php'); // Asegúrate de que esta ruta sea correcta
    exit();
}

// Obtener datos del usuario
$datosUsuario = $usuarioModel->getUsuarioId($idUsuario, $conexPDO);

// Incluir la vista, pasando los datos del modelo
include("../view/pedidoView.php");
