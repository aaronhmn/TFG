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
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
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
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $producto["idproducto"] = $_POST["idProducto"];
        $producto["nombre"] = $_POST["nombre"];
        $producto["precio"] = $_POST["precio"];
        $producto["categoria"] = $_POST["categoria"];
        $producto["sub_categoria"] = $_POST["sub_categoria"];
        $producto["descripcion"] = $_POST["descripcion"];
        $producto["especificacion"] = $_POST["especificacion"];
        $producto["marca"] = $_POST["marca"];
        $producto["stock"] = $_POST["stock"];


        
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

            }
            else
            {
                if(move_uploaded_file($tmp_name, $path_filename_ext))
                {

                }
                else
                {

                }
            }
        }

        //Nos conectamos a la Bd
        $conexPDO = utils::conectar();
        $gestorproducto = new producto();
        $gestorproducto->updateProducto($producto, $conexPDO);

        include("../view/modificarProductoView.php");
    }

?>
