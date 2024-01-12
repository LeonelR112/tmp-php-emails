<?php
    ### Rutas API ###
    $Router->get("/api/ejemplo", function(){});

    $Router->get("/api/check", "TrackerEmailController@checekarEstadoDelEmailAbierto");
?>