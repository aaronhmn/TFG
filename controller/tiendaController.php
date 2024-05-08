<?php

namespace model;

use \model\utils;
use \model\producto;

require_once("../model/utils.php");
require_once("../model/productoModel.php");

$gestorProducto = new producto();
$conexPDO = utils::conectar();

$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : null;
$productos = $busqueda ? $gestorProducto->getProductosPorNombre($conexPDO, $busqueda) : $gestorProducto->getProductos($conexPDO);

$mensajeAlerta = "";
if (empty($productos) && $busqueda) {
    $productos = $gestorProducto->getProductos($conexPDO); // Cargar todos los productos si la búsqueda no encuentra nada
    $mensajeAlerta = "No se encontraron productos que coincidan con su búsqueda.";
}

include("../view/tiendaView.php");

?>
