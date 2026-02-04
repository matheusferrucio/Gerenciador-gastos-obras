<?php
   require_once(__DIR__."/../../conexao/connection.php");

   require_once(__DIR__."/../utils.php");

   try {
      $clientes = selecionaTodos(
         $conn,
         'clientes',
         'nome'
      );

      if($clientes) {
         return $clientes;
      }

   } catch (PDOException $erro) {
      echo "Não foi possível recuperar os clientes cadastrados";
      exit();
   }
?>