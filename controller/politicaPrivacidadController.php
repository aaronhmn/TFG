<?php

namespace model;

use \model\utils;

//Añadimos el código del modelo
require_once("../model/utils.php");
$mensaje = null;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$conexPDO = utils::conectar();

include("../view/politicaPrivacidadView.php");
