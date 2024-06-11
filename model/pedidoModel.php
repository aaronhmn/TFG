<?php

namespace model;

require_once("utils.php"); // Incluir el archivo utils.php que posiblemente contenga funciones auxiliares.

use \PDO; // Usar la clase PDO para la conexión con la base de datos.
use \PDOException; // Usar la clase PDOException para manejar excepciones relacionadas con PDO.

class pedido
{
    /** Función que devuelve todos los pedidos */
    public function getPedidos($conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la sentencia SQL para seleccionar todos los pedidos
                $sentencia = $conexPDO->prepare("SELECT * FROM genesis.pedido");
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

    /** Función que devuelve los pedidos con paginación */
    public function getPedidosPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la sentencia SQL base para obtener los pedidos, ordenados según un campo específico
                $query = "SELECT * FROM genesis.pedido ORDER BY ? ";
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

    /** Función que devuelve un pedido por su ID */
    public function getPedidoId($id, $conexPDO)
    {
        // Verifica si el ID es válido
        if (isset($id) && is_numeric($id)) {
            try {
                // Prepara la sentencia SQL para seleccionar un pedido por su ID, incluyendo datos del usuario relacionado
                $stmt = $conexPDO->prepare("
                    SELECT p.*, u.nombre, u.primer_apellido, u.segundo_apellido, u.dni, u.telefono, u.codigo_postal, u.calle, u.numero_bloque, u.piso
                    FROM genesis.pedido p
                    JOIN genesis.usuario u ON p.id_usuario_pedido = u.idusuario
                    WHERE p.idpedido = ?
                ");
                // Asocia el ID a la sentencia
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                // Ejecuta la sentencia
                $stmt->execute();
                // Devuelve el resultado de la consulta
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
        return null; // Devuelve null si no hay datos o el ID no es válido
    }

    /** Función para agregar un nuevo pedido */
    public function addPedido($conexPDO, $idUsuario, $total)
    {
        $result = null;
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la sentencia SQL para insertar un nuevo pedido
                $sql = "INSERT INTO genesis.pedido (fecha_pedido, precio_total, id_usuario_pedido) VALUES (NOW(), :precio_total, :id_usuario_pedido)";
                $stmt = $conexPDO->prepare($sql);
                // Asocia los valores a los parámetros de la sentencia SQL
                $stmt->bindParam(":precio_total", $total);
                $stmt->bindParam(":id_usuario_pedido", $idUsuario);
                // Ejecuta la sentencia
                $result = $stmt->execute();
                // Devuelve el ID del pedido creado
                return $conexPDO->lastInsertId();
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al acceder a BD: " . $e->getMessage());
                return false;
            }
        }
        return $result;
    }

    /** Función para contar el total de pedidos */
    public function contarPedidos($conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara una sentencia SQL para contar el total de pedidos
                $sentencia = $conexPDO->prepare("SELECT COUNT(*) AS total FROM genesis.pedido");
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

    /** Función que devuelve los pedidos de un usuario con paginación */
    public function getPedidosPorUsuario($usuarioId, $conexPDO, $pagina = 1, $registrosPorPagina = 10)
    {
        // Calcula el inicio de los registros basado en la página actual y el número de registros por página
        $inicio = ($pagina - 1) * $registrosPorPagina;
        try {
            // Prepara la sentencia SQL para seleccionar los pedidos de un usuario específico con paginación
            $sentencia = $conexPDO->prepare("SELECT * FROM genesis.pedido WHERE id_usuario_pedido = ? LIMIT ?, ?");
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

    /** Función para contar los pedidos de un usuario específico */
    public function contarPedidosPorUsuario($usuarioId, $conexPDO)
    {
        try {
            // Prepara la sentencia SQL para contar los pedidos de un usuario específico
            $sentencia = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.pedido WHERE id_usuario_pedido = ?");
            // Asocia el ID del usuario a la sentencia
            $sentencia->bindParam(1, $usuarioId, PDO::PARAM_INT);
            // Ejecuta la sentencia
            $sentencia->execute();
            // Devuelve el número de pedidos
            return $sentencia->fetchColumn();
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            print("Error al contar pedidos: " . $e->getMessage());
            return 0;
        }
    }
}
