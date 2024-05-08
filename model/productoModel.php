<?php

namespace model;

require_once("utils.php");

use \PDO;
use \PDOException;

class producto
{
    /**Funcion que nos devuelve todos los productos */
    public function getProductos($conexPDO)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conexPDO->prepare("SELECT * FROM genesis.producto");
                //Ejecutamos la sentencia
                $sentencia->execute();

                //Devolvemos los datos del cliente
                return $sentencia->fetchAll();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }


    /**
     * Funcion que nos devuelve todos los productos con paginacion
     * */
    public function getProductosPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones

                //Query inicial
                $query = "SELECT * FROM genesis.producto ORDER BY ? ";

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

                //INTERESANTE 
                //queryString contiene la sentencia sql a ejecutar
                //print($sentencia->queryString);

                //Ejecutamos la sentencia
                $sentencia->execute();

                //Devolvemos los datos del cliente
                return $sentencia->fetchAll();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }

    public function getProductoId($id, $conexPDO)
    {
        if (isset($id) && is_numeric($id)) {

            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.producto where idproducto=?");
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

    function addProducto($producto, $conexPDO)
    {
        $result = null;
        if (isset($producto) && $conexPDO != null) {
            try {
                // Preparamos la sentencia SQL con todos los campos necesarios, incluidas las claves foráneas
                $sql = "INSERT INTO genesis.producto (nombre, precio, id_categoria, descripcion, especificacion, id_marca, stock, imagen, tipo_imagen, ruta_imagen) VALUES (:nombre, :precio, :id_categoria, :descripcion, :especificacion, :id_marca, :stock, :imagen, :tipo_imagen, :ruta_imagen)";
                $stmt = $conexPDO->prepare($sql);

                // Asociamos los valores a los parámetros de la sentencia SQL
                $stmt->bindParam(":nombre", $producto["nombre"]);
                $stmt->bindParam(":precio", $producto["precio"]);
                $stmt->bindParam(":id_categoria", $producto["id_categoria"]);
                $stmt->bindParam(":descripcion", $producto["descripcion"]);
                $stmt->bindParam(":especificacion", $producto["especificacion"]);
                $stmt->bindParam(":id_marca", $producto["id_marca"]);
                $stmt->bindParam(":stock", $producto["stock"]);
                $stmt->bindParam(":imagen", $producto["imagen"]);
                $stmt->bindParam(":tipo_imagen", $producto["tipo_imagen"]);
                $stmt->bindParam(":ruta_imagen", $producto["ruta_imagen"]);

                // Ejecutamos la sentencia
                $result = $stmt->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD: " . $e->getMessage());
            }
        }

        return $result;
    }

    function updateProducto($producto, $conexPDO)
    {
        $result = null;
        if (isset($producto) && isset($producto["idproducto"]) && is_numeric($producto["idproducto"]) && $conexPDO != null) {
            try {
                // Preparamos la sentencia SQL con todos los campos necesarios, incluidas las claves foráneas
                $sql = "UPDATE genesis.producto SET nombre = :nombre, precio = :precio, id_categoria = :id_categoria, descripcion = :descripcion, especificacion = :especificacion, id_marca = :id_marca, stock = :stock, ruta_imagen = :ruta_imagen  WHERE idproducto = :idproducto";

                $stmt = $conexPDO->prepare($sql);

                // Asociamos los valores a los parámetros de la sentencia SQL
                $stmt->bindParam(":idproducto", $producto["idproducto"], PDO::PARAM_INT);
                $stmt->bindParam(":nombre", $producto["nombre"]);
                $stmt->bindParam(":precio", $producto["precio"]);
                $stmt->bindParam(":id_categoria", $producto["id_categoria"]);
                $stmt->bindParam(":descripcion", $producto["descripcion"]);
                $stmt->bindParam(":especificacion", $producto["especificacion"]);
                $stmt->bindParam(":id_marca", $producto["id_marca"]);
                $stmt->bindParam(":stock", $producto["stock"]);
                $stmt->bindParam(":ruta_imagen", $producto["ruta_imagen"]);

                // Ejecutamos la sentencia
                $result = $stmt->execute();
            } catch (PDOException $e) {
                print("Error al actualizar producto en BD: " . $e->getMessage());
                // Considera loguear el error en un archivo de logs para un seguimiento detallado
            }
        } else {
            print("Datos insuficientes para actualizar el producto o conexión de base de datos nula.");
        }

        return $result;
    }

    function delProducto($idProducto, $conexPDO)
    {
        $result = null;
        if (isset($idProducto) && is_numeric($idProducto)) {
            if ($conexPDO != null) {
                try {
                    //Borramos el cliente asociado a dicho id
                    $sentencia = $conexPDO->prepare("DELETE  FROM genesis.producto where idproducto=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idProducto);
                    //Ejecutamos la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }

        return $result;
    }

    public function getImagenesPorProducto($idProducto, $conexPDO)
    {
        $rutasImagenes = [];

        if (isset($idProducto) && is_numeric($idProducto)) {
            if ($conexPDO != null) {
                try {
                    // Preparamos la sentencia SQL para obtener las rutas de las imágenes
                    $sentencia = $conexPDO->prepare("SELECT ruta_imagen FROM genesis.producto WHERE idproducto = :idProducto");

                    // Vinculamos el parámetro ':idProducto' al valor real de la variable $idProducto
                    $sentencia->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);

                    // Ejecutamos la consulta
                    $sentencia->execute();

                    // Obtenemos el resultado de la consulta
                    $fila = $sentencia->fetch(PDO::FETCH_ASSOC);

                    if ($fila && $fila['ruta_imagen']) {
                        // Si la columna 'ruta_imagen' contiene las rutas de las imágenes separadas por comas,
                        // las separamos y las agregamos al array $rutasImagenes
                        $rutasImagenes = explode(',', $fila['ruta_imagen']);
                    }
                } catch (PDOException $e) {
                    print("Error al acceder a la BD: " . $e->getMessage());
                }
            }
        }

        return $rutasImagenes;
    }

    public function getProductosPorNombre($conexPDO, $nombre) {
        try {
            $stmt = $conexPDO->prepare("SELECT * FROM genesis.producto WHERE nombre LIKE ?");
            $stmt->execute(['%' . $nombre . '%']);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            print("Error al acceder a BD" . $e->getMessage());
            return [];
        }
    }

    public function contarProductos($conexPDO) {
        if ($conexPDO != null) {
            try {
                $sentencia = $conexPDO->prepare("SELECT COUNT(*) AS total FROM genesis.producto");
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                return $resultado['total'];
            } catch (PDOException $e) {
                print("Error al contar productos: " . $e->getMessage());
                return 0; // Devuelve 0 en caso de error
            }
        }
        return 0; // Si no hay conexión, retorna 0
    }
}

function getCategorias($conexPDO)
{
    if ($conexPDO != null) {
        try {
            $sentencia = $conexPDO->prepare("SELECT * FROM genesis.categoria");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print("Error al acceder a BD: " . $e->getMessage());
            return [];
        }
    }
}

function getMarcas($conexPDO)
{
    if ($conexPDO != null) {
        try {
            $sentencia = $conexPDO->prepare("SELECT * FROM genesis.marca");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print("Error al acceder a BD: " . $e->getMessage());
            return [];
        }
    }
}

