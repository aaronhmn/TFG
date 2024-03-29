<?php
namespace model;

use \model\utils;
use \model\usuarioModel;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/usuarioModel.php");
$mensaje=null;

//var_dump($datosClientes);
include("../view/insertarUsuarioAdminView.php");

// Solo se ejecutará cuando reciba una petición del registro
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $nombre = $_POST['inputNombre'];
    $primerApellido = $_POST['inputPrimerApellido'];
    $segundoApellido = $_POST['inputSegundoApellido'];
    $telefono = $_POST['inputTelefono'];
    $dni = $_POST['inputDNI'];
    $direccion = $_POST['inputDireccion'];
    $email = $_POST['inputEmail'];
    $usuario = $_POST['inputUsuario'];
    $contraseña = $_POST['inputPassword'];

    $datosUsuario = array();
    $datosUsuario["nombre"] = utils::limpiar_datos($nombre);
    $datosUsuario["primer_apellido"] = utils::limpiar_datos($primerApellido);
    $datosUsuario["segundo_apellido"] = utils::limpiar_datos($segundoApellido);
    $datosUsuario["telefono"] = utils::limpiar_datos($telefono);
    $datosUsuario["dni"] = utils::limpiar_datos($dni);
    $datosUsuario["direccion"] = utils::limpiar_datos($direccion);
    $datosUsuario["email"] = utils::limpiar_datos($email);
    $datosUsuario["nombre_usuario"] = utils::limpiar_datos($usuario);

    //Generamos una salt de 16 posiciones
    $salt = utils::generar_salt(16);
    $datosUsuario["salt"] = $salt;
    $datosUsuario["contrasena"] = crypt($contraseña,'$6$rounds=5000$'.$salt.'$');

    $datosUsuario["activo"] = 0;

    $datosUsuario["activacion"]=utils::generar_codigo_activacion();
    $gestorUsu = new Usuario();

    //Nos conectamos a la Base de Datos
    $conexPDO = utils::conectar();
    $resultado = $gestorUsu->addUsuario($datosUsuario, $conexPDO);

    if ($resultado != null)
    {
        $mensaje = "El Usuario se Registro Correctamente";
        echo ($mensaje);

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
