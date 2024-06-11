<?php

namespace model;

require_once("utils.php"); // Incluir el archivo utils.php que posiblemente contenga funciones auxiliares.

use \PDO; // Usar la clase PDO para la conexión con la base de datos.
use \PDOException; // Usar la clase PDOException para manejar excepciones relacionadas con PDO.

class marca
{
    /** Función que devuelve todas las marcas */
    public function getMarcas($conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la sentencia SQL para seleccionar todas las marcas
                $sentencia = $conexPDO->prepare("SELECT * FROM genesis.marca");
                // Ejecuta la sentencia
                $sentencia->execute();
                // Devuelve los resultados de la consulta
                return $sentencia->fetchAll();
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }

    /** Función que devuelve una marca por su ID */
    public function getMarcaId($id, $conexPDO)
    {
        // Verifica si el ID es válido
        if (isset($id) && is_numeric($id)) {
            // Verifica si la conexión no es nula
            if ($conexPDO != null) {
                try {
                    // Prepara la sentencia SQL para seleccionar una marca por su ID
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.marca WHERE idmarca = ?");
                    // Asocia el ID a la sentencia
                    $sentencia->bindParam(1, $id);
                    // Ejecuta la sentencia
                    $sentencia->execute();
                    // Devuelve el resultado de la consulta
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    // Maneja y muestra el error si ocurre una excepción
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }

    /** Función para agregar una nueva marca */
    function addMarca($marca, $conexPDO)
    {
        $result = null;
        // Verifica si la marca y la conexión no son nulas
        if (isset($marca) && $conexPDO != null) {
            try {
                // Prepara la sentencia SQL para insertar una nueva marca
                $sentencia = $conexPDO->prepare("INSERT INTO genesis.marca (nombre_marca) VALUES (:nombre_marca)");
                // Asocia el nombre de la marca al parámetro de la sentencia SQL
                $sentencia->bindParam(":nombre_marca", $marca["nombre_marca"]);
                // Ejecuta la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
        // Devuelve el resultado de la operación (true si fue exitosa, false o null si no)
        return $result;
    }

    /** Función para eliminar una marca, verificando primero si no hay productos asociados */
    public function delMarca($idMarca, $conexPDO)
    {
        // Verifica si no hay productos asociados a la marca
        if (!$this->verificarProductosMarca($idMarca, $conexPDO)) {
            try {
                // Prepara la sentencia SQL para eliminar la marca
                $stmt = $conexPDO->prepare("DELETE FROM marca WHERE id_marca = :idMarca");
                // Asocia el ID de la marca al parámetro de la sentencia
                $stmt->bindParam(':idMarca', $idMarca, PDO::PARAM_INT);
                // Ejecuta la sentencia y devuelve el resultado
                return $stmt->execute();
            } catch (PDOException $e) {
                // Maneja el error y registra el mensaje en el log
                error_log("Error al eliminar marca: " . $e->getMessage());
                return null;
            }
        } else {
            // Devuelve false si hay productos asociados a la marca
            return false;
        }
    }

    /** Función para actualizar una marca existente */
    function updateMarca($marca, $conexPDO)
    {
        $result = null;
        // Verifica si la marca y su ID son válidos, y que la conexión no es nula
        if (isset($marca) && isset($marca["idmarca"]) && is_numeric($marca["idmarca"]) && $conexPDO != null) {
            try {
                // Prepara la sentencia SQL para actualizar una marca en la base de datos
                $sentencia = $conexPDO->prepare("UPDATE genesis.marca SET nombre_marca = :nombre_marca WHERE idmarca = :idmarca");
                // Asocia los valores a los parámetros de la sentencia SQL
                $sentencia->bindParam(":idmarca", $marca["idmarca"]);
                $sentencia->bindParam(":nombre_marca", $marca["nombre_marca"]);
                // Ejecuta la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
        // Devuelve el resultado de la operación (true si fue exitosa, false o null si no)
        return $result;
    }

    /** Función que devuelve las marcas con paginación */
    public function getMarcasPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la sentencia SQL base para obtener las marcas, ordenadas según un campo específico
                $query = "SELECT * FROM genesis.marca ORDER BY ? ";
                // Si el orden es descendente, añade DESC al final de la consulta
                if (!$ordAsc) $query .= "DESC ";
                // Añade los límites y el offset a la consulta para la paginación
                $query .= "LIMIT ? OFFSET ?";
                // Prepara la consulta SQL en la conexión a la base de datos
                $sentencia = $conexPDO->prepare($query);
                // Vincula el campo por el cual se ordenará como primer parámetro
                $sentencia->bindParam(1, $campoOrd);
                // Vincula la cantidad de elementos por página como segundo parámetro
                $sentencia->bindParam(2, $cantElem, PDO::PARAM_INT);
                // Calcula el offset basado en el número de página
                $offset = ($numPag - 1) * $cantElem;
                if ($numPag != 1) $offset++;
                // Vincula el offset como tercer parámetro
                $sentencia->bindParam(3, $offset, PDO::PARAM_INT);
                // Ejecuta la sentencia preparada
                $sentencia->execute();
                // Devuelve los resultados de la consulta
                return $sentencia->fetchAll();
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }

    /** Función para contar el total de marcas */
    public function contarMarcas($conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara una sentencia SQL para contar el total de marcas
                $sentencia = $conexPDO->prepare("SELECT COUNT(*) AS total FROM genesis.marca");
                // Ejecuta la sentencia
                $sentencia->execute();
                // Obtiene y retorna el resultado de la consulta
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                return $resultado['total'];
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al contar marcas: " . $e->getMessage());
                return 0; // Devuelve 0 en caso de error
            }
        }
        // Retorna 0 si la conexión es nula
        return 0;
    }

    /** Función para verificar si existen productos asociados con una marca */
    public function verificarProductosMarca($idMarca, $conexPDO)
    {
        try {
            // Prepara una sentencia SQL para contar los productos asociados a una marca específica
            $stmt = $conexPDO->prepare("SELECT COUNT(*) as cantidad FROM producto WHERE id_marca = :idMarca");
            // Asocia el ID de la marca al parámetro de la sentencia
            $stmt->bindParam(':idMarca', $idMarca, PDO::PARAM_INT);
            // Ejecuta la sentencia
            $stmt->execute();
            // Obtiene y retorna el resultado de la consulta
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['cantidad'] > 0;
        } catch (PDOException $e) {
            // Maneja y registra el error en el log
            error_log("Error en consulta: " . $e->getMessage());
            return false;
        }
    }

    /** Función para verificar si existe una marca por su nombre */
    public function existeNombre($nombre, $conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara una sentencia SQL para contar las marcas con un nombre específico
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.marca WHERE nombre_marca = :nombre_marca");
                // Asocia el nombre de la marca al parámetro de la sentencia
                $stmt->bindParam(':nombre_marca', $nombre);
                // Ejecuta la sentencia
                $stmt->execute();
                // Retorna true si existe al menos una marca con ese nombre, false de lo contrario
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                // Maneja y registra el error en el log
                error_log("Error al verificar marca: " . $e->getMessage());
                return false;
            }
        }
        // Retorna false si la conexión es nula
        return false;
    }

    /** Función para verificar si existe una marca por su nombre, excluyendo un ID de marca específico */
    public function existeNombreM($nombre, $idmarca, $conexPDO)
    {
        try {
            // Prepara una sentencia SQL para contar las marcas con un nombre específico, excluyendo un ID de marca dado
            $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.marca WHERE nombre_marca = :nombre_marca AND idmarca <> :idmarca");
            // Asocia el nombre de la marca y el ID de la marca a los parámetros de la sentencia
            $stmt->bindParam(':nombre_marca', $nombre);
            $stmt->bindParam(':idmarca', $idmarca);
            // Ejecuta la sentencia
            $stmt->execute();
            // Retorna true si existe al menos una marca con ese nombre, excluyendo el ID especificado, false de lo contrario
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            // Maneja y registra el error en el log
            error_log("Error al verificar marca: " . $e->getMessage());
            return false;
        }
    }
}
