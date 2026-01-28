<?php
   require_once(__DIR__."/../../conexao/connection.php");

   try {
      $query = $conn->prepare("SELECT * FROM clientes");

      $query->execute();

      if($query) {
         $dados = $query->fetchAll(PDO::FETCH_ASSOC);

         return $dados;
      }

   } catch (PDOException $erro) {
      echo "Não foi possível recuperar os clientes cadastrados";
      exit();
   }
?>