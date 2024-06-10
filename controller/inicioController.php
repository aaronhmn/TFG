<?php

namespace model;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use \model\utils;

require_once("../model/utils.php");
$mensaje = null;

$conexPDO = utils::conectar();

include("../view/inicioView.php");
