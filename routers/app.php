<?php
    $Router = new \Bramus\Router\Router();
    $Router->set404(function(){
        echo "Page not found - 404";
    });

    include "./routers/middleware.php";
    include "./routers/api.php";

    ### Rutas ###
    $Router->get("/", "MainController@renderIndex");
    
    $Router->post("/add-messaje-template", "EmailController@agregarNuevoMensaje");
    $Router->get("/delete-message/{id}", "EmailController@borrarMensaje");
    $Router->get("/enviar-mensaje", "EmailController@prepararEnvio");
    $Router->post("/enviar-mensaje/realizar-envio", "EmailController@enviarMensaje");
    
    $Router->run();
?>