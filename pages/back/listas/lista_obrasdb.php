<?php

require_once(__DIR__."/../../conexao/connection.php");

try {
   $query = $conn->prepare("SELECT
                                 O.id,
                                 O.nome AS nomeObra,
                                 O.rua,
                                 O.numObra,
                                 O.porcentagem_cobranca AS porcentagem,
                                 C.cpf_cnpj,
                                 C.nome AS nomeCliente,
                                 Ci.cidade,
                                 SUM(g.valor_gasto) AS total_gasto,
                                 AVG(g.valor_gasto) AS media_mensal
                              FROM obras O
                              INNER JOIN clientes C
                              ON O.cpf_cnpj_cliente = C.cpf_cnpj
                              INNER JOIN cidades Ci
                              ON O.id_cidade = Ci.id
                              LEFT JOIN gastosobras g
                              ON O.id = g.id_obra
                              GROUP BY O.nome
                              ORDER BY nomeObra ASC");

   $query->execute();

   if(!$query) {
      throw new Exception("Não foi possível recuperar as obras cadastradas");
   }
   
   $obras = $query->fetchAll(PDO::FETCH_ASSOC);

   return $obras;

} catch(PDOException $erro) {
   echo $erro->getMessage();
   exit();
}