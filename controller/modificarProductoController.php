<?php

namespace model;

use \model\producto;
use \model\marca;
use \model\categoria;
use \model\almacen;
use \model\utils;

require_once("../model/productoModel.php");
require_once("../model/marcaModel.php");
require_once("../model/categoriaModel.php");
require_once("../model/almacenModel.php");
require_once("../model/utils.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

$conexPDO = utils::conectar();

$gestorProducto = new Producto();
$gestorMarca = new Marca();
$gestorCategoria = new Categoria();
$gestorAlmacen = new Almacen();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producto = [
        "idproducto" => $_POST["idproducto"],
        "nombre" => $_POST["nombre"],
        "precio" => $_POST["precio"],
        "id_categoria" => $_POST["id_categoria"],
        "descripcion" => $_POST["descripcion"],
        "especificacion" => $_POST["especificacion"],
        "id_marca" => $_POST["id_marca"],
        "stock" => $_POST["stock"],
        "id_almacen" => $_POST["id_almacen"],
        "ruta_imagen" => $gestorProducto->getProductoId($_POST["idproducto"], $conexPDO)['ruta_imagen']
    ];

    // Verificar si se han enviado nuevas imágenes
    if (!empty($_FILES['inputImagen']['name'][0])) {
        $rutasAntiguas = explode(',', $producto['ruta_imagen']);
        foreach ($rutasAntiguas as $rutaAntigua) {
            if (file_exists($rutaAntigua)) {
                unlink($rutaAntigua); // Borrar la imagen del servidor
            }
        }

        $imagenesRutas = [];
        foreach ($_FILES['inputImagen']['name'] as $key => $name) {
            $imageType = $_FILES['inputImagen']['type'][$key];
            if (substr($imageType, 0, 5) == "image") {
                $targetDir = "../assets/img/products/";
                $path = pathinfo($name);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['inputImagen']['tmp_name'][$key];
                $path_filename_ext = $targetDir . $filename . "." . $ext;

                if (!file_exists($path_filename_ext)) {
                    if (move_uploaded_file($temp_name, $path_filename_ext)) {
                        $imagenesRutas[] = $path_filename_ext;
                    } else {
                        echo "Error al subir el archivo.";
                    }
                } else {
                    echo "El archivo ya existe en el servidor.";
                }
            } else {
                echo "Tipo de archivo no permitido.";
            }
        }
        $producto["ruta_imagen"] = implode(',', $imagenesRutas);
    }

    $resultado = $gestorProducto->updateProducto($producto, $conexPDO);

    if ($resultado) {
        $_SESSION['mensaje'] = "El producto ha sido modificado correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "No se realizaron cambios en el producto.";
        $_SESSION['tipo_mensaje'] = "warning";
    }
    header('Location: ../controller/productosAdminController.php');
    exit();
} else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["idproducto"])) {
    $producto = $gestorProducto->getProductoId($_GET["idproducto"], $conexPDO);
    $marcas = $gestorMarca->getMarcas($conexPDO);
    $categorias = $gestorCategoria->getCategorias($conexPDO);
    $almacenes = $gestorAlmacen->getAlmacenes($conexPDO);

    /* include("../view/modificarProductoView.php"); */
}

?>
