<?php

namespace model;

require_once("utils.php");
use \PDO;
use \PDOException;

class Carrito
{
    public function addProductoAlCarrito($idUsuario, $idProducto, $cantidad, $conexPDO) {
        try {
            $sql = "SELECT cantidad FROM carrito WHERE id_usuario_carrito = ? AND id_producto_carrito = ?";
            $stmt = $conexPDO->prepare($sql);
            $stmt->execute([$idUsuario, $idProducto]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $nuevaCantidad = $result['cantidad'] + $cantidad;
                $sqlUpdate = "UPDATE carrito SET cantidad = ? WHERE id_usuario_carrito = ? AND id_producto_carrito = ?";
                $stmt = $conexPDO->prepare($sqlUpdate);
                $stmt->execute([$nuevaCantidad, $idUsuario, $idProducto]);
            } else {
                $sqlInsert = "INSERT INTO carrito (id_usuario_carrito, id_producto_carrito, cantidad) VALUES (?, ?, ?)";
                $stmt = $conexPDO->prepare($sqlInsert);
                $stmt->execute([$idUsuario, $idProducto, $cantidad]);
            }
            return true;
        } catch (PDOException $e) {
            // Consider logging this error
            print("Error: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarProductoDelCarrito($idUsuario, $idProducto, $conexPDO) {
        try {
            $sql = "DELETE FROM carrito WHERE id_usuario_carrito = ? AND id_producto_carrito = ?";
            $stmt = $conexPDO->prepare($sql);
            $stmt->execute([$idUsuario, $idProducto]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Consider logging this error
            print("Error: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerProductosDelCarrito($idUsuario, $conexPDO) {
        try {
            $sql = "SELECT p.*, c.cantidad FROM producto p JOIN carrito c ON p.idproducto = c.id_producto_carrito WHERE c.id_usuario_carrito = ?";
            $stmt = $conexPDO->prepare($sql);
            $stmt->execute([$idUsuario]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Consider logging this error
            print("Error: " . $e->getMessage());
            return [];
        }
    }
}

?>
