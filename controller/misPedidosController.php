<?php

namespace model;

require_once("../model/pedidoModel.php");
require_once("../model/utils.php");

use \model\pedido;
use \model\utils;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Asegúrate de que el usuario esté autorizado
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: ../view/loginView.php');
    exit();
}

$usuarioId = $_SESSION['id_usuario']; // Obtener el ID del usuario de la sesión
$conexPDO = utils::conectar(); // Asegúrate de que esto conecta correctamente a la base de datos

$gestorPedidos = new pedido();
$pedidos = $gestorPedidos->getPedidosPorUsuario($usuarioId, $conexPDO);

$paginaActual = $_GET['page'] ?? 1; // Recupera la página actual o establece la primera página como predeterminada
$registrosPorPagina = 10;  // Número de registros por página

$totalPedidos = $gestorPedidos->contarPedidosPorUsuario($usuarioId, $conexPDO); 
// Calcula el número total de páginas necesarias para mostrar todos los registros
$totalPaginas = ceil($totalPedidos / $registrosPorPagina);

$pedidos = $gestorPedidos->getPedidosPorUsuario($usuarioId, $conexPDO, $paginaActual, $registrosPorPagina);

include("../view/misPedidosView.php");



