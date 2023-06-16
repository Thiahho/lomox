<?php
    $servername="";
    $user="root";
    $password="";
    $dbname="lomox";

    //$conexion= new mysqli($servername,$user,$password,$dbname);
    // $conexion=set_charset("utf8");

//-------------------------------------------------
    class Conexion{
        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private  $db = "lomox";
        private $conect; //se utilizara para las instrucciones sql

        public function __construct(){
            $conectionstring="mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8";
            try{
                //conectanto a la base de datos
                $this->conect = new PDO($conectionstring,$this->user,$this->password);
                 //detecta los errores ocurridos durante el desarrollo
                $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(Exception $e ){
                $this->conect='Error de conexion';
                echo "ERROR".$e->getMessage() ;
            }
        }

        public function ejecutarQuery($query, $params = []) {
            $stmt = $this->conect->prepare($query);
            $stmt->execute($params);
            return $stmt;
        }

        public function getLastId() {
            return $this->conect->lastInsertId();
        }

        public function desconectar(){
            $this->conect = null;
        }

    }


?>