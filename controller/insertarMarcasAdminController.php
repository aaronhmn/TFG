<?php

namespace model;

use \model\utils;
use \model\marca;

require_once("../model/utils.php");
require_once("../model/marcaModel.php");
$mensaje = null;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['inputNombre'];

    $datosMarca = array();
    $datosMarca["nombre_marca"] = utils::limpiar_datos($nombre);

    $gestorMarca = new Marca();

    // Conexión a la BD
    $conexPDO = utils::conectar();

    // Verificar si el nombre ya existe
    if ($gestorMarca->existeNombre($nombre, $conexPDO)) {
        $_SESSION['mensaje'] = 'Este nombre ya esta en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/marcasAdminController.php");
        exit();
    }

    $resultado = $gestorMarca->addMarca($datosMarca, $conexPDO);

    //Para verificar si todo funcionó correctamente y mensajes para accesibilidad con bootstrap
    if ($resultado != null) {
        $_SESSION['mensaje'] = "La marca ha sido creada correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ../controller/marcasAdminController.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al crear la marca.";
        $_SESSION['tipo_mensaje'] = "danger";
        header('Location: ../controller/marcasAdminController.php');
        exit();
    }
}
