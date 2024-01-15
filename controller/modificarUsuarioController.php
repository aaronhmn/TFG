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
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $usuario["idusuario"] = $_GET["idUsuario"];
        $usuario["nombre"] = $_GET["nombre"];
        $usuario["primer_apellido"] = $_GET["primer_apellido"];
        $usuario["segundo_apellido"] = $_GET["segundo_apellido"];
        $usuario["dni"] = $_GET["dni"];
        $usuario["email"] = $_GET["email"];
        $usuario["nombre_usuario"] = $_GET["nombre_usuario"];
        $usuario["direccion"] = $_GET["direccion"];
        $usuario["telefono"] = $_GET["telefono"];
        $usuario["activacion"] = $_GET["activacion"];
        $usuario["activo"] = $_GET["activo"];
        $usuario["rol"] = $_GET["rol"];
        
        include("../view/modificarUsuarioView.php");
    }

    // Solo se ejecutará cuando reciba una petición del registro
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $usuario["idusuario"] = $_POST["idUsuario"];
        $usuario["nombre"] = $_POST["nombre"];
        $usuario["primer_apellido"] = $_POST["primer_apellido"];
        $usuario["segundo_apellido"] = $_POST["segundo_apellido"];
        $usuario["dni"] = $_POST["dni"];
        $usuario["email"] = $_POST["email"];
        $usuario["nombre_usuario"] = $_POST["nombre_usuario"];
        $usuario["direccion"] = $_POST["direccion"];
        $usuario["telefono"] = $_POST["telefono"];
        $usuario["activacion"] = $_POST["activacion"];
        $usuario["activo"] = $_POST["activo"];
        $usuario["rol"] = $_POST["rol"];
        

        //Nos conectamos a la Bd
        $conexPDO = utils::conectar();
        $gestorUsuario = new Usuario();
        $resultado=$gestorUsuario->updateUsuario($usuario, $conexPDO);

        include("../view/modificarUsuarioView.php");

        if ($resultado != null)
        {
            $mensaje = "El Usuario se Registro Correctamente";
            print ("<p style='display:flex; justify-content:center; color: #67cb57;'><b>".($mensaje)."</b></p>");

            /*header("Location: ../controller/usuariosAdminController.php");
                exit();*/
        }    
        else
        {
            $mensaje = "Ha habido un fallo al acceder a la Base de Datos";
            echo ($mensaje);
        }
    }

    

?>
