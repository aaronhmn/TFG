<?php

namespace model;

use \model\utils;
use \model\producto;

require_once("../model/utils.php");
require_once("../model/productoModel.php");

$gestorProducto = new producto();
$conexPDO = utils::conectar();

$ordenPrecio = $_GET['ordenPrecio'] ?? 'porDefecto';
$busqueda = $_GET['busqueda'] ?? null;

// Iniciar con la obtención de todos los productos o filtrados por precio si está especificado
if ($ordenPrecio !== 'porDefecto') {
    $productos = $gestorProducto->getProductosFiltrados($conexPDO, $ordenPrecio);
} else {
    $productos = $gestorProducto->getProductos($conexPDO);
}

// Aplicar búsqueda si hay término de búsqueda especificado
if (!empty($busqueda)) {
    $productos = $gestorProducto->getProductosPorNombre($conexPDO, $busqueda);
}

// Verificar si la búsqueda o el filtro devuelve productos vacíos
$mensajeAlerta = "";
if (empty($productos)) {
    $mensajeAlerta = "No se encontraron productos que coincidan con su búsqueda o filtro.";
}

include("../view/tiendaView.php");

?>