<?php

namespace model;

use \model\almacen;
use \model\utils;


//Añadimos el código del modelo
require_once("../model/almacenModel.php");
require_once("../model/utils.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el categoria está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

//Creamos un array para guardar los datos del categoria
$almacen = array();

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $almacen["idalmacen"] = $_GET["idAlmacen"];
    $almacen["nombre"] = $_GET["nombre"];
    $almacen["telefono"] = $_GET["telefono"];
    $almacen["codigo_postal"] = $_GET["codigo_postal"];
    $almacen["calle"] = $_GET["calle"];
    $almacen["numero_bloque"] = $_GET["numero_bloque"];
    $almacen["piso"] = $_GET["piso"];
}

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $almacen["idalmacen"] = $_POST["idAlmacen"];
    $almacen["nombre"] = $_POST["nombre"];
    $almacen["telefono"] = $_POST["telefono"];
    $almacen["codigo_postal"] = $_POST["codigo_postal"];
    $almacen["calle"] = $_POST["calle"];
    $almacen["numero_bloque"] = $_POST["numero_bloque"];
    $almacen["piso"] = $_POST["piso"];

    //Nos conectamos a la Bd
    $conexPDO = utils::conectar();
    $gestorAlmacen = new Almacen();

    // Exclusión del usuario actual en las comprobaciones
    if ($gestorAlmacen->existeNombreAlmacenM($almacen["nombre"], $almacen["idalmacen"], $conexPDO)) {
        $_SESSION['mensaje'] = 'Este nombre ya está en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/almacenesAdminController.php");
        exit();
    }

    if ($gestorAlmacen->existeTelefonoM($almacen["telefono"], $almacen["idalmacen"], $conexPDO)) {
        $_SESSION['mensaje'] = 'Este telefono ya está en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/almacenesAdminController.php");
        exit();
    }

    $resultado = $gestorAlmacen->updateAlmacen($almacen, $conexPDO);

    //Para verificar si todo funcionó correctamente
    if ($resultado != null) {
        $_SESSION['mensaje'] = "El almacén ha sido modificada correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ../controller/almacenesAdminController.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al modificar el almacén.";
        $_SESSION['tipo_mensaje'] = "danger";
        // Si decides redireccionar de todos modos o manejar de otra forma
        header('Location: ../controller/almacenesAdminController.php');
        exit();
    }
}
