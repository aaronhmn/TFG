<?php

use \model\Marca;
use \model\Utils;

//Añadimos el código del modelo
require_once("../model/marcaModel.php");
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

$gestorMarcas = new Marca();

//Nos conectamos a la Bd
$conexPDO = utils::conectar();
//Recolectamos los datos de los clientes
$datosMarca = $gestorMarcas->getMarcas($conexPDO);

//Paginacion
$totalMarcas = $gestorMarcas->getMarcas($conexPDO);
$itemsPorPagina = 10;
$totalPaginas = ceil(count($totalMarcas) / $itemsPorPagina);
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
    $marcasPaginadas = array_slice($datosMarca, $inicio, $itemsPorPagina);

    include("../view/marcaAdminView.php");
} catch (\Throwable $th) {
    print("Error al pintar los Datos" . $th->getMessage());
}
?>