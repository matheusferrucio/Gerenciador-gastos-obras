<?php
   require_once(__DIR__."/../utils.php");

   require_once(__DIR__."/../../conexao/connection.php");

   require_once(__DIR__."/../config.php");

   $cpfCnpj = $_GET['cpfCnpj'];

   try {
      $path = BASE_URL."pages/front/listas/lista_clientes.php";
      
      excluirPorKey(
         $conn,
         $path,
         "clientes",
         "cpf_cnpj",
         $cpfCnpj
      );
   } catch (PDOException $erro) {
      echo "Não foi possível excluir os dados";
      exit();
   }
?>