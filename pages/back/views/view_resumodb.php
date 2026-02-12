<?php
   require_once __DIR__."/../../conexao/connection.php";

   try {
      $query = $conn->prepare("SELECT
                                 SUM(valor_gasto) * 0.1 AS total_comissao_obras,
                                 SUM(valor_gasto) AS total_gastos_obras,
                                 COUNT(DISTINCT id_obra) AS qtd_total_obras,
                                 SUM(valor_gasto) / COUNT(DISTINCT id_obra) AS ticket_medio_obra
                                 FROM gastosobras");

      $query->execute();

      if($query) {
         $dados = $query->fetch(PDO::FETCH_ASSOC);
      }

   } catch(PDOException $erro) {
      echo "Não foi possível recuperar os dados".$erro;
      exit();
   }
?>