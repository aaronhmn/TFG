<?php

namespace controller;

// Asegúrate de que los namespaces y rutas sean correctos
require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
require_once("../model/productoModel.php");
/* require_once("../model/carritoModel.php"); */

use \model\utils;
use model\Usuario;
use model\Producto;
/* use model\Carrito; */

// Inicializar la conexión a la base de datos
$conexPDO = utils::conectar();

// Iniciar sesión para manejar la autenticación del usuario
session_start();

// Obtener el ID del usuario desde la sesión
$idUsuario = $_SESSION['id_usuario'] ?? null;

$usuarioModel = new Usuario();
/* $carritoModel = new Carrito(); */
$productoModel = new Producto();

// Si no hay un usuario identificado, redirigir a la página de login
if (!$idUsuario) {
    header('Location: login.php'); // Asegúrate de que esta ruta sea correcta
    exit();
}

// Obtener datos del usuario
$datosUsuario = $usuarioModel->getUsuarioId($idUsuario, $conexPDO);

// Obtener los productos en el carrito del usuario
/* $productosCarrito = $carritoModel->obtenerProductosDelCarrito($idUsuario, $conexPDO); */

// Datos adicionales que la vista pueda requerir
$mensaje = "Revisa tu pedido antes de confirmar.";

// Incluir la vista, pasando los datos del modelo
include("../view/pedidoView.php");

?>
