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

session_start();

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
$detallesPedido = $detallePedidoModel->getDetallesPedidosPag($conexPDO, $idPedido, 1, 1000); // Suponiendo que quieres todos los detalles de una vez

// Generar el PDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, "Factura del Pedido: {$idPedido}", 0, 1, 'C');
$pdf->Cell(0, 10, "Fecha del Pedido: {$datosPedido['fecha_pedido']}", 0, 1, 'C');
$pdf->Cell(0, 10, '', 0, 1);
$pdf->Cell(0, 10, "Nombre: {$datosPedido['nombre']} {$datosPedido['primer_apellido']} {$datosPedido['segundo_apellido']}", 0, 1);
$pdf->Cell(0, 10, "DNI: {$datosPedido['dni']}, Teléfono: {$datosPedido['telefono']}", 0, 1);
$pdf->Cell(0, 10, "Código Postal: {$datosPedido['codigo_postal']}", 0, 1);
$pdf->Cell(0, 10, "Calle: {$datosPedido['calle']}, Número de bloque: {$datosPedido['numero_bloque']}, Piso: {$datosPedido['piso']}", 0, 1);

foreach ($detallesPedido as $detalle) {
    $pdf->MultiCell(0, 10, "{$detalle['nombre_producto']}: {$detalle['cantidad']} x {$detalle['precio']}€ = " . ($detalle['cantidad'] * $detalle['precio']) . "€", 0, 'L', 0, 1);
}

$pdf->Cell(0, 10, "Total: {$datosPedido['precio_total']}€", 0, 1);
$pdf->Output("Factura_{$idPedido}.pdf", 'D');
