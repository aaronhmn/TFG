<?php

require_once("../model/pedidoModel.php");
require_once("../model/detallePedidoModel.php");
require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
require_once("../model/productoModel.php");

use model\pedido;
use model\detalle_pedido;
use model\usuario;
use model\producto;
use model\utils;

session_start();

// Asegúrate de que el usuario esté autorizado
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

$gestorPedidos = new pedido();
$gestorDetallesPedido = new detalle_pedido();
$usuarioModel = new usuario();
$productoModel = new producto();

$conexPDO = utils::conectar();

$productos = $productoModel->getProductos($conexPDO);

// Inicializa variables para la paginación
$itemsPorPagina = 10;
$paginaActual = $_GET['Pag'] ?? 1;  // Usa el operador de fusión de null para tomar el valor de $_GET o 1 como predeterminado
$totalDetalles = count($gestorDetallesPedido->getDetallesPedidos($conexPDO));  // Este método debería contar todos los detalles, no cargarlos todos en memoria
$totalPaginas = ceil($totalDetalles / $itemsPorPagina);

if ($paginaActual < 1 || $paginaActual > $totalPaginas) {
    $paginaActual = 1;  // Asegura que la página actual sea válida
}

// Calcula el offset basado en la página actual
$offset = ($paginaActual - 1) * $itemsPorPagina;

if (isset($_GET['idPedido'])) {
    $idPedido = $_GET['idPedido'];
    $pedido = $gestorPedidos->getPedidoId($idPedido, $conexPDO);

    if (!$pedido) {
        echo "Pedido no encontrado.";
        exit;
    } else {
        // Recuperar detalles del pedido
        $detallesPedido = $gestorDetallesPedido->getDetallesPedidosPag($conexPDO, $idPedido, true, 'id_producto_dp', $paginaActual, $itemsPorPagina);
        if ($detallesPedido) {
            $detalles = $detallesPedido;
        } else {
            $detalles = []; // Asegurarse de que $detalles es siempre un array
        }
        include("../view/detallePedidoAdminView.php");
    }
} else {
    header('Location: ../view/pedidoAdminView.php'); // Redirigir si no hay ID de pedido
}
?>
