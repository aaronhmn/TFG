<?php

namespace model;

use \model\utils;
use \model\producto;
use \model\reseña;
use \model\detalle_pedido;

require_once("../model/utils.php");
require_once("../model/productoModel.php");
require_once("../model/reseñaModel.php");
require_once("../model/detallePedidoModel.php");
$mensaje = null;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$gestorProducto = new producto();
$gestorReseña = new reseña();
$detallePedidoModel = new detalle_pedido();
// Conexión a la BD
$conexPDO = utils::conectar();

// Número de reseñas por página
$reseñasPorPagina = 6;

// Verificamos que el ID del producto está presente y es válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $idUsuario = $_SESSION['id_usuario'] ?? null;
    $productos = $gestorProducto->getProductoId($id, $conexPDO);

    if (!$productos) {
        header("HTTP/1.0 404 Not Found");
        $mensaje = "No se encontró el producto.";
        include("../view/error404View.php");
        exit;
    }

    $haComprado = $detallePedidoModel->usuarioHaCompradoProducto($conexPDO, $idUsuario, $id);

    // Pasar esta información a la vista
    $productos['haComprado'] = $haComprado;
    // Calcular la media de valoraciones para el diseño
    $mediaValoraciones = $gestorReseña->calcularMediaValoraciones($id, $conexPDO);

    // Obtener el número de página actual o predeterminar a 1 si no se proporciona ninguna
    $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $inicio = ($paginaActual - 1) * $reseñasPorPagina;

    // Obtener reseñas con paginación
    $reseñas = $gestorReseña->getReseñasPorProductoIdPaginado($id, $conexPDO, $inicio, $reseñasPorPagina);

    // Contar el total de reseñas para calcular el total de páginas
    $totalReseñas = $gestorReseña->contarReseñasPorProducto($id, $conexPDO);
    $totalPaginas = ceil($totalReseñas / $reseñasPorPagina);

    // Pasar datos de paginación a la vista
    $datosPaginacion = [
        'paginaActual' => $paginaActual,
        'totalPaginas' => $totalPaginas,
        'totalReseñas' => $totalReseñas
    ];

    // Incluir la vista
    include("../view/productoView.php");
} else {
    $mensaje = "ID de producto no especificado o inválido.";
    include("../view/error404View.php");
}
