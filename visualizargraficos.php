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
  rb.dataResultado as 'Data', rb.resultadoTarifa as 'resultadoTarifa', rb.resultadoSeguro as 'resultadoSeguro', rb.metaTarifa as 'metaTarifa', rb.metaSeguro as 'metaSeguro' from usuario as u inner join Estabelecimento as e inner join resultadoBilheteiro as rb on 
  u.idEstabelecimento = e.codigoEstabelecimento and u.matricula = rb.matriculaBilheteiro where u.matricula = '{$matricula}' and MONTH(rb.dataResultado) = '{$mes}' AND YEAR(rb.dataResultado) = '{$ano}'";

  $resulta1 = mysqli_query($conexao, $sql1);

  while($row = mysqli_fetch_array($resulta1)){
    extract($row);
    $nova_data = date("d/m/Y", strtotime($Data));
    $json_data[] = $nova_data;
    $json_resultado_tarifa[] = $resultadoTarifa;
    $json_meta_tarifa[] = $metaTarifa;
    $json_resultado_seguro[] = $resultadoSeguro;
    $json_meta_seguro[] = $metaSeguro;
  }

  $data =  json_encode($json_data);
  $resultado_tarifa =  json_encode($json_resultado_tarifa);
  $meta_tarifa = json_encode($json_meta_tarifa);
  $resultado_seguro = json_encode($json_resultado_seguro);
  $meta_seguro = json_encode($json_meta_seguro);


}else if($resultadoControledeAcesso['cargo'] == "Cobrador"){
  // Cobrador

  // Amostragem de dados com base no mês e ano selecionado
  $sql1 = "SELECT u.nome as 'Nome', u.cargo as 'Cargo', u.matricula as 'Matrícula', e.nomeEstabelecimento as 'Estabelecimento',
  rc.dataResultado as 'Data', rc.resultado as 'resultadoTarifa', rc.meta as 'metaTarifa' from usuario as u inner join Estabelecimento as e inner join resultadoCobrador as rc on 
  u.idEstabelecimento = e.codigoEstabelecimento and u.matricula = rc.matriculaCobrador where u.matricula = '{$matricula}' and MONTH(rc.dataResultado) = '{$mes}' AND YEAR(rc.dataResultado) = '{$ano}'";

  $resulta1 = mysqli_query($conexao, $sql1);

  while($row = mysqli_fetch_array($resulta1)){
    extract($row);
    $nova_data = date("d/m/Y", strtotime($Data));
    $json_data[] = $nova_data;
    $json_resultado_tarifa[] = $resultadoTarifa;
    $json_meta_tarifa[] = $metaTarifa;
  }

  $data =  json_encode($json_data);
  $resultado_tarifa =  json_encode($json_resultado_tarifa);
  $meta_tarifa = json_encode($json_meta_tarifa);
}

$sql2 = "SELECT nome from usuario where usuario.matricula = '{$matricula}'";

$resulta2 = mysqli_query($conexao, $sql2);

//mysqli_data_seek($resulta1, '0');

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
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

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

            <a class="col px-2" href="painelprincipal.php">
              <div class="col px-2">
                <div class="card bg-dark border-0 mb-3">
                  <div class="card-body p-2 text-light text-center">
                    <span data-feather="trello"></span>
                    <h5 class="card-text"><small>Visualizar em Tabela</small></h5>
                  </div>
                </div>
              </div>
            </a>
        </div>
        <!-- End: row -->

        <div class="card-deck mb-3">
          <div class="card bg-light card-panel-content">
            <div class="card-body">
              <h6 class="card-title text-center">Período: <?php echo $mes?>/<?php echo$ano ?></h6>
              <h6 class="card-title text-center">Se quiser visualizar os seus resultados em outra data <a href="escolherdata.php">Clique Aqui</a></h6>
              <p class="text-center">Usuário: <?php
              while ($resultado = $resulta2->fetch_array()){ echo $resultado['nome']; }?></p>
               <!-- <p class="card-text text-justify text-center"><small>
                  Confira os resultados obtidos do seu mês e faça a gestão das suas metas.
                </small></p>
              -->
              <br>
              <div class="table-responsive">

                <div class="container-fluid" style="background-color: transparent; max-height: 280px; max-width: 800px;">
                  <center><h2>Resultado Tarifa</h2></center>
                  <canvas id="resultadogeral" style="width: 200px;"></canvas>
                </div>
                <?php if($resultadoControledeAcesso['cargo'] == "Bilheteiro"){ ?>
                <div class="container-fluid" style="background-color: transparent; max-height: 280px; max-width: 800px; margin-top: 180px;">
                  <center><h2>Resultado Seguro</h2></center>
                  <canvas id="resultadoseguro"></canvas>
                </div>
                <?php }?>
                
                <script>
                  var ctx = document.getElementById('resultadogeral').getContext('2d');
                  var myChart = new Chart(ctx, {
                    type: 'line',
                    data: { /*date('d/m/Y', strtotime($data_viag));*/
                    labels: <?php echo $data;?>,
                    datasets: [{

                      label: 'Meta',
                      data: <?php echo $meta_tarifa; ?>,
                      backgroundColor: 'transparent',
                      borderColor: 'red',
                      borderWidth: 1
                    },

                    {


                      label: 'Tarifa',
                      subtitle: 'Previsto e Realizado das Tarifas',
                      data: <?php echo $resultado_tarifa; ?>,
                      backgroundColor: [
                      '#5B9BD5',
                      ],

                      pointBorderColor: [
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',
                      'blue',

                      ],

                      borderColor: 'blue',

                      borderWidth: 2

                    }]
                  },
                  options: {
                    title:{
                      display: true,
                      fontSize: 13,
                      text: "Previsto e Realizado das Tarifas",

                      scales: {
                        yAxes: [{
                          ticks: {
                            beginAtZero: true
                          }
                        }]
                      }
                    }
                  }
                });
              </script>

              <script>
                var ctx = document.getElementById('resultadoseguro').getContext('2d');
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: { /*date('d/m/Y', strtotime($data_viag));*/
                  labels: <?php echo $data;?>,
                  datasets: [{
                    label: 'Meta Seguro',
                    data: <?php echo $meta_seguro; ?>,
                    backgroundColor: 'transparent',
                    borderColor: 'red',
                    borderWidth: 1,
                    type: 'line',
                  },

                  {
                    label: 'Resultado Seguro',
                    data: <?php echo $resultado_seguro; ?>,
                    backgroundColor:
                    'orange',
                    borderColor:
                    'gray',
                    borderWidth: 3,   
                  }

                  ]
                },
                options: {
                  title:{
                    display: true,
                    fontSize: 13,
                    text: "Obs: Previsto e Realizado do Seguro",
                    scales: {
                      yAxes: [{
                        ticks: {
                          beginAtZero: true
                        }
                      }]
                    }
                  }
                }
              }); 
            </script>
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
  $(function () {
   $('.toggle-menu').click(function(){
    $('.exo-menu').toggleClass('display');

  });

 }); 

</script>

</body>
</html>

