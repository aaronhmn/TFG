<?php

namespace model;

use \model\usuarioModel;
use \model\utils;


//Añadimos el código del modelo
require_once("../model/usuarioModel.php");
require_once("../model/utils.php");

session_start();

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

//Creamos un array para guardar los datos del usuario
$usuario = array();

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $usuario["idusuario"] = $_GET["idUsuario"];
    $usuario["nombre"] = $_GET["nombre"];
    $usuario["primer_apellido"] = $_GET["primer_apellido"];
    $usuario["segundo_apellido"] = $_GET["segundo_apellido"];
    $usuario["dni"] = $_GET["dni"];
    $usuario["email"] = $_GET["email"];
    $usuario["nombre_usuario"] = $_GET["nombre_usuario"];
    $usuario["codigo_postal"] = $_GET["codigo_postal"];
    $usuario["calle"] = $_GET["calle"];
    $usuario["numero_bloque"] = $_GET["numero_bloque"];
    $usuario["piso"] = $_GET["piso"];
    $usuario["telefono"] = $_GET["telefono"];
    $usuario["activacion"] = $_GET["activacion"];
    $usuario["activo"] = $_GET["activo"];
    $usuario["rol"] = $_GET["rol"];
    $usuario["estado"] = $_GET["estado"];
    /* $usuario["contrasena"] = $_GET["contrasena"]; */
}

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario["idusuario"] = $_POST["idUsuario"];
    $usuario["nombre"] = $_POST["nombre"];
    $usuario["primer_apellido"] = $_POST["primer_apellido"];
    $usuario["segundo_apellido"] = $_POST["segundo_apellido"];
    $usuario["dni"] = $_POST["dni"];
    $usuario["email"] = $_POST["email"];
    $usuario["nombre_usuario"] = $_POST["nombre_usuario"];
    $usuario["codigo_postal"] = $_POST["codigo_postal"];
    $usuario["calle"] = $_POST["calle"];
    $usuario["numero_bloque"] = $_POST["numero_bloque"];
    $usuario["piso"] = $_POST["piso"];
    $usuario["telefono"] = $_POST["telefono"];
    $usuario["activacion"] = $_POST["activacion"];
    $usuario["activo"] = $_POST["activo"];
    $usuario["rol"] = $_POST["rol"];
    /* $usuario["estado"] = $_POST["estado"]; */
    /* $usuario["contrasena"] = $_POST["contrasena"]; */

    //Nos conectamos a la Bd
    $gestorUsuario = new Usuario();
    $conexPDO = utils::conectar();


    // Exclusión del usuario actual en las comprobaciones
    if ($gestorUsuario->existeEmailM($usuario["email"], $usuario["idusuario"], $conexPDO)) {
        $_SESSION['mensaje'] = 'Este email ya está en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/usuariosAdminController.php");
        exit();
    }

    if ($gestorUsuario->existeNombreUsuarioM($usuario["nombre_usuario"], $usuario["idusuario"], $conexPDO)) {
        $_SESSION['mensaje'] = 'Este nombre de usuario ya está en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/usuariosAdminController.php");
        exit();
    }

    if ($gestorUsuario->existeDniM($usuario["dni"], $usuario["idusuario"], $conexPDO)) {
        $_SESSION['mensaje'] = 'Este dni ya está en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/usuariosAdminController.php");
        exit();
    }

    if ($gestorUsuario->existeTelefonoM($usuario["telefono"], $usuario["idusuario"], $conexPDO)) {
        $_SESSION['mensaje'] = 'Este telefono ya está en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/usuariosAdminController.php");
        exit();
    }

    $resultado = $gestorUsuario->updateUsuario($usuario, $conexPDO);

    // Cambio de contraseña solo si se proporcionan ambos campos de contraseña y son iguales
    if (!empty($_POST['contrasenaNueva']) && !empty($_POST['contrasenaConfirmar']) && $_POST['contrasenaNueva'] === $_POST['contrasenaConfirmar']) {
        $nuevaSalt = Utils::generar_salt(16);
        $nuevaContrasenaHash = crypt($_POST['contrasenaNueva'], '$6$rounds=5000$' . $nuevaSalt . '$');
        if ($gestorUsuario->cambiarContraseñaPorId($_POST["idUsuario"], $nuevaContrasenaHash, $nuevaSalt, $conexPDO)) {
            $_SESSION['mensaje'] .= " y la contraseña ha sido actualizada correctamente.";
        } else {
            $_SESSION['mensaje'] .= " pero no se pudo actualizar la contraseña.";
        }
    } elseif (!empty($_POST['contrasenaNueva']) || !empty($_POST['contrasenaConfirmar'])) {
        $_SESSION['mensaje'] = "Error: Las contraseñas no coinciden o están incompletas.";
        $_SESSION['tipo_mensaje'] = "danger";
    }

    if ($resultado != null) {
        $_SESSION['mensaje'] = "El usuario ha sido modificado correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ../controller/usuariosAdminController.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al modificar el usuario.";
        $_SESSION['tipo_mensaje'] = "danger";
        // Si decides redireccionar de todos modos o manejar de otra forma
        header('Location: ../controller/usuariosAdminController.php');
        exit();
    }
}
