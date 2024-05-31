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
    if (isset($reseña) && $conexPDO != null) {
        try {
            // Si la valoración es null, significa que el usuario no ha valorado
            $valoracion = isset($reseña["valoracion"]) && $reseña["valoracion"] === 0 ? 0 : ($reseña["valoracion"] >= 1 && $reseña["valoracion"] <= 5 ? $reseña["valoracion"] : null);
            $sentencia = $conexPDO->prepare("INSERT INTO genesis.resena (fecha_resena, comentario, valoracion, id_producto_resena, id_usuario_resena) VALUES (:fecha_resena, :comentario, :valoracion, :id_producto_resena, :id_usuario_resena)");
            $sentencia->bindParam(":fecha_resena", $reseña["fecha_resena"]);
            $sentencia->bindParam(":comentario", $reseña["comentario"]);
            $sentencia->bindParam(":valoracion", $valoracion);
            $sentencia->bindParam(":id_producto_resena", $reseña["id_producto_resena"]);
            $sentencia->bindParam(":id_usuario_resena", $reseña["id_usuario_resena"]);
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

    public function getReseñasPorProductoId($idProducto, $conexPDO) {
        try {
            // Asegúrate de que el nombre de la columna ID en la tabla 'usuario' sea correcto
            // Aquí se asume que la columna se llama 'id' en la tabla 'usuario'
            $query = "SELECT r.*, u.nombre_usuario AS nombre_usuario 
                      FROM genesis.resena r 
                      INNER JOIN genesis.usuario u ON r.id_usuario_resena = u.idusuario
                      WHERE r.id_producto_resena = :idProducto";
            $sentencia = $conexPDO->prepare($query);
            $sentencia->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print("Error al acceder a BD: " . $e->getMessage());
            return [];
        }
    }

    public function getReseñasPorProductoIdPaginado($idProducto, $conexPDO, $start, $limit) {
        try {
            $query = "SELECT r.*, u.nombre_usuario AS nombre_usuario 
                      FROM genesis.resena r 
                      INNER JOIN genesis.usuario u ON r.id_usuario_resena = u.idusuario
                      WHERE r.id_producto_resena = :idProducto
                      LIMIT :start, :limit";
    
            $sentencia = $conexPDO->prepare($query);
            $sentencia->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
            $sentencia->bindParam(':start', $start, PDO::PARAM_INT);
            $sentencia->bindParam(':limit', $limit, PDO::PARAM_INT);
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print("Error al acceder a BD: " . $e->getMessage());
            return [];
        }
    }

    public function contarReseñasPorProducto($idProducto, $conexPDO) {
        try {
            $query = "SELECT COUNT(*) FROM genesis.resena WHERE id_producto_resena = :idProducto";
            $sentencia = $conexPDO->prepare($query);
            $sentencia->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
            $sentencia->execute();
            return $sentencia->fetchColumn();  // Devuelve el número total de reseñas para el producto
        } catch (PDOException $e) {
            print("Error al contar reseñas: " . $e->getMessage());
            return 0;
        }
    }

    public function calcularMediaValoraciones($idProducto, $conexPDO) {
        try {
            $query = "SELECT AVG(valoracion) AS mediaValoracion FROM genesis.resena WHERE id_producto_resena = :idProducto AND valoracion IS NOT NULL";
            $sentencia = $conexPDO->prepare($query);
            $sentencia->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado['mediaValoracion'] ?? 0; // Devuelve la media o 0 si no hay valoraciones
        } catch (PDOException $e) {
            print("Error al calcular la media de valoraciones: " . $e->getMessage());
            return 0;
        }
    }

    public function yaValorado($usuarioId, $idProducto, $conexPDO) {
        try {
            $query = "SELECT COUNT(*) FROM genesis.resena WHERE id_usuario_resena = :usuarioId AND id_producto_resena = :idProducto";
            $stmt = $conexPDO->prepare($query);
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->bindParam(':idProducto', $idProducto);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            return false; // En caso de error, considerar que no hay reseñas previas
        }
    }

    public function obtenerDetalleReseña($usuarioId, $idProducto, $conexPDO) {
        try {
            $query = "SELECT comentario, valoracion FROM genesis.resena WHERE id_usuario_resena = :usuarioId AND id_producto_resena = :idProducto LIMIT 1";
            $stmt = $conexPDO->prepare($query);
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->bindParam(':idProducto', $idProducto);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null; // En caso de error
        }
    }

    function addOrUpdateReseña($reseña, $conexPDO) {
        $detalleReseñaExistente = $this->obtenerDetalleReseña($reseña['id_usuario_resena'], $reseña['id_producto_resena'], $conexPDO);
        if ($detalleReseñaExistente) {
            // Si ya existe una reseña, se actualiza
            $sql = "UPDATE genesis.resena SET comentario = COALESCE(:comentario, comentario), valoracion = COALESCE(:valoracion, valoracion) WHERE id_usuario_resena = :id_usuario_resena AND id_producto_resena = :id_producto_resena";
        } else {
            // Si no existe, se inserta una nueva reseña
            $sql = "INSERT INTO genesis.resena (fecha_resena, comentario, valoracion, id_producto_resena, id_usuario_resena) VALUES (:fecha_resena, :comentario, :valoracion, :id_producto_resena, :id_usuario_resena)";
        }
        try {
            $stmt = $conexPDO->prepare($sql);
            $stmt->bindParam(':fecha_resena', $reseña['fecha_resena']);
            $stmt->bindParam(':comentario', $reseña['comentario']);
            $stmt->bindParam(':valoracion', $reseña['valoracion']);
            $stmt->bindParam(':id_producto_resena', $reseña['id_producto_resena']);
            $stmt->bindParam(':id_usuario_resena', $reseña['id_usuario_resena']);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
