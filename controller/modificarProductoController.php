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

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Si no tienes el rol de admin no te deja pasar a la página
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

// Conexión a la BD
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

    // Exclusión del usuario actual en las comprobaciones
    if ($gestorProducto->existeNombreM($producto["nombre"], $producto["idproducto"], $conexPDO)) {
        $_SESSION['mensaje'] = 'Este nombre ya está en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/productosAdminController.php");
        exit();
    }

    // Verificar si se han enviado nuevas imágenes
    if (!empty($_FILES['inputImagen']['name'][0])) {
        // Separar las rutas antiguas de las imágenes almacenadas en el producto
        $rutasAntiguas = explode(',', $producto['ruta_imagen']);
        foreach ($rutasAntiguas as $rutaAntigua) {
            // Comprobar si el archivo existe en el servidor
            if (file_exists($rutaAntigua)) {
                // Borrar la imagen antigua del servidor
                unlink($rutaAntigua);
            }
        }

        $imagenesRutas = [];
        foreach ($_FILES['inputImagen']['name'] as $key => $name) {
            // Obtener el tipo de archivo de la imagen
            $imageType = $_FILES['inputImagen']['type'][$key];
            // Verificar que el archivo es una imagen
            if (substr($imageType, 0, 5) == "image") {
                // Definir el directorio de destino para las imágenes
                $targetDir = "../assets/img/products/";
                // Obtener la información del archivo
                $path = pathinfo($name);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['inputImagen']['tmp_name'][$key];
                $path_filename_ext = $targetDir . $filename . "." . $ext;

                // Verificar si el archivo no existe ya en el servidor
                if (!file_exists($path_filename_ext)) {
                    // Mover el archivo subido al directorio de destino
                    if (move_uploaded_file($temp_name, $path_filename_ext)) {
                        // Añadir la ruta de la imagen al array de rutas
                        $imagenesRutas[] = $path_filename_ext;
                    } else {
                        // Mostrar mensaje de error si no se puede mover el archivo
                        echo "Error al subir el archivo.";
                    }
                } else {
                    // Mostrar mensaje si el archivo ya existe en el servidor
                    echo "El archivo ya existe en el servidor.";
                }
            } else {
                // Mostrar mensaje si el archivo no es de tipo imagen
                echo "Tipo de archivo no permitido.";
            }
        }
        // Convertir el array de rutas de imágenes en una cadena separada por comas y asignarla al producto
        $producto["ruta_imagen"] = implode(',', $imagenesRutas);
    }

    $resultado = $gestorProducto->updateProducto($producto, $conexPDO);
    // Comprobaciones de errores y mensajes de accesibilidad con bootstrap
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
}
