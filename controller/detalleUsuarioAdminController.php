<?php

namespace controller;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("../model/usuarioModel.php");
require_once("../model/utils.php");

use model\Usuario;
use model\utils;

header('Content-Type: application/json'); // Establece el tipo de contenido de la respuesta HTTP como JSON

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

    // Verifica si no hay conexión a la base de datos
    if (!$conexPDO) {
        // Si no hay conexión, devuelve un mensaje de error en formato JSON
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
