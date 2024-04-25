<?php

// Iniciar sesión al comienzo del script
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir las dependencias necesarias
require_once("../model/utils.php");
require_once("../model/usuarioModel.php");

use model\Usuario;
use model\utils;

// Crear una instancia de conexión y del modelo
$conexPDO = utils::conectar();
$usuarioModel = new Usuario();

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario o usar valores vacíos si no están disponibles
    $idUsuario = $_SESSION['id_usuario'];
    $nombre = $_POST['nombre'] ?? '';
    $nombre_usuario = $_POST['nombre_usuario'] ?? '';
    $primerApellido = $_POST['primer_apellido'] ?? '';
    $segundoApellido = $_POST['segundo_apellido'] ?? '';
    $dni = $_POST['dni'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $codigoPostal = $_POST['codigo_postal'] ?? '';
    $calle = $_POST['calle'] ?? '';
    $numero_bloque = $_POST['numero_bloque'] ?? '';
    $piso = $_POST['piso'] ?? '';
    $email = $_POST['email'] ?? '';

    // Crear un array asociativo con los datos del usuario
    $usuario = [
        'idusuario' => $idUsuario,
        'nombre' => $nombre,
        'nombre_usuario' => $nombre_usuario,
        'primer_apellido' => $primerApellido,
        'segundo_apellido' => $segundoApellido,
        'dni' => $dni,
        'telefono' => $telefono,
        'codigo_postal' => $codigoPostal,
        'calle' => $calle,
        'numero_bloque' => $numero_bloque,
        'piso' => $piso,
        'email' => $email
    ];

    // Llamar al método de actualización del modelo
    $resultado = $usuarioModel->updateUsuario($usuario, $conexPDO);

    // Verificar el resultado de la actualización y responder al usuario
    if ($resultado) {
        echo "<p>Datos actualizados correctamente.</p>";
    } else {
        echo "<p>Error al actualizar los datos. Por favor, intente de nuevo.</p>";
    }
}

// (Opcional) Incluir el formulario de perfil o cualquier otra vista necesaria
include("../view/perfilView.php");
?>