<?php

namespace model;

require_once("utils.php");

use \PDO;
use \PDOException;

class categoria
{

    /**Funcion que nos devuelve todas las categorias */
    public function getCategorias($conexPDO)
    {

        if ($conexPDO != null) {
            try {

                $sentencia = $conexPDO->prepare("SELECT * FROM genesis.categoria");
                //Ejecutamos la sentencia
                $sentencia->execute();

                //Devolvemos los datos del cliente
                return $sentencia->fetchAll();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }

    public function getCategoriaId($id, $conexPDO)
    {
        if (isset($id) && is_numeric($id)) {

            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.categoria where idcategoria=?");
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

    function addCategoria($categoria, $conexPDO)
    {
        $result = null;
        if (isset($categoria) && $conexPDO != null) {
            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO genesis.categoria (nombre_categoria) VALUES ( :nombre_categoria)");

                //Asociamos los valores a los parametros de la sentencia sql (A la izquierda el parámetro y a la derecha los valores como están en la base de datos)
                $sentencia->bindParam(":nombre_categoria", $categoria["nombre_categoria"]);
                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    public function delCategoria($idCategoria, $conexPDO)
    {
        if (!$this->verificarProductosCategoria($idCategoria, $conexPDO)) {
            try {
                $stmt = $conexPDO->prepare("DELETE FROM categoria WHERE id_categoria = :idCategoria");
                $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                // Manejo del error
                error_log("Error al eliminar categoría: " . $e->getMessage());
                return null;
            }
        } else {
            // Devuelve false si hay productos asociados a la categoría
            return false;
        }
    }


    function updateCategoria($categoria, $conexPDO)
    {
        $result = null;
        if (isset($categoria) && isset($categoria["idcategoria"]) && is_numeric($categoria["idcategoria"])  && $conexPDO != null) {
            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE genesis.categoria set nombre_categoria=:nombre_categoria  where idcategoria=:idcategoria");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idcategoria", $categoria["idcategoria"]);
                $sentencia->bindParam(":nombre_categoria", $categoria["nombre_categoria"]);

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    public function getCategoriasPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones

                //Query inicial
                $query = "SELECT * FROM genesis.categoria ORDER BY ? ";

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

    public function contarCategorias($conexPDO)
    {
        if ($conexPDO != null) {
            try {
                $sentencia = $conexPDO->prepare("SELECT COUNT(*) AS total FROM genesis.categoria");
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                return $resultado['total'];
            } catch (PDOException $e) {
                print("Error al contar categorias: " . $e->getMessage());
                return 0; // Devuelve 0 en caso de error
            }
        }
        return 0; // Si no hay conexión, retorna 0
    }

    public function verificarProductosCategoria($idCategoria, $conexPDO)
    {
        try {
            $stmt = $conexPDO->prepare("SELECT COUNT(*) as cantidad FROM producto WHERE id_categoria = :idCategoria");
            $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['cantidad'] > 0;
        } catch (PDOException $e) {
            // Manejo del error
            error_log("Error en consulta: " . $e->getMessage());
            return false;
        }
    }

    public function existeNombre($nombre, $conexPDO)
    {
        if ($conexPDO != null) {
            try {
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.categoria WHERE nombre_categoria = :nombre_categoria");
                $stmt->bindParam(':nombre_categoria', $nombre);
                $stmt->execute();
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                error_log("Error al verificar categoria: " . $e->getMessage());
                return false; // Considera cómo manejar los errores correctamente
            }
        }
        return false;
    }

    public function existeNombreM($nombre, $idcategoria, $conexPDO)
    {
        try {
            $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.categoria WHERE nombre_categoria = :nombre_categoria AND idcategoria <> :idcategoria");
            $stmt->bindParam(':nombre_categoria', $nombre);
            $stmt->bindParam(':idcategoria', $idcategoria);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Error al verificar categoria: " . $e->getMessage());
            return false;
        }
    }
}
