<?php

    namespace model;

    use \model\utils;
    use \model\productoModel;

    //Añadimos el código del modelo
    require_once("../model/utils.php");
    require_once("../model/productoModel.php");
    $mensaje=null;

    $gestorProducto = new producto();
    $conexPDO = utils::conectar();
    $productos = $gestorProducto->getProductos($conexPDO);

    include("../view/tiendaView.php");

?>