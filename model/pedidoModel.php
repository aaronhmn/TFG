<?php

namespace model;

require_once("utils.php");

use \PDO;
use \PDOException;

class pedido
{
    /**Funcion que nos devuelve todos los productos */
    public function getPedidos($conexPDO)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conexPDO->prepare("SELECT * FROM genesis.pedido");
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
     * Funcion que nos devuelve todos los productos con paginacion
     * */
    public function getPedidosPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones

                //Query inicial
                $query = "SELECT * FROM genesis.pedido ORDER BY ? ";

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

    public function getPedidoId($id, $conexPDO) {
        if (isset($id) && is_numeric($id)) {
            try {
                $stmt = $conexPDO->prepare("SELECT * FROM genesis.pedido WHERE idpedido = ?");
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);  // fetch() para obtener solo un registro
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
        return null; // Devuelve null si no hay datos o el id no es válido
    }

    public function addPedido($conexPDO, $idUsuario, $total)
    {
        $result = null;
        if ($conexPDO != null) {
            try {
                $sql = "INSERT INTO genesis.pedido (fecha_pedido, precio_total, id_usuario_pedido) VALUES (NOW(), :precio_total, :id_usuario_pedido)";
                $stmt = $conexPDO->prepare($sql);
                $stmt->bindParam(":precio_total", $total);
                $stmt->bindParam(":id_usuario_pedido", $idUsuario);
                $result = $stmt->execute();

                return $conexPDO->lastInsertId();  // Devuelve el ID del pedido creado
            } catch (PDOException $e) {
                print("Error al acceder a BD: " . $e->getMessage());
                return false;
            }
        }
        return $result;
    }
}
