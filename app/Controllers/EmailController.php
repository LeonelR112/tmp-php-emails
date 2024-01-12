<?Php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    class EmailController{
        static function agregarNuevoMensaje(){
            $EmailModel = new EmailModel;
            $datos = [
                "asunto" => htmlspecialchars(addslashes($_POST['asunto'])),
                "mensaje" => $_POST['mensaje'],
                "link_tracker" => htmlspecialchars($_POST['link_tracker']),
                "fecha" => current_datetime()
            ];

            if($EmailModel->addMensaje($datos)){
                redirectTo("?status=success");
            }
            else{
                redirectTo("?status=error");
            }
        }

        static function borrarMensaje($id){    
            $EmailModel = new EmailModel;        
            $id_mensaje = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $mensaje = $EmailModel->getMensaje($id_mensaje);
            if(!$mensaje) redirectTo("not-found");
            if($EmailModel->deleteMensaje($id_mensaje)){
                redirectTo("");
            }
            else{
                redirectTo("?status=error");
            }
        }

        static function prepararEnvio(){
            $EmailModel = new EmailModel;
            $mensajes_guardados = $EmailModel->getAllMensajes();

            view("enviarMensajes.index", [
                "mensajes_guardados" => $mensajes_guardados
            ]);
        }

        static function enviarMensaje(){
            require_once __DIR__ . "/../../libs/phpmailer/PHPMailer.php";
            require_once __DIR__ . "/../../libs/phpmailer/SMTP.php";
            require_once __DIR__ . "/../../libs/phpmailer/Exception.php";
            $EmailModel = new EmailModel;        
            $id_mensaje = filter_var($_POST['id_mensaje'], FILTER_SANITIZE_NUMBER_INT);
            $email_send = filter_var($_POST['email_send'], FILTER_SANITIZE_EMAIL);
            $mensaje = $EmailModel->getMensaje($id_mensaje);
            if(!$mensaje) redirectTo("not-found");
            $PHPMailer = new PHPMailer();
            $PHPMailer->CharSet = "UTF-8";
            $PHPMailer->isSMTP();                                       //Send using SMTP
            $PHPMailer->Host       = $_ENV['MAILER_SMTP_HOST'];         //Set the SMTP server to send through
            $PHPMailer->SMTPAuth   = true;                              //Enable SMTP authentication
            $PHPMailer->Username   = $_ENV['MAILER_EMAIL'];             //SMTP username
            $PHPMailer->Password   = $_ENV['MAILER_PASS'];              //SMTP password
            $PHPMailer->SMTPSecure = $_ENV['MAILER_PROTOCOL'];          //Enable implicit TLS encryption
            $PHPMailer->Port       = (int)$_ENV['MAILER_SMTP_PORT'];    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $PHPMailer->setFrom($_ENV['MAILER_EMAIL'], 'Contacto ProDermic');
            $PHPMailer->Subject = $mensaje['asunto'];
            // preparando tracker
            $code = generateRandomString(30); // key identificador de email
            $pixel_tracking = '<img src="'. API_URL_EMAILS .'?image=default_activ.png&code='. $code .'" alt="" />';
            $template_mensaje = $pixel_tracking . $mensaje['cuerpo'];
            $datos_tracking = [
                "id_mensaje" => (int)$mensaje['id_mensaje'],
                "email" => $email_send,
                "fecha_envio" => current_datetime(),
                "tracker_code" => $code,
                "abierto" => "N",
                "fecha_abierto" => "0000-00-00 00:00:00",
                "interes" => "N",
                "estado" => ""
            ];
            
            // setear usuarios a enviar (este caso uno solo para prueba)
            $PHPMailer->addAddress($email_send, "User Test");
            // Fin seteo de usuarios

            $PHPMailer->Body = $template_mensaje;
            $PHPMailer->isHTML();
            $PHPMailer->AltBody = 'Para ver el mensaje, por favor use un visor de email compatible con HTML';
            if($PHPMailer->send()){
                // 'El correo electrónico se envió correctamente.';
                $datos_tracking['estado'] = "Enviado";
                echo "Enviado!";
            }
            else{
                // 'El correo electrónico no pudo ser enviado.';
                $smtpInstance = $PHPMailer->getSMTPInstance();
                if($smtpInstance) {
                    //$lastReply = $smtpInstance->getLastReply();
                    Logger::info($smtpInstance->getLastReply());
                    $datos_tracking['estado'] = "Rechazado";
                    var_dump($smtpInstance);
                }
                var_dump($PHPMailer->ErrorInfo);
            }
            $EmailModel->addHistory($datos_tracking);

        }
    }
?>