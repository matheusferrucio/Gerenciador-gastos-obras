<?php
   require_once __DIR__."/../../conexao/connection.php";

   require_once __DIR__."/../config.php";

   try {
      $query = $conn->prepare("SELECT
                                 o.nome AS nomeObra,
                                 c.nome AS nomeCliente,
                                 g.id,
                                 g.valor_gasto,
                                 g.data_gasto,
                                 g.descricao
                                 FROM gastosobras g
                                 INNER JOIN obras o
                                 ON g.id_obra = o.id
                                 INNER JOIN clientes c
                                 ON o.cpf_cnpj_cliente = c.cpf_cnpj");

      $query->execute();

      if($query) {
         $dados = $query->fetchAll(PDO::FETCH_ASSOC);

         return $dados;
         exit();
      }
      
   } catch(PDOException $erro) {
      echo "Não foi possível recuperar os gastos das obras";
      exit();
   }
?>