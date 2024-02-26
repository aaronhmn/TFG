<?php
namespace model;

use \model\utils;
use \model\productoModel;
use \model\usuarioModel;

//Añadimos el código del modelo
require_once("../model/utils.php");
require_once("../model/productoModel.php");
require_once("../model/usuarioModel.php");
$mensaje=null;

include("../view/productoView.php");
?>