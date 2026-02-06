<?php
   require_once __DIR__."/../../conexao/connection.php";

   require_once __DIR__."/../config.php";

   require_once __DIR__."/../utils.php";

   $idGastoObra = $_GET['id'];

   try {
      
      $path = BASE_URL."pages/front/listas/lista_gastos_obras.php";

      excluirPorKey(
         $conn,
         $path,
         'gastosobras',
         'id',
         $idGastoObra
      );

   } catch(PDOException $erro) {
      echo "Não foi possível excluir esse gasto";
      exit();
   }
?>