<?php
   require_once __DIR__."/../../conexao/connection.php";

   try {
      // Estou utilizando LEFT JOIN para que todas as obras entrem na contagem independentemente
      // se possuem gastos registrados ou não
      $query = $conn->prepare("SELECT
                                 SUM(g.valor_gasto) * 0.1 AS total_comissao_obras,
                                 SUM(g.valor_gasto) AS total_gastos_obras,
                                 COUNT(DISTINCT o.id) AS qtd_total_obras,
                                 SUM(g.valor_gasto) / COUNT(DISTINCT o.id) AS ticket_medio_obra
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