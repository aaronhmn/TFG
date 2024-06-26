<?php

namespace model;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use \model\utils;
use \model\producto;
use \model\marca;
use \model\categoria;
use \model\almacen;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/productoModel.php");
require_once("../model/marcaModel.php");
require_once("../model/categoriaModel.php");
require_once("../model/almacenModel.php");
$mensaje = null;

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['inputNombre'];
    $precio = $_POST['inputPrecio'];
    $categoria = $_POST['inputCategoria'];
    $descripcion = $_POST['inputDescripcion'];
    $especificacion = $_POST['inputEspecificacion'];
    $marca = $_POST['inputMarca'];
    $stock = $_POST['inputStock'];
    $almacen = $_POST['inputAlmacen'];

    // Verifica si se subieron exactamente cuatro imágenes
    if (count($_FILES['inputImagen']['name']) == 4) {
        InsertarProducto($nombre, $precio, $categoria, $descripcion, $especificacion, $marca, $stock, $almacen);
    } else {
        $_SESSION['mensaje'] = "Debe subir exactamente cuatro imágenes.";
        $_SESSION['tipo_mensaje'] = "warning";
        header('Location: ../controller/productosAdminController.php');
        exit();
    }
}

function InsertarProducto($nombre, $precio, $categoria, $descripcion, $especificacion, $marca, $stock, $almacen)
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
    $producto["id_almacen"] = utils::limpiar_datos($almacen);

    //Declaramos un objeto de la clase producto para utilizar sus funciones
    $gestorProducto = new producto();
    //Nos conectamos a la Bd
    $conexPDO = utils::conectar();

    // Verificar si el nombre ya existe
    if ($gestorProducto->existeNombre($nombre, $conexPDO)) {
        $_SESSION['mensaje'] = 'Este nombre ya esta en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/productosAdminController.php");
        exit();
    }

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
                // Directorio de destino para las imágenes subidas
                $target_dir = "../assets/img/products/";
                // Obtener la información del archivo
                $path = pathinfo($name); // Obtiene información del archivo, como nombre y extensión
                $filename = $path['filename']; // Nombre del archivo sin la extensión
                $ext = $path['extension']; // Extensión del archivo
                // Ruta temporal del archivo subido
                $temp_name = $_FILES['inputImagen']['tmp_name'][$key];
                // Ruta completa y final del archivo en el servidor
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

    //Añadimos el registro
    $resultado = $gestorProducto->addProducto($producto, $conexPDO);

    //Para verificar si todo funcionó correctamente y mensajes de accesibilidad con bootstrap
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
