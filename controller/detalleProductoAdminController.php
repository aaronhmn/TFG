<?php

namespace controller;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("../model/productoModel.php");
require_once("../model/categoriaModel.php");
require_once("../model/marcaModel.php");
require_once("../model/almacenModel.php");
require_once("../model/utils.php");

use model\Producto;
use model\Marca;
use model\Categoria;
use model\Almacen;
use model\utils;

header('Content-Type: application/json'); // Establece el tipo de contenido de la respuesta HTTP como JSON

// Verificar si el usuario está logueado y tiene permisos adecuados
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    // No autorizado
    echo json_encode(['error' => 'Acceso no autorizado']);
    exit;
}

// Verificar que la solicitud sea POST y contenga el ID del usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idProducto'])) {
    $idProducto = $_POST['idProducto'];

    // Conexión a la base de datos
    $conexPDO = utils::conectar();
    if (!$conexPDO) {
        echo json_encode(['error' => 'Error de conexión a la base de datos']);
        exit;
    }

    // Crear una instancia del modelo Usuario
    $gestorProducto = new Producto();
    $producto = $gestorProducto->getProductoIdAdmin($idProducto, $conexPDO);

    $gestorMarca = new marca();
    $marca = $gestorMarca->getMarcaId($producto['id_marca'], $conexPDO);

    $gestorCategoria = new categoria();
    $categoria = $gestorCategoria->getCategoriaId($producto['id_categoria'], $conexPDO);

    $gestorAlmacen = new almacen();
    $almacen = $gestorAlmacen->getAlmacenId($producto['id_almacen'], $conexPDO);

    // Compilar la respuesta con todos los datos
    $respuesta = [
        'idproducto' => $producto['idproducto'],
        'nombre' => $producto['nombre'],
        'precio' => $producto['precio'].'€',
        'descripcion' => $producto['descripcion'],
        'especificacion' => $producto['especificacion'],
        'stock' => $producto['stock'],
        'ruta_imagen' => $producto['ruta_imagen'],
        'marca' => $marca ? $marca['nombre_marca'] : 'Marca no especificada',
        'categoria' => $categoria ? $categoria['nombre_categoria'] : 'Categoría no especificada',
        'almacen' => $almacen ? $almacen['nombre'] : 'Almacén no especificado'
    ];
    
    // Verificar si se obtuvieron los datos correctamente
    if ($respuesta) {
        echo json_encode($respuesta);
    } else {
        echo json_encode(['error' => 'Producto no encontrado']);
    }
} else {
    echo json_encode(['error' => 'Datos incorrectos o método de solicitud inadecuado']);
}
?>