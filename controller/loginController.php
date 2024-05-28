<?php
namespace model;

use \model\utils;
use \model\Usuario;

require_once("../model/utils.php");
require_once("../model/usuarioModel.php");

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? null;
    $password = $_POST['contrasena'] ?? null;

    $conexPDO = utils::conectar();
    if ($conexPDO) {
        $gestorUsu = new Usuario();
        $resultado = $gestorUsu->getUsuario($email, $conexPDO);

        if ($resultado && password_verify($password, $resultado["contrasena"])) {
            if ($resultado["activo"] == 0) {
                // Usuario no activo, redirigir a la página de verificación
                $_SESSION['email'] = $email; // Guardar email en sesión para usar en la verificación
                header("Location: ../controller/verificarController.php");
                exit();
            }

            // Agregar verificación de estado de banneo
            if ($resultado['estado'] == 1) { // Suponiendo que '1' significa baneado
                $mensaje = 'Su cuenta ha sido baneada y no puede volver a iniciar sesión.';
                // Puedes considerar redireccionar a una página de error o simplemente no iniciar sesión y mostrar el mensaje
            } else {
                // Usuario activo y no baneado, establecer datos de sesión y redirigir según el rol
                $_SESSION['id_usuario'] = $resultado['idusuario'];
                $_SESSION['email'] = $resultado['email'];
                $_SESSION['nombre'] = $resultado['nombre'];
                $_SESSION['nombre_usuario'] = $resultado['nombre_usuario'];
                $_SESSION['rol'] = $resultado['rol'];
                $_SESSION['login'] = true;

                // Redirige según el rol
                if ($resultado["rol"] == 0) {
                    header("Location: ../controller/inicioController.php");
                    exit();
                } else if ($resultado["rol"] == 1) {
                    header("Location: ../controller/inicioAdminController.php");
                    exit();
                }
            }
        } else {
            $mensaje = 'Email o contraseña incorrecta.';
        }
    } else {
        $mensaje = 'Error al conectar con la base de datos.';
    }
}

include("../view/loginView.php");
?>
