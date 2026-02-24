<?php
   require __DIR__."/../../conexao/connection.php";

   try {
      $stmt = $conn->prepare("SELECT
                                 o.nome,
                                 SUM(g.valor_gasto) AS total,
                                 SUM(g.valor_gasto * (o.porcentagem_cobranca / 100)) AS comissao_obra,
                                 o.porcentagem_cobranca AS porcentagem
                              FROM obras o
                              INNER JOIN gastosobras g
                              ON o.id = g.id_obra
                              GROUP BY o.nome
                              ORDER BY o.nome ASC");

      $stmt->execute();

      if($stmt) {
         $resumoPorObra = $stmt->fetchAll(PDO::FETCH_ASSOC);

         return $resumoPorObra;
      }
   } catch(PDOException $erro) {
      echo "Não foi possível recuperar os dados";
      exit();
   }
?>