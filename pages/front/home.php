<?php
   require_once(__DIR__."/../back/config.php");

   require_once(__DIR__."/../back/_session.php");

   require_once(__DIR__."/../back/utils.php");

   require_once(__DIR__."/../back/views/view_resumodb.php");

   require_once __DIR__."/../back/views/view_tabela_resumo_obrasdb.php";
   
   $meses = retornaMeses(false);

   $query = $conn->query("SELECT YEAR(g.data_gasto) AS ano FROM gastosobras g GROUP BY YEAR(g.data_gasto) ORDER BY g.data_gasto DESC");

   $anos = $query->fetchAll(PDO::FETCH_ASSOC);

//    echo "<pre>";
//    print_r($anos);
//    echo "</pre>";
   
   $nomePagina = isset($_GET['nomePag']) ? $_GET['nomePag'] : "Início";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/reset.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/style.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/home.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/table.css">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
      <script src="<?= BASE_URL; ?>js/home.js" defer></script>
      <title><?= $nomePagina; ?></title>
</head>
<body>
      <?php require_once(__DIR__."/menu.php"); ?>
            
      <main>
            <div class="container">
                  <div class="row rowTitulo">
                        <h1><i class='bx bxs-calendar'></i> Escolha o período que deseja consultar</h1>
                  </div>
                  
                  <div class="row filtro_periodo">
                        <div class="particao anos">
                              <button id="btn_ano" class="">
                                    <?= date('Y'); ?> <i class='bx bxs-chevron-down'></i>
                              </button>

                              <div class="dropdown" id="dropdown_filtro_ano">
                                    <ul class="dados_dropdown">
                                          <?php
                                                foreach($anos as $ano) {
                                          ?>
                                          
                                          <li class="ano_dashboard" data-ano="<?= $ano['ano']; ?>">
                                                <?= $ano['ano']; ?>
                                          </li>

                                          <?php
                                                }
                                          ?>
                                    </ul>
                              </div>
                        </div>
                        
                        <div class="particao meses">
                              <span class="mes_dashboard" value="todos">Todos</span>
      
                              <?php foreach($meses as $val => $mes) { ?>
                              
                              <span class="mes_dashboard" value="<?= $val; ?>"><?= $mes; ?></span>
            
                              <?php } ?>
                        </div>
                  </div>
      
                  <section class="dashboard">
                        <section class="row resumo">
                              <div class="card totais">
                                    <div class="row row_resumo">
                                          <div class="particao f1">
                                                <i class='bx bx-wallet bg_verde co_verde'></i>
                                          </div>
                                          
                                          <div class="particao f4">
                                                <h3>Total de administração</h3>
                                                <h1 class="co_verde" id="total_comissoes"></h1>
                                          </div>
                                    </div>
                              </div>
                              
                              <div class="card totais">
                                    <div class="row row_resumo">
                                          <div class="particao f1">
                                                <i class='bx bx-dollar bg_azul co_azul'></i>
                                          </div>

                                          <div class="particao f4">
                                                <h3>Total dos gastos da obras</h3>
                                                <h1 class="co_azul" id="total_gastos"></h1>
                                          </div>
                                    </div>
                              </div>
            
                              <div class="card totais">
                                    <div class="row row_resumo">
                                          <div class="particao f1">
                                                <i class='bx bx-buildings bg_roxo co_roxo' ></i>
                                          </div>

                                          <div class="particao f4">
                                                <h3>Total de obras ativas</h3>
                                                <h1 class="co_roxo" id="qtd_obras"></h1>
                                          </div>
                                    </div>
                              </div>
            
                              <div class="card totais">
                                    <div class="row row_resumo">
                                          <div class="particao f1">
                                                <i class='bx bx-dollar-circle bg_laranja co_laranja'></i>
                                          </div>
                                          <div class="particao f4">
                                                <h3>Média por obra</h3>
                                                <h1 class="co_laranja" id="media_comissoes"></h1>
                                          </div>
                                    </div>
                              </div>
                        </section>
      
                        <section class="row grafico">
                              <div class="card">
                                    <h1><i class='bx bx-bar-chart'></i> Comparativo de ganho por obra</h1>
                                    <canvas id="myChart"></canvas>
                              </div>
                        </section>

                        <section class="row resumo_por_obra">
                              <div class="card f4">
                                    <div class="row linha_titulo">
                                          <h1><i class='bx bx-table'></i> Resumo dos gastos por obra</h1>
                                    </div>

                                    <div class="row">
                                          <table class="tabela_gastos_obras">
                                                <tr class="linha_cabecalho">
                                                      <th class="f2">Nome obra</th>
                                                      <th class="f1">Total gasto</th>
                                                      <th class="f-6">%</th>
                                                      <th class="f1">Comissão</th>
                                                </tr> 
                                          </table>
                                    </div>
                              </div>

                              <div class="card f2">
                                    <div class="row">
                                          <h1><i class='bx bx-doughnut-chart'></i> Distribuição de comissões por obra</h1>
                                    </div>

                                    <div class="row">
                                          <canvas id="donut_chart"></canvas>
                                    </div>
                              </div>
                        </section>
                  </section>
            </div>
      </main>
</body>
</html>