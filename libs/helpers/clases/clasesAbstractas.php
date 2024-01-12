<?php
    abstract class ModelTools extends Conexion{
        static function setErrorLog(string $error_status, string $message){
            Logger::$error_status($message);
            die("Ha ocurrido un error");
        }
    }
?>