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

         $chaves = [];
         $valores = [];
         
         foreach($teste as $key => $value) {
            array_push($valores, $value['soma_gastos_obra']);
            array_push($chaves, $value['nome_obra']);
         }

         $dados = [
            'labels' => array_values($chaves),
            'values' => array_values($valores)
         ];

         // echo '<pre>';
         // print_r($dados);
         // echo '</pre>';
         
         echo json_encode($dados);
      }

   } catch(PDOException $erro) {
      echo "Não foi possível recuperar os dados";
      exit();
   }
?>