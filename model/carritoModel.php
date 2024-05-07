<?php

namespace model;

require_once("utils.php");

use \PDO;
use \PDOException;

class Carrito
{
    public function addProductoAlCarrito($idUsuario, $idProducto, $cantidad, $conexPDO) {
        $sql = "SELECT cantidad FROM carrito WHERE id_usuario_carrito = ? AND id_producto_carrito = ?";
        $stmt = $conexPDO->prepare($sql);
        $stmt->execute([$idUsuario, $idProducto]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Producto ya existe, actualizar cantidad
            $nuevaCantidad = $result['cantidad'] + $cantidad;
            $sqlUpdate = "UPDATE carrito SET cantidad = ? WHERE id_usuario_carrito = ? AND id_producto_carrito = ?";
            $stmt = $conexPDO->prepare($sqlUpdate);
            $stmt->execute([$nuevaCantidad, $idUsuario, $idProducto]);
        } else {
            // Producto no existe, insertar nuevo registro
            $sqlInsert = "INSERT INTO carrito (id_usuario_carrito, id_producto_carrito, cantidad) VALUES (?, ?, ?)";
            $stmt = $conexPDO->prepare($sqlInsert);
            $stmt->execute([$idUsuario, $idProducto, $cantidad]);
        }
        return true;
    }

    // Elimina un producto del carrito
    public function eliminarProductoDelCarrito($idUsuario, $idProducto, $conexPDO) {
        $sql = "DELETE FROM carrito WHERE id_usuario_carrito = ? AND id_producto_carrito = ?";
        $stmt = $conexPDO->prepare($sql);
        $stmt->execute([$idUsuario, $idProducto]);
        return $stmt->rowCount() > 0;
    }

    // Obtiene los productos en el carrito de un usuario
    public function obtenerProductosDelCarrito($idUsuario, $conexPDO) {
        $sql = "SELECT p.*, c.cantidad FROM productos p JOIN carrito c ON p.idproducto = c.id_producto_carrito WHERE c.id_usuario_carrito = ?";
        $stmt = $conexPDO->prepare($sql);
        $stmt->execute([$idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>