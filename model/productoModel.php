<?php

namespace model;

require_once("utils.php"); // Incluir el archivo utils.php que posiblemente contenga funciones auxiliares.

use \PDO; // Usar la clase PDO para la conexión con la base de datos.
use \PDOException; // Usar la clase PDOException para manejar excepciones relacionadas con PDO.

class producto
{
    /** Función que devuelve todos los productos */
    public function getProductos($conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la sentencia SQL para seleccionar todos los productos
                $sentencia = $conexPDO->prepare("SELECT * FROM genesis.producto");
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

    /** Función que devuelve los productos con paginación */
    public function getProductosPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la sentencia SQL base para obtener los productos, ordenados según un campo específico
                $query = "SELECT * FROM genesis.producto ORDER BY ? ";
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

    /** Función que devuelve un producto por su ID */
    public function getProductoId($id, $conexPDO)
    {
        // Verifica si el ID es válido
        if (isset($id) && is_numeric($id)) {
            // Verifica si la conexión no es nula
            if ($conexPDO != null) {
                try {
                    // Prepara la sentencia SQL para seleccionar un producto por su ID y que esté activo
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.producto WHERE idproducto=? AND estado = 0");
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

    /** Función que devuelve un producto por su ID para el administrador */
    public function getProductoIdAdmin($id, $conexPDO)
    {
        // Verifica si el ID es válido
        if (isset($id) && is_numeric($id)) {
            // Verifica si la conexión no es nula
            if ($conexPDO != null) {
                try {
                    // Prepara la sentencia SQL para seleccionar un producto por su ID
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.producto WHERE idproducto=?");
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

    /** Función para agregar un nuevo producto */
    function addProducto($producto, $conexPDO)
    {
        $result = null;
        // Verifica si el producto y la conexión no son nulos
        if (isset($producto) && $conexPDO != null) {
            try {
                // Prepara la sentencia SQL con todos los campos necesarios, incluidas las claves foráneas
                $sql = "INSERT INTO genesis.producto (nombre, precio, id_categoria, descripcion, especificacion, id_marca, stock, id_almacen, imagen, tipo_imagen, ruta_imagen) VALUES (:nombre, :precio, :id_categoria, :descripcion, :especificacion, :id_marca, :stock, :id_almacen, :imagen, :tipo_imagen, :ruta_imagen)";
                $stmt = $conexPDO->prepare($sql);
                // Asocia los valores a los parámetros de la sentencia SQL
                $stmt->bindParam(":nombre", $producto["nombre"]);
                $stmt->bindParam(":precio", $producto["precio"]);
                $stmt->bindParam(":id_categoria", $producto["id_categoria"]);
                $stmt->bindParam(":descripcion", $producto["descripcion"]);
                $stmt->bindParam(":especificacion", $producto["especificacion"]);
                $stmt->bindParam(":id_marca", $producto["id_marca"]);
                $stmt->bindParam(":stock", $producto["stock"]);
                $stmt->bindParam(":id_almacen", $producto["id_almacen"]);
                $stmt->bindParam(":imagen", $producto["imagen"]);
                $stmt->bindParam(":tipo_imagen", $producto["tipo_imagen"]);
                $stmt->bindParam(":ruta_imagen", $producto["ruta_imagen"]);
                // Ejecuta la sentencia
                $result = $stmt->execute();
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al acceder a BD: " . $e->getMessage());
            }
        }
        // Devuelve el resultado de la operación (true si fue exitosa, false o null si no)
        return $result;
    }

    /** Función para actualizar un producto */
    function updateProducto($producto, $conexPDO)
    {
        $result = null;
        // Verifica si el producto y sus campos necesarios no son nulos, y si la conexión no es nula
        if (isset($producto) && isset($producto["idproducto"]) && is_numeric($producto["idproducto"]) && $conexPDO != null) {
            try {
                // Prepara la sentencia SQL con todos los campos necesarios, incluidas las claves foráneas
                $sql = "UPDATE genesis.producto SET nombre = :nombre, precio = :precio, id_categoria = :id_categoria, descripcion = :descripcion, especificacion = :especificacion, id_marca = :id_marca, stock = :stock, id_almacen = :id_almacen, ruta_imagen = :ruta_imagen, estado = :estado  WHERE idproducto = :idproducto";
                $stmt = $conexPDO->prepare($sql);
                // Asocia los valores a los parámetros de la sentencia SQL
                $stmt->bindParam(":idproducto", $producto["idproducto"], PDO::PARAM_INT);
                $stmt->bindParam(":nombre", $producto["nombre"]);
                $stmt->bindParam(":precio", $producto["precio"]);
                $stmt->bindParam(":id_categoria", $producto["id_categoria"]);
                $stmt->bindParam(":descripcion", $producto["descripcion"]);
                $stmt->bindParam(":especificacion", $producto["especificacion"]);
                $stmt->bindParam(":id_marca", $producto["id_marca"]);
                $stmt->bindParam(":stock", $producto["stock"]);
                $stmt->bindParam(":id_almacen", $producto["id_almacen"]);
                $stmt->bindParam(":ruta_imagen", $producto["ruta_imagen"]);
                $stmt->bindParam(":estado", $producto["estado"]);
                // Ejecuta la sentencia
                $result = $stmt->execute();
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al actualizar producto en BD: " . $e->getMessage());
            }
        } else {
            // Muestra un mensaje si hay datos insuficientes para actualizar el producto o si la conexión a la base de datos es nula
            print("Datos insuficientes para actualizar el producto o conexión de base de datos nula.");
        }
        // Devuelve el resultado de la operación (true si fue exitosa, false o null si no)
        return $result;
    }

    /** Función para eliminar un producto */
    function delProducto($idProducto, $conexPDO)
    {
        $result = null;
        // Verifica si el ID del producto es válido
        if (isset($idProducto) && is_numeric($idProducto)) {
            // Verifica si la conexión no es nula
            if ($conexPDO != null) {
                try {
                    // Prepara la sentencia SQL para eliminar un producto por su ID
                    $sentencia = $conexPDO->prepare("DELETE FROM genesis.producto WHERE idproducto=?");
                    // Asocia el ID del producto a la sentencia
                    $sentencia->bindParam(1, $idProducto);
                    // Ejecuta la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    // Maneja y muestra el error si ocurre una excepción
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }
        // Devuelve el resultado de la operación (true si fue exitosa, false o null si no)
        return $result;
    }

    /** Función para obtener las imágenes de un producto */
    public function getImagenesPorProducto($idProducto, $conexPDO)
    {
        $rutasImagenes = [];
        // Verifica si el ID del producto es válido
        if (isset($idProducto) && is_numeric($idProducto)) {
            // Verifica si la conexión no es nula
            if ($conexPDO != null) {
                try {
                    // Prepara la sentencia SQL para obtener las rutas de las imágenes
                    $sentencia = $conexPDO->prepare("SELECT ruta_imagen FROM genesis.producto WHERE idproducto = :idProducto");
                    // Vincula el parámetro ':idProducto' al valor real de la variable $idProducto
                    $sentencia->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
                    // Ejecuta la consulta
                    $sentencia->execute();
                    // Obtenemos el resultado de la consulta
                    $fila = $sentencia->fetch(PDO::FETCH_ASSOC);
                    if ($fila && $fila['ruta_imagen']) {
                        // Si la columna 'ruta_imagen' contiene las rutas de las imágenes separadas por comas, las separamos y las agregamos al array $rutasImagenes
                        $rutasImagenes = explode(',', $fila['ruta_imagen']);
                    }
                } catch (PDOException $e) {
                    // Maneja y muestra el error si ocurre una excepción
                    print("Error al acceder a la BD: " . $e->getMessage());
                }
            }
        }
        // Devuelve las rutas de las imágenes
        return $rutasImagenes;
    }

    /** Función para obtener productos por nombre */
    public function getProductosPorNombre($conexPDO, $nombre)
    {
        try {
            // Prepara la sentencia SQL para buscar productos por nombre usando LIKE
            $stmt = $conexPDO->prepare("SELECT * FROM genesis.producto WHERE nombre LIKE ?");
            // Ejecuta la sentencia con el nombre del producto
            $stmt->execute(['%' . $nombre . '%']);
            // Devuelve los resultados de la consulta
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            print("Error al acceder a BD" . $e->getMessage());
            return [];
        }
    }

    /** Función para contar el total de productos */
    public function contarProductos($conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara una sentencia SQL para contar el total de productos
                $sentencia = $conexPDO->prepare("SELECT COUNT(*) AS total FROM genesis.producto");
                // Ejecuta la sentencia
                $sentencia->execute();
                // Obtiene y retorna el resultado de la consulta
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                return $resultado['total'];
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al contar productos: " . $e->getMessage());
                return 0; // Devuelve 0 en caso de error
            }
        }
        // Retorna 0 si la conexión es nula
        return 0;
    }

    /** Función para obtener productos filtrados por precio, categoría y marca */
    public function getProductosFiltrados($conexPDO, $ordenPrecio, $categoria = null, $marca = null)
    {
        // Inicia la consulta base para obtener productos activos
        $query = "SELECT * FROM genesis.producto WHERE estado = 0";
        $params = [];
        $paramTypes = [];
        // Agregar filtro por categoría si está presente
        if (!empty($categoria)) {
            $query .= " AND id_categoria = ?";
            $params[] = $categoria;
            $paramTypes[] = PDO::PARAM_INT;
        }
        // Agregar filtro por marca si está presente
        if (!empty($marca)) {
            $query .= " AND id_marca = ?";
            $params[] = $marca;
            $paramTypes[] = PDO::PARAM_INT;
        }
        // Orden de precios
        if ($ordenPrecio === 'menorMayor') {
            $query .= " ORDER BY precio ASC";
        } elseif ($ordenPrecio === 'mayorMenor') {
            $query .= " ORDER BY precio DESC";
        }
        $stmt = $conexPDO->prepare($query);
        // Vincula los parámetros a la consulta SQL
        foreach ($params as $index => $param) {
            $stmt->bindValue($index + 1, $param, $paramTypes[$index]);
        }
        // Ejecuta la consulta
        $stmt->execute();
        // Devuelve los resultados de la consulta
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Función para ocultar o mostrar un producto */
    public function ocultarProducto($idProducto, $conexPDO)
    {
        // Verifica si el ID del producto es válido y si la conexión no es nula
        if (isset($idProducto) && is_numeric($idProducto) && $conexPDO != null) {
            try {
                // Prepara la sentencia SQL para cambiar el estado del producto (ocultar o mostrar)
                $sql = "UPDATE genesis.producto SET estado = 1 - estado WHERE idproducto = :idproducto";
                $stmt = $conexPDO->prepare($sql);
                // Vincula el ID del producto a la sentencia
                $stmt->bindParam(":idproducto", $idProducto, PDO::PARAM_INT);
                // Ejecuta la sentencia
                return $stmt->execute();
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al cambiar el estado del producto: " . $e->getMessage());
                return false;
            }
        }
        // Devuelve false si el ID del producto o la conexión no son válidos
        return false;
    }

    /** Función para actualizar el stock de un producto */
    function updateStock($idProducto, $cantidad, $conexPDO)
    {
        try {
            // Prepara la sentencia SQL para actualizar el stock de un producto
            $sql = "UPDATE genesis.producto SET stock = stock - :cantidad WHERE idproducto = :idproducto AND stock >= :cantidad";
            $stmt = $conexPDO->prepare($sql);
            // Vincula los parámetros de la sentencia SQL
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
            $stmt->bindParam(":idproducto", $idProducto, PDO::PARAM_INT);
            // Ejecuta la sentencia
            return $stmt->execute();
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            print("Error al actualizar el stock del producto: " . $e->getMessage());
            return false;
        }
    }

    /** Función para verificar si un nombre de producto ya existe */
    public function existeNombre($nombre, $conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la consulta SQL para verificar si un nombre de producto ya existe
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.producto WHERE nombre = :nombre");
                // Vincula el nombre del producto a la sentencia
                $stmt->bindParam(':nombre', $nombre);
                // Ejecuta la consulta
                $stmt->execute();
                // Devuelve true si el nombre ya existe, false de lo contrario
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                error_log("Error al verificar nombre: " . $e->getMessage());
                return false;
            }
        }
        // Devuelve false si la conexión es nula
        return false;
    }

    /** Función para verificar si un nombre de producto ya existe, excluyendo un ID específico */
    public function existeNombreM($nombre, $idproducto, $conexPDO)
    {
        try {
            // Prepara la consulta SQL para verificar si un nombre de producto ya existe, excluyendo un ID específico
            $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.producto WHERE nombre = :nombre AND idproducto <> :idproducto");
            // Vincula los parámetros de la consulta SQL
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':idproducto', $idproducto);
            // Ejecuta la consulta
            $stmt->execute();
            // Devuelve true si el nombre ya existe, false de lo contrario
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            error_log("Error al verificar nombre: " . $e->getMessage());
            return false;
        }
    }
}

/** Función para obtener todas las categorías */
function getCategorias($conexPDO)
{
    // Verifica si la conexión no es nula
    if ($conexPDO != null) {
        try {
            // Prepara la consulta SQL para obtener todas las categorías
            $sentencia = $conexPDO->prepare("SELECT * FROM genesis.categoria");
            // Ejecuta la consulta
            $sentencia->execute();
            // Devuelve los resultados de la consulta
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            print("Error al acceder a BD: " . $e->getMessage());
            return [];
        }
    }
}

/** Función para obtener todas las marcas */
function getMarcas($conexPDO)
{
    // Verifica si la conexión no es nula
    if ($conexPDO != null) {
        try {
            // Prepara la consulta SQL para obtener todas las marcas
            $sentencia = $conexPDO->prepare("SELECT * FROM genesis.marca");
            // Ejecuta la consulta
            $sentencia->execute();
            // Devuelve los resultados de la consulta
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            print("Error al acceder a BD: " . $e->getMessage());
            return [];
        }
    }
}

/** Función para obtener todos los almacenes */
function getAlmacenes($conexPDO)
{
    // Verifica si la conexión no es nula
    if ($conexPDO != null) {
        try {
            // Prepara la consulta SQL para obtener todos los almacenes
            $sentencia = $conexPDO->prepare("SELECT * FROM genesis.almacen");
            // Ejecuta la consulta
            $sentencia->execute();
            // Devuelve los resultados de la consulta
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            print("Error al acceder a BD: " . $e->getMessage());
            return [];
        }
    }
}
