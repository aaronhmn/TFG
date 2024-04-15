<?php

namespace model;

use \model\productoModel;
use \model\utils;


//Añadimos el código del modelo
require_once("../model/productoModel.php");
require_once("../model/utils.php");

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['idusuario']) || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php'); // Redirecciona a una página de error
    exit();
}

//Creamos un array para guardar los datos del producto
$producto = array();

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $producto["idproducto"] = $_GET["idProducto"];
    $producto["nombre"] = $_GET["nombre"];
    $producto["precio"] = $_GET["precio"];
    $producto["categoria"] = $_GET["categoria"];
    $producto["sub_categoria"] = $_GET["sub_categoria"];
    $producto["descripcion"] = $_GET["descripcion"];
    $producto["especificacion"] = $_GET["especificacion"];
    $producto["marca"] = $_GET["marca"];
    $producto["stock"] = $_GET["stock"];
    $producto["ruta_imagen"] = $_GET["ruta_imagen"];

    include("../view/modificarProductoView.php");
}

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $producto["idproducto"] = $_POST["idProducto"];
    $producto["nombre"] = $_POST["nombre"];
    $producto["precio"] = $_POST["precio"];
    $producto["categoria"] = $_POST["categoria"];
    $producto["sub_categoria"] = $_POST["sub_categoria"];
    $producto["descripcion"] = $_POST["descripcion"];
    $producto["especificacion"] = $_POST["especificacion"];
    $producto["marca"] = $_POST["marca"];
    $producto["stock"] = $_POST["stock"];

    // Verificar si se ha enviado al menos una nueva imagen
    if (!empty($_FILES['inputImagen']['name'][0])) {
        $imagenesRutas = []; // Inicializa una nueva lista para almacenar las rutas de las imágenes actualizadas

        // Itera sobre todos los archivos subidos
        foreach ($_FILES['inputImagen']['name'] as $key => $name) {
            $imageType = $_FILES['inputImagen']['type'][$key];
            // Verificar si el archivo es realmente una imagen
            if (substr($imageType, 0, 5) == "image") {
                $targetDir = "../assets/img/products/";
                $path = pathinfo($name);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['inputImagen']['tmp_name'][$key];
                $path_filename_ext = $targetDir . $filename . "." . $ext;

                // Verifica si el archivo ya existe
                if (!file_exists($path_filename_ext)) {
                    // Mueve el archivo subido a la carpeta de destino
                    if (move_uploaded_file($temp_name, $path_filename_ext)) {
                        $imagenesRutas[] = $path_filename_ext; // Agrega la ruta de la imagen al array
                    } else {
                        echo "File not uploaded";
                    }
                } else {
                    echo "File already exists";
                }
            } else {
                echo "Solo está permitido subir imágenes";
            }
        }

        // Concatena las rutas de las imágenes en una sola cadena, separadas por comas
        $rutasConcatenadas = implode(',', $imagenesRutas);
        $producto["ruta_imagen"] = $rutasConcatenadas; // Actualiza la ruta de la imagen en el array del producto
    } else {
        // Conservar la ruta de la imagen existente si no se envía una nueva imagen
        if (isset($_POST["ruta_imagen"])) {
            $producto["ruta_imagen"] = $_POST["ruta_imagen"];
        } else {
            echo "No se proporcionó la ruta de la imagen existente.";
        }
    }

    // Actualizar el producto en la base de datos
    $conexPDO = utils::conectar();
    $gestorproducto = new producto();
    $gestorproducto->updateProducto($producto, $conexPDO);

    // Incluir la vista para mostrar el resultado
    include("../view/modificarProductoView.php");
}
