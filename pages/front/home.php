<?php
   require_once(__DIR__."/../back/config.php");

   require_once(__DIR__."/../back/_session.php");

   require_once(__DIR__."/../back/utils.php");

   require_once(__DIR__."/../back/views/view_resumodb.php");

   require_once(__DIR__."/../back/api_dados_grafico.php");

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
                        <h1>🗓️ Escolha o mês que deseja consultar</h1>
                  </div>
                  
                  <div class="row meses">
                        <?php foreach($meses as $val => $mes) { ?>
                        
                        <span class="mes_dashboard" value="<?= $val; ?>"><?= $mes; ?></span>
      
                        <?php } ?>
                  </div>
      
                  <section class="dashboard">
                        <section class="row resumo">
                              <div class="card totais">
                                    <div class="row">
                                          <h3>Total 10% cobrado</h3>
                                          <h1 class="price">R$ <?= number_format($dados['total_comissao_obras'], 2, ',', '.'); ?></h1>
                                    </div>
            
                                    <span class="emoji_fundo">💵</span>
                              </div>
                              
                              <div class="card totais">
                                    <div class="row">
                                          <h3>Total dos gastos da obras</h3>
                                          <h1 class="">R$ <?= number_format($dados['total_gastos_obras'], 2, ',', '.'); ?></h1>
                                    </div>
            
                                    <span class="emoji_fundo">💰</span>
                              </div>
            
                              <div class="card totais">
                                    <div class="row">
                                          <h3>Total de obras ativas</h3>
                                          <h1><?= $dados['qtd_total_obras'] ?></h1>
                                    </div>
            
                                    <span class="emoji_fundo">🏡</span>
                              </div>
            
                              <div class="card totais">
                                    <div class="row">
                                          <h3>Média de ganho por obra</h3>
                                          <h1>R$ <?= number_format($dados['ticket_medio_obra'], 2, ',', '.'); ?></h1>
                                    </div>
            
                                    <span class="emoji_fundo">📈</span>
                              </div>
                        </section>
      
                        <section class="row grafico">
                              <div class="card">
                                    <h1>📊 Comparativo de ganho por obra</h1>
                                    <canvas id="myChart"></canvas>
                              </div>
                        </section>
                  </section>
            </div>
      </main>
</body>
</html>