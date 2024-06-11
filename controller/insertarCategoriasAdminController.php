<?php
namespace model;

use \model\utils;
use \model\categoria;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/categoriaModel.php");
$mensaje=null;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $nombre = $_POST['inputNombre'];

    $datosCategoria = array();
    $datosCategoria["nombre_categoria"] = utils::limpiar_datos($nombre);

    $gestorCat = new Categoria();

    //Nos conectamos a la Base de Datos
    $conexPDO = utils::conectar();

    // Verificar si el nombre ya existe
    if ($gestorCat->existeNombre($nombre, $conexPDO)) {
        $_SESSION['mensaje'] = 'Este nombre ya esta en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/categoriasAdminController.php");
        exit();
    }

    $resultado = $gestorCat->addCategoria($datosCategoria, $conexPDO);

    //Para verificar si todo funcionó correctamente
    if ($resultado != null) {
        $_SESSION['mensaje'] = "La categoría ha sido creada correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ../controller/categoriasAdminController.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al crear la categoría.";
        $_SESSION['tipo_mensaje'] = "danger";
        // Si decides redireccionar de todos modos o manejar de otra forma
        header('Location: ../controller/categoriasAdminController.php');
        exit();
    }
}

?>
