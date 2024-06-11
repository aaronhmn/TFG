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
// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

//Creamos un array para guardar los datos del usuario
$categoria = array();

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idMarca = $_POST["idMarca"];

    // Conexión a la BD
    $conexPDO = utils::conectar();
    $gestorMarca = new Marca();
    $resultado = $gestorMarca->delMarca($idMarca, $conexPDO);

    // Control de errores y mensajes de accesibilidad con bootstrap
    if ($resultado === false) {
        $_SESSION['mensaje'] = "No se puede eliminar la marca porque está asociada con uno o más productos.";
        $_SESSION['tipo_mensaje'] = "danger";
    } elseif ($resultado) {
        $_SESSION['mensaje'] = "La marca ha sido borrada correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al borrar la marca.";
        $_SESSION['tipo_mensaje'] = "danger";
    }
    header('Location: ../controller/marcasAdminController.php');
    exit();
}
