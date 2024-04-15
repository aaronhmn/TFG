<?php

    namespace model;

    use \model\utils;
    use \model\usuarioModel;

    //Añadimos el código del modelo
    require_once("../model/utils.php");
    require_once("../model/usuarioModel.php");
    $mensaje=null;

    session_start();

    // Verificar si el usuario está logueado y si es administrador
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
        header('Location: ../view/noAutorizadoView.php');
        exit();
    }

    include("../view/inicioAdminView.php");

?>