<?php
namespace model;

use \model\utils;
use \model\productoModel;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/productoModel.php");
$mensaje=null;

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['idusuario']) || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php'); // Redirecciona a una página de error
    exit();
}

$productoId = $_POST['idProducto'];

$gestorProducto = new Producto();

//Nos conectamos a la Bd
$conexPDO = utils::conectar();
//Recolectamos los datos del usuario
$datosProducto = $gestorProducto->getProductoId($productoId, $conexPDO);


include("../view/detalleProductoAdminView.php");
?>
