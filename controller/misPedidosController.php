<?php

    namespace model;

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    use \model\utils;
    use \model\usuarioModel;

    //Añadimos el código del modelo
    require_once("../model/utils.php");
    require_once("../model/usuarioModel.php");
    $mensaje=null;

    include("../view/misPedidosView.php");

?>