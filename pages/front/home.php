<?php
   require_once(__DIR__."/../back/config.php");

   require_once(__DIR__."/../back/_session.php");

   require_once(__DIR__."/../back/utils.php");

   require_once(__DIR__."/../back/views/view_resumodb.php");

//    require_once(__DIR__."/../back/api_dados_grafico.php");

   $meses = retornaMeses(true);

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
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <script src="<?= BASE_URL; ?>js/botoes.js" defer></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
      <script src="<?= BASE_URL; ?>js/grafico.js" defer></script>
      <title><?= $nomePagina; ?></title>
</head>
<body>
      <?php require_once(__DIR__."/menu.php"); ?>
            
      <main>
            <div class="container">
                  <div class="row rowTitulo">
                        <h1><i class='bx bxs-calendar'></i> Escolha o mês que deseja consultar</h1>
                  </div>
                  
                  <div class="row meses">
                        <?php foreach($meses as $val => $mes) { ?>
                        
                        <span class="mes_dashboard" value="<?= $val; ?>"><?= $mes; ?></span>
      
                        <?php } ?>
                  </div>
      
                  <section class="dashboard">
                        <section class="row resumo">
                              <div class="card totais">
                                    <div class="row row_resumo">
                                          <div class="particao f1">
                                                <i class='bx bx-wallet bg_verde co_verde'></i>
                                          </div>
                                          
                                          <div class="particao f4">
                                                <h3>Total 10% cobrado</h3>
                                                <h1 class="co_verde">R$ <?= number_format($dados['total_comissao_obras'], 2, ',', '.'); ?></h1>
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
                                                <h1 class="co_azul">R$ <?= number_format($dados['total_gastos_obras'], 2, ',', '.'); ?></h1>
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
                                                <h1 class="co_roxo"><?= $dados['qtd_total_obras'] ?></h1>
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
                                                <h1 class="co_laranja">R$ <?= number_format($dados['ticket_medio_obra'], 2, ',', '.'); ?></h1>
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
                  </section>
            </div>
      </main>
</body>
</html>