<?php
namespace model;

use \model\utils;
use \model\productoModel;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/productoModel.php");
$mensaje=null;

include("../view/insertarProductoAdminView.php");

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
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
    $imageName = $_FILES["inputImagen"]["name"];
    $imageData = $_FILES["inputImagen"]["tmp_name"]; 
    $imageType = $_FILES["inputImagen"]["type"];

    if(substr($imageType,0,5) == "image")
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
    }


}

?>
