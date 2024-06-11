<?php
// Inicio del código PHP.

namespace model;
// Define el espacio de nombres 'model' para organizar el código.

require_once("utils.php");
// Incluye el archivo 'utils.php' una sola vez en la ejecución.

use \PDO;
use \PDOException;
// Importa las clases PDO y PDOException para el manejo de la base de datos y excepciones relacionadas.

class almacen
// Define una clase llamada 'almacen'.

{
    /**Funcion que nos devuelve todas las categorias */
    public function getAlmacenes($conexPDO)
    // Define un método para obtener todos los almacenes de la base de datos.

    {
        if ($conexPDO != null) {
            try {
                $sentencia = $conexPDO->prepare("SELECT * FROM genesis.almacen");
                // Prepara una consulta SQL para seleccionar todos los registros de la tabla 'almacen'.

                $sentencia->execute();
                // Ejecuta la consulta preparada.

                return $sentencia->fetchAll();
                // Retorna todos los resultados de la consulta.
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
                // Captura y maneja excepciones de errores en la conexión a la base de datos.
            }
        }
    }

    public function getAlmacenId($id, $conexPDO)
    // Define un método para obtener un almacén específico por su ID.

    {
        if (isset($id) && is_numeric($id)) {
            // Verifica que el ID esté establecido y sea numérico.

            if ($conexPDO != null) {
                try {
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.almacen where idalmacen=?");
                    // Prepara una consulta SQL con un parámetro para filtrar por 'idalmacen'.

                    $sentencia->bindParam(1, $id);
                    // Asocia el valor del ID al parámetro de la consulta.

                    $sentencia->execute();
                    // Ejecuta la consulta preparada.

                    return $sentencia->fetch();
                    // Retorna el primer resultado de la consulta.
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                    // Captura y maneja excepciones de errores en la conexión a la base de datos.
                }
            }
        }
    }

    function addAlmacen($almacen, $conexPDO)
    // Define un método para agregar un nuevo almacén a la base de datos.

    {
        $result = null;
        if (isset($almacen) && $conexPDO != null) {
            try {
                $sentencia = $conexPDO->prepare("INSERT INTO genesis.almacen (nombre, telefono, codigo_postal, calle, numero_bloque, piso) VALUES ( :nombre, :telefono, :codigo_postal, :calle, :numero_bloque, :piso)");
                // Prepara una consulta SQL para insertar un nuevo registro en la tabla 'almacen' con múltiples parámetros.

                // Asocia cada valor del array '$almacen' a los parámetros de la consulta.
                $sentencia->bindParam(":nombre", $almacen["nombre"]);
                $sentencia->bindParam(":telefono", $almacen["telefono"]);
                $sentencia->bindParam(":codigo_postal", $almacen["codigo_postal"]);
                $sentencia->bindParam(":calle", $almacen["calle"]);
                $sentencia->bindParam(":numero_bloque", $almacen["numero_bloque"]);
                $sentencia->bindParam(":piso", $almacen["piso"]);

                $result = $sentencia->execute();
                // Ejecuta la consulta y guarda el resultado (éxito o fracaso).
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
                // Captura y maneja excepciones de errores en la conexión a la base de datos.
            }
        }

        return $result;
        // Retorna el resultado de la ejecución de la consulta.
    }

    public function delAlmacen($idAlmacen, $conexPDO)
    {
        if (!$this->verificarProductosAlmacen($idAlmacen, $conexPDO)) {
            // Verifica si el almacén no tiene productos asociados antes de intentar eliminarlo.
            try {
                $stmt = $conexPDO->prepare("DELETE FROM almacen WHERE idalmacen = :idAlmacen");
                // Prepara una consulta SQL para eliminar un almacén por ID.

                $stmt->bindParam(':idAlmacen', $idAlmacen, PDO::PARAM_INT);
                // Asocia el ID del almacén al parámetro de la consulta.

                return $stmt->execute();
                // Ejecuta la consulta y retorna el resultado (éxito o fracaso).
            } catch (PDOException $e) {
                // Manejo del error
                error_log("Error al eliminar almacen: " . $e->getMessage());
                return null;
                // Captura y maneja excepciones, retornando null en caso de error.
            }
        } else {
            // Devuelve false si hay productos asociados al almacén.
            return false;
        }
    }

    function updateAlmacen($almacen, $conexPDO)
    {
        $result = null;  // Inicializa la variable result a null, que almacenará el resultado de la ejecución de la sentencia.
        if (isset($almacen) && isset($almacen["idalmacen"]) && is_numeric($almacen["idalmacen"])  && $conexPDO != null) {
            // Verifica que el array almacen y el idalmacen están establecidos y que idalmacen es numérico y que conexPDO no es null.
            try {
                $sentencia = $conexPDO->prepare("UPDATE genesis.almacen set nombre=:nombre, telefono=:telefono, codigo_postal=:codigo_postal, calle=:calle, numero_bloque=:numero_bloque, piso=:piso  where idalmacen=:idalmacen");
                // Prepara una sentencia SQL para actualizar los datos de un almacén.

                // Asociación de los valores de $almacen a los marcadores en la sentencia SQL.
                $sentencia->bindParam(":idalmacen", $almacen["idalmacen"]);
                $sentencia->bindParam(":nombre", $almacen["nombre"]);
                $sentencia->bindParam(":telefono", $almacen["telefono"]);
                $sentencia->bindParam(":codigo_postal", $almacen["codigo_postal"]);
                $sentencia->bindParam(":calle", $almacen["calle"]);
                $sentencia->bindParam(":numero_bloque", $almacen["numero_bloque"]);
                $sentencia->bindParam(":piso", $almacen["piso"]);

                $result = $sentencia->execute();  // Ejecuta la sentencia y guarda el resultado.
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());  // Captura y maneja cualquier excepción relacionada con la base de datos.
            }
        }

        return $result;  // Devuelve el resultado de la operación de actualización.
    }

    public function getAlmacenesPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {
        // Verificar si la conexión a la base de datos es nula
        if ($conexPDO != null) {
            try {
                // Preparar la consulta SQL básica para obtener los almacenes, ordenados según un campo específico
                $query = "SELECT * FROM genesis.almacen ORDER BY ? ";

                // Si el orden es descendente, añadir DESC al final de la consulta
                if (!$ordAsc) $query .= "DESC ";

                // Añadir límites y offset a la consulta para gestionar la paginación
                $query .= "LIMIT ? OFFSET ?";

                // Preparar la consulta SQL en la conexión a la base de datos
                $sentencia = $conexPDO->prepare($query);

                // Vincular el campo por el cual se ordenará como primer parámetro
                $sentencia->bindParam(1, $campoOrd);
                // Vincular la cantidad de elementos por página como segundo parámetro
                $sentencia->bindParam(2, $cantElem, PDO::PARAM_INT);
                // Calcular el offset basado en el número de página
                $offset = ($numPag - 1) * $cantElem;
                if ($numPag != 1) $offset++;

                // Vincular el offset como tercer parámetro
                $sentencia->bindParam(3, $offset, PDO::PARAM_INT);

                // Ejecutar la sentencia preparada
                $sentencia->execute();

                // Devolver los resultados de la consulta
                return $sentencia->fetchAll();
            } catch (PDOException $e) {
                // Imprimir mensaje de error si ocurre una excepción
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }

    public function contarAlmacenes($conexPDO)
    {
        // Verificar si la conexión a la base de datos no es nula
        if ($conexPDO != null) {
            try {
                // Preparar la consulta SQL para contar el total de almacenes
                $sentencia = $conexPDO->prepare("SELECT COUNT(*) AS total FROM genesis.almacen");
                // Ejecutar la consulta
                $sentencia->execute();
                // Obtener y retornar el resultado de la consulta
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                return $resultado['total'];
            } catch (PDOException $e) {
                // Imprimir mensaje de error y retornar 0 en caso de excepción
                print("Error al contar almacenes: " . $e->getMessage());
                return 0;
            }
        }
        // Retornar 0 si la conexión es nula
        return 0;
    }

    // Función para verificar si existen productos asociados con una marca
    public function verificarProductosAlmacen($idAlmacen, $conexPDO)
    {
        try {
            // Prepara una sentencia SQL para contar los productos en un almacén específico
            $stmt = $conexPDO->prepare("SELECT COUNT(*) as cantidad FROM producto WHERE id_almacen = :idAlmacen");
            // Asigna el valor de idAlmacen a la consulta preparada
            $stmt->bindParam(':idAlmacen', $idAlmacen, PDO::PARAM_INT);
            // Ejecuta la sentencia preparada
            $stmt->execute();
            // Recupera el resultado de la consulta
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            // Devuelve true si hay al menos un producto, false de lo contrario
            return $resultado['cantidad'] > 0;
        } catch (PDOException $e) {
            // Registra el error en el log en caso de excepción
            error_log("Error en consulta: " . $e->getMessage());
            // Retorna false si ocurre un error
            return false;
        }
    }

    public function existeNombreAlmacen($nombreAlmacen, $conexPDO)
    {
        // Verifica que la conexión no sea nula
        if ($conexPDO != null) {
            try {
                // Prepara una consulta SQL para contar los almacenes con un nombre específico
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.almacen WHERE nombre = :nombre");
                // Asocia el nombre del almacén a la consulta preparada
                $stmt->bindParam(':nombre', $nombreAlmacen);
                // Ejecuta la sentencia preparada
                $stmt->execute();
                // Devuelve true si existe al menos un almacén con ese nombre, false de lo contrario
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                // Registra el error en el log en caso de excepción
                error_log("Error al verificar nombre: " . $e->getMessage());
                // Retorna false si ocurre un error
                return false;
            }
        }
        // Retorna false si la conexión es nula
        return false;
    }

    public function existeTelefono($telefono, $conexPDO)
    {
        // Verifica que la conexión no sea nula
        if ($conexPDO != null) {
            try {
                // Prepara una consulta SQL para contar los almacenes con un teléfono específico
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.almacen WHERE telefono = :telefono");
                // Asocia el teléfono a la consulta preparada
                $stmt->bindParam(':telefono', $telefono);
                // Ejecuta la sentencia preparada
                $stmt->execute();
                // Devuelve true si existe al menos un almacén con ese teléfono, false de lo contrario
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                // Registra el error en el log en caso de excepción
                error_log("Error al verificar telefono: " . $e->getMessage());
                // Retorna false si ocurre un error
                return false;
            }
        }
        // Retorna false si la conexión es nula
        return false;
    }

    public function existeNombreAlmacenM($nombreAlmacen, $idalmacen, $conexPDO)
    {
        try {
            // Prepara una consulta SQL para contar los almacenes con un nombre específico, excluyendo un id de almacén dado
            $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.almacen WHERE nombre = :nombre AND idalmacen <> :idalmacen");
            // Asocia el nombre y el id del almacén a la consulta preparada
            $stmt->bindParam(':nombre', $nombreAlmacen);
            $stmt->bindParam(':idalmacen', $idalmacen);
            // Ejecuta la sentencia preparada
            $stmt->execute();
            // Devuelve true si existe al menos un almacén con ese nombre, excluyendo el id especificado, false de lo contrario
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            // Registra el error en el log en caso de excepción
            error_log("Error al verificar nombre: " . $e->getMessage());
            // Retorna false si ocurre un error
            return false;
        }
    }

    public function existeTelefonoM($telefono, $idalmacen, $conexPDO)
    {
        try {
            // Prepara una consulta SQL para contar los almacenes con un teléfono específico, excluyendo un id de almacén dado
            $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.almacen WHERE telefono = :telefono AND idalmacen <> :idalmacen");
            // Asocia el teléfono y el id del almacén a la consulta preparada
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':idalmacen', $idalmacen);
            // Ejecuta la sentencia preparada
            $stmt->execute();
            // Devuelve true si existe al menos un almacén con ese teléfono, excluyendo el id especificado, false de lo contrario
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            // Registra el error en el log en caso de excepción
            error_log("Error al verificar telefono: " . $e->getMessage());
            // Retorna false si ocurre un error
            return false;
        }
    }

    public function existeDireccionEnCodigoPostal($calle, $numeroBloque, $codigoPostal, $conexPDO)
    {
        // Verifica que la conexión no sea nula
        if ($conexPDO != null) {
            try {
                // Prepara una consulta SQL para verificar la existencia de la dirección en el código postal especificado
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.almacen WHERE calle = :calle AND numero_bloque = :numero_bloque AND codigo_postal = :codigo_postal");
                // Asocia los parámetros calle, número de bloque y código postal a la consulta preparada
                $stmt->bindParam(':calle', $calle);
                $stmt->bindParam(':numero_bloque', $numeroBloque, PDO::PARAM_INT);
                $stmt->bindParam(':codigo_postal', $codigoPostal);
                // Ejecuta la sentencia preparada
                $stmt->execute();
                // Devuelve true si se encuentra al menos un registro, false en caso contrario
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                // Registra el error en el log en caso de excepción
                error_log("Error al verificar dirección en código postal: " . $e->getMessage());
                // Retorna false si ocurre un error
                return false;
            }
        }
        // Retorna false si la conexión es nula
        return false;
    }

    public function existeDireccionEnCodigoPostalM($calle, $numeroBloque, $codigoPostal, $idalmacen, $conexPDO)
    {
        // Verifica que la conexión no sea nula
        if ($conexPDO != null) {
            try {
                // Prepara una consulta SQL para verificar la existencia de la dirección en el código postal especificado, excluyendo un id de almacén específico
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.almacen WHERE calle = :calle AND numero_bloque = :numeroBloque AND codigo_postal = :codigoPostal AND idalmacen <> :idalmacen");
                // Asocia los parámetros calle, número de bloque, código postal y id del almacén a la consulta preparada
                $stmt->bindParam(':calle', $calle);
                $stmt->bindParam(':numeroBloque', $numeroBloque, PDO::PARAM_INT);
                $stmt->bindParam(':codigoPostal', $codigoPostal);
                $stmt->bindParam(':idalmacen', $idalmacen, PDO::PARAM_INT);
                // Ejecuta la sentencia preparada
                $stmt->execute();
                // Devuelve true si se encuentra al menos un registro, excluyendo el id especificado, false en caso contrario
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                // Registra el error en el log en caso de excepción
                error_log("Error al verificar dirección en código postal excluyendo un almacén específico: " . $e->getMessage());
                // Retorna false si ocurre un error
                return false;
            }
        }
        // Retorna false si la conexión es nula
        return false;
    }
}
