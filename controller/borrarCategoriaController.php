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

    // Conexión a la BD
    $conexPDO = utils::conectar();
    $gestorCategoria = new Categoria();
    $resultado = $gestorCategoria->delCategoria($idCategoria, $conexPDO);

    if ($resultado === false) {
        $_SESSION['mensaje'] = "No se puede eliminar la categoría porque está asociada con uno o más productos.";
        $_SESSION['tipo_mensaje'] = "danger";
    } elseif ($resultado) {
        $_SESSION['mensaje'] = "La categoría ha sido borrada correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al borrar la categoría.";
        $_SESSION['tipo_mensaje'] = "danger";
    }
    header('Location: ../controller/categoriasAdminController.php');
    exit();
}
