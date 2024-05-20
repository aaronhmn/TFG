<?php
namespace model;

use \model\pedido;
use \model\utils;
use \model\usuario;
/* use \model\producto; */

//Añadimos el código del modelo
require_once("../model/pedidoModel.php");
require_once("../model/usuarioModel.php");
/* require_once("../model/productoModel.php"); */
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

$gestorPedidos = new Pedido();
$gestorUsuarios = new Usuario();
/* $gestorCategorias = new Producto(); */

//Nos conectamos a la Bd
$conexPDO = utils::conectar();
//Recolectamos los datos de los productos
$datosPedido = $gestorPedidos->getPedidos($conexPDO);
$usuarios = $gestorUsuarios->getUsuarios($conexPDO);
/* $categorias = $gestorCategorias->getProductos($conexPDO); */

//Paginacion
$totalProductos = $gestorPedidos->getPedidos($conexPDO);
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
    $pedidosPaginados = array_slice($datosPedido, $inicio, $itemsPorPagina);

    include("../view/pedidoAdminView.php");
} catch (\Throwable $th) {
    print("Error al pintar los Datos" . $th->getMessage());
}
?>
