<?php

use \model\Almacen;
use \model\Utils;

//Añadimos el código del modelo
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

$gestorAlmacenes = new Almacen();

//Nos conectamos a la Bd
$conexPDO = utils::conectar();
//Recolectamos los datos de los clientes
$datosAlmacen = $gestorAlmacenes->getAlmacenes($conexPDO);

// Paginacion
$totalAlmacenes = $gestorAlmacenes->getAlmacenes($conexPDO);
// Define la cantidad de elementos a mostrar por página
$itemsPorPagina = 10;
// Calcula el total de páginas necesarias
$totalPaginas = ceil(count($totalAlmacenes) / $itemsPorPagina);

// Verifica si se ha enviado el número de página por POST
if (isset($_POST['Pag'])) {
    // Asigna el número de página actual
    $paginaActual = $_POST['Pag'];
    // Verifica que la página actual esté dentro del rango válido
    if ($paginaActual < 1 || $paginaActual > $totalPaginas) {
        $paginaActual = 1;
    }
} else {
    // Si no se ha enviado número de página, se muestra la primera página
    $paginaActual = 1;
}
try {
    // Calcula el índice inicial para la página actual
    $inicio = ($paginaActual - 1) * $itemsPorPagina;
    // Obtiene los almacenes correspondientes a la página actual
    $AlmacenesPaginadas = array_slice($datosAlmacen, $inicio, $itemsPorPagina);

    // Incluye el archivo de vista para mostrar los almacenes
    include("../view/almacenAdminView.php");
} catch (\Throwable $th) {
    // Maneja y muestra el error si ocurre una excepción
    print("Error al pintar los Datos" . $th->getMessage());
}
