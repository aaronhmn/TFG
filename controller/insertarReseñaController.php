<?php
namespace model;

use \model\utils;
use \model\producto;
use \model\reseña;

require_once("../model/utils.php");
require_once("../model/productoModel.php");
require_once("../model/reseñaModel.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$gestorProducto = new producto();
$gestorReseña = new reseña();
$conexPDO = utils::conectar();

// Solo procesar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $valoracion = isset($_POST['valoracion']) ? (int)$_POST['valoracion'] : null;
    $comentario = $_POST['comentario'] ?? null;
    $idProducto = $_POST['idProducto'] ?? 0;
    $usuarioId = $_SESSION['id_usuario'] ?? null;

    // Verificar si el usuario ya ha realizado una reseña para este producto
    $yaValorado = $gestorReseña->yaValorado($usuarioId, $idProducto, $conexPDO);

    if ($yaValorado) {
        echo json_encode(['success' => false, 'message' => 'Ya has realizado una reseña para este producto.']);
        exit;
    }

    // Validar los datos necesarios
    if ($valoracion === null || $comentario === null || $idProducto <= 0) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Preparar los datos de la reseña
    $reseñaData = [
        'fecha_resena' => date('Y-m-d'),
        'comentario' => $comentario,
        'valoracion' => $valoracion,
        'id_producto_resena' => $idProducto,
        'id_usuario_resena' => $usuarioId
    ];

    // Intentar añadir la reseña
    if ($gestorReseña->addReseña($reseñaData, $conexPDO)) {
        echo json_encode(['success' => true, 'message' => 'Reseña añadida con éxito']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al añadir la reseña']);
    }
} else {
    // Redireccionar si la solicitud no es POST
    header("Location: ../view/error404View.php");
    exit;
}
?>