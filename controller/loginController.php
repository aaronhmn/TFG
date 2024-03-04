<?php

namespace model;


use \model\utils;
use \model\usuarioModel;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
$mensaje = null;

include("../view/loginView.php");





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) &&  isset($_POST['contrasena'])) {
        $email = $_POST['email'];
        $contraseña = $_POST['contrasena'];

        //Nos conectamos a la Bd
        $conexPDO = utils::conectar();

        //Comprobamos la conexión
        if ($conexPDO == true) {
            //Variable
            $usuario = array();

            //Declaramos un objeto de la clase Usuario para utilizar sus funciones
            $gestorUsu = new Usuario();

            //Buscamos al usuario según su Email y recoger su salt
            $usuario["email"] = utils::limpiar_datos($email);
            $resultado = $gestorUsu->getUsuario($email, $conexPDO);

            if (is_array($resultado) && isset($resultado["salt"])) {
                $salt = $resultado["salt"];
                $usuario["salt"] = $salt;

                
            //Encriptamos la contraseña con la función crypt para ver si councide con la de la base de datos
            //utilizando la salt generada y SHA-512
            $usuario["contrasena"] = crypt($contraseña, '$6$rounds=5000$' . $salt . '$');
            }
           


            if (is_array($resultado) && $usuario["contrasena"] == $resultado["contrasena"]) {
                session_start();
                $_SESSION['email'] = $email;
            
                if ($resultado["activo"] == 0) {
                    header("Location: ../controller/verificarController.php");
                    $_SESSION['login'] = false;
                    exit();
                } else {
                    // Redirigir a diferentes vistas según el rol del usuario
                    if ($resultado["rol"] == 0) {
                        // Si el rol es 0 (cliente), redirigir al inicio de los clientes
                        header("Location: ../controller/inicioController.php");
                    } elseif ($resultado["rol"] == 1) {
                        // Si el rol es 1 (administrador), redirigir al inicio de los administradores
                        header("Location: ../controller/inicioAdminController.php");
                    }
                    $_SESSION['login'] = true;
                    exit();
                }
            } else {
                echo "<script>console.log('Email o contraseña incorrecta');</script>";
            }
            
        }
    }
}
