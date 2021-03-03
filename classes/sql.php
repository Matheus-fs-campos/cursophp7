<?php
    class sql extends PDO{
        private $conn;
        public function __construct(){
            $this-> conn = new PDO("sqlsrv:Database=db_php7;server=BEXCON-338\SQLEXPRESS;ConnectionPooling=0","sa","root");
        }

        private function setParams($statment, $parameters = array()){
                foreach($parameters as $key => $value){
                    $statment->bindParam($key,$value);
                }
        }

        private function setParam($statment, $key, $value){
            $statment->bindParam($key,$value);
        }

        public function querry($rawQuerry, $params = array()){
            $stmt = $this->conn->prepare($rawQuerry);
            $this->setParams($stmt,$params);
            $stmt->execute();
            return $stmt;
        }

        public function select($rawQuerry, $params=array()):array
        {
            $stmt = $this->querry($rawQuerry,$params);
            return $stmt->fetchAll (PDO::FETCH_ASSOC);
        }
    }

?>