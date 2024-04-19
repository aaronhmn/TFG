<?php
namespace model;

use \model\categoria;
use \model\utils;


//Añadimos el código del modelo
require_once("../model/categoriaModel.php");
require_once("../model/utils.php");

session_start();

// Verificar si el usuario está logueado y si es administrador
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['rol'] != 1) {
    header('Location: ../view/noAutorizadoView.php');
    exit();
}

    //Creamos un array para guardar los datos del usuario
    $categoria = array();

    // Solo se ejecutará cuando reciba una petición del registro
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $idCategoria = $_POST["idCategoria"];

        //Nos conectamos a la Bd
        $conexPDO = utils::conectar();
        $gestorCategoria = new Categoria();
        $gestorCategoria->delCategoria($idCategoria, $conexPDO);

        header("Location: ../controller/categoriasAdminController.php");
        exit();
    }

?>
