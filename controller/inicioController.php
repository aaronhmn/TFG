<?php

namespace model;

// Asegura si hay o no sesion activa para que si no la hay iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use \model\utils;

require_once("../model/utils.php");
$mensaje = null;

$conexPDO = utils::conectar();

include("../view/inicioView.php");
