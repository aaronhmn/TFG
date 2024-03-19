<?php

namespace model;

use \model\productoModel;
use \model\utils;


//Añadimos el código del modelo
require_once("../model/productoModel.php");
require_once("../model/utils.php");

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

    // Verificar si se ha enviado una nueva imagen
    if ($_FILES["inputImagen"]["size"] > 0) {
        // Obtener la información de la nueva imagen
        $imageName = $_FILES["inputImagen"]["name"];
        $imageData = $_FILES["inputImagen"]["tmp_name"];
        $imageType = $_FILES["inputImagen"]["type"];

        if (substr($imageType, 0, 5) == "image") {
            $target_dir = "../assets/img/products/";
            $file = $_FILES["inputImagen"]["name"];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $tmp_name = $_FILES["inputImagen"]["tmp_name"];

            $path_filename_ext = $target_dir . $filename . "." . $ext;

            // Mover la imagen al directorio de destino
            if (move_uploaded_file($tmp_name, $path_filename_ext)) {
                // Actualizar la ruta de la imagen en el array del producto
                $producto["ruta_imagen"] = $path_filename_ext;
            } else {
                // Manejar el error si no se pudo mover la imagen
                // Puedes mostrar un mensaje de error o realizar otra acción adecuada
            }
        }
    } else {
        // Conservar la ruta de la imagen existente si no se envía una nueva imagen
        $producto["ruta_imagen"] = $_POST["ruta_imagen"];
    }

    // Actualizar el producto en la base de datos
    $conexPDO = utils::conectar();
    $gestorproducto = new producto();
    $gestorproducto->updateProducto($producto, $conexPDO);

    // Incluir la vista para mostrar el resultado
    include("../view/modificarProductoView.php");
}
