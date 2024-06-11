<?php

namespace model;

require_once("utils.php"); // Incluir el archivo utils.php que posiblemente contenga funciones auxiliares.

use \PDO; // Usar la clase PDO para la conexión con la base de datos.
use \PDOException; // Usar la clase PDOException para manejar excepciones relacionadas con PDO.

class reseña
{
    /** Función que devuelve todas las reseñas */
    public function getReseñas($conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la sentencia SQL para seleccionar todas las reseñas
                $sentencia = $conexPDO->prepare("SELECT * FROM genesis.resena");
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

    /** Función que devuelve las reseñas con paginación */
    public function getReseñasPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la sentencia SQL base para obtener las reseñas, ordenadas según un campo específico
                $query = "SELECT * FROM genesis.resena ORDER BY ? ";
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

    /** Función que devuelve una reseña por su ID */
    public function getReseñaId($id, $conexPDO)
    {
        // Verifica si el ID es válido
        if (isset($id) && is_numeric($id)) {
            // Verifica si la conexión no es nula
            if ($conexPDO != null) {
                try {
                    // Prepara la sentencia SQL para seleccionar una reseña por su ID
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.resena WHERE idresena = ?");
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

    /** Función para agregar una nueva reseña */
    function addReseña($reseña, $conexPDO)
    {
        // Verifica si la reseña y la conexión no son nulas
        if (isset($reseña) && $conexPDO != null) {
            try {
                // Si la valoración es null, significa que el usuario no ha valorado
                $valoracion = isset($reseña["valoracion"]) && $reseña["valoracion"] === 0 ? 0 : ($reseña["valoracion"] >= 1 && $reseña["valoracion"] <= 5 ? $reseña["valoracion"] : null);
                // Prepara la sentencia SQL para insertar una nueva reseña
                $sentencia = $conexPDO->prepare("INSERT INTO genesis.resena (fecha_resena, comentario, valoracion, id_producto_resena, id_usuario_resena) VALUES (:fecha_resena, :comentario, :valoracion, :id_producto_resena, :id_usuario_resena)");
                // Asocia los valores a los parámetros de la sentencia SQL
                $sentencia->bindParam(":fecha_resena", $reseña["fecha_resena"]);
                $sentencia->bindParam(":comentario", $reseña["comentario"]);
                $sentencia->bindParam(":valoracion", $valoracion);
                $sentencia->bindParam(":id_producto_resena", $reseña["id_producto_resena"]);
                $sentencia->bindParam(":id_usuario_resena", $reseña["id_usuario_resena"]);
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

    /** Función para contar el total de reseñas */
    public function contarReseñas($conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara una sentencia SQL para contar el total de reseñas
                $sentencia = $conexPDO->prepare("SELECT COUNT(*) AS total FROM genesis.resena");
                // Ejecuta la sentencia
                $sentencia->execute();
                // Obtiene y retorna el resultado de la consulta
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                return $resultado['total'];
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al contar reseñas: " . $e->getMessage());
                return 0; // Devuelve 0 en caso de error
            }
        }
        // Retorna 0 si la conexión es nula
        return 0;
    }

    /** Función que devuelve las reseñas de un usuario con paginación */
    public function getReseñasPorUsuario($usuarioId, $conexPDO, $pagina = 1, $registrosPorPagina = 10)
    {
        // Calcula el inicio de los registros basado en la página actual y el número de registros por página
        $inicio = ($pagina - 1) * $registrosPorPagina;
        try {
            // Prepara la sentencia SQL para seleccionar las reseñas de un usuario específico con paginación
            $sentencia = $conexPDO->prepare("SELECT * FROM genesis.resena WHERE id_usuario_resena = ? LIMIT ?, ?");
            // Asocia los parámetros de la consulta SQL
            $sentencia->bindParam(1, $usuarioId, PDO::PARAM_INT);
            $sentencia->bindParam(2, $inicio, PDO::PARAM_INT);
            $sentencia->bindParam(3, $registrosPorPagina, PDO::PARAM_INT);
            // Ejecuta la sentencia
            $sentencia->execute();
            // Devuelve los resultados de la consulta
            return $sentencia->fetchAll();
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            print("Error al acceder a BD" . $e->getMessage());
            return []; // Devuelve un arreglo vacío en caso de error
        }
    }

    /** Función para contar las reseñas de un usuario específico */
    public function contarReseñasPorUsuario($usuarioId, $conexPDO)
    {
        try {
            // Prepara la sentencia SQL para contar las reseñas de un usuario específico
            $sentencia = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.resena WHERE id_usuario_resena = ?");
            // Asocia el ID del usuario a la sentencia
            $sentencia->bindParam(1, $usuarioId, PDO::PARAM_INT);
            // Ejecuta la sentencia
            $sentencia->execute();
            // Devuelve el número de reseñas
            return $sentencia->fetchColumn();
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            print("Error al contar reseñas: " . $e->getMessage());
            return 0;
        }
    }

    /** Función que devuelve las reseñas de un producto específico */
    public function getReseñasPorProductoId($idProducto, $conexPDO)
    {
        try {
            // Prepara la consulta SQL para obtener las reseñas de un producto específico, incluyendo el nombre del usuario
            $query = "SELECT r.*, u.nombre_usuario AS nombre_usuario 
                      FROM genesis.resena r 
                      INNER JOIN genesis.usuario u ON r.id_usuario_resena = u.idusuario
                      WHERE r.id_producto_resena = :idProducto";
            // Prepara la consulta SQL en la conexión a la base de datos
            $sentencia = $conexPDO->prepare($query);
            // Asocia el ID del producto a la sentencia
            $sentencia->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
            // Ejecuta la sentencia
            $sentencia->execute();
            // Devuelve los resultados de la consulta
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            print("Error al acceder a BD: " . $e->getMessage());
            return [];
        }
    }

    /** Función que devuelve las reseñas de un producto específico con paginación */
    public function getReseñasPorProductoIdPaginado($idProducto, $conexPDO, $start, $limit)
    {
        try {
            // Prepara la consulta SQL para obtener las reseñas de un producto específico, incluyendo el nombre del usuario, con paginación
            $query = "SELECT r.*, u.nombre_usuario AS nombre_usuario 
                      FROM genesis.resena r 
                      INNER JOIN genesis.usuario u ON r.id_usuario_resena = u.idusuario
                      WHERE r.id_producto_resena = :idProducto
                      LIMIT :start, :limit";
            // Prepara la consulta SQL en la conexión a la base de datos
            $sentencia = $conexPDO->prepare($query);
            // Asocia los parámetros de la consulta SQL
            $sentencia->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
            $sentencia->bindParam(':start', $start, PDO::PARAM_INT);
            $sentencia->bindParam(':limit', $limit, PDO::PARAM_INT);
            // Ejecuta la sentencia
            $sentencia->execute();
            // Devuelve los resultados de la consulta
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            print("Error al acceder a BD: " . $e->getMessage());
            return [];
        }
    }

    /** Función para contar las reseñas de un producto específico */
    public function contarReseñasPorProducto($idProducto, $conexPDO)
    {
        try {
            // Prepara la consulta SQL para contar las reseñas de un producto específico
            $query = "SELECT COUNT(*) FROM genesis.resena WHERE id_producto_resena = :idProducto";
            // Prepara la consulta SQL en la conexión a la base de datos
            $sentencia = $conexPDO->prepare($query);
            // Asocia el ID del producto a la sentencia
            $sentencia->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
            // Ejecuta la sentencia
            $sentencia->execute();
            // Devuelve el número total de reseñas para el producto
            return $sentencia->fetchColumn();
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            print("Error al contar reseñas: " . $e->getMessage());
            return 0;
        }
    }

    /** Función para calcular la media de valoraciones de un producto */
    public function calcularMediaValoraciones($idProducto, $conexPDO)
    {
        try {
            // Prepara la consulta SQL para calcular la media de valoraciones de un producto específico
            $query = "SELECT AVG(valoracion) AS mediaValoracion FROM genesis.resena WHERE id_producto_resena = :idProducto AND valoracion IS NOT NULL";
            // Prepara la consulta SQL en la conexión a la base de datos
            $sentencia = $conexPDO->prepare($query);
            // Asocia el ID del producto a la sentencia
            $sentencia->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
            // Ejecuta la sentencia
            $sentencia->execute();
            // Obtiene y retorna el resultado de la consulta
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado['mediaValoracion'] ?? 0; // Devuelve la media o 0 si no hay valoraciones
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            print("Error al calcular la media de valoraciones: " . $e->getMessage());
            return 0;
        }
    }

    /** Función para verificar si un usuario ya ha valorado un producto */
    public function yaValorado($usuarioId, $idProducto, $conexPDO)
    {
        try {
            // Prepara la consulta SQL para contar las valoraciones de un usuario sobre un producto específico
            $query = "SELECT COUNT(*) FROM genesis.resena WHERE id_usuario_resena = :usuarioId AND id_producto_resena = :idProducto";
            // Prepara la consulta SQL en la conexión a la base de datos
            $stmt = $conexPDO->prepare($query);
            // Asocia los parámetros de la consulta SQL
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->bindParam(':idProducto', $idProducto);
            // Ejecuta la consulta
            $stmt->execute();
            // Devuelve true si el usuario ya ha valorado el producto, false de lo contrario
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            return false; // En caso de error, considerar que no hay reseñas previas
        }
    }

    /** Función para obtener el detalle de una reseña específica */
    public function obtenerDetalleReseña($usuarioId, $idProducto, $conexPDO)
    {
        try {
            // Prepara la consulta SQL para obtener el detalle de una reseña específica
            $query = "SELECT comentario, valoracion FROM genesis.resena WHERE id_usuario_resena = :usuarioId AND id_producto_resena = :idProducto LIMIT 1";
            // Prepara la consulta SQL en la conexión a la base de datos
            $stmt = $conexPDO->prepare($query);
            // Asocia los parámetros de la consulta SQL
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->bindParam(':idProducto', $idProducto);
            // Ejecuta la consulta
            $stmt->execute();
            // Devuelve el resultado de la consulta
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            return null; // En caso de error
        }
    }

    /** Función para agregar o actualizar una reseña */
    function addOrUpdateReseña($reseña, $conexPDO)
    {
        // Obtiene el detalle de la reseña existente si hay una
        $detalleReseñaExistente = $this->obtenerDetalleReseña($reseña['id_usuario_resena'], $reseña['id_producto_resena'], $conexPDO);
        // Si ya existe una reseña, se actualiza
        if ($detalleReseñaExistente) {
            $sql = "UPDATE genesis.resena SET comentario = COALESCE(:comentario, comentario), valoracion = COALESCE(:valoracion, valoracion) WHERE id_usuario_resena = :id_usuario_resena AND id_producto_resena = :id_producto_resena";
        } else {
            // Si no existe, se inserta una nueva reseña
            $sql = "INSERT INTO genesis.resena (fecha_resena, comentario, valoracion, id_producto_resena, id_usuario_resena) VALUES (:fecha_resena, :comentario, :valoracion, :id_producto_resena, :id_usuario_resena)";
        }
        try {
            // Prepara la consulta SQL en la conexión a la base de datos
            $stmt = $conexPDO->prepare($sql);
            // Asocia los valores a los parámetros de la consulta SQL
            $stmt->bindParam(':fecha_resena', $reseña['fecha_resena']);
            $stmt->bindParam(':comentario', $reseña['comentario']);
            $stmt->bindParam(':valoracion', $reseña['valoracion']);
            $stmt->bindParam(':id_producto_resena', $reseña['id_producto_resena']);
            $stmt->bindParam(':id_usuario_resena', $reseña['id_usuario_resena']);
            // Ejecuta la consulta
            return $stmt->execute();
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            return false;
        }
    }
}
