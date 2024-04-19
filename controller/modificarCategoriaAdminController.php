<?php
namespace model;
use \model\categoria;
use \model\utils;


//Añadimos el código del modelo
require_once("../model/categoriaModel.php");
require_once("../model/utils.php");

session_start();

// Verificar si el categoria está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

    //Creamos un array para guardar los datos del categoria
    $categoria = array();

    // Solo se ejecutará cuando reciba una petición del registro
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $categoria["idcategoria"] = $_GET["idCategoria"];
        $categoria["nombre_categoria"] = $_GET["nombre_categoria"];
    }

    // Solo se ejecutará cuando reciba una petición del registro
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $categoria["idcategoria"] = $_POST["idCategoria"];
        $categoria["nombre_categoria"] = $_POST["nombre_categoria"];

        //Nos conectamos a la Bd
        $conexPDO = utils::conectar();
        $gestorcategoria = new Categoria();
        $resultado=$gestorcategoria->updateCategoria($categoria, $conexPDO);

        //Para verificar si todo funcionó correctamente
    if ($resultado != null) {
        $_SESSION['mensaje'] = "La categoría ha sido creada correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ../controller/categoriasAdminController.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al modificar la categoría.";
        $_SESSION['tipo_mensaje'] = "danger";
        // Si decides redireccionar de todos modos o manejar de otra forma
        header('Location: ../controller/categoriasAdminController.php');
        exit();
    }
    }

    

?>
