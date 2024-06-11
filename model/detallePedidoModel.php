<?php

namespace model;

require_once("utils.php"); // Incluir el archivo utils.php que posiblemente contenga funciones auxiliares.

use \PDO; // Usar la clase PDO para la conexión con la base de datos.
use \PDOException; // Usar la clase PDOException para manejar excepciones relacionadas con PDO.

class detalle_pedido
{
    /** Función que devuelve todos los detalles de pedidos */
    public function getDetallesPedidos($conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la sentencia SQL para seleccionar todos los detalles de pedidos
                $sentencia = $conexPDO->prepare("SELECT * FROM genesis.detalle_pedido");
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

    /** Función que devuelve los detalles de pedidos con paginación */
    public function getDetallesPedidosPag($conexPDO, $idPedido, $pagina, $registrosPorPagina)
    {
        // Calcula el inicio de los registros basado en la página actual y el número de registros por página
        $inicio = ($pagina - 1) * $registrosPorPagina;
        // Consulta SQL para obtener los detalles de pedido junto con el nombre del producto
        $sql = "SELECT dp.*, p.nombre AS nombre_producto 
                FROM genesis.detalle_pedido dp
                JOIN genesis.producto p ON dp.id_producto_dp = p.idproducto
                WHERE dp.id_pedido_dp = :idPedido 
                ORDER BY dp.iddetalle_pedido ASC 
                LIMIT :inicio, :registrosPorPagina";

        try {
            // Prepara la sentencia SQL
            $stmt = $conexPDO->prepare($sql);
            // Vincula los parámetros de la consulta SQL
            $stmt->bindParam(':idPedido', $idPedido, PDO::PARAM_INT);
            $stmt->bindParam(':inicio', $inicio, PDO::PARAM_INT);
            $stmt->bindParam(':registrosPorPagina', $registrosPorPagina, PDO::PARAM_INT);
            // Ejecuta la sentencia
            $stmt->execute();
            // Devuelve los resultados de la consulta
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Maneja y registra el error si ocurre una excepción
            error_log("Error al obtener detalles de pedido: " . $e->getMessage());
            return [];
        }
    }

    /** Función que devuelve los detalles de un pedido por su ID */
    public function getDetallePedidoId($id, $conexPDO)
    {
        // Verifica si el ID es válido
        if (isset($id) && is_numeric($id)) {
            // Verifica si la conexión no es nula
            if ($conexPDO != null) {
                try {
                    // Prepara la sentencia SQL para seleccionar un detalle de pedido por su ID
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.detalle_pedido WHERE iddetalle_pedido = ?");
                    // Asocia el ID a la sentencia
                    $sentencia->bindParam(1, $id);
                    // Ejecuta la sentencia
                    $sentencia->execute();
                    // Devuelve los resultados de la consulta (usamos fetchAll para recuperar todos los detalles)
                    return $sentencia->fetchAll();
                } catch (PDOException $e) {
                    // Maneja y muestra el error si ocurre una excepción
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }

    /** Función para agregar un nuevo detalle de pedido */
    public function addDetallePedido($conexPDO, $idPedido, $idProducto, $cantidad, $precio, $precioSubtotal)
    {
        try {
            // Prepara la sentencia SQL para insertar un nuevo detalle de pedido
            $sql = "INSERT INTO genesis.detalle_pedido (id_pedido_dp, id_producto_dp, cantidad, precio, precio_subtotal) VALUES (:id_pedido_dp, :id_producto_dp, :cantidad, :precio, :precio_subtotal)";
            $stmt = $conexPDO->prepare($sql);
            // Asocia los valores a los parámetros de la sentencia SQL
            $stmt->bindParam(":id_pedido_dp", $idPedido);
            $stmt->bindParam(":id_producto_dp", $idProducto);
            $stmt->bindParam(":cantidad", $cantidad);
            $stmt->bindParam(":precio", $precio);
            $stmt->bindParam(":precio_subtotal", $precioSubtotal);
            // Ejecuta la sentencia
            $stmt->execute();
            // Devuelve el ID del último registro insertado
            return $conexPDO->lastInsertId();
        } catch (PDOException $e) {
            // Devuelve un mensaje de error si ocurre una excepción
            return "Error al insertar detalle: " . $e->getMessage();
        }
    }

    /** Función para contar los detalles de un pedido específico */
    public function contarDetallesPorPedido($idPedido, $conexPDO)
    {
        try {
            // Prepara la sentencia SQL para contar los detalles de un pedido específico
            $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.detalle_pedido WHERE id_pedido_dp = ?");
            // Asocia el ID del pedido a la sentencia
            $stmt->bindParam(1, $idPedido, PDO::PARAM_INT);
            // Ejecuta la sentencia
            $stmt->execute();
            // Devuelve el número de detalles
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            // Maneja y registra el error si ocurre una excepción
            error_log("Error al contar detalles: " . $e->getMessage());
            return 0;
        }
    }

    /** Función para verificar si un usuario ha comprado un producto específico */
    public function usuarioHaCompradoProducto($pdo, $idUsuario, $idProducto)
    {
        // Prepara la sentencia SQL para verificar si un usuario ha comprado un producto específico
        $stmt = $pdo->prepare(
            "SELECT COUNT(*) 
            FROM detalle_pedido dp 
            JOIN pedido p ON dp.id_pedido_dp = p.idpedido
            WHERE p.id_usuario_pedido = :idUsuario AND dp.id_producto_dp = :idProducto"
        );
        // Ejecuta la sentencia con los parámetros especificados
        $stmt->execute(['idUsuario' => $idUsuario, 'idProducto' => $idProducto]);
        // Devuelve true si el usuario ha comprado el producto, false de lo contrario
        return $stmt->fetchColumn() > 0;
    }
}
