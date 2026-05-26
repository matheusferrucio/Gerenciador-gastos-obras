<?php

/*
|  Arquivo que exclui um fornecedor do banco. Para facilitar eu criei uma função geral com alguns parâmetros:
|  -> A conexão, o caminho de redirecionamento, o nome da tabela, a coluna de referência e a key(que é a referência para excluir o dado correto)  
*/

require_once __DIR__ . "/../../conexao/connection.php";

require_once __DIR__ . "/../config.php";

require_once __DIR__ . "/../utils.php";

$idFornecedor = $_GET['idFornecedor'];

try {
   $path = BASE_URL . "pages/front/listas/lista_fornecedores.php";

   excluirPorKey(
      $conn,
      $path,
      'fornecedores',
      'id_fornecedor',
      $idFornecedor
   );

} catch (PDOException $erro) {
   echo $erro->getMessage();
   die();
}