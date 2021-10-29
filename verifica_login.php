<?php

session_start();
// Verifica se o não existe o usuário 
if(!$_SESSION['matricula']){
	session_destroy();
	header('Location : index.php');
	exit();
}