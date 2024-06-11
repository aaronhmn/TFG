<?php

namespace model;

require_once("utils.php"); // Incluir el archivo utils.php, que posiblemente contenga funciones auxiliares.

use \PDO; // Usar la clase PDO para la conexión con la base de datos.
use \PDOException; // Usar la clase PDOException para manejar excepciones relacionadas con PDO.

class categoria
{
    /** Función que devuelve todas las categorías */
    public function getCategorias($conexPDO)
    {
        // Verificar si la conexión a la base de datos no es nula
        if ($conexPDO != null) {
            try {
                // Preparar una sentencia SQL para seleccionar todas las categorías
                $sentencia = $conexPDO->prepare("SELECT * FROM genesis.categoria");
                // Ejecutar la sentencia preparada
                $sentencia->execute();
                // Devolver los resultados de la consulta
                return $sentencia->fetchAll();
            } catch (PDOException $e) {
                // Manejar y mostrar el error si ocurre una excepción
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }

    /** Función que devuelve una categoría por su ID */
    public function getCategoriaId($id, $conexPDO)
    {
        // Verificar si el ID es válido
        if (isset($id) && is_numeric($id)) {
            // Verificar si la conexión no es nula
            if ($conexPDO != null) {
                try {
                    // Preparar la sentencia SQL para seleccionar una categoría por su ID
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.categoria WHERE idcategoria=?");
                    // Asociar el ID a la sentencia
                    $sentencia->bindParam(1, $id);
                    // Ejecutar la sentencia
                    $sentencia->execute();
                    // Devolver el resultado de la consulta
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    // Manejar y mostrar el error si ocurre una excepción
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }

    /** Función para agregar una nueva categoría */
    function addCategoria($categoria, $conexPDO)
    {
        $result = null;
        // Verificar si la categoría y la conexión no son nulas
        if (isset($categoria) && $conexPDO != null) {
            try {
                // Preparar la sentencia SQL para insertar una nueva categoría
                $sentencia = $conexPDO->prepare("INSERT INTO genesis.categoria (nombre_categoria) VALUES (:nombre_categoria)");
                // Asociar el nombre de la categoría al parámetro de la sentencia
                $sentencia->bindParam(":nombre_categoria", $categoria["nombre_categoria"]);
                // Ejecutar la sentencia y guardar el resultado
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                // Manejar y mostrar el error si ocurre una excepción
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
        // Devolver el resultado de la operación (true si fue exitosa, false o null si no)
        return $result;
    }

    /** Función para eliminar una categoría, verificando primero si no hay productos asociados */
    public function delCategoria($idCategoria, $conexPDO)
    {
        // Verificar si no hay productos asociados a la categoría
        if (!$this->verificarProductosCategoria($idCategoria, $conexPDO)) {
            try {
                // Preparar la sentencia SQL para eliminar la categoría
                $stmt = $conexPDO->prepare("DELETE FROM categoria WHERE id_categoria = :idCategoria");
                // Asociar el ID de la categoría al parámetro de la sentencia
                $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
                // Ejecutar la sentencia y devolver el resultado
                return $stmt->execute();
            } catch (PDOException $e) {
                // Manejar el error en caso de excepción
                error_log("Error al eliminar categoría: " . $e->getMessage());
                return null;
            }
        } else {
            // Devolver false si hay productos asociados a la categoría
            return false;
        }
    }

    function updateCategoria($categoria, $conexPDO)
    {
        $result = null; // Inicializa la variable $result como null

        // Verifica si la variable $categoria está definida, contiene el campo 'idcategoria' y que es numérico, y que la conexión no es nula
        if (isset($categoria) && isset($categoria["idcategoria"]) && is_numeric($categoria["idcategoria"]) && $conexPDO != null) {
            try {
                // Prepara la sentencia SQL para actualizar una categoría en la base de datos
                $sentencia = $conexPDO->prepare("UPDATE genesis.categoria SET nombre_categoria=:nombre_categoria WHERE idcategoria=:idcategoria");

                // Asocia los valores a los parámetros de la sentencia SQL
                $sentencia->bindParam(":idcategoria", $categoria["idcategoria"]);
                $sentencia->bindParam(":nombre_categoria", $categoria["nombre_categoria"]);

                // Ejecuta la sentencia y guarda el resultado
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                // Imprime un mensaje de error si ocurre una excepción
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        // Retorna el resultado de la ejecución de la sentencia
        return $result;
    }

    public function getCategoriasPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la sentencia SQL base para obtener las categorías, ordenadas según un campo específico
                $query = "SELECT * FROM genesis.categoria ORDER BY ? ";

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
                // Imprime un mensaje de error si ocurre una excepción
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }

    public function contarCategorias($conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara una sentencia SQL para contar el total de categorías
                $sentencia = $conexPDO->prepare("SELECT COUNT(*) AS total FROM genesis.categoria");
                // Ejecuta la sentencia
                $sentencia->execute();
                // Obtiene y retorna el resultado de la consulta
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                return $resultado['total'];
            } catch (PDOException $e) {
                // Imprime un mensaje de error y retorna 0 en caso de excepción
                print("Error al contar categorias: " . $e->getMessage());
                return 0; // Devuelve 0 en caso de error
            }
        }
        // Retorna 0 si la conexión es nula
        return 0;
    }

    public function verificarProductosCategoria($idCategoria, $conexPDO)
    {
        try {
            // Prepara una sentencia SQL para contar los productos en una categoría específica
            $stmt = $conexPDO->prepare("SELECT COUNT(*) as cantidad FROM producto WHERE id_categoria = :idCategoria");
            // Asocia el ID de la categoría al parámetro de la sentencia
            $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
            // Ejecuta la sentencia
            $stmt->execute();
            // Recupera y retorna el resultado de la consulta, indicando si hay al menos un producto en la categoría
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['cantidad'] > 0;
        } catch (PDOException $e) {
            // Maneja el error y registra el mensaje en el log
            error_log("Error en consulta: " . $e->getMessage());
            // Retorna false si ocurre un error
            return false;
        }
    }

    public function existeNombre($nombre, $conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara una sentencia SQL para contar las categorías con un nombre específico
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.categoria WHERE nombre_categoria = :nombre_categoria");
                // Asocia el nombre de la categoría al parámetro de la sentencia
                $stmt->bindParam(':nombre_categoria', $nombre);
                // Ejecuta la sentencia
                $stmt->execute();
                // Retorna true si existe al menos una categoría con ese nombre, false de lo contrario
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                // Maneja el error y registra el mensaje en el log
                error_log("Error al verificar categoria: " . $e->getMessage());
                // Retorna false si ocurre un error
                return false;
            }
        }
        // Retorna false si la conexión es nula
        return false;
    }

    public function existeNombreM($nombre, $idcategoria, $conexPDO)
    {
        try {
            // Prepara una sentencia SQL para contar las categorías con un nombre específico, excluyendo un ID de categoría dado
            $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.categoria WHERE nombre_categoria = :nombre_categoria AND idcategoria <> :idcategoria");
            // Asocia el nombre y el ID de la categoría a los parámetros de la sentencia
            $stmt->bindParam(':nombre_categoria', $nombre);
            $stmt->bindParam(':idcategoria', $idcategoria);
            // Ejecuta la sentencia
            $stmt->execute();
            // Retorna true si existe al menos una categoría con ese nombre, excluyendo el ID especificado, false de lo contrario
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            // Maneja el error y registra el mensaje en el log
            error_log("Error al verificar categoria: " . $e->getMessage());
            // Retorna false si ocurre un error
            return false;
        }
    }
}
