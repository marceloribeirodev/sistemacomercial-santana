<?php
session_start();

include ("conexao.php");


$ano = $_POST['ano'];
$mes = $_POST['mes'];

$matricula = $_SESSION['matricula'];
$_SESSION['ano'] = $ano;
$_SESSION['mes'] = $mes;

$sqlControleAcesso = "SELECT cargo FROM usuario WHERE matricula = '{$matricula}'";

$queryResultaControleAcesso = mysqli_query($conexao, $sqlControleAcesso);

$resultadoControledeAcesso = $queryResultaControleAcesso->fetch_array();

if($resultadoControledeAcesso['cargo'] == "Bilheteiro"){
	$sql1 = "SELECT * FROM resultadoBilheteiro INNER JOIN usuario on resultadoBilheteiro.matriculaBilheteiro = usuario.matricula WHERE usuario.matricula = '{$matricula}' AND MONTH(dataResultado) = '{$mes}' AND YEAR(dataResultado) = '{$ano}'";
}else if($resultadoControledeAcesso['cargo'] == "Cobrador"){
	$sql1 = "SELECT * FROM resultadoCobrador INNER JOIN usuario on resultadoCobrador.matriculaCobrador = usuario.matricula WHERE usuario.matricula = '{$matricula}' AND MONTH(dataResultado) = '{$mes}' AND YEAR(dataResultado) = '{$ano}'";
}

$resultado = mysqli_query($conexao, $sql1);

mysqli_close($conexao);

if(mysqli_fetch_array($resultado) == null or ""){
	?>
	<script>
		alert("Informações não cadastradas no sistema!!")
		window.location = "escolherdata.php";
	</script>
	<?php
}else{
	header('Location: painelprincipal.php');
}

mysqli_close($conexao);
