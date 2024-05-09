<?php
namespace model;

use \model\utils;
use \model\marca;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/marcaModel.php");
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

    $datosMarca = array();
    $datosMarca["nombre_marca"] = utils::limpiar_datos($nombre);

    $gestorMarca = new Marca();

    //Nos conectamos a la Base de Datos
    $conexPDO = utils::conectar();
    $resultado = $gestorMarca->addMarca($datosMarca, $conexPDO);

    //Para verificar si todo funcionó correctamente
    if ($resultado != null) {
        $_SESSION['mensaje'] = "La marca ha sido creada correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ../controller/marcasAdminController.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al crear la marca.";
        $_SESSION['tipo_mensaje'] = "danger";
        // Si decides redireccionar de todos modos o manejar de otra forma
        header('Location: ../controller/marcasAdminController.php');
        exit();
    }
}

?>
