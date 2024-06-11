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

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Asegúrate de que el usuario esté autorizado
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

$gestorPedidos = new pedido();
$gestorDetallesPedido = new detalle_pedido();
$usuarioModel = new usuario();
$productoModel = new producto();

// Conectamos a la BD
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

// Comprueba si se ha enviado el ID del pedido a través de la URL
if (isset($_GET['idPedido'])) {
    // Asigna el ID del pedido a una variable
    $idPedido = $_GET['idPedido'];
    // Obtiene el número total de detalles del pedido desde la base de datos
    $totalDetalles = $gestorDetallesPedido->contarDetallesPorPedido($idPedido, $conexPDO);
    // Calcula el número total de páginas necesarias
    $totalPaginas = ceil($totalDetalles / $itemsPorPagina);
    // Verifica que la página actual esté dentro del rango válido
    if ($paginaActual < 1 || $paginaActual > $totalPaginas) {
        $paginaActual = 1; // Si no está en el rango, establece la página actual a 1
    }
    // Obtiene los detalles del pedido para la página actual
    $detalles = $gestorDetallesPedido->getDetallesPedidosPag($conexPDO, $idPedido, $paginaActual, $itemsPorPagina);

    include("../view/detallePedidoAdminView.php");
} else {
    header('Location: ../view/pedidoAdminView.php'); // Redirigir si no hay ID de pedido
}
