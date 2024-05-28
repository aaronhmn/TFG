<?php

namespace model;

use \model\utils;
use \model\usuario;

// Cargar los modelos necesarios
require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
$mensaje = null;

if (!empty($_GET['busqueda'])) {
    // Limpiar el término de búsqueda para eliminar espacios en blanco al inicio y al final
    $busquedaLimpia = trim($_GET['busqueda']);

    // Verificar el resultado de la limpieza
    error_log("Búsqueda limpia: " . $busquedaLimpia); // Esta línea ayudará a ver en los logs qué está recibiendo exactamente

    $urlActual = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (strpos($urlActual, 'tiendaController.php') === false) {
        header('Location: ../controller/tiendaController.php?busqueda=' . urlencode($busquedaLimpia));
        exit;
    }
}

include("../view/components/navbarView.php");

?>
