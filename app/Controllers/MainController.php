<?php
    class MainController{
        static function renderIndex(){
            $EmailModel = new EmailModel;
            $mensajes_guardados = $EmailModel->getAllMensajes();

            view("homepage.index", [
                "titulo" => "Página principal",
                "mensajes_guardados" => $mensajes_guardados
            ]);
        }
        
    }
?>