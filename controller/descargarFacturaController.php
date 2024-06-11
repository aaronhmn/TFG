<?php
require_once('../config/TCPDF-main/tcpdf.php');
require_once("../model/pedidoModel.php");
require_once("../model/detallePedidoModel.php");
require_once("../model/usuarioModel.php");
require_once("../model/utils.php");

use model\pedido;
use model\detalle_pedido;
use model\Usuario;
use model\Utils;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está autenticado y si el idPedido está presente
if (!isset($_SESSION['id_usuario']) || !isset($_GET['idPedido'])) {
    header('Location: loginView.php');
    exit;
}

$idPedido = $_GET['idPedido'];
$pedidoModel = new pedido();
$detallePedidoModel = new detalle_pedido();
$usuarioModel = new Usuario();
$conexPDO = Utils::conectar();

// Obtener los datos del pedido incluyendo los datos del usuario
$datosPedido = $pedidoModel->getPedidoId($idPedido, $conexPDO);
if (!$datosPedido) {
    die("Pedido no encontrado o acceso denegado.");
}

// Obtener detalles del pedido
$detallesPedido = $detallePedidoModel->getDetallesPedidosPag($conexPDO, $idPedido, 1, 1000);

// Generar el PDF
$pdf = new TCPDF(); // Crea una nueva instancia de TCPDF
$pdf->AddPage(); // Añade una nueva página al documento PDF
$pdf->SetFont('helvetica', '', 12); // Establece la fuente a Helvetica, tamaño 12

// Añade un título centrado con el ID del pedido
$pdf->Cell(0, 10, "Factura del Pedido: {$idPedido}", 0, 1, 'C');
// Añade la fecha del pedido centrada
$pdf->Cell(0, 10, "Fecha del Pedido: {$datosPedido['fecha_pedido']}", 0, 1, 'C');
// Añade un espacio en blanco
$pdf->Cell(0, 10, '', 0, 1);

// Añade el nombre del cliente
$pdf->Cell(0, 10, "Nombre: {$datosPedido['nombre']} {$datosPedido['primer_apellido']} {$datosPedido['segundo_apellido']}", 0, 1);
// Añade el DNI y el teléfono del cliente
$pdf->Cell(0, 10, "DNI: {$datosPedido['dni']}, Teléfono: {$datosPedido['telefono']}", 0, 1);
// Añade el código postal del cliente
$pdf->Cell(0, 10, "Código Postal: {$datosPedido['codigo_postal']}", 0, 1);
// Añade la dirección del cliente
$pdf->Cell(0, 10, "Calle: {$datosPedido['calle']}, Número de bloque: {$datosPedido['numero_bloque']}, Piso: {$datosPedido['piso']}", 0, 1);

// Itera sobre los detalles del pedido y añade cada producto con su cantidad y precio
foreach ($detallesPedido as $detalle) {
    $pdf->MultiCell(0, 10, "{$detalle['nombre_producto']}: {$detalle['cantidad']} x {$detalle['precio']}€ = " . ($detalle['cantidad'] * $detalle['precio']) . "€", 0, 'L', 0, 1);
}

// Añade el precio total del pedido
$pdf->Cell(0, 10, "Total: {$datosPedido['precio_total']}€", 0, 1);

// Genera y envía el PDF al navegador para descargar con el nombre "Factura_{idPedido}.pdf"
$pdf->Output("Factura_{$idPedido}.pdf", 'D');
