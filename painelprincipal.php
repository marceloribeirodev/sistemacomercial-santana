<!-- Tarifa -->
<?php

include("verifica_login.php");

include("conexao.php");

$matricula = $_SESSION['matricula'];
$ano = $_SESSION['ano'];
$mes = $_SESSION['mes'];

$sqlControleAcesso = "SELECT cargo FROM usuario WHERE matricula = '{$matricula}'";

$queryResultaControleAcesso = mysqli_query($conexao, $sqlControleAcesso);

$resultadoControledeAcesso = $queryResultaControleAcesso->fetch_array();

if($resultadoControledeAcesso['cargo'] == "Bilheteiro"){
  // Bilheteiro

// Amostragem de dados com base no mês e ano selecionado
  $sql1 = "SELECT u.nome as 'Nome', u.cargo as 'Cargo', u.matricula as 'Matrícula', e.nomeEstabelecimento as 'Estabelecimento',
  rb.dataResultado as 'Data', rb.resultadoTarifa as 'Realizado', rb.metaTarifa as 'Meta', (rb.resultadoTarifa - rb.metaTarifa)
  as 'Resultado $', round((((rb.resultadoTarifa * 100)/rb.metaTarifa)-100),2) as '%'  from usuario as u inner join Estabelecimento as e inner join resultadoBilheteiro as rb on 
  u.idEstabelecimento = e.codigoEstabelecimento and u.matricula = rb.matriculaBilheteiro where u.matricula = '{$matricula}' and MONTH(rb.dataResultado) = '{$mes}' AND YEAR(rb.dataResultado) = '{$ano}'";

// Contador Positivo de metas das tarifas com base no mês e ano selecionado
  $sql2 = "SELECT count(*) as 'contadorPositivo' from resultadoBilheteiro as rb inner join usuario as u on rb.matriculaBilheteiro = u.matricula 
  where rb.resultadoTarifa - rb.metaTarifa >= 0 and u.matricula = '{$matricula}' and MONTH(rb.dataResultado) = '{$mes}' AND YEAR(rb.dataResultado) = '{$ano}'";

// Contador Negativo de metas das tarifas com base no mês e ano selecionado
  $sql3 = "SELECT count(*) as 'contadorNegativo' from resultadoBilheteiro as rb inner join usuario as u on rb.matriculaBilheteiro = u.matricula 
  where rb.resultadoTarifa - rb.metaTarifa < 0 and u.matricula = '{$matricula}' and MONTH(rb.dataResultado) = '{$mes}' AND YEAR(rb.dataResultado) = '{$ano}'";

  $sql4 = "SELECT nome from usuario where usuario.matricula = '{$matricula}'";

}else if($resultadoControledeAcesso['cargo'] == "Cobrador"){
  // Cobrador

  // Amostragem de dados com base no mês e ano selecionado
  $sql1 = "SELECT u.nome as 'Nome', u.cargo as 'Cargo', u.matricula as 'Matrícula', e.nomeEstabelecimento as 'Estabelecimento',
  rc.dataResultado as 'Data', rc.resultado as 'Realizado', rc.meta as 'Meta', (rc.resultado- rc.meta)
  as 'Resultado $', round((((rc.resultado * 100)/rc.meta)-100),2) as '%'  from usuario as u inner join Estabelecimento as e inner join resultadoCobrador as rc on 
  u.idEstabelecimento = e.codigoEstabelecimento and u.matricula = rc.matriculaCobrador where u.matricula = '{$matricula}' and MONTH(rc.dataResultado) = '{$mes}' AND YEAR(rc.dataResultado) = '{$ano}'";

  // Contador Positivo de metas das tarifas com base no mês e ano selecionado
  $sql2 = "SELECT count(*) as 'contadorPositivo' from resultadoCobrador as rc inner join usuario as u on rc.matriculaCobrador = u.matricula 
  where rc.resultado - rc.meta >= 0 and u.matricula = '{$matricula}' and MONTH(rc.dataResultado) = '{$mes}' AND YEAR(rc.dataResultado) = '{$ano}'";

  // Contador Negativo de metas das tarifas com base no mês e ano selecionado
  $sql3 = "SELECT count(*) as 'contadorNegativo' from resultadoCobrador as rc inner join usuario as u on rc.matriculaCobrador = u.matricula 
  where rc.resultado - rc.meta < 0 and u.matricula = '{$matricula}' and MONTH(rc.dataResultado) = '{$mes}' AND YEAR(rc.dataResultado) = '{$ano}'";

  $sql4 = "SELECT nome from usuario where usuario.matricula = '{$matricula}'";

  

}

$resulta1 = mysqli_query($conexao, $sql1);
$resulta2 = mysqli_query($conexao, $sql2);
$resulta3 = mysqli_query($conexao, $sql3);
$resulta4 = mysqli_query($conexao, $sql4);

mysqli_data_seek($resulta1, '0');
mysqli_data_seek($resulta2, '0');
mysqli_data_seek($resulta3, '0');
mysqli_data_seek($resulta4, '0');

mysqli_close($conexao);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="shortcut icon" href="img/faviconsantana.ico" />
  <title>Portal SISCOM</title>
</head>
<body>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="painelprincipal.php"><img src="img/logo-santana-navbar1.png" class="img-fluid" alt="Imagem responsiva"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">
      </ul>
      <a class="btn btn-primary" href="logout.php" role="button">Sair</a></div>
    </nav>
    <br>
    <h3 class="text-center">Painel Principal do Sistema Comercial Santana</h3>
    <hr>

    <div id="wrapper" class="container-fluid px-0">
      <main class="uncollapsed-main">
        <div class="container-fluid pt-2">

          <div class="row px-3">

            <div class="col px-2">
              <div class="card bg-success border-0 mb-3" >
                <div class="card-body p-2 text-white text-center">
                  <span data-feather="check-circle"></span>
                  <h5 class="card-text"><small>Metas batidas: <?php
                  while ($resultado = $resulta2->fetch_array()){ echo $resultado['contadorPositivo']; }?></small></h5> 
                </div>
              </div>
            </div>

            <div class="col px-2">
              <div class="card bg-warning border-0 mb-3">
                <div class="card-body p-2 text-white text-center rounded" style="background-color: #E14823;">
                  <span data-feather="x-square" ></span>
                  <h5 class="card-text"><small>Metas Não batidas: <?php
                  while ($resultado = $resulta3->fetch_array()){ echo $resultado['contadorNegativo']; }?></small></h5> 
                </div>
              </div>
            </div>

            <a class="col px-2" href="http://sac.liderus.com/santana/" target="_blank">
              <div class="col px-2">
                <div class="card bg-warning border-0 mb-3">
                  <div class="card-body p-2 text-white text-center rounded" style="background-color: #1BA6E7;">
                    <span data-feather="mouse-pointer"></span>
                    <h5 class="card-text"><small>Fale Conosco</small></h5>
                  </div>
                </div>
              </div>
            </a>

            <a class="col px-2" href="visualizargraficos.php">
              <div class="col px-2">
                <div class="card bg-dark border-0 mb-3">
                  <div class="card-body p-2 text-light text-center">
                    <span data-feather="trending-up"></span>
                    <h5 class="card-text"><small>Visualizar em Gráficos</small></h5>
                  </div>
                </div>
              </div>
            </a>
            <?php if($resultadoControledeAcesso['cargo'] == "Bilheteiro"){ ?>
            <a class="col px-2" href="painelseguro.php">
              <div class="col px-2">
                <div class="card bg-dark border-0 mb-3">
                  <div class="card-body p-2 text-light text-center rounded" style="background-color: #DB8545;">
                    <span data-feather="user-check"></span>
                    <h5 class="card-text"><small>Seguro</small></h5>
                  </div>
                </div>
              </div>
            </a>
            <?php } ?>

          </div>
          <!-- End: row -->

          <div class="card-deck mb-3">
            <div class="card bg-light card-panel-content">
              <div class="card-body">
                <h4 class="card-title text-center">Resultado - Tarifa</h4>
                <h6 class="card-title text-center">Período: <?php echo $mes?>/<?php echo$ano ?></h6>
                <h6 class="card-title text-center">Se quiser visualizar os seus resultados em outra data <a href="escolherdata.php">Clique Aqui</a></h6>
                <p class="text-center">Usuário: <?php
                while ($resultado = $resulta4->fetch_array()){ echo $resultado['nome']; }?></p>
               <!-- <p class="card-text text-justify text-center"><small>
                  Confira os resultados obtidos do seu mês e faça a gestão das suas metas.
                </small></p>
              -->
              <br>
              <div class="table-responsive">
                <table id="minhaTabela" class="table table-striped" style="background-color: white;">
                  <thead>
                    <tr>
                      <th scope="col">Data</th>
                      <th scope="col">Previsto</th>
                      <th scope="col">Realizado</th>
                      <th scope="col">Result.R$</th>
                      <th scope="col">Result.%</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($novo_resultado = $resulta1->fetch_array()){ 



                      $nova_data = date("d/m/Y", strtotime($novo_resultado['Data'])); ?>

                      <td><?php echo $nova_data; ?></td>
                      <td><?php echo $novo_resultado['Meta']; ?></td>
                      <td><?php echo $novo_resultado['Realizado']; ?></td>
                      <?php
                      if($novo_resultado['Resultado $'] >= 0){ ?>
                        <td style="color: green;"><?php echo $novo_resultado['Resultado $']; ?></td>
                        <?php
                      }else{
                        ?>
                        <td style="color: red;"><?php echo $novo_resultado['Resultado $']; ?></td>
                      <?php                      }
                      ?>
                      <?php
                      if($novo_resultado['%'] >= 0){ ?>
                        <td style="color: green;">+<?php echo $novo_resultado['%']; ?>%</td>
                        <?php
                      }else{
                        ?>
                        <td style="color: red;"><?php echo $novo_resultado['%']; ?>%</td>
                      <?php                      }
                      ?>
                    </tr> 
                    <?php         
                  }
                  ?>
                </tr>
              </tbody>
            </table>
          </div>
          <p class="card-text text-right"><small class="text-muted">Desenvolvimento: TI Santana</small></p>
        </div>
      </div>
    </div>
  </main>

</div>
<!-- End: wrapper -->

<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
crossorigin="anonymous"></script>

<!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
</script>

<script>
  $(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
      if ($('#sidebar .nav .nav-item .nav-link span:nth-child(2n)').hasClass('d-none')) {
        $('#sidebar .nav .nav-item .nav-link span:nth-child(2n)').removeClass('d-none');
        $('li#sidebarCollapse a.nav-link i#toggle-icon').removeClass('fa-angle-right');
        $('li#sidebarCollapse a.nav-link i#toggle-icon').toggleClass('fa-angle-left');
        $('main').removeClass('uncollapsed-main');
        $('main').toggleClass('collapsed-main');
      } else {
        $('main').removeClass('collapsed-main');
        $('main').toggleClass('uncollapsed-main');
        $('#sidebar .nav .nav-item .nav-link span:nth-child(2n)').toggleClass('d-none');
        $('li#sidebarCollapse a.nav-link i#toggle-icon').removeClass('fa-angle-left');
        $('li#sidebarCollapse a.nav-link i#toggle-icon').toggleClass('fa-angle-right');
      }
    });
  });  
</script>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function(){
    $('#minhaTabela').DataTable({
      "language": {
        "lengthMenu": "Mostrando _MENU_ registros por página",
        "zeroRecords": "Nada encontrado",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "Nenhum registro disponível",
        "infoFiltered": "(filtrado de _MAX_ registros no total)"
      }
    });
  });


</script>


</body>
</html>

