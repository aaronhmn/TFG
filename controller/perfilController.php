<?php

namespace model;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use \model\utils;
use \model\usuario;

// Incluir las definiciones de las clases del modelo
require_once("../model/utils.php");
require_once("../model/usuarioModel.php");

$usuarioModel = new Usuario();
$conexPDO = utils::conectar();

$mensaje = ''; // Para almacenar mensajes que se mostrarán al usuario

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    // Redirigir al login si no hay ID de usuario en la sesión
    header("Location: ../view/loginView.php");
    exit();
}

// Intentar cargar los datos del usuario de la base de datos
$datosUsuario = $usuarioModel->getUsuarioId($_SESSION['id_usuario'], $conexPDO);
if (!$datosUsuario) {
    $datosUsuario = [];  // Si no se encuentran datos, usar un arreglo vacío
    $mensaje = 'No se pudo cargar la información del perfil.';
}

// Comprobar si se enviaron datos del formulario por POST para actualizar el perfil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aplicar trim a todos los valores de entrada para limpiarlos
    $_POST = array_map('trim', $_POST);
    // Recolectar datos del formulario asegurándose de manejar posibles valores nulos
    $nombre = $_POST['nombre'] ?? '';
    $nombre_usuario = $_POST['nombre_usuario'] ?? '';
    $primerApellido = $_POST['primer_apellido'] ?? '';
    $segundoApellido = $_POST['segundo_apellido'] ?? '';
    $dni = $_POST['dni'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $codigo_postal = $_POST['codigo_postal'] ?? '';
    $calle = $_POST['calle'] ?? '';
    $numero_bloque = $_POST['numero_bloque'] ?? '';
    $piso = $_POST['piso'] ?? '';

    // Verificar si el email o el nombre de usuario ya están registrados
    if ($usuarioModel->existeEmail($email, $conexPDO) && $email !== $datosUsuario['email']) {
        $_SESSION['mensaje'] = 'Este email ya está registrado.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header('Location: ../controller/perfilController.php');
        exit();
    }

    if ($usuarioModel->existeNombreUsuario($nombre_usuario, $conexPDO) && $nombre_usuario !== $datosUsuario['nombre_usuario']) {
        $_SESSION['mensaje'] = 'Este nombre de usuario ya está en uso.';
        $_SESSION['tipo_mensaje'] = 'danger';
        header('Location: ../controller/perfilController.php');
        exit();
    }

    $errores = [];

    // Validar el DNI
    if (!preg_match('/^\d{8}[A-Za-z]$/', $dni)) {
        $errores[] = "El DNI debe tener 8 dígitos seguidos de una letra.";
    }

    // Validar el teléfono
    if (!preg_match('/^\d{9}$/', $telefono)) {
        $errores[] = "El número de teléfono debe tener 9 dígitos.";
    }

    // Validar el email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email es inválido.";
    }

    // Si hay errores, prepara una respuesta adecuada o maneja los errores como consideres necesario
    if (!empty($errores)) {
        $_SESSION['mensaje'] = "Errores en el formulario: \n" . implode("\n", $errores);
        $_SESSION['tipo_mensaje'] = "danger";
        header('Location: ../controller/perfilController.php');
        exit();
    }

    // Crear el array de datos del usuario para la actualización
    $usuario = [
        'idusuario' => $_SESSION['id_usuario'],
        'nombre' => $nombre,
        'nombre_usuario' => $nombre_usuario,
        'primer_apellido' => $primerApellido,
        'segundo_apellido' => $segundoApellido,
        'dni' => $dni,
        'email' => $email,
        'telefono' => $telefono,
        'codigo_postal' => $codigo_postal,
        'calle' => $calle,
        'numero_bloque' => $numero_bloque,
        'piso' => $piso,
        'activo' => true, // Asumiendo que se quiere mantener al usuario como activo
    ];

    // Intentar actualizar los datos del usuario en la base de datos
    $resultado = $usuarioModel->updateUsuario($usuario, $conexPDO);
    if ($resultado) {
        $mensaje = "Perfil actualizado correctamente.";
        // Recargar los datos del usuario para reflejar los cambios
        $datosUsuario = $usuarioModel->getUsuarioId($_SESSION['id_usuario'], $conexPDO);
    } else {
        $mensaje = "Error al actualizar el perfil.";
    }

    if ($resultado != null) {
        $_SESSION['mensaje'] = "El perfil ha sido modificado correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
        header('Location: ../controller/perfilController.php');
        exit();
    } else {
        $_SESSION['mensaje'] = "Error al modificar el perfil.";
        $_SESSION['tipo_mensaje'] = "danger";
        // Si decides redireccionar de todos modos o manejar de otra forma
        header('Location: ../controller/perfilController.php');
        exit();
    }
}

// Incluir la vista que presenta la información del usuario
include("../view/perfilView.php");

?>
