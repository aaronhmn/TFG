<?php

namespace model;

require_once("utils.php");

use \PDO;
use \PDOException;

class marca{

     /**Funcion que nos devuelve todas las categorias */
     public function getMarcas($conexPDO)
     {
 
         if ($conexPDO != null) {
             try {
 
                 $sentencia = $conexPDO->prepare("SELECT * FROM genesis.marca");
                 //Ejecutamos la sentencia
                 $sentencia->execute();
 
                 //Devolvemos los datos del cliente
                 return $sentencia->fetchAll();
             } catch (PDOException $e) {
                 print("Error al acceder a BD" . $e->getMessage());
             }
         }
     }
 
     public function getMarcaId($id, $conexPDO)
     {
         if (isset($id) && is_numeric($id)) {
 
             if ($conexPDO != null) {
                 try {
                     //Primero introducimos la sentencia a ejecutar con prepare
                     //Ponemos en lugar de valores directamente, interrogaciones
                     $sentencia = $conexPDO->prepare("SELECT * FROM genesis.marca where idmarca=?");
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
 
     function addMarca($marca, $conexPDO)
     {
         $result = null;
         if (isset($marca) && $conexPDO != null) {
             try {
                 //Preparamos la sentencia
                 $sentencia = $conexPDO->prepare("INSERT INTO genesis.marca (nombre_marca) VALUES ( :nombre_marca)");
 
                 //Asociamos los valores a los parametros de la sentencia sql (A la izquierda el parámetro y a la derecha los valores como están en la base de datos)
                 $sentencia->bindParam(":nombre_marca", $marca["nombre_marca"]);
                 //Ejecutamos la sentencia
                 $result = $sentencia->execute();
             } catch (PDOException $e) {
                 print("Error al acceder a BD" . $e->getMessage());
             }
         }
 
         return $result;
     }
 
     function delMarca($idMarca, $conexPDO)
     {
         $result = null;
         if (isset($idMarca) && is_numeric($idMarca)) {
             if ($conexPDO != null) {
                 try {
                     //Borramos el cliente asociado a dicho id
                     $sentencia = $conexPDO->prepare("DELETE  FROM genesis.marca where idmarca=?");
                     //Asociamos a cada interrogacion el valor que queremos en su lugar
                     $sentencia->bindParam(1, $idMarca);
                     //Ejecutamos la sentencia
                     $result = $sentencia->execute();
                 } catch (PDOException $e) {
                     print("Error al borrar" . $e->getMessage());
                 }
             }
         }
 
         return $result;
     }
 
 
     function updateMarca($marca, $conexPDO)
     {
         $result = null;
         if (isset($marca) && isset($marca["idmarca"]) && is_numeric($marca["idmarca"])  && $conexPDO != null) {
             try {
                 //Preparamos la sentencia
                 $sentencia = $conexPDO->prepare("UPDATE genesis.marca set nombre_marca=:nombre_marca  where idmarca=:idmarca");
 
                 //Asociamos los valores a los parametros de la sentencia sql
                 $sentencia->bindParam(":idmarca", $marca["idmarca"]);
                 $sentencia->bindParam(":nombre_marca", $marca["nombre_marca"]);
 
                 //Ejecutamos la sentencia
                 $result = $sentencia->execute();
             } catch (PDOException $e) {
                 print("Error al acceder a BD" . $e->getMessage());
             }
         }
 
         return $result;
     }

     public function getMarcasPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones

                //Query inicial
                $query = "SELECT * FROM genesis.marca ORDER BY ? ";

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

    public function contarMarcas($conexPDO) {
        if ($conexPDO != null) {
            try {
                $sentencia = $conexPDO->prepare("SELECT COUNT(*) AS total FROM genesis.marca");
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                return $resultado['total'];
            } catch (PDOException $e) {
                print("Error al contar marcas: " . $e->getMessage());
                return 0; // Devuelve 0 en caso de error
            }
        }
        return 0; // Si no hay conexión, retorna 0
    }

}

?>