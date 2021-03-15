<?php

Class usuario{
private $idusuario;
private $deslogin;
private $dessenha;
private $dtcadastro;


        public function getIdUsuario(){
            return $this->idusuario;
        }

        public function setIdUsuario($value){
            $this->idusuario = $value;
        }

        public function getDeslogin(){
            return $this->deslogin;
        }

        public function setDeslogin($value){
            $this->deslogin = $value;
        }

        public function getDessenha(){
            return $this->dessenha;
        }

        public function setDessenha($value){
            $this->dessenha = $value;
        }

        public function getDtCadastro(){
            return $this->dtcadastro;
        }

        public function setDtCadastro($value){
            $this->dtcadastro = $value;
        }

        public function loadById($id){
            
            $sql = new sql();

            $result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
                ":ID"=>$id
            ));

            if(count($result)>0){

                $this->setData($results[0]);

            }

        }

        public function __toString(){
            return json_encode(array(
                "idusuario"=>$this->getIdUsuario(),
                "deslogin"=>$this->getDeslogin(),
                "dessenha"=>$this->getDessenha(),
                "dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
            ));
        }

        public static function getList(){

            $sql = new sql();

            return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
        }

        public static function search($login){

            $sql = new sql();

            return $sql->select("SELECT *FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
                ":SEARCH"=>"%".$login."%"
            ));

        }

        public function login($login, $password){
            
            $sql = new sql();

            $result = $sql->select("SELECT * FROM tb_usuarios WHERE DESLOGIN = :LOGIN AND dessenha = :PASSWORD", array(
                ":LOGIN"=>$login,
                ":PASSWORD"=>$password
            ));

            if(count($result)>0){

                $this->setData($results[0]);

            } else{
                throw new Exception("login ou senha inválidos");
            }
        }

        public function setData($data){
            $this->setIdUsuario($data['idusuario']);
            $this->setDeslogin($data['deslogin']);
            $this->setDessenha($data['dessenha']);
            $this->setDtCadastro(new DateTime($data['dtcadastro']));
        }

        public function insert(){
            $sql = new sql();

            $results = $sql->select("CALL tb_usuarios_insert(:LOGIN,:PASSWORD)", array( //procedure de mysql
                ":LOGIN"=>$this->getDeslogin(),
                ":PASSWORD"=>$this->getDessenha()
            ));

            if(count($results)>0){

                $this->setData($results[0]);

            } else{
                throw new Exception("login ou senha inválidos");
            }

        }

        public function __construct($login = "", $password = ""){

            $this->setDeslogin($login);
            $this->setDessenha($password);
        }
    }  
?>