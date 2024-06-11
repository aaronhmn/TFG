<?php

namespace model;

use \model\utils;
use \model\producto;
use \model\reseña;

require_once("../model/utils.php");
require_once("../model/productoModel.php");
require_once("../model/reseñaModel.php");

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$gestorProducto = new producto();
$gestorReseña = new reseña();
// Conexión a la BD
$conexPDO = utils::conectar();

// Solo procesar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $valoracion = isset($_POST['valoracion']) ? (int)$_POST['valoracion'] : null; // Obtiene y convierte la valoración a entero
    $comentario = $_POST['comentario'] ?? null; // Obtiene el comentario, o null si no está definido
    $idProducto = $_POST['idProducto'] ?? 0; // Obtiene el ID del producto, o 0 si no está definido
    $usuarioId = $_SESSION['id_usuario'] ?? null; // Obtiene el ID del usuario de la sesión, o null si no está definido

    // Verificar si el usuario ya ha realizado una reseña para este producto
    $yaValorado = $gestorReseña->yaValorado($usuarioId, $idProducto, $conexPDO);
    if ($yaValorado) {
        // Si el usuario ya ha realizado una reseña, devuelve un mensaje de error en formato JSON
        echo json_encode(['success' => false, 'message' => 'Ya has realizado una reseña para este producto.']);
        exit; // Termina la ejecución del script
    }

    // Validar los datos necesarios
    if ($valoracion === null || $comentario === null || $idProducto <= 0) {
        // Si falta alguno de los datos requeridos, devuelve un mensaje de error en formato JSON
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit; // Termina la ejecución del script
    }

    // Preparar los datos de la reseña
    $reseñaData = [
        'fecha_resena' => date('Y-m-d'), // Establece la fecha actual
        'comentario' => $comentario, // Comentario del usuario
        'valoracion' => $valoracion, // Valoración del usuario
        'id_producto_resena' => $idProducto, // ID del producto
        'id_usuario_resena' => $usuarioId // ID del usuario
    ];

    // Intentar añadir la reseña
    if ($gestorReseña->addReseña($reseñaData, $conexPDO)) {
        // Si la reseña se añade con éxito, devuelve un mensaje de éxito en formato JSON
        echo json_encode(['success' => true, 'message' => 'Reseña añadida con éxito']);
    } else {
        // Si hay un error al añadir la reseña, devuelve un mensaje de error en formato JSON
        echo json_encode(['success' => false, 'message' => 'Error al añadir la reseña']);
    }
} else {
    // Redireccionar si la solicitud no es POST
    header("Location: ../view/error404View.php");
    exit;
}
