<?php

namespace model;

use \model\producto;
use \model\marca;
use \model\categoria;
use \model\utils;

// Incluir los modelos necesarios
require_once("../model/productoModel.php");
require_once("../model/marcaModel.php");
require_once("../model/categoriaModel.php");
require_once("../model/utils.php");

session_start();

// Verificar si el usuario está logueado y es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

$conexPDO = utils::conectar();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["idProducto"])) {
    $gestorProducto = new producto();
    $producto = $gestorProducto->getProductoId($_GET["idProducto"], $conexPDO);

    $gestorMarca = new marca();
    $marcas = $gestorMarca->getMarcas($conexPDO);

    $gestorCategoria = new categoria();
    $categorias = $gestorCategoria->getCategorias($conexPDO);

    include("../view/modificarProductoView.php");
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProducto = $_POST["idProducto"];
    $gestorProducto = new producto();

    // Recuperar la información del producto antes de actualizar
    $productoActual = $gestorProducto->getProductoId($idProducto, $conexPDO);

    // Array para mantener los datos del producto a actualizar
    $producto = [
        "idproducto" => $_POST["idProducto"],
        "nombre" => $_POST["nombre"],
        "precio" => $_POST["precio"],
        "id_categoria" => $_POST["id_categoria"],
        "descripcion" => $_POST["descripcion"],
        "especificacion" => $_POST["especificacion"],
        "id_marca" => $_POST["id_marca"],
        "stock" => $_POST["stock"]
    ];

    // Verificar si se han enviado nuevas imágenes
    if (!empty($_FILES['inputImagen']['name'][0])) {
        // Eliminar imágenes antiguas
        $rutasAntiguas = explode(',', $productoActual['ruta_imagen']);
        foreach ($rutasAntiguas as $rutaAntigua) {
            if (file_exists($rutaAntigua)) {
                unlink($rutaAntigua); // Borrar la imagen del servidor
            }
        }

        $imagenesRutas = []; // Inicializa una lista para las nuevas imágenes
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
    } else {
        // Conservar la ruta de la imagen existente
        $producto["ruta_imagen"] = $productoActual["ruta_imagen"];
    }

    // Actualizar el producto en la base de datos
    $gestorProducto->updateProducto($producto, $conexPDO);

    // Redirigir al usuario o recargar la información
    include("../view/modificarProductoView.php");
}
