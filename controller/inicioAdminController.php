<?php
namespace model;

use model\utils;
use model\Usuario;
use model\Producto;
use model\Categoria;
use model\Marca;
/* use model\Pedido; */

require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
require_once("../model/productoModel.php");
require_once("../model/categoriaModel.php");
require_once("../model/marcaModel.php");
/* require_once("../model/pedidoModel.php"); */

$mensaje = null;

session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

$conexPDO = utils::conectar();

$usuarioModel = new Usuario();
$productModel = new Producto();
$categoriaModel = new Categoria();
$marcaModel = new Marca();
/* $pedidoModel = new Pedido(); */ 

// Realizar las consultas para obtener los contadores
$usuarios = $usuarioModel->contarUsuarios($conexPDO);
$productos = $productModel->contarProductos($conexPDO);
$categorias = $categoriaModel->contarCategorias($conexPDO);
$marcas = $marcaModel->contarMarcas($conexPDO);
/* $pedidos = $pedidoModel->contarPedidos($conexPDO); */

include("../view/inicioAdminView.php");
?>
