<?php
namespace model;

use \model\usuarioModel;
use \model\utils;


//Añadimos el código del modelo
require_once("../model/usuarioModel.php");
require_once("../model/utils.php");

    //Creamos un array para guardar los datos del usuario
    $usuario = array();

    // Solo se ejecutará cuando reciba una petición del registro
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $idUsuario = $_POST["idUsuario"];

        //Nos conectamos a la Bd
        $conexPDO = utils::conectar();
        $gestorUsuario = new Usuario();
        $gestorUsuario->BanUsuarioPorId($idUsuario, $conexPDO);

        header("Location: ../controller/usuariosAdminController.php");
        exit();
    }

?>
