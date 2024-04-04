<?php

namespace model;

use \model\utils;
use \model\productoModel;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/productoModel.php");
$mensaje = null;

include("../view/insertarProductoAdminView.php");

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['inputNombre'];
    $precio = $_POST['inputPrecio'];
    $categoria = $_POST['inputCategoria'];
    $subCategoria = $_POST['inputSubCategoria'];
    $descripcion = $_POST['inputDescripcion'];
    $especificacion = $_POST['inputEspecificacion'];
    $marca = $_POST['inputMarca'];
    $stock = $_POST['inputStock'];

    InsertarProducto($nombre, $precio, $categoria, $subCategoria, $descripcion, $especificacion, $marca, $stock);
}

function InsertarProducto($nombre, $precio, $categoria, $subCategoria, $descripcion, $especificacion, $marca, $stock)
{
    //Declaramos un array vacio que alojará los datos del producto
    $producto = array();

    $producto["nombre"] = utils::limpiar_datos($nombre);
    $producto["precio"] = utils::limpiar_datos($precio);
    $producto["categoria"] = utils::limpiar_datos($categoria);
    $producto["sub_categoria"] = utils::limpiar_datos($subCategoria);
    $producto["descripcion"] = utils::limpiar_datos($descripcion);
    $producto["especificacion"] = utils::limpiar_datos($especificacion);
    $producto["marca"] = utils::limpiar_datos($marca);
    $producto["stock"] = utils::limpiar_datos($stock);



    // Obtengo la imagen
    /* $imageName = $_FILES["inputImagen"]["name"];
    $imageData = $_FILES["inputImagen"]["tmp_name"];
    $imageType = $_FILES["inputImagen"]["type"]; */

    // Inicializa una variable para almacenar las rutas de las imágenes
    $imagenesRutas = [];
    $imagenesNombresTipos = [];

    /* if(substr($imageType,0,5) == "image")
    {
        $target_dir="../assets/img/products/";
        $file = $_FILES["inputImagen"]["name"];
        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $tmp_name = $_FILES["inputImagen"]["tmp_name"];
    
        $path_filename_ext = $target_dir.$filename.".".$ext;

        $producto["tipo_imagen"] = $imageData;
        $producto["imagen"] = $imageName;
        $producto["ruta_imagen"] = $path_filename_ext;

        if(file_exists($path_filename_ext))
        {
            echo "File already exists";
        }
        else
        {
            if(move_uploaded_file($tmp_name, $path_filename_ext))
            {
                echo "File uploaded";
                //echo "<img src='$file'>";
            }
            else
            {
                echo "File not uploaded";
            }
        }
        
        //Declaramos un objeto de la clase producto para utilizar sus funciones
        $gestorProducto = new producto();

        //Nos conectamos a la Bd
        $conexPDO = utils::conectar();

        //Añadimos el registro
        $resultado = $gestorProducto->addProducto($producto, $conexPDO);


        //Para verificar si todo funcionó correctamente
        if ($resultado != null)
        {
            $mensaje = "El producto se Registro Correctamente";
            echo ($mensaje);
        }    
        else
        {
            $mensaje = "Ha habido un fallo al acceder a la Base de Datos";
            echo ($mensaje);
        }
    }
    else
    {
        echo "Solo está permitido subir imágenes";
    } */

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
                    $imagenesNombresTipos[] = $imageName . "|" . $imageType;
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
    $mensaje = "El producto se Registro Correctamente";
    echo ($mensaje);
} else {
    $mensaje = "Ha habido un fallo al acceder a la Base de Datos";
    echo ($mensaje);
}
}
