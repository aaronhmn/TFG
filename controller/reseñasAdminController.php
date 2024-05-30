<?php
namespace model;

use \model\reseña;
use \model\utils;
use \model\usuario;
use \model\producto;

//Añadimos el código del modelo
require_once("../model/reseñaModel.php");
require_once("../model/usuarioModel.php");
require_once("../model/productoModel.php");
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

$gestorReseñas = new Reseña();
$gestorUsuarios = new Usuario();
$gestorProductos = new Producto();

//Nos conectamos a la Bd
$conexPDO = utils::conectar();
//Recolectamos los datos de los productos
$datosReseña = $gestorReseñas->getReseñas($conexPDO);
$usuarios = $gestorUsuarios->getUsuarios($conexPDO);
$productos = $gestorProductos->getProductos($conexPDO);

//Paginacion
$totalProductos = $gestorReseñas->getReseñas($conexPDO);
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
    $reseñasPaginados = array_slice($datosReseña, $inicio, $itemsPorPagina);

    include("../view/reseñaAdminView.php");
} catch (\Throwable $th) {
    print("Error al pintar los Datos" . $th->getMessage());
}
?>
