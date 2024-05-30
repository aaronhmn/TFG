<?php

namespace model;

require_once("utils.php");

use \PDO;
use \PDOException;

class reseña
{
    /**Funcion que nos devuelve todos los productos */
    public function getReseñas($conexPDO)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conexPDO->prepare("SELECT * FROM genesis.resena");
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
    public function getReseñasPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones

                //Query inicial
                $query = "SELECT * FROM genesis.resena ORDER BY ? ";

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

    public function getReseñaId($id, $conexPDO)
    {
        if (isset($id) && is_numeric($id)) {

            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.resena where idresena=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $id);
                    //Ejecutamos la sentencia
                    $sentencia->execute();

                    //Devolvemos los datos del cliente
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }

    function addReseña($reseña, $conexPDO)
    {
        $result = null;
        if (isset($reseña) && $conexPDO != null) {
            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO genesis.resena (fecha_resena, comentario, valoracion, id_producto_resena, id_usuario_resena) VALUES ( :fecha_resena, :comentario, :valoracion, :id_producto_resena, :id_usuario_resena)");

                //Asociamos los valores a los parametros de la sentencia sql (A la izquierda el parámetro y a la derecha los valores como están en la base de datos)
                $sentencia->bindParam(":fecha_resena", $reseña["fecha_resena"]);
                $sentencia->bindParam(":comentario", $reseña["comentario"]);
                $sentencia->bindParam(":valoracion", $reseña["valoracion"]);
                $sentencia->bindParam(":id_producto_resena", $reseña["id_producto_resena"]);
                $sentencia->bindParam(":id_usuario_resena", $reseña["id_usuario_resena"]);
                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    public function contarReseñas($conexPDO) {
        if ($conexPDO != null) {
            try {
                $sentencia = $conexPDO->prepare("SELECT COUNT(*) AS total FROM genesis.resena");
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                return $resultado['total'];
            } catch (PDOException $e) {
                print("Error al contar reseñas: " . $e->getMessage());
                return 0; // Devuelve 0 en caso de error
            }
        }
        return 0; // Si no hay conexión, retorna 0
    }

    public function getReseñasPorUsuario($usuarioId, $conexPDO, $pagina = 1, $registrosPorPagina = 10) {
        $inicio = ($pagina - 1) * $registrosPorPagina;
        try {
            $sentencia = $conexPDO->prepare("SELECT * FROM genesis.resena WHERE id_usuario_resena = ? LIMIT ?, ?");
            $sentencia->bindParam(1, $usuarioId, PDO::PARAM_INT);
            $sentencia->bindParam(2, $inicio, PDO::PARAM_INT);
            $sentencia->bindParam(3, $registrosPorPagina, PDO::PARAM_INT);
            $sentencia->execute();
            return $sentencia->fetchAll();
        } catch (PDOException $e) {
            print("Error al acceder a BD" . $e->getMessage());
            return [];  // Devuelve un arreglo vacío en caso de error
        }
    }

    public function contarReseñasPorUsuario($usuarioId, $conexPDO) {
        try {
            $sentencia = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.resena WHERE id_usuario_resena = ?");
            $sentencia->bindParam(1, $usuarioId, PDO::PARAM_INT);
            $sentencia->execute();
            return $sentencia->fetchColumn();
        } catch (PDOException $e) {
            print("Error al contar reseñas: " . $e->getMessage());
            return 0;
        }
    }
}
