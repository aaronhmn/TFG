<?php

namespace model;

require_once("utils.php"); // Incluir el archivo utils.php que posiblemente contenga funciones auxiliares.

use \PDO; // Usar la clase PDO para la conexión con la base de datos.
use \PDOException; // Usar la clase PDOException para manejar excepciones relacionadas con PDO.

class Usuario
{
    /** Función que devuelve todos los usuarios */
    public function getUsuarios($conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la sentencia SQL para seleccionar todos los usuarios
                $sentencia = $conexPDO->prepare("SELECT * FROM genesis.usuario");
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

    /** Función que devuelve todos los usuarios con paginación */
    public function getUsuariosPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la sentencia SQL base para obtener los usuarios, ordenados según un campo específico
                $query = "SELECT * FROM genesis.usuario ORDER BY ? ";

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

    /** Función que devuelve el usuario asociado a la clave primaria introducida */
    public function getUsuario($correo, $conexPDO)
    {
        // Verifica si el correo es válido
        if (isset($correo) && is_string($correo)) {
            // Verifica si la conexión no es nula
            if ($conexPDO != null) {
                try {
                    // Prepara la sentencia SQL para seleccionar un usuario por su correo
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.usuario WHERE email=?");
                    // Asocia el correo a la sentencia
                    $sentencia->bindParam(1, $correo);
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

    /** Función que devuelve el usuario por su ID */
    public function getUsuarioId($id, $conexPDO)
    {
        // Verifica si el ID es válido
        if (isset($id) && is_numeric($id)) {
            // Verifica si la conexión no es nula
            if ($conexPDO != null) {
                try {
                    // Prepara la sentencia SQL para seleccionar un usuario por su ID
                    $sentencia = $conexPDO->prepare("SELECT * FROM genesis.usuario WHERE idusuario=?");
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

    /** Función para agregar un nuevo usuario */
    function addUsuario($usuario, $conexPDO)
    {
        $result = null;
        // Verifica si el usuario y la conexión no son nulos
        if (isset($usuario) && $conexPDO != null) {
            try {
                // Prepara la sentencia SQL para insertar un nuevo usuario
                $sentencia = $conexPDO->prepare("INSERT INTO genesis.usuario (nombre, primer_apellido, segundo_apellido, dni, email, contrasena, nombre_usuario, codigo_postal, calle, numero_bloque, piso, telefono, salt, activacion, activo, rol) VALUES (:nombre, :primer_apellido, :segundo_apellido, :dni, :email, :contrasena, :nombre_usuario, :codigo_postal, :calle, :numero_bloque, :piso, :telefono, :salt, :activacion, :activo, :rol)");

                // Asocia los valores a los parámetros de la sentencia SQL
                $sentencia->bindParam(":nombre", $usuario["nombre"]);
                $sentencia->bindParam(":primer_apellido", $usuario["primer_apellido"]);
                $sentencia->bindParam(":segundo_apellido", $usuario["segundo_apellido"]);
                $sentencia->bindParam(":dni", $usuario["dni"]);
                $sentencia->bindParam(":email", $usuario["email"]);
                $sentencia->bindParam(":contrasena", $usuario["contrasena"]);
                $sentencia->bindParam(":nombre_usuario", $usuario["nombre_usuario"]);
                $sentencia->bindParam(":codigo_postal", $usuario["codigo_postal"]);
                $sentencia->bindParam(":calle", $usuario["calle"]);
                $sentencia->bindParam(":numero_bloque", $usuario["numero_bloque"]);
                $sentencia->bindParam(":piso", $usuario["piso"]);
                $sentencia->bindParam(":telefono", $usuario["telefono"]);
                $sentencia->bindParam(":salt", $usuario["salt"]);
                $sentencia->bindParam(":activacion", $usuario["activacion"]);
                $sentencia->bindParam(":activo", $usuario["activo"]);
                $sentencia->bindParam(":rol", $usuario["rol"]);

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

    /** Función para eliminar un usuario por su ID */
    function delUsuario($idusuario, $conexPDO)
    {
        $result = null;
        // Verifica si el ID del usuario es válido
        if (isset($idusuario) && is_numeric($idusuario)) {
            // Verifica si la conexión no es nula
            if ($conexPDO != null) {
                try {
                    // Prepara la sentencia SQL para eliminar un usuario por su ID
                    $sentencia = $conexPDO->prepare("DELETE FROM genesis.usuario WHERE idusuario=?");
                    // Asocia el ID del usuario a la sentencia
                    $sentencia->bindParam(1, $idusuario);
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

    /** Función para actualizar un usuario existente */
    function updateUsuario($usuario, $conexPDO)
    {
        $result = null;
        // Verifica si el usuario y su ID son válidos, y que la conexión no es nula
        if (isset($usuario) && isset($usuario["idusuario"]) && is_numeric($usuario["idusuario"]) && $conexPDO != null) {
            try {
                // Prepara la sentencia SQL para actualizar un usuario en la base de datos
                $sentencia = $conexPDO->prepare("UPDATE genesis.usuario SET nombre=:nombre, primer_apellido=:primer_apellido, segundo_apellido=:segundo_apellido, dni=:dni, email=:email, nombre_usuario=:nombre_usuario, codigo_postal=:codigo_postal, calle=:calle, numero_bloque=:numero_bloque, piso=:piso, telefono=:telefono, activacion=:activacion, activo=:activo, rol=:rol, estado=:estado WHERE idusuario=:idusuario");

                // Asocia los valores a los parámetros de la sentencia SQL
                $sentencia->bindParam(":idusuario", $usuario["idusuario"]);
                $sentencia->bindParam(":nombre", $usuario["nombre"]);
                $sentencia->bindParam(":primer_apellido", $usuario["primer_apellido"]);
                $sentencia->bindParam(":segundo_apellido", $usuario["segundo_apellido"]);
                $sentencia->bindParam(":dni", $usuario["dni"]);
                $sentencia->bindParam(":email", $usuario["email"]);
                $sentencia->bindParam(":nombre_usuario", $usuario["nombre_usuario"]);
                $sentencia->bindParam(":codigo_postal", $usuario["codigo_postal"]);
                $sentencia->bindParam(":calle", $usuario["calle"]);
                $sentencia->bindParam(":numero_bloque", $usuario["numero_bloque"]);
                $sentencia->bindParam(":piso", $usuario["piso"]);
                $sentencia->bindParam(":telefono", $usuario["telefono"]);
                $sentencia->bindParam(":activacion", $usuario["activacion"]);
                $sentencia->bindParam(":activo", $usuario["activo"]);
                $sentencia->bindParam(":rol", $usuario["rol"]);
                $sentencia->bindParam(":estado", $usuario["estado"]);
                // $sentencia->bindParam(":contrasena", $usuario["contrasena"]); // Este parámetro está comentado

                // Ejecuta la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al acceder a BD" . $e->getMessage());
                return false;
            }
        }

        // Devuelve el resultado de la operación (true si fue exitosa, false o null si no)
        return $result;
    }

    /** Función para activar un usuario por su email */
    function activarUsuario($email, $conexPDO)
    {
        $result = null;
        $activo = 1; // Variable para indicar que el usuario está activo
        $email2 = $email; // Copia del email

        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara la sentencia SQL para activar un usuario
                $sentencia = $conexPDO->prepare("UPDATE genesis.usuario SET activo=? WHERE email=?");
                // Asocia los valores a los parámetros de la sentencia SQL
                $sentencia->bindParam(1, $activo, PDO::PARAM_INT);
                $sentencia->bindParam(2, $email2);
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

    /** Función para cambiar la contraseña de un usuario */
    function cambiarContraseña($email, $nuevaContrasena, $nuevaSalt, $conexPDO)
    {
        $result = null;

        try {
            // Prepara la sentencia SQL para actualizar la contraseña y salt de un usuario
            $sentencia = $conexPDO->prepare("UPDATE genesis.usuario SET contrasena=?, salt=? WHERE email=?");
            // Asocia los valores a los parámetros de la sentencia SQL
            $sentencia->bindParam(1, $nuevaContrasena);
            $sentencia->bindParam(2, $nuevaSalt);
            $sentencia->bindParam(3, $email);
            // Ejecuta la sentencia
            $result = $sentencia->execute();
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            print("Error al acceder a BD" . $e->getMessage());
        }

        // Devuelve el resultado de la operación (true si fue exitosa, false o null si no)
        return $result;
    }

    /** Función para cambiar la contraseña de un usuario por su ID */
    public function cambiarContraseñaPorId($idUsuario, $nuevaContrasena, $nuevaSalt, $conexPDO)
    {
        try {
            // Prepara la sentencia SQL para actualizar la contraseña y salt de un usuario por su ID
            $sentencia = $conexPDO->prepare("UPDATE genesis.usuario SET contrasena=?, salt=? WHERE idusuario=?");
            // Asocia los valores a los parámetros de la sentencia SQL
            $sentencia->bindParam(1, $nuevaContrasena);
            $sentencia->bindParam(2, $nuevaSalt);
            $sentencia->bindParam(3, $idUsuario);
            // Ejecuta la sentencia y devuelve el resultado
            return $sentencia->execute();
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            print("Error al actualizar contraseña: " . $e->getMessage());
            return false;
        }
    }

    /** Función para banear o desbanear un usuario por su ID */
    function BanUsuarioPorId($idUsuario, $conexPDO)
    {
        $result = null;

        // Verifica si el ID del usuario es válido y la conexión no es nula
        if (isset($idUsuario) && is_numeric($idUsuario) && $conexPDO != null) {
            try {
                // Primero, obtiene el estado actual del usuario (si está baneado o no)
                $sentencia = $conexPDO->prepare("SELECT estado FROM genesis.usuario WHERE idusuario = ?");
                $sentencia->bindParam(1, $idUsuario, PDO::PARAM_INT);
                $sentencia->execute();
                $usuario = $sentencia->fetch(PDO::FETCH_ASSOC);

                if ($usuario) {
                    // Invierte el estado: si es 0 (activo), lo pone a 1 (baneado), y viceversa.
                    $nuevoEstado = $usuario['estado'] == 0 ? 1 : 0;

                    // Actualiza el estado del usuario en la base de datos
                    $sentencia = $conexPDO->prepare("UPDATE genesis.usuario SET estado = ? WHERE idusuario = ?");
                    $sentencia->bindParam(1, $nuevoEstado, PDO::PARAM_INT);
                    $sentencia->bindParam(2, $idUsuario, PDO::PARAM_INT);
                    $result = $sentencia->execute();
                }
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al cambiar el estado de baneo del usuario: " . $e->getMessage());
            }
        }

        // Devuelve el resultado de la operación (true si fue exitosa, false o null si no)
        return $result;
    }

    /** Función para contar el total de usuarios */
    public function contarUsuarios($conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara una sentencia SQL para contar el total de usuarios
                $sentencia = $conexPDO->prepare("SELECT COUNT(*) AS total FROM genesis.usuario");
                // Ejecuta la sentencia
                $sentencia->execute();
                // Obtiene y retorna el resultado de la consulta
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                return $resultado['total'];
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                print("Error al contar usuarios: " . $e->getMessage());
                return 0; // Devuelve 0 en caso de error
            }
        }
        // Retorna 0 si la conexión es nula
        return 0;
    }

    /** Función para verificar si un email ya existe en la base de datos */
    public function existeEmail($email, $conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara una sentencia SQL para contar los usuarios con un email específico
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.usuario WHERE email = :email");
                // Asocia el email a la sentencia
                $stmt->bindParam(':email', $email);
                // Ejecuta la sentencia
                $stmt->execute();
                // Retorna true si existe al menos un usuario con ese email, false de lo contrario
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                error_log("Error al verificar email: " . $e->getMessage());
                return false;
            }
        }
        // Retorna false si la conexión es nula
        return false;
    }

    /** Función para verificar si un nombre de usuario ya existe en la base de datos */
    public function existeNombreUsuario($nombreUsuario, $conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara una sentencia SQL para contar los usuarios con un nombre de usuario específico
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.usuario WHERE nombre_usuario = :nombre_usuario");
                // Asocia el nombre de usuario a la sentencia
                $stmt->bindParam(':nombre_usuario', $nombreUsuario);
                // Ejecuta la sentencia
                $stmt->execute();
                // Retorna true si existe al menos un usuario con ese nombre de usuario, false de lo contrario
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                error_log("Error al verificar nombre_usuario: " . $e->getMessage());
                return false;
            }
        }
        // Retorna false si la conexión es nula
        return false;
    }

    /** Función para verificar si un DNI ya existe en la base de datos */
    public function existeDni($dni, $conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara una sentencia SQL para contar los usuarios con un DNI específico
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.usuario WHERE dni = :dni");
                // Asocia el DNI a la sentencia
                $stmt->bindParam(':dni', $dni);
                // Ejecuta la sentencia
                $stmt->execute();
                // Retorna true si existe al menos un usuario con ese DNI, false de lo contrario
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                error_log("Error al verificar dni: " . $e->getMessage());
                return false;
            }
        }
        // Retorna false si la conexión es nula
        return false;
    }

    /** Función para verificar si un teléfono ya existe en la base de datos */
    public function existeTelefono($telefono, $conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara una sentencia SQL para contar los usuarios con un teléfono específico
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.usuario WHERE telefono = :telefono");
                // Asocia el teléfono a la sentencia
                $stmt->bindParam(':telefono', $telefono);
                // Ejecuta la sentencia
                $stmt->execute();
                // Retorna true si existe al menos un usuario con ese teléfono, false de lo contrario
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                error_log("Error al verificar telefono: " . $e->getMessage());
                return false;
            }
        }
        // Retorna false si la conexión es nula
        return false;
    }

    /** Función para verificar si un email ya existe en la base de datos excluyendo un ID de usuario específico */
    public function existeEmailM($email, $idusuario, $conexPDO)
    {
        try {
            // Prepara una sentencia SQL para contar los usuarios con un email específico, excluyendo un ID de usuario dado
            $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.usuario WHERE email = :email AND idusuario <> :idusuario");
            // Asocia el email y el ID del usuario a la sentencia
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':idusuario', $idusuario);
            // Ejecuta la sentencia
            $stmt->execute();
            // Retorna true si existe al menos un usuario con ese email, excluyendo el ID especificado, false de lo contrario
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            error_log("Error al verificar email: " . $e->getMessage());
            return false;
        }
    }

    /** Función para verificar si un nombre de usuario ya existe en la base de datos excluyendo un ID de usuario específico */
    public function existeNombreUsuarioM($nombreUsuario, $idusuario, $conexPDO)
    {
        // Verifica si la conexión no es nula
        if ($conexPDO != null) {
            try {
                // Prepara una consulta SQL que excluya el ID del usuario actual
                $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.usuario WHERE nombre_usuario = :nombre_usuario AND idusuario <> :idusuario");
                // Asocia los valores a los parámetros de la consulta
                $stmt->bindParam(':nombre_usuario', $nombreUsuario);
                $stmt->bindParam(':idusuario', $idusuario);
                // Ejecuta la consulta
                $stmt->execute();
                // Retorna true si existe al menos un usuario con ese nombre de usuario, excluyendo el ID especificado, false de lo contrario
                return $stmt->fetchColumn() > 0;
            } catch (PDOException $e) {
                // Maneja y muestra el error si ocurre una excepción
                error_log("Error al verificar nombre_usuario: " . $e->getMessage());
                return false;
            }
        }
        // Retorna false si la conexión es nula
        return false;
    }

    /** Función para verificar si un DNI ya existe en la base de datos excluyendo un ID de usuario específico */
    public function existeDniM($dni, $idusuario, $conexPDO)
    {
        try {
            // Prepara una sentencia SQL para contar los usuarios con un DNI específico, excluyendo un ID de usuario dado
            $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.usuario WHERE dni = :dni AND idusuario <> :idusuario");
            // Asocia el DNI y el ID del usuario a la sentencia
            $stmt->bindParam(':dni', $dni);
            $stmt->bindParam(':idusuario', $idusuario);
            // Ejecuta la sentencia
            $stmt->execute();
            // Retorna true si existe al menos un usuario con ese DNI, excluyendo el ID especificado, false de lo contrario
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            error_log("Error al verificar dni: " . $e->getMessage());
            return false;
        }
    }

    /** Función para verificar si un teléfono ya existe en la base de datos excluyendo un ID de usuario específico */
    public function existeTelefonoM($telefono, $idusuario, $conexPDO)
    {
        try {
            // Prepara una sentencia SQL para contar los usuarios con un teléfono específico, excluyendo un ID de usuario dado
            $stmt = $conexPDO->prepare("SELECT COUNT(*) FROM genesis.usuario WHERE telefono = :telefono AND idusuario <> :idusuario");
            // Asocia el teléfono y el ID del usuario a la sentencia
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':idusuario', $idusuario);
            // Ejecuta la sentencia
            $stmt->execute();
            // Retorna true si existe al menos un usuario con ese teléfono, excluyendo el ID especificado, false de lo contrario
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            // Maneja y muestra el error si ocurre una excepción
            error_log("Error al verificar telefono: " . $e->getMessage());
            return false;
        }
    }
}
