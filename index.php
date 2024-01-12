<?php
    ob_start();
    require_once __DIR__ . "/vendor/autoload.php";
    require_once __DIR__ . "/libs/helpers/helpers_varios.php";
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env');
    $dotenv->load();
    require_once __DIR__ . "/libs/helpers/clases/Conexion.php";
    require_once __DIR__ . "/libs/helpers/clases/clasesAbstractas.php";
    require_once __DIR__ . "/config/autoFuncLoader.php";
    require_once __DIR__ . "/config/app.php";
    require_once __DIR__ . "/libs/view.php";
    require_once __DIR__ . "/routers/app.php";
?>