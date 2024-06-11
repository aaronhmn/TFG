<?php

use \model\Almacen;
use \model\Utils;

//Añadimos el código del modelo
require_once("../model/almacenModel.php");
require_once("../model/utils.php");
$mensaje = null;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

$gestorAlmacenes = new Almacen();

//Nos conectamos a la Bd
$conexPDO = utils::conectar();
//Recolectamos los datos de los clientes
$datosAlmacen = $gestorAlmacenes->getAlmacenes($conexPDO);

//Paginacion
$totalAlmacenes = $gestorAlmacenes->getAlmacenes($conexPDO);
$itemsPorPagina = 10;
$totalPaginas = ceil(count($totalAlmacenes) / $itemsPorPagina);
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
    $AlmacenesPaginadas = array_slice($datosAlmacen, $inicio, $itemsPorPagina);

    include("../view/almacenAdminView.php");
} catch (\Throwable $th) {
    print("Error al pintar los Datos" . $th->getMessage());
}
?>