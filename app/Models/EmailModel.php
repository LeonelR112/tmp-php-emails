<?php
    class EmailModel extends ModelTools{
        private $db;

        public function __construct(){
            $this->db = self::conectar();
        }

        public function getMensaje(int $id_mensaje){
            try{
                $sql = "SELECT * FROM test_emails_tracker WHERE id_mensaje = :id_mensaje";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":id_mensaje", $id_mensaje, PDO::PARAM_INT);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
            catch(PDOException $e){
                self::setErrorLog("critical", $e->getMessage());
            }
        }

        public function addHistory(array $datos){
            try{
                $sql = "INSERT INTO test_emails_historial (id_mensaje, email, fecha_envio, tracker_code, abierto, fecha_abierto, interes, estado) VALUES (:id_mensaje, :email, :fecha_envio, :tracker_code, :abierto, :fecha_abierto, :interes, :estado)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":id_mensaje", $datos['id_mensaje'], PDO::PARAM_INT);
                $stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_envio", $datos['fecha_envio'], PDO::PARAM_STR);
                $stmt->bindParam(":tracker_code", $datos['tracker_code'], PDO::PARAM_STR);
                $stmt->bindParam(":abierto", $datos['abierto'], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_abierto", $datos['fecha_abierto'], PDO::PARAM_STR);
                $stmt->bindParam(":interes", $datos['interes'], PDO::PARAM_STR);
                $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_STR);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    return true;
                }
            }
            catch(PDOException $e){
                self::setErrorLog("critical", $e->getMessage());
            }
        }

        public function getAllMensajes(){
            try{
                $sql = "SELECT * FROM test_emails_tracker ORDER BY id_mensaje DESC";
                $stmt = $this->db->query($sql);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            catch(PDOException $e){
                self::setErrorLog("critical", $e->getMessage());
            }
        }

        public function addMensaje(array $datos){
            try{
                $sql = "INSERT INTO test_emails_tracker (asunto, cuerpo, track_link, fecha) VALUES (:asunto, :cuerpo, :track_link, :fecha)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":asunto", $datos['asunto'], PDO::PARAM_STR);
                $stmt->bindParam(":cuerpo", $datos['mensaje'], PDO::PARAM_STR);
                $stmt->bindParam(":track_link", $datos['link_tracker'], PDO::PARAM_STR);
                $stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    return true;
                }
            }
            catch(PDOException $e){
                self::setErrorLog("critical", $e->getMessage());
            }
        }
        
        public function deleteMensaje(int $id_mensaje){
            try{
                $sql = "DELETE FROM test_emails_tracker WHERE id_mensaje = :id_mensaje";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":id_mensaje", $id_mensaje, PDO::PARAM_INT);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    return true;
                }
            }
            catch(PDOException $e){
                self::setErrorLog("critical", $e->getMessage());
            }
        }
    }
?>

