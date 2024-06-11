<?php
namespace model;

use \model\utils;
use \model\almacen;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/almacenModel.php");
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
    $telefono = $_POST['inputTelefono'];
    $codigoPostal = $_POST['inputCP'];
    $calle = $_POST['inputCalle'];
    $numeroBloque = $_POST['inputNB'];
    $piso = $_POST['inputPiso'];

    $datosAlmacen = array();
    $datosAlmacen["nombre"] = utils::limpiar_datos($nombre);
    $datosAlmacen["telefono"] = utils::limpiar_datos($telefono);
    $datosAlmacen["codigo_postal"] = utils::limpiar_datos($codigoPostal);
    $datosAlmacen["calle"] = utils::limpiar_datos($calle);
    $datosAlmacen["numero_bloque"] = utils::limpiar_datos($numeroBloque);
    $datosAlmacen["piso"] = utils::limpiar_datos($piso);

    $gestorAlmacen = new Almacen();

    //Nos conectamos a la Base de Datos
    $conexPDO = utils::conectar();
    $resultado = $gestorAlmacen->addAlmacen($datosAlmacen, $conexPDO);

    //Para verificar si todo funcionó correctamente
    if ($resultado != null) {
        $_SESSION['mensaje'] = "El almacén ha sido creado correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ../controller/almacenesAdminController.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al crear el almacén.";
        $_SESSION['tipo_mensaje'] = "danger";
        // Si decides redireccionar de todos modos o manejar de otra forma
        header('Location: ../controller/almacenesAdminController.php');
        exit();
    }
}

?>
