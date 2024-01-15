<?php
    namespace model;

    session_start();
    // Solo se ejecutará cuando reciba una petición del login
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        session_destroy();
        header("Location: ../controller/inicioController.php");
        exit();
    }
?>