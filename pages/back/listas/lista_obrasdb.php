<?php
   require_once(__DIR__."/../../conexao/connection.php");

   try {
      $query = $conn->prepare("SELECT
                                 O.id,
                                 O.nome AS nomeObra,
                                 O.rua,
                                 O.numObra,
                                 C.cpf_cnpj,
                                 C.nome AS nomeCliente,
                                 Ci.cidade
                               FROM obras O
                               INNER JOIN clientes C
                               ON O.cpf_cnpj_cliente = C.cpf_cnpj
                               INNER JOIN cidades Ci
                               ON O.id_cidade = Ci.id
                               ORDER BY nomeObra ASC");

      $query->execute();

      if($query) {
         $obras = $query->fetchAll(PDO::FETCH_ASSOC);

         return $obras;
      }
   } catch(PDOException $erro) {
      echo $erro;
      echo "Não foi possível recuperar as obras cadastradas";
      exit();
   }
?>