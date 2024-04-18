<?php

namespace model;

require_once("utils.php");

use \PDO;
use \PDOException;

class categoria{

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

    function delCategoria($idCategoria, $conexPDO)
    {
        $result = null;
        if (isset($idCategoria) && is_numeric($idCategoria)) {
            if ($conexPDO != null) {
                try {
                    //Borramos el cliente asociado a dicho id
                    $sentencia = $conexPDO->prepare("DELETE  FROM genesis.categoria where idcategoria=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idCategoria);
                    //Ejecutamos la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }

        return $result;
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

}

?>