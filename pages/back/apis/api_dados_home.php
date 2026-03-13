<?php
   // header("Content-type: application/json");

   require_once __DIR__."/../../conexao/connection.php";

   $filtro_mes = isset($_GET['mes']) ? $_GET['mes'] : date('m');
   $filtro_ano = isset($_GET['ano']) ? $_GET['ano'] : date('Y');

   $condicoes = [];
   $params = [];

   if($filtro_mes !== "todos") {
      $condicoes[] = "MONTH(g.data_gasto) = :mes";
      $params[":mes"] = $filtro_mes;
   }

   $condicoes[] = "YEAR(g.data_gasto) = :ano";
   $params[":ano"] = $filtro_ano;

   $where = "WHERE " . implode(" AND ", $condicoes);

   try {
      // Estou utilizando LEFT JOIN para que todas as obras entrem na contagem independentemente
      // se possuem gastos registrados ou não
      $stmtCards = $conn->prepare("SELECT
                                 SUM(g.valor_gasto * (o.porcentagem_cobranca / 100)) AS total_comissao_obras,
                                 SUM(g.valor_gasto) AS total_gastos_obras,
                                 COUNT(DISTINCT o.id) AS qtd_total_obras,
                                 SUM(g.valor_gasto * (o.porcentagem_cobranca / 100)) / COUNT(DISTINCT o.id) AS ticket_medio_obra
                                 FROM obras o
                                 LEFT JOIN gastosobras g
                                 ON o.id = g.id_obra");

      $stmtCards->execute();

      if($stmtCards) {
         $dadosCards = $stmtCards->fetch(PDO::FETCH_ASSOC);

         echo "<pre>";
         print_r($dadosCards);
         echo "</pre>";
      }

   } catch(PDOException $erro) {
      echo "Não foi possível recuperar os dados".$erro;
      exit();
   }
?>