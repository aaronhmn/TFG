<?php

namespace model;

use \model\producto;
use \model\utils;
use \model\marca;
use \model\categoria;
use \model\almacen;

require_once("../model/productoModel.php");
require_once("../model/marcaModel.php");
require_once("../model/categoriaModel.php");
require_once("../model/almacenModel.php");
require_once("../model/utils.php");
$mensaje = null;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

// Truncar el texto para diseño
function truncarTexto($texto, $maxCaracteres)
{
    if (strlen($texto) > $maxCaracteres) {
        $texto = substr($texto, 0, $maxCaracteres) . '...';
    }
    return $texto;
}

$gestorProductos = new Producto();
$gestorMarcas = new Marca();
$gestorCategorias = new Categoria();
$gestorAlmacenes = new Almacen();

//Nos conectamos a la Bd
$conexPDO = utils::conectar();
//Recolectamos los datos de los productos
$datosProducto = $gestorProductos->getProductos($conexPDO);
$marcas = $gestorMarcas->getMarcas($conexPDO);
$categorias = $gestorCategorias->getCategorias($conexPDO);
$almacenes = $gestorAlmacenes->getAlmacenes($conexPDO);

// Paginación
$totalProductos = $gestorProductos->getProductos($conexPDO);
// Define la cantidad de elementos a mostrar por página
$itemsPorPagina = 10;
// Calcula el total de páginas necesarias
$totalPaginas = ceil(count($totalProductos) / $itemsPorPagina);

// Verifica si se ha enviado el número de página por POST
if (isset($_POST['Pag'])) {
    // Asigna el número de página actual desde el valor enviado por POST
    $paginaActual = $_POST['Pag'];
    // Verifica que la página actual esté dentro del rango válido
    if ($paginaActual < 1 || $paginaActual > $totalPaginas) {
        $paginaActual = 1; // Si no está en el rango, establece la página actual a 1
    }
} else {
    // Si no se ha enviado número de página, se muestra la primera página
    $paginaActual = 1;
}
try {
    // Calcula el índice inicial para la página actual
    $inicio = ($paginaActual - 1) * $itemsPorPagina;
    // Obtiene los productos correspondientes a la página actual
    $productosPaginados = array_slice($datosProducto, $inicio, $itemsPorPagina);

    // Incluye el archivo de vista para mostrar los productos
    include("../view/productoAdminView.php");
} catch (\Throwable $th) {
    // Maneja y muestra el error si ocurre una excepción
    print("Error al pintar los Datos" . $th->getMessage());
}
