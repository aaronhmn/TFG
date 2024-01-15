<?php
namespace model;

use \model\utils;
use \model\usuarioModel;

require_once("../model/utils.php");
require_once("../model/usuarioModel.php");

$mensaje = null;

session_start();
include("../view/verificarView.php");


//if (isset($_POST['email']) && isset($_POST['activacion'])) {

    $conexPDO2 = utils::conectar();

    $gestorUsu2 = new Usuario(); 
    $correo2 = $_SESSION['email'];

    $usuario2 = $gestorUsu2->getUsuario($correo2, $conexPDO2);

    $codigo = $usuario2['activacion'];
    echo "<script>console.log($codigo)</script>";

    // Solo se ejecutará cuando reciba una petición del login
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $codigo = $_POST['inputCodigo'];
        ValidarCodigo($codigo);
    }
//}

function ValidarCodigo($codigo) {
    $conexPDO = utils::conectar();

    if ($conexPDO == true) {
        $usuario = array();
        $gestorUsu = new Usuario(); // Asegúrate de que el espacio de nombres sea correcto
        $direccion = $_SESSION['email'];
        $usuario = $gestorUsu->getUsuario($direccion, $conexPDO);

        if ($usuario["activacion"] == $codigo) {
            echo "Código Correcto";
            $gestorUsu->ActivarUsuario($direccion, $conexPDO);
            header("Location: ../controller/loginController.php");
            exit();
        } else {
            echo "Código Erróneo";
        }
    }
}
?>