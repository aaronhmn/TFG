<?php
namespace model;

require_once("utils.php");

use \PDO;
use \PDOException;

class Usuario
{
    /**Funcion que nos devuelve todos los usuarios */
    public function getUsuarios($conexPDO)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conexPDO->prepare("SELECT * FROM genesis.usuario");
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
     * Funcion que nos devuelve todos los usuarios con paginacion
     * */
    public function getUsuariosPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones

                //Query inicial
                $query = "SELECT * FROM genesis.usuario ORDER BY ? ";

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

    /**
     * Devuelve el usuario asociado a la clave primaria introducida
     */
    public function getUsuario($correo, $conexPDO)
    {
        if (isset($correo) && is_string($correo)) {

            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.usuario where email=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $correo);
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

    public function getUsuarioId($id, $conexPDO)
    {
        if (isset($id) && is_numeric($id)) {

            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.usuario where idusuario=?");
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

    function addUsuario($usuario, $conexPDO)
    {
        $result = null;
        if (isset($usuario) && $conexPDO != null) {
            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO genesis.usuario (nombre, primer_apellido, segundo_apellido, dni, email, contrasena, nombre_usuario, direccion, telefono, salt, activacion, activo) VALUES ( :nombre, :primer_apellido, :segundo_apellido, :dni, :email, :contrasena, :nombre_usuario, :direccion, :telefono, :salt, :activacion, :activo)");

                //Asociamos los valores a los parametros de la sentencia sql (A la izquierda el parámetro y a la derecha los valores como están en la base de datos)
                $sentencia->bindParam(":nombre", $usuario["nombre"]);
                $sentencia->bindParam(":primer_apellido", $usuario["primer_apellido"]);
                $sentencia->bindParam(":segundo_apellido", $usuario["segundo_apellido"]);
                $sentencia->bindParam(":dni", $usuario["dni"]);
                $sentencia->bindParam(":email", $usuario["email"]);
                $sentencia->bindParam(":contrasena", $usuario["contrasena"]);
                $sentencia->bindParam(":nombre_usuario", $usuario["nombre_usuario"]);
                $sentencia->bindParam(":direccion", $usuario["direccion"]);
                $sentencia->bindParam(":telefono", $usuario["telefono"]);
                $sentencia->bindParam(":salt", $usuario["salt"]);
                $sentencia->bindParam(":activacion", $usuario["activacion"]);
                $sentencia->bindParam(":activo", $usuario["activo"]);


                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    function delUsuario($idusuario, $conexPDO)
    {
        $result = null;
        if (isset($idusuario) && is_numeric($idusuario)) {
            if ($conexPDO != null) {
                try {
                    //Borramos el cliente asociado a dicho id
                    $sentencia = $conexPDO->prepare("DELETE  FROM genesis.usuario where idusuario=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idusuario);
                    //Ejecutamos la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }

        return $result;
    }


    function updateUsuario($usuario, $conexPDO)
    {
        $result = null;
        if (isset($usuario) && isset($usuario["idusuario"]) && is_numeric($usuario["idusuario"])  && $conexPDO != null) {
            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE genesis.usuario set nombre=:nombre, primer_apellido=:primer_apellido, segundo_apellido=:segundo_apellido, dni=:dni, email=:email, nombre_usuario=:nombre_usuario, direccion=:direccion, telefono=:telefono, activacion=:activacion, activo=:activo, rol=:activo, contrasena=:contrasena where idusuario=:idusuario");

                //print($sentencia->queryString);

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idusuario", $usuario["idusuario"]);
                $sentencia->bindParam(":nombre", $usuario["nombre"]);
                $sentencia->bindParam(":primer_apellido", $usuario["primer_apellido"]);
                $sentencia->bindParam(":segundo_apellido", $usuario["segundo_apellido"]);
                $sentencia->bindParam(":dni", $usuario["dni"]);
                $sentencia->bindParam(":email", $usuario["email"]);               
                $sentencia->bindParam(":nombre_usuario", $usuario["nombre_usuario"]);
                $sentencia->bindParam(":direccion", $usuario["direccion"]);
                $sentencia->bindParam(":telefono", $usuario["telefono"]);
                $sentencia->bindParam(":activacion", $usuario["activacion"]);
                $sentencia->bindParam(":activo", $usuario["activo"]);
                $sentencia->bindParam(":rol", $usuario["rol"]);
                $sentencia->bindParam(":contrasena", $usuario["contrasena"]);
                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    function activarUsuario($email, $conexPDO)
    {
        $result = null;
        $activo = 1;
        $email2 = $email; 

        echo $email2;

        if ($conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE genesis.usuario SET activo=? WHERE email=?");
                

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(1, $activo, PDO::PARAM_INT);
                $sentencia->bindParam(2, $email2);


                //Ejecutamos la sentencia
                $result = $sentencia->execute();


            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    function cambiarContraseña($usuario, $conexPDO)
    {
        $result = null;

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE genesis.usuario SET activo=?, contrasena=?, salt=? WHERE email=?");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(1, $usuario["activo"], PDO::PARAM_INT);
                $sentencia->bindParam(2, $usuario["contrasena"]);
                $sentencia->bindParam(3, $usuario["salt"]);
                $sentencia->bindParam(4, $usuario["email"]);
                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }

        return $result;
    }
}