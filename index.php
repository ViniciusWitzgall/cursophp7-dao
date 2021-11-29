<?php

require_once("config.php");

//carrega um usuario
//$vinicius = new Usuario();
//$vinicius->loadbyId(3);
//echo $vinicius;

//carrega uma lista de usuarios EX2 -- USUARIO2
//$lista = Usuario2::getList();
//echo json_encode($lista);

//carregad uma lista de ususarios buscando pelo login
//$search = Usuario2::search("vi");
//echo json_encode($search);


//EXEMPLO DO Sql
//$sql = new Sql();
//$usuarios = $sql->select("SELECT * FROM tb_usuarios");
//echo json_encode($usuarios);

//carrega um usuario usando o login e a senha
$usuarios = new Usuario2();
$usuarios->login("vinicius", "1234567890");

echo $usuarios;

?>