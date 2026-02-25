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
      $msgErro = 'Não foi possível excluir a obra, há 1 ou mais gastos atrelados a ela';
      $title = 'Exclusão não permitida';
      $caminhoVolta = BASE_URL . "pages/front/listas/lista_obras.php";
      
      // echo "Não foi possível excluir a obra";
      header("Location:" . BASE_URL . "pages/front/error.php?erro=$msgErro&title=$title&caminho_volta=$caminhoVolta");
      exit();
   }
?>