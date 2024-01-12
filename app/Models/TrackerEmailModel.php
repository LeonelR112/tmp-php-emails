<?php
    class TrackerEmailModel extends ModelTools{
        private $db;

        public function __construct(){
            $this->db = self::conectar();
        }

        public function getCorreoRegistrado(string $code){
            try{
                $sql = "SELECT * FROM test_emails_historial WHERE tracker_code = :code";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":code", $code, PDO::PARAM_STR);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    $registro = $stmt->fetch(PDO::FETCH_ASSOC);
                    return $registro;
                }
            }
            catch(PDOException $e){
                self::setErrorLog('critical', $e->getMessage());
            }   
        }

        public function setNuevoEstado(array $datos){
            try{
                $sql = "UPDATE test_emails_historial SET estado = :estado, abierto = :abierto, fecha_abierto = :fecha_abierto WHERE tracker_code = :code";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_STR);
                $stmt->bindParam(":abierto", $datos['abierto'], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_abierto", $datos['fecha_abierto'], PDO::PARAM_STR);
                $stmt->bindParam(":code", $datos['code'], PDO::PARAM_STR);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    return true;
                }
            }
            catch(PDOException $e){
                self::setErrorLog('critical', $e->getMessage());
            }
        }
    }
?>