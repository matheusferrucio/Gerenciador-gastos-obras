<?php
    header("Content-type: application/json");

   require_once __DIR__."/../../conexao/connection.php";

   $filtro_mes = isset($_GET['mes']) ? $_GET['mes'] : '';
   $filtro_ano = isset($_GET['ano']) ? $_GET['ano'] : '';

   $condicoes = [];
   $params = [];

   try {
      // Estou utilizando LEFT JOIN para que todas as obras entrem na contagem independentemente
      // se possuem gastos registrados ou não
      $query = $conn->prepare("SELECT
                                 SUM(g.valor_gasto * (o.porcentagem_cobranca / 100)) AS total_comissao_obras,
                                 SUM(g.valor_gasto) AS total_gastos_obras,
                                 COUNT(DISTINCT o.id) AS qtd_total_obras,
                                 SUM(g.valor_gasto * (o.porcentagem_cobranca / 100)) / COUNT(DISTINCT o.id) AS ticket_medio_obra
                                 FROM obras o
                                 LEFT JOIN gastosobras g
                                 ON o.id = g.id_obra");

      $query->execute();

      if($query) {
         $dados = $query->fetch(PDO::FETCH_ASSOC);
      }

   } catch(PDOException $erro) {
      echo "Não foi possível recuperar os dados".$erro;
      exit();
   }
?>