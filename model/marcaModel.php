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

}

?>