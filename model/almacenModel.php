<?php

namespace model;

require_once("utils.php");

use \PDO;
use \PDOException;

class almacen{

     /**Funcion que nos devuelve todas las categorias */
     public function getAlmacenes($conexPDO)
     {
 
         if ($conexPDO != null) {
             try {
 
                 $sentencia = $conexPDO->prepare("SELECT * FROM genesis.almacen");
                 //Ejecutamos la sentencia
                 $sentencia->execute();
 
                 //Devolvemos los datos del cliente
                 return $sentencia->fetchAll();
             } catch (PDOException $e) {
                 print("Error al acceder a BD" . $e->getMessage());
             }
         }
     }
 
     public function getAlmacenId($id, $conexPDO)
     {
         if (isset($id) && is_numeric($id)) {
 
             if ($conexPDO != null) {
                 try {
                     //Primero introducimos la sentencia a ejecutar con prepare
                     //Ponemos en lugar de valores directamente, interrogaciones
                     $sentencia = $conexPDO->prepare("SELECT * FROM genesis.almacen where idalmacen=?");
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
 
     function addAlmacen($almacen, $conexPDO)
     {
         $result = null;
         if (isset($almacen) && $conexPDO != null) {
             try {
                 //Preparamos la sentencia
                 $sentencia = $conexPDO->prepare("INSERT INTO genesis.almacen (nombre, telefono, codigo_postal, calle, numero_bloque, piso) VALUES ( :nombre, :telefono, :codigo_postal, :calle, :numero_bloque, :piso)");
 
                 //Asociamos los valores a los parametros de la sentencia sql (A la izquierda el parámetro y a la derecha los valores como están en la base de datos)
                 $sentencia->bindParam(":nombre", $almacen["nombre"]);
                 $sentencia->bindParam(":telefono", $almacen["telefono"]);
                 $sentencia->bindParam(":codigo_postal", $almacen["codigo_postal"]);
                 $sentencia->bindParam(":calle", $almacen["calle"]);
                 $sentencia->bindParam(":numero_bloque", $almacen["numero_bloque"]);
                 $sentencia->bindParam(":piso", $almacen["piso"]);
                 //Ejecutamos la sentencia
                 $result = $sentencia->execute();
             } catch (PDOException $e) {
                 print("Error al acceder a BD" . $e->getMessage());
             }
         }
 
         return $result;
     }
 
     public function delAlmacen($idAlmacen, $conexPDO) {
        if (!$this->verificarProductosAlmacen($idAlmacen, $conexPDO)) {
            try {
                $stmt = $conexPDO->prepare("DELETE FROM almacen WHERE idalmacen = :idAlmacen");
                $stmt->bindParam(':idAlmacen', $idAlmacen, PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                // Manejo del error
                error_log("Error al eliminar almacen: " . $e->getMessage());
                return null;
            }
        } else {
            // Devuelve false si hay productos asociados a la marca
            return false;
        }
    }
 
 
     function updateAlmacen($almacen, $conexPDO)
     {
         $result = null;
         if (isset($almacen) && isset($almacen["idalmacen"]) && is_numeric($almacen["idalmacen"])  && $conexPDO != null) {
             try {
                 //Preparamos la sentencia
                 $sentencia = $conexPDO->prepare("UPDATE genesis.almacen set nombre=:nombre, telefono=:telefono, codigo_postal=:codigo_postal, calle=:calle, numero_bloque=:numero_bloque, piso=:piso  where idalmacen=:idalmacen");
 
                 //Asociamos los valores a los parametros de la sentencia sql
                 $sentencia->bindParam(":idalmacen", $almacen["idalmacen"]);
                 $sentencia->bindParam(":nombre", $almacen["nombre"]);
                 $sentencia->bindParam(":telefono", $almacen["telefono"]);
                 $sentencia->bindParam(":codigo_postal", $almacen["codigo_postal"]);
                 $sentencia->bindParam(":calle", $almacen["calle"]);
                 $sentencia->bindParam(":numero_bloque", $almacen["numero_bloque"]);
                 $sentencia->bindParam(":piso", $almacen["piso"]);
 
                 //Ejecutamos la sentencia
                 $result = $sentencia->execute();
             } catch (PDOException $e) {
                 print("Error al acceder a BD" . $e->getMessage());
             }
         }
 
         return $result;
     }

     public function getAlmacenesPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones

                //Query inicial
                $query = "SELECT * FROM genesis.almacen ORDER BY ? ";

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

    public function contarAlmacenes($conexPDO) {
        if ($conexPDO != null) {
            try {
                $sentencia = $conexPDO->prepare("SELECT COUNT(*) AS total FROM genesis.almacen");
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                return $resultado['total'];
            } catch (PDOException $e) {
                print("Error al contar almacenes: " . $e->getMessage());
                return 0; // Devuelve 0 en caso de error
            }
        }
        return 0; // Si no hay conexión, retorna 0
    }

    // Función para verificar si existen productos asociados con una marca
    public function verificarProductosAlmacen($idAlmacen, $conexPDO) {
        try {
            $stmt = $conexPDO->prepare("SELECT COUNT(*) as cantidad FROM producto WHERE id_almacen = :idAlmacen");
            $stmt->bindParam(':idAlmacen', $idAlmacen, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['cantidad'] > 0;
        } catch (PDOException $e) {
            // Manejo del error
            error_log("Error en consulta: " . $e->getMessage());
            return false;
        }
    }

    public function existeNombreAlmacen($nombreAlmacen, $conexPDO) {
        if ($conexPDO != null) {
            try {
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.almacen WHERE nombre = :nombre");
                $stmt->bindParam(':nombre', $nombreAlmacen);
                $stmt->execute();
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                error_log("Error al verificar nombre: " . $e->getMessage());
                return false; // Considera cómo manejar los errores correctamente
            }
        }
        return false;
    }

    public function existeTelefono($telefono, $conexPDO) {
        if ($conexPDO != null) {
            try {
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.almacen WHERE telefono = :telefono");
                $stmt->bindParam(':telefono', $telefono);
                $stmt->execute();
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                error_log("Error al verificar telefono: " . $e->getMessage());
                return false; // Considera cómo manejar los errores correctamente
            }
        }
        return false;
    }

    public function existeNombreAlmacenM($nombreAlmacen, $idalmacen, $conexPDO) {
        try {
            $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.almacen WHERE nombre = :nombre AND idalmacen <> :idalmacen");
            $stmt->bindParam(':nombre', $nombreAlmacen);
            $stmt->bindParam(':idalmacen', $idalmacen);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Error al verificar nombre: " . $e->getMessage());
            return false;
        }
    }

    public function existeTelefonoM($telefono, $idalmacen, $conexPDO) {
        try {
            $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.almacen WHERE telefono = :telefono AND idalmacen <> :idalmacen");
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':idalmacen', $idalmacen);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Error al verificar telefono: " . $e->getMessage());
            return false;
        }
    }

    public function existeDireccionEnCodigoPostal($calle, $numeroBloque, $codigoPostal, $conexPDO) {
        if ($conexPDO != null) {
            try {
                // Preparar la sentencia SQL para verificar la existencia de la dirección en el código postal especificado
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.almacen WHERE calle = :calle AND numero_bloque = :numero_bloque AND codigo_postal = :codigo_postal");
    
                // Asociar los parámetros a la consulta
                $stmt->bindParam(':calle', $calle);
                $stmt->bindParam(':numero_bloque', $numeroBloque, PDO::PARAM_INT);
                $stmt->bindParam(':codigo_postal', $codigoPostal);
    
                // Ejecutar la sentencia
                $stmt->execute();
    
                // Devolver true si se encuentra al menos un registro, false en caso contrario
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                // Logear y manejar el error
                error_log("Error al verificar dirección en código postal: " . $e->getMessage());
                return false;
            }
        }
        return false; // Retornar false si no hay conexión a la base de datos
    }

    public function existeDireccionEnCodigoPostalM($calle, $numeroBloque, $codigoPostal, $idalmacen, $conexPDO) {
        if ($conexPDO != null) {
            try {
                // Preparar la sentencia SQL para verificar la existencia de la dirección en el código postal especificado, excluyendo un id de almacén específico
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.almacen WHERE calle = :calle AND numero_bloque = :numeroBloque AND codigo_postal = :codigoPostal AND idalmacen <> :idalmacen");
    
                // Asociar los parámetros a la consulta
                $stmt->bindParam(':calle', $calle);
                $stmt->bindParam(':numeroBloque', $numeroBloque, PDO::PARAM_INT);
                $stmt->bindParam(':codigoPostal', $codigoPostal);
                $stmt->bindParam(':idalmacen', $idalmacen, PDO::PARAM_INT);
    
                // Ejecutar la sentencia
                $stmt->execute();
    
                // Devolver true si se encuentra al menos un registro, false en caso contrario
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                // Logear y manejar el error
                error_log("Error al verificar dirección en código postal excluyendo un almacén específico: " . $e->getMessage());
                return false;
            }
        }
        return false; // Retornar false si no hay conexión a la base de datos
    }

}

?>