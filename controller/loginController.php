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

            // Usuario activo, establecer datos de sesión y redirigir según el rol
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
        } else {
            $mensaje = 'Credenciales incorrectas o cuenta no encontrada.';
            // Manejar error de autenticación
        }
    } else {
        $mensaje = 'Error al conectar con la base de datos.';
        // Manejar error de conexión
    }
}

include("../view/loginView.php");
?>
