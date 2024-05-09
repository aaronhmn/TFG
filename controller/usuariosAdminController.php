<?php

use \model\Usuario;
use \model\Utils;

//Añadimos el código del modelo
require_once("../model/usuarioModel.php");
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

$gestorUsuarios = new Usuario();

//Nos conectamos a la Bd
$conexPDO = utils::conectar();
//Recolectamos los datos de los clientes
$datosUsuario = $gestorUsuarios->getUsuarios($conexPDO);

//Paginacion
$totalUsuarios = $gestorUsuarios->getUsuarios($conexPDO);
$itemsPorPagina = 10;
$totalPaginas = ceil(count($totalUsuarios) / $itemsPorPagina);
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
    $usuariosPaginados = array_slice($datosUsuario, $inicio, $itemsPorPagina);

    include("../view/usuarioAdminView.php");
} catch (\Throwable $th) {
    print("Error al pintar los Datos" . $th->getMessage());
}
?>