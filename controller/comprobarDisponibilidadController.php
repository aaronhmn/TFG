<?php

use \model\utils;
use \model\producto;

require_once("../model/productoModel.php");
require_once("../model/utils.php");

$gestorProductos = new Producto();
$conexPDO = utils::conectar();

// Obtiene los IDs de productos enviados via POST
$productIds = json_decode(file_get_contents('php://input'), true);

$resultados = [];
foreach ($productIds as $id) {
    $producto = $gestorProductos->getProductoIdAdmin($id, $conexPDO);
    if ($producto) { // Asegura que el producto existe
        $resultados[] = [
            'id' => $id,
            'disponible' => $producto['estado'] == 0, // Asumiendo que 'estado' 0 significa disponible
            'nombre' => $producto['nombre']
        ];
    } else {
        $resultados[] = [
            'id' => $id,
            'disponible' => false,
            'nombre' => 'Producto no encontrado'
        ];
    }
}

echo json_encode($resultados);