<?php
namespace model;

require_once("../model/productoModel.php");
require_once("../model/utils.php");

session_start();

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idProducto'])) {
    $idProducto = $_POST['idProducto'];
    $conexPDO = utils::conectar();
    $gestorProductos = new Producto();

    if ($gestorProductos->ocultarProducto($idProducto, $conexPDO)) {
        $_SESSION['mensaje'] = 'Estado del producto actualizado con éxito.';
        $_SESSION['tipo_mensaje'] = 'success';
    } else {
        $_SESSION['mensaje'] = 'No se pudo cambiar el estado del producto.';
        $_SESSION['tipo_mensaje'] = 'danger';
    }
}

header('Location: ../controller/productosAdminController.php');
exit();
?>
