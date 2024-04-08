<?php
namespace model;

use \model\productoModel;
use \model\utils;

// Añadimos el código del modelo
require_once("../model/productoModel.php");
require_once("../model/utils.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProducto = $_POST["idProducto"];

    // Nos conectamos a la Bd
    $conexPDO = utils::conectar();

    // Recuperar las rutas de las imágenes antes de eliminar el producto
    $gestorProducto = new Producto();
    $rutasImagenes = $gestorProducto->getImagenesPorProducto($idProducto, $conexPDO);

    // Verificar si se recuperaron las rutas de las imágenes
    if ($rutasImagenes) {
        foreach ($rutasImagenes as $rutaImagen) {
            if (file_exists($rutaImagen)) {
                unlink($rutaImagen); // Eliminar la imagen del servidor
            } else {
                // Manejar el caso en que el archivo no exista. Puede ser simplemente un registro en un log.
            }
        }
    }

    // Después de eliminar las imágenes, proceder a eliminar el producto
    $gestorProducto->delProducto($idProducto, $conexPDO);

    // Redirigir al administrador de productos
    header("Location: ../controller/productosAdminController.php");
    exit();
}
?>