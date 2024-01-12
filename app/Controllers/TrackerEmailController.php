<?php
    
    class TrackerEmailController{
        static function checekarEstadoDelEmailAbierto(){
            $TrackerEmailModel = new TrackerEmailModel;
            if(isset($_GET['code'])){
                $code = htmlspecialchars(addslashes($_GET['code']));
                $imagen_logo = isset($_GET['image']) ? htmlspecialchars(addslashes($_GET['image'])) : null;
                $email_history = $TrackerEmailModel->getCorreoRegistrado($code);
                if($email_history){
                    // Existe email enviado y fue abierto
                    $datos_guardar = [
                        "code" => $code,
                        "abierto" => "S",
                        "fecha_abierto" => current_datetime(),
                        "estado" => "Abierto"
                    ];
                    if(!$TrackerEmailModel->setNuevoEstado($datos_guardar)){
                        Logger::error("Error al actualizar un registro de un email enviado", $code);
                    }
                    if($imagen_logo != null){
                        $imagen_url = 'resources/assets/' . $imagen_logo;
                        header('Content-Type: image/png');
                        readfile($imagen_url);
                    }
                }
                else{
                    $response = [
                        "status" => "error",
                        "response" => "missing_history"
                    ];
                    http_response_code(400);
                    header("Content-Type: application/json");
                    print json_encode($response);
                }
            }
            else{
                $response = [
                    "status" => "error",
                    "response" => "missing_code_data"
                ];
                http_response_code(400);
                header("Content-Type: application/json");
                print json_encode($response);
            }
        }
    }
?>