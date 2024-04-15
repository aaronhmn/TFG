<?php
namespace model;

use \model\productoModel;
use \model\utils;

//Añadimos el código del modelo
require_once("../model/productoModel.php");
require_once("../model/utils.php");
$mensaje=null;

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['idusuario']) || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php'); // Redirecciona a una página de error
    exit();
}

$gestorProductos = new Producto();

//Nos conectamos a la Bd
$conexPDO = utils::conectar();
//Recolectamos los datos de los productos
$datosProducto = $gestorProductos->getProductos($conexPDO);

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

    include("../view/productoAdminView.php");
} catch (\Throwable $th) {
    print("Error al pintar los Datos" . $th->getMessage());
}
?>