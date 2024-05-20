<?php

namespace model;

require_once("utils.php");

use \PDO;
use \PDOException;

class detalle_pedido
{
    /**Funcion que nos devuelve todos los productos */
    public function getDetallesPedidos($conexPDO)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conexPDO->prepare("SELECT * FROM genesis.detalle_pedido");
                //Ejecutamos la sentencia
                $sentencia->execute();

                //Devolvemos los datos del cliente
                return $sentencia->fetchAll();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }


    /**
     * Funcion que nos devuelve todos los pedidos con paginacion
     * */
    public function getDetallesPedidosPag($conexPDO, $idPedido, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
{
    if ($conexPDO != null) {
        try {
            $query = "SELECT * FROM genesis.detalle_pedido WHERE id_pedido_dp = :idPedido ORDER BY {$campoOrd} ";
            if (!$ordAsc) $query .= "DESC ";

            $query .= "LIMIT :limit OFFSET :offset";

            $stmt = $conexPDO->prepare($query);
            $stmt->bindParam(':idPedido', $idPedido, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $cantElem, PDO::PARAM_INT);
            $stmt->bindValue(':offset', ($numPag - 1) * $cantElem, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            print("Error al acceder a BD" . $e->getMessage());
        }
    }
}

    public function getDetallePedidoId($id, $conexPDO)
    {
        if (isset($id) && is_numeric($id)) {
            if ($conexPDO != null) {
                try {
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.detalle_pedido WHERE iddetalle_pedido = ?");
                    $sentencia->bindParam(1, $id);
                    $sentencia->execute();
                    return $sentencia->fetchAll();  // Cambiado a fetchAll para recuperar todos los detalles
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }

    public function addDetallePedido($conexPDO, $idPedido, $idProducto, $cantidad, $precio, $precioSubtotal) {
        try {
            $sql = "INSERT INTO genesis.detalle_pedido (id_pedido_dp, id_producto_dp, cantidad, precio, precio_subtotal) VALUES (:id_pedido_dp, :id_producto_dp, :cantidad, :precio, :precio_subtotal)";
            $stmt = $conexPDO->prepare($sql);
            $stmt->bindParam(":id_pedido_dp", $idPedido);
            $stmt->bindParam(":id_producto_dp", $idProducto);
            $stmt->bindParam(":cantidad", $cantidad);
            $stmt->bindParam(":precio", $precio);
            $stmt->bindParam(":precio_subtotal", $precioSubtotal);
            $stmt->execute();
            return $conexPDO->lastInsertId();  // Esto ayudará a verificar si el insert realmente añadió un registro
        } catch (PDOException $e) {
            return "Error al insertar detalle: " . $e->getMessage();  // Más detalle sobre el error
        }
    }
}
