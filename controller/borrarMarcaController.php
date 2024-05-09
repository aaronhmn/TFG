<?php

namespace model;

use \model\marca;
use \model\utils;


//Añadimos el código del modelo
require_once("../model/marcaModel.php");
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
    $idMarca = $_POST["idMarca"];

    //Nos conectamos a la Bd
    $conexPDO = utils::conectar();
    $gestorMarca = new Marca();
    $resultado = $gestorMarca->delMarca($idMarca, $conexPDO);

    //Para verificar si todo funcionó correctamente
    if ($resultado != null) {
        $_SESSION['mensaje'] = "La marca ha sido borrada correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ../controller/marcasAdminController.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al borrar la marca.";
        $_SESSION['tipo_mensaje'] = "danger";
        // Si decides redireccionar de todos modos o manejar de otra forma
        header('Location: ../controller/marcasAdminController.php');
        exit();
    }
}
