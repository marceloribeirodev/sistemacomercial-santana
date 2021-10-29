<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="ID-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="bootstrap.css">
  <link rel="stylesheet" type="text/css" href="style.css"> 

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="shortcut icon" href="imagens/faviconsantana.ico" />
  <link rel="stylesheet" type="text/css" href="css/cssLogin.css">
  <link rel="shortcut icon" href="img/faviconsantana.ico" />
  
  <title>Portal SISCOM</title>
</head>
<body>

  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <div class="container" id="container">
    <div class="form-container sign-in-container">
      <form action="processamentosenha.php" method="post">
        <h1>Trocar Senha</h1>
        <span>Digite os dados abaixo para trocar a sua senha</span>
        <input type="text" placeholder="Matricula" id="matricula" name="matricula" required />
        <input type="password" placeholder="Senha Atual" id="senhaAtual" name="senhaAtual" required />
        <input type="password" placeholder="Nova Senha" id="novaSenha" name="novaSenha" required />
        <input type="password" placeholder="Repetir Senha" id="repetirSenha" name="repetirSenha" required />
        <button>Enviar</button>
        <a href="index.php">Voltar para o login</a>

      </form>
    </div>
  </div>
</body>
</html>

<script type="text/javascript">

  const signUpButton = document.getElementById('signUp');
  const signInButton = document.getElementById('signIn');
  const container = document.getElementById('container');

  signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
  });

  signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
  });

</script>