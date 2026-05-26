<?php

/* 
|  API que busca e retorna os fornecedores cadastrados no formato JSON
*/

header("Content-type: application/json");

require_once(__DIR__."/../../conexao/connection.php");

try {
   $stmt = $conn->prepare("SELECT * FROM fornecedores f ORDER BY f.nome_fornecedor ASC");
   $stmt->execute();

   if (!$stmt) {
      throw new PDOException("Não foi possível recuperar os fornecedores cadastrados");
   }

   $dados = $stmt->fetchAll();

   echo json_encode($dados);
   
} catch(PDOException $erro) {
   http_response_code(500);
   echo json_encode([
      "erro" => true,
      "mensagem" => $erro->getMessage()
   ]);
}
