<?php

require_once("config.php");

$vinicius = new Usuario();

$vinicius->loadbyId(3);

echo $vinicius;


/*
EXEMPLO DO sQL
$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);
*/
?>