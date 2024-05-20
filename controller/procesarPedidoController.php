<?php

namespace controller;

// Desactivar la visualización de errores en la salida HTML
ini_set('display_errors', 0);
error_reporting(0);

require_once("../model/utils.php");
require_once("../model/pedidoModel.php");
require_once("../model/detallePedidoModel.php");

use \model\utils;
use model\pedido;
use model\detalle_pedido;

session_start();

// Verifica que la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = json_decode(file_get_contents('php://input'), true);

    if (isset($_SESSION['id_usuario']) && !empty($datos)) {
        $idUsuario = $_SESSION['id_usuario'];
        $pedidoModel = new pedido();
        $detallePedidoModel = new detalle_pedido();

        // Conexión a la base de datos
        $conexPDO = utils::conectar();

        // Inserta el pedido
        $total = array_sum(array_map(function($item) {
            return $item['precio'] * $item['cantidad'];
        }, $datos));

        $idPedido = $pedidoModel->addPedido($conexPDO, $idUsuario, $total);

        if ($idPedido) {
            // Inserta los detalles del pedido
            foreach ($datos as $item) {
                $detallePedidoModel->addDetallePedido($conexPDO, $idPedido, $idProducto, $cantidad, $precio, $precioSubtotal);
            }
            echo json_encode(['success' => true, 'message' => 'Pedido realizado con éxito']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al realizar el pedido']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No hay datos de carrito o usuario no identificado']);
    }
}
?>
