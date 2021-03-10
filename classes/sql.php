<?php

    class sql extends PDO{
        private $conn;
        
        public function __construct(){
            //$this->conn = new PDO("mysql:BEXCON-338\localhost;dbname=test","root","");
            $this->conn = new PDO("mysql:host=localhost;dbname=test","root","");
            //$this->conn = new PDO("sqlsrv:Database=db_php7;server=BEXCON-338\SQLEXPRESS;ConnectionPooling=0","sa","root");
        }

        private function setParams($statment,$parameters = array()){
            foreach ($parameters as $key=> $value){

                $this->setParam($statment, $key,$value);

            }
        }

        private function setParam($statment,$key, $value){

            $statment->bindParam($key,$value);

        }

        public function querry($rawquerry, $params=array()){

            $stmt = $this->conn->prepare($rawquerry);

            $this->setParams($stmt,$params);

            $stmt->execute();

            return $stmt;
        }

        public function select($rawquerry, $params = array()):array
        {

            $stmt =$this->querry($rawquerry,$params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }

    }

?>