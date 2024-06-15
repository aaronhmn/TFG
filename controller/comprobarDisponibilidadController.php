<?php

use \model\utils;
use \model\producto;

require_once("../model/productoModel.php");
require_once("../model/utils.php");

$gestorProductos = new Producto();
// Conexión a la BD
$conexPDO = utils::conectar();

// Obtiene los IDs de productos enviados via POST
$productIds = json_decode(file_get_contents('php://input'), true);

$resultados = []; // Inicializa un array para almacenar los resultados
foreach ($productIds as $id) { // Itera sobre cada ID de producto
    $producto = $gestorProductos->getProductoIdAdmin($id, $conexPDO); // Obtiene la información del producto por su ID
    if ($producto) { // Asegura que el producto existe
        $disponible = ($producto['estado'] == 0) && ($producto['stock'] > 0);
        $resultados[] = [
            'id' => $id,
            'disponible' => $disponible,
            'nombre' => $producto['nombre'],
            'stock' => $producto['stock']
        ];
    } else {
        // Si el producto no existe, agrega un mensaje indicando que no se encontró
        $resultados[] = [
            'id' => $id,
            'disponible' => false,
            'nombre' => 'Producto no encontrado'
        ];
    }
}

// Codifica el array de resultados en formato JSON y lo imprime
echo json_encode($resultados);
