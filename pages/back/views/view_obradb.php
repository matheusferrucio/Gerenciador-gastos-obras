<?php
   require_once __DIR__."/../../conexao/connection.php";

   require_once __DIR__."/../utils.php";

   $idObra = $_GET['id'];

   try {
      $query = $conn->prepare("SELECT
                                 O.id,
                                 O.nome AS nomeObra,
                                 O.rua,
                                 O.numObra,
                                 O.porcentagem_cobranca AS porcentagem,
                                 C.cpf_cnpj,
                                 C.nome AS nomeCliente,
                                 Ci.cidade
                               FROM obras O
                               INNER JOIN clientes C
                               ON O.cpf_cnpj_cliente = C.cpf_cnpj
                               INNER JOIN cidades Ci
                               ON O.id_cidade = Ci.id
                               WHERE O.id = :id
                               ORDER BY nomeObra ASC");

      $query->execute([
         ":id" => $idObra
      ]);

      if($query) {
         $dados = $query->fetch(PDO::FETCH_ASSOC);

         return $dados;
      }

   } catch (PDOException $erro) {
      echo "Não foi possível recuperar os dados da obra";
      exit();
   }
?>