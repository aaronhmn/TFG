<?php
namespace model;

require_once("../model/productoModel.php");
require_once("../model/utils.php");

use model\Producto;
use model\utils;

session_start();

// Verificación de acceso
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idProducto'])) {
    $idProducto = $_POST['idProducto'];
    $conexPDO = utils::conectar();

    $gestorProducto = new Producto();
    $rutasImagenes = $gestorProducto->getImagenesPorProducto($idProducto, $conexPDO);

    try {
        $resultado = $gestorProducto->delProducto($idProducto, $conexPDO);
        if ($resultado) {
            foreach ($rutasImagenes as $rutaImagen) {
                if (file_exists($rutaImagen)) {
                    if (!unlink($rutaImagen)) {
                        throw new \Exception("No se pudo eliminar la imagen: $rutaImagen");
                    }
                }
            }
            $_SESSION['mensaje'] = "Producto eliminado exitosamente.";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            $_SESSION['mensaje'] = "El producto no se puede eliminar porque está asociado a pedidos.";
            $_SESSION['tipo_mensaje'] = "danger";
        }
    } catch (\Exception $e) {
        error_log($e->getMessage());
        $_SESSION['mensaje'] = "Error al eliminar el producto: " . $e->getMessage();
        $_SESSION['tipo_mensaje'] = "danger";
    }
} else {
    $_SESSION['mensaje'] = "Solicitud inválida.";
    $_SESSION['tipo_mensaje'] = "danger";
}

header("Location: ../controller/productosAdminController.php");
exit();
?>
