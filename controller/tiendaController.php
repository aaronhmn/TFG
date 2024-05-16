<?php

namespace model;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("../model/utils.php");
require_once("../model/productoModel.php");
require_once("../model/categoriaModel.php");
require_once("../model/marcaModel.php");

$gestorProducto = new Producto();
$gestorCategoria = new Categoria();
$gestorMarca = new Marca();

$conexPDO = utils::conectar();

// Obtener categorías y marcas
$categorias = $gestorCategoria->getCategorias($conexPDO);
$marcas = $gestorMarca->getMarcas($conexPDO);         // Asegúrate de que esta función exista y funcione correctamente

$ordenPrecio = $_GET['ordenPrecio'] ?? 'porDefecto';
$categoria = $_GET['categoria'] ?? null;
$marca = $_GET['marca'] ?? null;
$busqueda = $_GET['busqueda'] ?? null;

$productos = $gestorProducto->getProductosFiltrados($conexPDO, $ordenPrecio, $categoria, $marca);

if (!empty($busqueda)) {
    $productos = $gestorProducto->getProductosPorNombre($conexPDO, $busqueda);
}

$mensajeAlerta = "";
if (empty($productos)) {
    $productos = $gestorProducto->getProductos($conexPDO);
    $mensajeAlerta = "No se encontraron productos que coincidan con su búsqueda o filtro.";
}

// Pasar datos a la vista
include("../view/tiendaView.php");

?>
