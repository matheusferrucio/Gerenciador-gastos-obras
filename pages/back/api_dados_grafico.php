<?php
   require_once __DIR__."/../conexao/connection.php";

   try {
      $query = $conn->prepare("SELECT
                                 SUM(g.valor_gasto) AS soma_gastos_obra,
                                 o.nome AS nome_obra
                              FROM gastosobras g
                              INNER JOIN obras o
                              ON g.id_obra = o.id 
                              ORDER BY o.nome ASC");

      $query->execute();

      if($query) {
         $teste = $query->fetchAll(PDO::FETCH_ASSOC);

         echo '<pre>';
         print_r($teste);
         echo '</pre>';
         
         // echo json_encode($dados);
      }

   } catch(PDOException $erro) {
      echo "Não foi possível recuperar os dados";
      exit();
   }
?>