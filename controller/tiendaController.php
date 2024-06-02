<?php

namespace model;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use \model\utils;
use \model\producto;
use \model\categoria;
use \model\marca;
use \model\reseña;

require_once("../model/utils.php");
require_once("../model/productoModel.php");
require_once("../model/categoriaModel.php");
require_once("../model/marcaModel.php");
require_once("../model/reseñaModel.php");

$gestorProducto = new Producto();
$gestorCategoria = new Categoria();
$gestorMarca = new Marca();
$gestorReseña = new reseña();

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

// Añadir la media de valoraciones a cada producto
foreach ($productos as $key => $producto) {
    $idProducto = $producto['idproducto'];
    $mediaValoraciones = $gestorReseña->calcularMediaValoraciones($idProducto, $conexPDO);
    $productos[$key]['mediaValoraciones'] = round($mediaValoraciones);
    
    // Contar reseñas para el producto
    $countReseñas = $gestorReseña->contarReseñasPorProducto($idProducto, $conexPDO);
    $productos[$key]['countReseñas'] = $countReseñas;
}

// Pasar datos a la vista
include("../view/tiendaView.php");

?>
