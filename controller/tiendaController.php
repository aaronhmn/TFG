<?php

namespace model;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
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

// Conexión a la BD
$conexPDO = utils::conectar();

// Obtener categorías y marcas
$categorias = $gestorCategoria->getCategorias($conexPDO);
$marcas = $gestorMarca->getMarcas($conexPDO);

// Obtiene los parámetros de la URL o establece valores por defecto
$ordenPrecio = $_GET['ordenPrecio'] ?? 'porDefecto'; // Orden de precios (por defecto)
$categoria = $_GET['categoria'] ?? null; // Categoría del producto (opcional)
$marca = $_GET['marca'] ?? null; // Marca del producto (opcional)
$busqueda = $_GET['busqueda'] ?? null; // Término de búsqueda (opcional)

// Obtiene los productos filtrados basados en el orden de precios, categoría y marca
$productos = $gestorProducto->getProductosFiltrados($conexPDO, $ordenPrecio, $categoria, $marca);

// Si hay un término de búsqueda, filtra los productos por nombre
if (!empty($busqueda)) {
    $productos = $gestorProducto->getProductosPorNombre($conexPDO, $busqueda);
}
// Inicializa el mensaje de alerta vacío
$mensajeAlerta = "";
// Si no se encontraron productos, obtiene todos los productos y establece un mensaje de alerta
if (empty($productos)) {
    $productos = $gestorProducto->getProductos($conexPDO);
    $mensajeAlerta = "No se encontraron productos que coincidan con su búsqueda o filtro.";
}

// Añadir la media de valoraciones a cada producto
foreach ($productos as $key => $producto) {
    // Obtiene el ID del producto
    $idProducto = $producto['idproducto'];
    // Calcula la media de valoraciones para el producto
    $mediaValoraciones = $gestorReseña->calcularMediaValoraciones($idProducto, $conexPDO);
    // Añade la media de valoraciones al array del producto, redondeada
    $productos[$key]['mediaValoraciones'] = round($mediaValoraciones);
    // Cuenta las reseñas para el producto
    $countReseñas = $gestorReseña->contarReseñasPorProducto($idProducto, $conexPDO);
    // Añade el conteo de reseñas al array del producto
    $productos[$key]['countReseñas'] = $countReseñas;
}

// Pasar datos a la vista
include("../view/tiendaView.php");
