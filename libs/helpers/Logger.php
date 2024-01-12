<?php
    abstract class Logger{
        private const CODE_CLEAR = 13975;
        private const CURRENT_DATETIME = "";
        private const DIR_LOG_FILE = __DIR__ . "/../../logs/log_app.txt";
        private const DIR_LOG_INFOS = __DIR__ . "/../../logs/log_info.txt";

        /**
         * Mensaje de error al momento de ejecutar una función, puede ser por corte de flujo también.
         */
        static function error(string $mensaje, string $comentario = ""){
            $pre_plantilla = "[ERROR] : " . $mensaje . ($comentario != "" ? " => " . $comentario : "");
            if(self::crearMensaje($pre_plantilla, 0)){
                return true;
            }
            else{
                return false;
            }
        }

         /**
         * Mensaje de algún error crítico que genera un corte en el flujo de ejecución y no puede continuar.
         */
        static function critical(string $mensaje, string $comentario = ""){
            $pre_plantilla = "[CRITICAL] : " . $mensaje . ($comentario != "" ? " => " . $comentario : "");
            if(self::crearMensaje($pre_plantilla, 0)){
                return true;
            }
            else{
                return false;
            }
        }

        /**
         * Mensaje de algún error intermedio, no afecta el flujo de ejecución.
         */
        static function warning(string $mensaje, string $comentario = ""){
            $pre_plantilla = "[WARNING] : " . $mensaje . ($comentario != "" ? " => " . $comentario : "");
            if(self::crearMensaje($pre_plantilla, 0)){
                return true;
            }
            else{
                return false;
            }
        }

        /**
         * Mensaje de algún error mínimo, que no afecta en nada la funcionalidad de la aplicación. Ejemplo, una variable sin uso o sin un valor válido, Página sin encontrar, etc.
         */
        static function notice(string $mensaje, string $comentario = ""){
            $pre_plantilla = "[NOTICE] : " . $mensaje . ($comentario != "" ? " => " . $comentario : "");
            if(self::crearMensaje($pre_plantilla, 0)){
                return true;
            }
            else{
                return false;
            }
        }

        /**
         * Mensajes de seguimiento de funcionalidades en el código. No son errores, sino que se especifíca algún suceso y seguirlo. Se guardan en log_info.txt
         */
        static function debug(string $mensaje, string $comentario = ""){
            $pre_plantilla = "[DEBUG] : " . $mensaje . ($comentario != "" ? " => " . $comentario : "");
            if(self::crearMensaje($pre_plantilla, 1)){
                return true;
            }
            else{
                return false;
            }
        }

        /**
         * Mensajes de seguimiento del tipo información. Se guardan en log_info.txt
         */
        static function info(string $mensaje, string $comentario = ""){
            $pre_plantilla = "[INFO] : " . $mensaje . ($comentario != "" ? " => " . $comentario : "");
            if(self::crearMensaje($pre_plantilla, 1)){
                return true;
            }
            else{
                return false;
            }
        }

        /**
         * Reinicia el logger y deja el archivo log_app.txt en blanco, se debe ingresar el código de verificación
         */
        static function resetLog(int $code){
            try{
                if(self::CODE_CLEAR == $code){
                    if(self::limpiarLog()){
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                else{
                    throw new Exception("Código de verificación incorrecto.");
                }
            }
            catch(PDOException $e){
                echo "Reseteo de logger fallido: " . $e->getMessage();
            }
        }

        //--------------------------- métodos privados ----------------------------
        static private function crearMensaje(string $mensaje_plantilla, int $type){
            $DateTimeNow = new DateTime('now');
            $fp = null;
            if($type == 0){
                $fp = fopen(self::DIR_LOG_FILE, "a+");
            }
            else if($type == 1){
                $fp = fopen(self::DIR_LOG_INFOS, "a+");
            }
            $format = $DateTimeNow->format("d-m-Y H:i:s ");
            if(fwrite($fp,$format . $mensaje_plantilla . "\n")){
                fclose($fp);
                return true;
            }
            else{
                fclose($fp);
                return false;
            }
        }

        static private function limpiarLog(){
            $fp = fopen(self::DIR_LOG_FILE, "w");
            fclose($fp);
            $fp = fopen(self::DIR_LOG_INFOS, "w");
            fclose($fp);
            return true;
        }
    }
?>