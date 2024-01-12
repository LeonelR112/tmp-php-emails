<?php
    abstract class Conexion{
        static function conectar(){
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'); //default utf8

            try{
                $link = new PDO("mysql:host=" . $_ENV['DBHOST'] .";dbname=" . $_ENV['DBNAME'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $opciones);
                $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                return $link;
            }
            catch(PDOException $e){
                Logger::critical("No se pudo establecer una conexión a la bdd: (Motivo)" . $e->getMessage());
                printMensajeAlertaCritica("Ha ocurrido un error al conectarse a la base de datos. Ver en archivos log_errors");
                die;
            }
        }
    }
?>