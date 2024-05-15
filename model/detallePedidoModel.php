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
    public function getDetallesPedidosPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {

        if ($conexPDO != null) {
            try {
                //Query inicial
                $query = "SELECT * FROM genesis.detalle_pedido ORDER BY ? ";

                //si esta ordenada descentemente añadimos DESC
                if (!$ordAsc) $query = $query . "DESC ";

                //Añadimos a la query la cantidad de elementos por página con LIMIT
                //Y desde que página empieza con OFFSET
                $query = $query . "LIMIT ? OFFSET ?";

                $sentencia = $conexPDO->prepare($query);
                //el primer parametro es el campo a ordenar
                $sentencia->bindParam(1, $campoOrd);
                //El segundo parametro es la cantidad de elementos por pagina
                $sentencia->bindParam(2, $cantElem, PDO::PARAM_INT);
                //El tercer parametro es desde que registro empieza a partir de la
                //pagina actual
                $offset = ($numPag - 1) * $cantElem;
                if ($numPag != 1)
                    $offset++;

                $sentencia->bindParam(3, $offset, PDO::PARAM_INT);

                //Ejecutamos la sentencia
                $sentencia->execute();

                //Devolvemos los datos del cliente
                return $sentencia->fetchAll();
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

    public function addDetallePedido($conexPDO, $idPedido, $idProducto, $cantidad, $precio)
    {
        if ($conexPDO != null) {
            try {
                $sql = "INSERT INTO genesis.detalle_pedido (id_pedido_dp, id_producto_dp, cantidad, precio) VALUES (:id_pedido_dp, :id_producto_dp, :cantidad, :precio)";
                $stmt = $conexPDO->prepare($sql);
                $stmt->bindParam(":id_pedido_dp", $idPedido);
                $stmt->bindParam(":id_producto_dp", $idProducto);
                $stmt->bindParam(":cantidad", $cantidad);
                $stmt->bindParam(":precio", $precio);
                $stmt->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD: " . $e->getMessage());
            }
        }
    }
}
