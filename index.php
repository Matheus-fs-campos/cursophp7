<?php

    require ("config.php");
//primeira parte
    //$sql = new sql();
    //$usuarios = $sql ->select("select * from tb_usuarios");
    //echo json_encode($usuarios);


//Segunda parte

    $root = new Usuario();
    $root->loadById(1);
    echo $root;
?>