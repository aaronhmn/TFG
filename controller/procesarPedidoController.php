<?php

namespace controller;

// Desactivar la visualización de errores en la salida HTML
ini_set('display_errors', 0);
error_reporting(0);

require_once("../model/utils.php");
require_once("../model/pedidoModel.php");
require_once("../model/detallePedidoModel.php");
require_once("../model/productoModel.php");

use \model\utils;
use model\pedido;
use model\detalle_pedido;
use model\producto;
use model\usuario;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica que la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos enviados en la solicitud HTTP
    $datos = json_decode(file_get_contents('php://input'), true);

    if (isset($_SESSION['id_usuario']) && !empty($datos)) {
        $idUsuario = $_SESSION['id_usuario'];
        $pedidoModel = new pedido();
        $detallePedidoModel = new detalle_pedido();
        $productoModel = new producto();

        // Conexión a la BD
        $conexPDO = utils::conectar();

        // Inserta el pedido
        // Calcula el total sumando los precios multiplicados por las cantidades
        $total = array_sum(array_map(function ($item) {
            // Multiplica el precio por la cantidad para cada elemento
            return $item['precio'] * $item['cantidad'];
        }, $datos));


        $idPedido = $pedidoModel->addPedido($conexPDO, $idUsuario, $total);

        if ($idPedido) {
            // Inserta los detalles del pedido
            foreach ($datos as $item) {
                $idProducto = $item['id_producto_dp'];
                $cantidad = $item['cantidad'];
                $precio = $item['precio'];
                $precioSubtotal = $cantidad * $precio;
                $resultado = $detallePedidoModel->addDetallePedido($conexPDO, $idPedido, $idProducto, $cantidad, $precio, $precioSubtotal);
                if (!$resultado) {
                    echo json_encode(['success' => false, 'message' => 'Error al insertar detalle de pedido']);
                    exit;
                }

                // Actualizar el stock del producto
                $resultadoStock = $productoModel->updateStock($idProducto, $cantidad, $conexPDO);
                if (!$resultadoStock) {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar el stock del producto']);
                    exit;
                }
            }
            echo json_encode(['success' => true, 'message' => 'Pedido realizado con éxito']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al realizar el pedido']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No hay datos de carrito o usuario no identificado']);
    }
}
