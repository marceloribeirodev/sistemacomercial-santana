<?php
session_start();

include ("conexao.php");


// Para não acessar o Login sem nenhuma informação
if(empty($_POST['matricula']) || empty($_POST['senha'])){
	header('Location : index.php');
	exit();
}

// Função para proteger para ver se está vindo ataque de mysql injection e realiza algumas validações,
// Não prejudicando assim o Login
$matricula = mysqli_real_escape_string($conexao, $_POST['matricula']);
$senhaantiga = mysqli_real_escape_string($conexao, md5($_POST['senha']));
$senhanova = mysqli_real_escape_string($conexao, md5($_POST['senha']));
// Query para verificar se o login está correto ou não
$queryantiga = "select matricula from usuario where matricula = '{$matricula}' and senha = '{$senhaantiga}'";
$querycript = "select matricula from usuario where matricula = '{$matricula}' and senha = '{$senhanova}'";
// Executar as query's
$resultantiga = mysqli_query($conexao, $queryantiga);
$resultcript = mysqli_query($conexao, $querycript);

// Quantidade de linhas que a query retornou
$rowantiga = mysqli_num_rows($resultantiga);
$rowcript = mysqli_num_rows($resultcript);

//Fecha o banco de dados

// Redirecionamento para a página certa
if(($rowantiga == 1)||($rowcript == 1)) {
	$_SESSION['matricula'] = $matricula;
    $queryHistorico = "INSERT INTO HISTORICO (idHistorico, matriculaHistorico, dataAcesso) values (default, '{$_SESSION['matricula']}', NOW());";
    mysqli_query($conexao,$queryHistorico);
    mysqli_close($conexao);
    header('Location: escolherdata.php');
	exit();
}
else {
	$_SESSION['nao_autenticado'] = true;
	mysqli_close($conexao);
	?>
	<script type="text/javascript">
  	alert("Usuário ou senha errado!!!");
    window.location = "index.php";
	</script>
	<?php
	exit();

}

mysqli_close($conexao);
