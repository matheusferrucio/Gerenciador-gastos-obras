<?php
   require_once __DIR__."/../../conexao/connection.php";

   require_once __DIR__."/../config.php";
   
   require_once __DIR__."/../utils.php";

   $idObra = $_GET['id'];
   
   try {
      
      $path = BASE_URL."pages/front/listas/lista_obras.php";
      
      excluirPorKey(
         $conn,
         $path,
         'obras',
         'id',
         $idObra
      );

   } catch(PDOException $erro) {
      echo "Não foi possível excluir a obra";
      exit();
   }
?>