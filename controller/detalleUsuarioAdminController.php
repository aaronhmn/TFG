<?php

namespace controller;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("../model/usuarioModel.php");
require_once("../model/utils.php");

use model\Usuario;
use model\utils;

header('Content-Type: application/json'); // Establece el MIME type a JSON

// Verificar si el usuario está logueado y tiene permisos adecuados
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    // No autorizado
    echo json_encode(['error' => 'Acceso no autorizado']);
    exit;
}

// Verificar que la solicitud sea POST y contenga el ID del usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idUsuario'])) {
    $idUsuario = $_POST['idUsuario'];

    // Conexión a la base de datos
    $conexPDO = utils::conectar();
    if (!$conexPDO) {
        echo json_encode(['error' => 'Error de conexión a la base de datos']);
        exit;
    }

    // Crear una instancia del modelo Usuario
    $gestorUsuario = new Usuario();

    // Obtener los detalles del usuario
    $usuario = $gestorUsuario->getUsuarioId($idUsuario, $conexPDO);
    
    // Verificar si se obtuvieron los datos correctamente
    if ($usuario) {
        echo json_encode($usuario);
    } else {
        echo json_encode(['error' => 'Usuario no encontrado']);
    }
} else {
    echo json_encode(['error' => 'Datos incorrectos o método de solicitud inadecuado']);
}
?>