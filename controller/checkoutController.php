<?php
namespace model;

use \model\utils;
use \model\productoModel;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/productoModel.php");
$mensaje=null;

$productoId = $_POST['idProducto'];

$gestorProducto = new Producto();

//Nos conectamos a la Bd
$conexPDO = utils::conectar();
//Recolectamos los datos del usuario
$datosProducto = $gestorProducto->getProductoId($productoId, $conexPDO);


include("../view/checkoutView.php");
?>
