<?php
namespace model;

use \model\utils;
use \model\productoModel;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/productoModel.php");
$mensaje = null;

$gestorProducto = new producto(); // Asegúrate de que el nombre de la clase es correcto
$conexPDO = utils::conectar();

// Verificamos que el ID del producto está presente y es válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $productos = $gestorProducto->getProductoId($id, $conexPDO);

    if (!$productos) {
        header("HTTP/1.0 404 Not Found");
        $mensaje = "No se encontró el producto.";
        include("../view/error404View.php");
        exit;
    }
} else {
    $mensaje = "ID de producto no especificado o inválido.";
    include("../view/error404View.php"); 
}

include("../view/productoView.php");
?>
