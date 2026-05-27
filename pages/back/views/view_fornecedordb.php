<?php

require_once __DIR__ . "/../../conexao/connection.php";

require_once __DIR__ . "/../utils.php";

$idFornecedor = $_GET['idFornecedor'];

try {

   $dados = selecionaPorKey(
      $conn,
      'fornecedores',
      'id_fornecedor',
      $idFornecedor
   );

   return $dados;

} catch (PDOException $erro) {
   echo $erro->getMessage();
   die();
}