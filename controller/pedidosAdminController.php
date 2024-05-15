<?php
namespace model;

use \model\producto;
use \model\utils;
use \model\marca;
use \model\categoria;

//Añadimos el código del modelo
require_once("../model/productoModel.php");
require_once("../model/marcaModel.php");
require_once("../model/categoriaModel.php");
require_once("../model/utils.php");
$mensaje=null;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

function truncarTexto($texto, $maxCaracteres) {
    if (strlen($texto) > $maxCaracteres) {
        $texto = substr($texto, 0, $maxCaracteres) . '...';
    }
    return $texto;
}

$gestorProductos = new Producto();
$gestorMarcas = new Marca();
$gestorCategorias = new Categoria();

//Nos conectamos a la Bd
$conexPDO = utils::conectar();
//Recolectamos los datos de los productos
$datosProducto = $gestorProductos->getProductos($conexPDO);
$marcas = $gestorMarcas->getMarcas($conexPDO);
$categorias = $gestorCategorias->getCategorias($conexPDO);

//Paginacion
$totalProductos = $gestorProductos->getProductos($conexPDO);
$itemsPorPagina = 10;
$totalPaginas = ceil(count($totalProductos) / $itemsPorPagina);
if (isset($_POST['Pag'])) {
    $paginaActual = $_POST['Pag'];
    if ($paginaActual < 1 || $paginaActual > $totalPaginas) {
        $paginaActual = 1;
    }
} else {
    $paginaActual = 1;
}

try {
    $inicio = ($paginaActual - 1) * $itemsPorPagina;
    $productosPaginados = array_slice($datosProducto, $inicio, $itemsPorPagina);

    include("../view/pedidoAdminView.php");
} catch (\Throwable $th) {
    print("Error al pintar los Datos" . $th->getMessage());
}
?>