<?php

require_once("config.php");

$sql = new sql();

//$usuarios = $sql->select("SELECT * from tb_usuarios");
//echo json_encode($usuarios);

//Carrega um usuario:
//$root = new usuario();

//$root->loadById(2);

//echo $root;


//Carrega uma lista de usuários

//$list = Usuario::getList();

//echo json_encode($list);


//Carrega uma lista de usuarios buscando pelo login

//$search = Usuario::search("root3");

//echo json_encode($search);

//Carrega um usuario usando o login e a senha

$usuario = new Usuario();
$usuario->login("root3","12345");

echo $usuario;
?>