<?php

    namespace model;

    use \model\utils;
    use \model\usuarioModel;

    //Añadimos el código del modelo
    require_once("../model/utils.php");
    require_once("../model/usuarioModel.php");
    $mensaje=null;

    if (!empty($_GET['busqueda'])) {
        $urlActual = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (strpos($urlActual, 'tiendaController.php') === false) {  // Solo redirigir si no estamos ya en tiendaController.php
            header('Location: ../controller/tiendaController.php?busqueda=' . urlencode($_GET['busqueda']));
            exit;
        }
    }

    include("../view/components/navbarView.php");

?>