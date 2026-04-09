<?php
   require_once(__DIR__."/../../conexao/connection.php");

   require_once(__DIR__."/../utils.php");

   try {
      $clientes = selecionaTodos(
         $conn,
         'clientes',
         'nome'
      );

      if(!$clientes) {
         throw new Exception('Nenhum cliente cadastrado');
      }
      
      return $clientes;

   } catch (Exception $erro) {
      echo $erro->getMessage();
      die();
   }
?>