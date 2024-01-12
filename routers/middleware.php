<?php
/**
 * En esta sección se cargará antes de las rutas configuradas en app. La estructura será de la siguiente manera:
 * $Router->before("GET|POST", ".*" ,function(){});
 * 
 */

    $Router->before("GET|POST", ".*" ,function(){
        
    });

    $Router->before("GET|POST", "/api/.*" ,function(){
        
    });
?>