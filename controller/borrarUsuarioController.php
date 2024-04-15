<?php
namespace model;

use \model\usuarioModel;
use \model\utils;


//Añadimos el código del modelo
require_once("../model/usuarioModel.php");
require_once("../model/utils.php");

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['idusuario']) || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php'); // Redirecciona a una página de error
    exit();
}

    //Creamos un array para guardar los datos del usuario
    $usuario = array();

    // Solo se ejecutará cuando reciba una petición del registro
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $idUsuario = $_POST["idUsuario"];

        //Nos conectamos a la Bd
        $conexPDO = utils::conectar();
        $gestorUsuario = new Usuario();
        $gestorUsuario->delUsuario($idUsuario, $conexPDO);

        header("Location: ../controller/usuariosAdminController.php");
        exit();
    }

?>
