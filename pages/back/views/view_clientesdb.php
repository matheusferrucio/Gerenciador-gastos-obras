<?php
   require_once(__DIR__."/../../conexao/connection.php");

   require_once(__DIR__."/../utils.php");

   $cpfCnpj = $_GET['cpfCnpj'];

   try {
      
      $linha = selecionaPorKey(
                  $conn,
                  'clientes',
                  'cpf_cnpj',
                  $cpfCnpj
               );
               
   } catch(PDOException $erro) {
      echo "Não foi possível recuperar os dados do cliente";
      exit();
   }
?>