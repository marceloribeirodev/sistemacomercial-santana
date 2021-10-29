<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "bancosistemacomercial";

$conexao = mysqli_connect($servidor,$usuario,$senha) or die ('Não foi possível conectar');
mysqli_select_db($conexao,$dbname) or die (mysqli_error());

mysqli_set_charset($conexao,"utf8");

?>