<?php

use \model\Marca;
use \model\Utils;

require_once("../model/marcaModel.php");
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

$gestorMarcas = new Marca();

//Nos conectamos a la Bd
$conexPDO = utils::conectar();
//Recolectamos los datos de los clientes
$datosMarca = $gestorMarcas->getMarcas($conexPDO);

// Paginación
$totalMarcas = $gestorMarcas->getMarcas($conexPDO);
$itemsPorPagina = 10; // Número de elementos a mostrar por página
// Calcula el número total de páginas
$totalPaginas = ceil(count($totalMarcas) / $itemsPorPagina);

// Verifica si se ha enviado el número de página a través de un formulario POST
if (isset($_POST['Pag'])) {
    $paginaActual = $_POST['Pag']; // Asigna la página actual enviada
    // Verifica que la página actual esté dentro del rango válido
    if ($paginaActual < 1 || $paginaActual > $totalPaginas) {
        $paginaActual = 1; // Si no está en el rango válido, establece la página actual a 1
    }
} else {
    $paginaActual = 1; // Si no se ha enviado el número de página, establece la página actual a 1
}
try {
    // Calcula el índice inicial para la paginación
    $inicio = ($paginaActual - 1) * $itemsPorPagina;
    // Obtiene las marcas para la página actual utilizando array_slice
    $marcasPaginadas = array_slice($datosMarca, $inicio, $itemsPorPagina);

    // Incluye la vista para mostrar las marcas paginadas
    include("../view/marcaAdminView.php");
} catch (\Throwable $th) {
    // Muestra un mensaje de error si ocurre alguna excepción
    print("Error al pintar los Datos" . $th->getMessage());
}
