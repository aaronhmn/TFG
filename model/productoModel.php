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
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO genesis.producto (nombre, precio, categoria, sub_categoria, descripcion, especificacion, marca, stock, imagen, tipo_imagen, ruta_imagen) VALUES ( :nombre, :precio, :categoria, :sub_categoria, :descripcion, :especificacion, :marca, :stock, :imagen, :tipo_imagen, :ruta_imagen)");

                //Asociamos los valores a los parametros de la sentencia sql (A la izquierda el parámetro y a la derecha los valores como están en la base de datos)
                $sentencia->bindParam(":nombre", $producto["nombre"]);
                $sentencia->bindParam(":precio", $producto["precio"]);
                $sentencia->bindParam(":categoria", $producto["categoria"]);
                $sentencia->bindParam(":sub_categoria", $producto["sub_categoria"]);
                $sentencia->bindParam(":descripcion", $producto["descripcion"]);
                $sentencia->bindParam(":especificacion", $producto["especificacion"]);
                $sentencia->bindParam(":marca", $producto["marca"]);
                $sentencia->bindParam(":stock", $producto["stock"]);
                $sentencia->bindParam(":imagen", $producto["imagen"]);
                $sentencia->bindParam(":tipo_imagen", $producto["tipo_imagen"]);
                $sentencia->bindParam(":ruta_imagen", $producto["ruta_imagen"]);


                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
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


    function updateProducto($producto, $conexPDO)
    {
        $result = null;
        if (isset($producto) && isset($producto["idproducto"]) && is_numeric($producto["idproducto"])  && $conexPDO != null) {
            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE genesis.producto set nombre=:nombre, precio=:precio, categoria=:categoria, sub_categoria=:sub_categoria, descripcion=:descripcion, especificacion=:especificacion, marca=:marca, stock=:stock, ruta_imagen=:ruta_imagen  where idproducto=:idproducto");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idproducto", $producto["idproducto"]);
                $sentencia->bindParam(":nombre", $producto["nombre"]);
                $sentencia->bindParam(":precio", $producto["precio"]);
                $sentencia->bindParam(":categoria", $producto["categoria"]);
                $sentencia->bindParam(":sub_categoria", $producto["sub_categoria"]);
                $sentencia->bindParam(":especificacion", $producto["especificacion"]);
                $sentencia->bindParam(":descripcion", $producto["descripcion"]);
                $sentencia->bindParam(":marca", $producto["marca"]);
                $sentencia->bindParam(":stock", $producto["stock"]);
                $sentencia->bindParam(":ruta_imagen", $producto["ruta_imagen"]);



                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
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
}
