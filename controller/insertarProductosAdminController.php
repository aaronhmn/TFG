<?php

namespace model;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use \model\utils;
use \model\producto;
use \model\marca;
use \model\categoria;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/productoModel.php");
require_once("../model/marcaModel.php");
require_once("../model/categoriaModel.php");
$mensaje = null;

session_start();

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

/* include("../view/insertarProductoAdminView.php"); */

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['inputNombre'];
    $precio = $_POST['inputPrecio'];
    $categoria = $_POST['inputCategoria'];
    $descripcion = $_POST['inputDescripcion'];
    $especificacion = $_POST['inputEspecificacion'];
    $marca = $_POST['inputMarca'];
    $stock = $_POST['inputStock'];

    // Verifica si se subieron exactamente cuatro imágenes
    if (count($_FILES['inputImagen']['name']) == 4) {
        InsertarProducto($nombre, $precio, $categoria, $descripcion, $especificacion, $marca, $stock);
    } else {
        $_SESSION['mensaje'] = "Debe subir exactamente cuatro imágenes.";
        $_SESSION['tipo_mensaje'] = "warning";
        header('Location: ../controller/productosAdminController.php');
        exit();
    }
}

function InsertarProducto($nombre, $precio, $categoria, $descripcion, $especificacion, $marca, $stock)
{
    //Declaramos un array vacio que alojará los datos del producto
    $producto = array();

    $producto["nombre"] = utils::limpiar_datos($nombre);
    $producto["precio"] = utils::limpiar_datos($precio);
    $producto["id_categoria"] = utils::limpiar_datos($categoria);
    $producto["descripcion"] = utils::limpiar_datos($descripcion);
    $producto["especificacion"] = utils::limpiar_datos($especificacion);
    $producto["id_marca"] = utils::limpiar_datos($marca);
    $producto["stock"] = utils::limpiar_datos($stock);

    // Inicializa una variable para almacenar las rutas de las imágenes
    $imagenesRutas = [];
    $imagenesNombresTipos = [];

    // Verifica si se subieron archivos
    if (!empty($_FILES['inputImagen']['name'][0])) {
        // Itera sobre todos los archivos subidos
        foreach ($_FILES['inputImagen']['name'] as $key => $name) {
            $imageName = $name;
            $imageType = $_FILES['inputImagen']['type'][$key];

            if (substr($imageType, 0, 5) == "image") {
                // Define la ruta de destino para la imagen
                $target_dir = "../assets/img/products/";
                $path = pathinfo($name);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['inputImagen']['tmp_name'][$key];
                $path_filename_ext = $target_dir . $filename . "." . $ext;

                // Verifica si el archivo ya existe
                if (!file_exists($path_filename_ext)) {
                    // Mueve el archivo subido a la carpeta de destino
                    if (move_uploaded_file($temp_name, $path_filename_ext)) {
                        // Agrega la ruta de la imagen al array
                        $imagenesRutas[] = $path_filename_ext;
                        // Agrega el nombre y tipo de la imagen a la cadena
                        $imagenesNombresTipos[] = $imageName . "," . $imageType;
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
    }

    // Concatena las rutas de las imágenes en una sola cadena, separadas por comas
    $rutasConcatenadas = implode(',', $imagenesRutas);
    // Concatena los nombres y tipos de las imágenes en una sola cadena, separadas por comas
    $nombresTiposConcatenados = implode(',', $imagenesNombresTipos);

    // Asigna la cadena concatenada al array del producto
    $producto["ruta_imagen"] = $rutasConcatenadas;
    $producto["imagen"] = $nombresTiposConcatenados;

    //Declaramos un objeto de la clase producto para utilizar sus funciones
    $gestorProducto = new producto();

    //Nos conectamos a la Bd
    $conexPDO = utils::conectar();

    //Añadimos el registro
    $resultado = $gestorProducto->addProducto($producto, $conexPDO);

    //Para verificar si todo funcionó correctamente
    if ($resultado != null) {
        $_SESSION['mensaje'] = "El producto ha sido creado correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ../controller/productosAdminController.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al crear el producto.";
        $_SESSION['tipo_mensaje'] = "danger";
        // Si decides redireccionar de todos modos o manejar de otra forma
        header('Location: ../controller/productosAdminController.php');
        exit();
    }
}
