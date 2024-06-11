<?php
namespace model;

require_once("../model/productoModel.php");
require_once("../model/utils.php");

use model\Producto;
use model\utils;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Comprueba si el usuario está logueado y si su rol es de administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php'); // Redirige a una vista de no autorizado si no cumple los requisitos
    exit(); // Termina la ejecución del script
}

// Comprueba si la solicitud es de tipo POST y si se ha enviado el ID del producto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idProducto'])) {
    $idProducto = $_POST['idProducto']; // Asigna el ID del producto
    $conexPDO = utils::conectar(); // Conecta con la base de datos usando la utilidad conectar

    $gestorProducto = new Producto(); // Crea una instancia del gestor de productos
    $rutasImagenes = $gestorProducto->getImagenesPorProducto($idProducto, $conexPDO); // Obtiene las rutas de las imágenes del producto

    try {
        $resultado = $gestorProducto->delProducto($idProducto, $conexPDO); // Intenta eliminar el producto
        if ($resultado) {
            // Si el producto se elimina correctamente, elimina las imágenes asociadas
            foreach ($rutasImagenes as $rutaImagen) {
                if (file_exists($rutaImagen)) { // Comprueba si el archivo existe
                    if (!unlink($rutaImagen)) { // Intenta eliminar el archivo
                        throw new \Exception("No se pudo eliminar la imagen: $rutaImagen"); // Lanza una excepción si no se puede eliminar
                    }
                }
            }
            // Establece un mensaje de éxito en la sesión
            $_SESSION['mensaje'] = "Producto eliminado exitosamente.";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            // Si no se puede eliminar el producto, establece un mensaje de error
            $_SESSION['mensaje'] = "El producto no se puede eliminar porque está asociado a pedidos.";
            $_SESSION['tipo_mensaje'] = "danger";
        }
    } catch (\Exception $e) {
        // Si ocurre una excepción, registra el error y establece un mensaje de error
        error_log($e->getMessage());
        $_SESSION['mensaje'] = "Error al eliminar el producto: " . $e->getMessage();
        $_SESSION['tipo_mensaje'] = "danger";
    }
} else {
    // Si la solicitud no es válida, establece un mensaje de error
    $_SESSION['mensaje'] = "Solicitud inválida.";
    $_SESSION['tipo_mensaje'] = "danger";
}

header("Location: ../controller/productosAdminController.php");
exit();
?>
