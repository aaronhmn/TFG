<?php

namespace model;

use \model\utils;
use \model\usuario;

require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
$mensaje = null;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['inputNombre'];
    $primerApellido = $_POST['inputPrimerApellido'];
    $segundoApellido = $_POST['inputSegundoApellido'];
    $telefono = $_POST['inputTelefono'];
    $dni = $_POST['inputDNI'];
    $codigoPostal = $_POST['inputCodigoPostal'];
    $calle = $_POST['inputCalle'];
    $numeroBloque = $_POST['inputNumeroBloque'];
    $piso = $_POST['inputPiso'];
    $email = $_POST['inputEmail'];
    $usuario = $_POST['inputUsuario'];
    $activo = $_POST['inputActivo'];
    $rol = $_POST['inputRol'];
    $contraseña = $_POST['inputPassword'];

    // Limpieza de los datos
    $datosUsuario = array();
    $datosUsuario["nombre"] = utils::limpiar_datos($nombre);
    $datosUsuario["primer_apellido"] = utils::limpiar_datos($primerApellido);
    $datosUsuario["segundo_apellido"] = utils::limpiar_datos($segundoApellido);
    $datosUsuario["telefono"] = utils::limpiar_datos($telefono);
    $datosUsuario["dni"] = utils::limpiar_datos($dni);
    $datosUsuario["codigo_postal"] = utils::limpiar_datos($codigoPostal);
    $datosUsuario["calle"] = utils::limpiar_datos($calle);
    $datosUsuario["numero_bloque"] = utils::limpiar_datos($numeroBloque);
    $datosUsuario["piso"] = utils::limpiar_datos($piso);
    $datosUsuario["email"] = utils::limpiar_datos($email);
    $datosUsuario["activo"] = utils::limpiar_datos($activo);
    $datosUsuario["rol"] = utils::limpiar_datos($rol);
    $datosUsuario["nombre_usuario"] = utils::limpiar_datos($usuario);

    $gestorUsu = new Usuario();
    //Nos conectamos a la Base de Datos
    $conexPDO = utils::conectar();

    // Verificar si el email ya existe
    if ($gestorUsu->existeEmail($email, $conexPDO)) {
        $_SESSION['mensaje'] = 'Este email ya esta en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/usuariosAdminController.php");
        exit();
    }

    // Verificar si el nombre de usuario ya existe
    if ($gestorUsu->existeNombreUsuario($usuario, $conexPDO)) {
        $_SESSION['mensaje'] = 'Este nombre de usuario ya está en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/usuariosAdminController.php");
        exit();
    }

    // Verificar si el codigo postal ya existe
    if ($gestorUsu->existeDni($dni, $conexPDO)) {
        $_SESSION['mensaje'] = 'Este dni ya esta en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/usuariosAdminController.php");
        exit();
    }

    // Verificar si el telefono ya existe
    if ($gestorUsu->existeTelefono($telefono, $conexPDO)) {
        $_SESSION['mensaje'] = 'Este telefono ya esta en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header("Location: ../controller/usuariosAdminController.php");
        exit();
    }

    // Generamos una salt de 16 posiciones
    $salt = utils::generar_salt(16); // Llama a la función para generar una salt de 16 caracteres
    // Asigna la salt generada al array de datos del usuario
    $datosUsuario["salt"] = $salt;
    // Genera el hash de la contraseña utilizando la salt y asigna al array de datos del usuario
    $datosUsuario["contrasena"] = crypt($contraseña, '$6$rounds=5000$' . $salt . '$'); // Crea un hash de la contraseña usando SHA-512 y la salt generada
    // Generamos el codigo de activación
    $datosUsuario["activacion"] = utils::generar_codigo_activacion();

    $resultado = $gestorUsu->addUsuario($datosUsuario, $conexPDO);

    //Para verificar si todo funcionó correctamente y mensajes de accesibilidad con bootstrap
    if ($resultado != null) {
        $_SESSION['mensaje'] = "El usuario ha sido creado correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ../controller/usuariosAdminController.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al crear el usuario.";
        $_SESSION['tipo_mensaje'] = "danger";
        header('Location: ../controller/usuariosAdminController.php');
        exit();
    }
}
