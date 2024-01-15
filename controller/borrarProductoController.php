<?php
namespace model;

use \model\productoModel;
use \model\utils;


//Añadimos el código del modelo
require_once("../model/productoModel.php");
require_once("../model/utils.php");

    //Creamos un array para guardar los datos del producto
    $producto = array();

    // Solo se ejecutará cuando reciba una petición del registro
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $idProducto = $_POST["idProducto"];

        //Nos conectamos a la Bd
        $conexPDO = utils::conectar();
        $gestorProducto = new Producto();
        $gestorProducto->delProducto($idProducto, $conexPDO);

        header("Location: ../controller/productosAdminController.php");
        exit();
    }

?>