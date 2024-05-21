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
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: ../view/loginView.php');
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
    $totalDetalles = $gestorDetallesPedido->contarDetallesPorPedido($idPedido, $conexPDO);
    $totalPaginas = ceil($totalDetalles / $itemsPorPagina);

    if ($paginaActual < 1 || $paginaActual > $totalPaginas) {
        $paginaActual = 1;
    }

    $detalles = $gestorDetallesPedido->getDetallesPedidosPag($conexPDO, $idPedido, $paginaActual, $itemsPorPagina);

    include("../view/misDetallesPedidoView.php");
} else {
    header('Location: ../view/misPedidosView.php'); // Redirigir si no hay ID de pedido
}
?>
