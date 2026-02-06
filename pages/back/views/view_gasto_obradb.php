<?php
   require_once __DIR__."/../../conexao/connection.php";

   $idObra = $_GET['id'];

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
                           ON o.cpf_cnpj_cliente = c.cpf_cnpj
                           WHERE g.id = :id");

      $query->execute([
         ":id" => $idObra
      ]);

      if($query) {
         $dados = $query->fetch(PDO::FETCH_ASSOC);

         return $dados;
      }
   } catch(PDOException $erro) {
      echo "Não foi possível recuperar os dados do gasto obra";
      exit();
   }
?>