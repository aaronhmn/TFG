<?php

namespace model;

use \model\categoria;
use \model\utils;


//Añadimos el código del modelo
require_once("../model/categoriaModel.php");
require_once("../model/utils.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

//Creamos un array para guardar los datos del usuario
$categoria = array();

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idCategoria = $_POST["idCategoria"];

    //Nos conectamos a la Bd
    $conexPDO = utils::conectar();
    $gestorCategoria = new Categoria();
    $resultado = $gestorCategoria->delCategoria($idCategoria, $conexPDO);

    //Para verificar si todo funcionó correctamente
    if ($resultado != null) {
        $_SESSION['mensaje'] = "La categoria ha sido borrada correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ../controller/categoriasAdminController.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al borrar la categoria.";
        $_SESSION['tipo_mensaje'] = "danger";
        // Si decides redireccionar de todos modos o manejar de otra forma
        header('Location: ../controller/categoriasAdminController.php');
        exit();
    }
}
