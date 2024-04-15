<?php

namespace model;

use \model\utils;
use \model\usuarioModel;

require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
$mensaje = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['contrasena'])) {
        $email = $_POST['email'];
        $contraseña = $_POST['contrasena'];

        session_start();  // Asegúrate de iniciar sesión aquí

        $conexPDO = utils::conectar();
        if ($conexPDO) {
            $gestorUsu = new Usuario();
            $resultado = $gestorUsu->getUsuario($email, $conexPDO);

            if (is_array($resultado) && isset($resultado["salt"])) {
                $usuario["contrasena"] = crypt($contraseña, '$6$rounds=5000$' . $resultado["salt"] . '$');

                if ($usuario["contrasena"] == $resultado["contrasena"] && $resultado["estado"] != 1) {
                    $_SESSION['email'] = $email;
                    $_SESSION['nombre_usuario'] = $resultado['nombre_usuario'];
                    $_SESSION['rol'] = $resultado['rol'];
                    $_SESSION['login'] = true;

                    if ($resultado["activo"] == 0) {
                        header("Location: ../controller/verificarController.php");
                        exit();
                    } else if ($resultado["rol"] == 0) {
                        header("Location: ../controller/inicioController.php");
                        exit();
                    } else if ($resultado["rol"] == 1) {
                        header("Location: ../controller/inicioAdminController.php");
                        exit();
                    }
                } else {
                    $mensaje = 'Tu cuenta puede estar baneada o los datos ingresados son incorrectos.';
                }
            } else {
                $mensaje = 'Error de autenticación.';
            }
        }
    }
}

include("../view/loginView.php");
?>
