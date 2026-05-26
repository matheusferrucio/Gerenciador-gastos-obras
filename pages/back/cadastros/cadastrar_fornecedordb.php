<?php

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
   throw new Exception("Não foi possível realizar o cadastro");
}

require_once(__DIR__."/../config.php");
require_once(__DIR__."/../../conexao/connection.php");

try {
   $cpfCnpjFornecedor = filter_input(INPUT_POST, 'cpfCnpjFornecedor', FILTER_SANITIZE_SPECIAL_CHARS);
   $nomeFornecedor    = filter_input(INPUT_POST, 'nomeFornecedor', FILTER_SANITIZE_SPECIAL_CHARS);
   $telFornecedor     = filter_input(INPUT_POST, 'telefoneFornecedor', FILTER_SANITIZE_SPECIAL_CHARS);

   $stmt = $conn->prepare("INSERT INTO fornecedores (
                              nome_fornecedor,
                              cpf_cnpj_fornecedor,
                              telefone
                           ) VALUES (
                              :nome_fornecedor,
                              :cpf_cnpj_fornecedor,
                              :telefone
                           )");

   $stmt->execute([
      ":nome_fornecedor"     => $nomeFornecedor,
      ":cpf_cnpj_fornecedor" => trim($cpfCnpjFornecedor),
      ":telefone"            => $telFornecedor
   ]);

   if (!$stmt) {
      throw new PDOException("Não foi possível cadastrar o fornecedor");
   }

   header("location:".BASE_URL."pages/front/listas/lista_fornecedores.php");
   exit();

} catch (PDOException $erro) {
   echo $erro->getMessage();
   die();
}