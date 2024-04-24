<?php
namespace model;

use \model\utils;
use \model\usuarioModel;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
$mensaje=null;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nombre = $_POST['nombre'];
    $primerApellido = $_POST['primer_apellido'];
    $segundoApellido = $_POST['segundo_apellido'];
    $telefono = $_POST['telefono'];
    $dni = $_POST['dni'];
    $codigoPostal = $_POST['codigo_postal'];
    $calle = $_POST['calle'];
    $numeroBloque = $_POST['numero_bloque'];
    $piso = $_POST['piso'];
    $email = $_POST['email'];
    $nombreUsuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contrasena'];

    $usuario = array();
    $usuario["nombre"] = utils::limpiar_datos($nombre);
    $usuario["primer_apellido"] = utils::limpiar_datos($primerApellido);
    $usuario["segundo_apellido"] = utils::limpiar_datos($segundoApellido);
    $usuario["telefono"] = utils::limpiar_datos($telefono);
    $usuario["dni"] = utils::limpiar_datos($dni);
    $usuario["codigo_postal"] = utils::limpiar_datos($codigoPostal);
    $usuario["calle"] = utils::limpiar_datos($calle);
    $usuario["numero_bloque"] = utils::limpiar_datos($numeroBloque);
    $usuario["piso"] = utils::limpiar_datos($piso);
    $usuario["email"] = utils::limpiar_datos($email);
    $usuario["nombre_usuario"] = utils::limpiar_datos($nombreUsuario);

    //Generamos una salt de 16 posiciones
    $salt = utils::generar_salt(16);
    $usuario["salt"] = $salt;
    $usuario["contrasena"] = crypt($contraseña,'$6$rounds=5000$'.$salt.'$');

    $usuario["activo"] = 0;

    $usuario["activacion"]=utils::generar_codigo_activacion();
    $gestorUsu = new Usuario();

    //Nos conectamos a la Base de Datos
    $conexPDO = utils::conectar();
    $resultado = $gestorUsu->addUsuario($usuario, $conexPDO);

    if ($resultado != null)
    {
        /*$mensaje = "El Usuario se Registro Correctamente";
        echo ($mensaje);*/

        header("Location: ../controller/loginController.php");
                exit();
    }    
    else
    {
        $mensaje = "Ha habido un fallo al acceder a la Base de Datos";
        echo ($mensaje);
    }
}

include("../view/registerView.php");


?>
