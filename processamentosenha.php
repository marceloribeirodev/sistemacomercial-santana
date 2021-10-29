<?php
include("conexao.php");

$matricula = $_POST['matricula'];
$senhaAtual = $_POST['senhaAtual'];
$criptAtual = md5($senhaAtual);
$novaSenha = $_POST['novaSenha'];
$repetirSenha = $_POST['repetirSenha'];

$verifica_matricula1 = mysqli_query($conexao,"SELECT * FROM usuario WHERE matricula = '{$matricula}' and senha = '{$senhaAtual}'");

$verifica_matricula2 = mysqli_query($conexao,"SELECT * FROM usuario WHERE matricula = '{$matricula}' and senha = '{$criptAtual}'");

$result1 = mysqli_num_rows($verifica_matricula1);
$result2 = mysqli_num_rows($verifica_matricula2);

if(($result1 == 1)||($result2 == 1)){

	if($novaSenha == $repetirSenha){
		$criptNova = md5($novaSenha);
		mysqli_query($conexao,"UPDATE usuario SET senha = '{$criptNova}' where matricula = '{$matricula}'");
		?>
		<script type="text/javascript">
			alert("Senhas alteradas com sucesso!! Fique tranquilo que a sua senha é criptografada.");
			window.location = "index.php";
		</script>
		<?php

		mysqli_close($conexao);
	}

	else{
		?>
		<script type="text/javascript">
			alert("As duas senhas não foram iguais!!");
			window.location = "trocandosenha.php";
		</script>
		<?php
		mysqli_close($conexao);
	}

}

if(($result1 == 0)||($result2 == 0)){
	?>
	<script type="text/javascript">
		alert("Dados colocados errados!!");
		window.location = "trocandosenha.php";
	</script>
	<?php
	mysqli_close($conexao);
}