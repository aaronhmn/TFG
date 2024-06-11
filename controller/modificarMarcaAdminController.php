<?php

namespace model;

use \model\marca;
use \model\utils;


//Añadimos el código del modelo
require_once("../model/marcaModel.php");
require_once("../model/utils.php");

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el categoria está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

//Creamos un array para guardar los datos del categoria
$marca = array();

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $marca["idmarca"] = $_GET["idMarca"];
    $marca["nombre_marca"] = $_GET["nombre_marca"];
}

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marca["idmarca"] = $_POST["idMarca"];
    $marca["nombre_marca"] = $_POST["nombre_marca"];

    //Nos conectamos a la Bd
    $conexPDO = utils::conectar();
    $gestormarca = new Marca();

    // Exclusión del usuario actual en las comprobaciones
    if ($gestormarca->existeNombreM($marca["nombre_marca"], $marca["idmarca"], $conexPDO)) {
        $_SESSION['mensaje'] = 'Este nombre ya está en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/marcasAdminController.php");
        exit();
    }

    $resultado = $gestormarca->updateMarca($marca, $conexPDO);

    //Para verificar si todo funcionó correctamente manejos de errores y mensajes para accesibilidad con bootstrap
    if ($resultado != null) {
        $_SESSION['mensaje'] = "La marca ha sido modificada correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ../controller/marcasAdminController.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al modificar la categoría.";
        $_SESSION['tipo_mensaje'] = "danger";
        // Si decides redireccionar de todos modos o manejar de otra forma
        header('Location: ../controller/marcasAdminController.php');
        exit();
    }
}
