<?php
require_once("config.php");
//$root = new Usuario();
// carrega um usuario
//$root -> loadById(1);
//$list = Usuario::getList();
 //echo json_encode($list);
// lista de usuarios pelo login
//$search = Usuario::search("o");
//echo json_encode($search);
//$usuario = new Usuario();
//$usuario -> login("hoot", "12345");
//echo $usuario;

$aluno=new Usuario("Aluno", "@aluno");
$aluno->insert();
echo $aluno;

?>