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
// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

//Creamos un array para guardar los datos del usuario
$categoria = array();

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idAlmacen = $_POST["idAlmacen"];

    // Conexión a la BD
    $conexPDO = utils::conectar();
    $gestorAlmacen = new Almacen();
    $resultado = $gestorAlmacen->delAlmacen($idAlmacen, $conexPDO);

    if ($resultado === false) {
        $_SESSION['mensaje'] = "No se puede eliminar el almacén porque está asociado con uno o más productos.";
        $_SESSION['tipo_mensaje'] = "danger";
    } elseif ($resultado) {
        $_SESSION['mensaje'] = "El almacén ha sido borrado correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al borrar el almacén.";
        $_SESSION['tipo_mensaje'] = "danger";
    }
    header('Location: ../controller/almacenesAdminController.php');
    exit();
}
