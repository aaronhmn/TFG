<?php
namespace model;

use \model\productoModel;
use \model\utils;

require_once("../model/productoModel.php");
require_once("../model/utils.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProducto = $_POST["idProducto"];
    $conexPDO = utils::conectar();

    $gestorProducto = new Producto();

    // Recuperar las rutas de las imágenes antes de intentar eliminar el producto
    $rutasImagenes = $gestorProducto->getImagenesPorProducto($idProducto, $conexPDO);

    // Intenta eliminar el producto
    if ($gestorProducto->delProducto($idProducto, $conexPDO)) {
        // Si la eliminación fue exitosa, proceder a eliminar las imágenes del servidor
        foreach ($rutasImagenes as $rutaImagen) {
            if (file_exists($rutaImagen)) {
                unlink($rutaImagen);
            }
        }
        $_SESSION['mensaje'] = "Producto eliminado exitosamente.";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        // Si falla la eliminación del producto, mostrar mensaje de error
        $_SESSION['mensaje'] = "No se puede eliminar el producto, está asociado a un pedido.";
        $_SESSION['tipo_mensaje'] = "danger";
    }

    // Redirigir de vuelta a la página de administración de productos
    header("Location: ../controller/productosAdminController.php");
    exit();
}
?>
