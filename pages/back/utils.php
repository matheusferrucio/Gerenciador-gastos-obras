<?php
   // Função que exclui um registro do banco de dados com base em uma key
   function excluirPorKey($conn, $path, $tabela, $coluna, $key) {
      try {
         $query = $conn->prepare("DELETE FROM $tabela WHERE $tabela.$coluna = '$key'");

         $query->execute();

         if(!$query) {
            throw new Exception("Não foi possível excluir o(s) dado(s)");
         }

         header("location:".$path);
         die();

      } catch (Exception $erro) {
         echo $erro->getMessage();
         die();
      }
   }

   // Criei essa função para conseguir buscar dados no banco com base em uma key
   function selecionaPorKey($conn, $tabela, $coluna, $key) {
      try {
         $query = $conn->prepare("SELECT * FROM $tabela WHERE $tabela.$coluna = '$key'");

         $query->execute();

         if(!$query) {
            throw new Exception("Não foi possível recuperar os dados");
         }

         $dados = $query->fetch();

         return $dados;

      } catch (Exception $erro) {
         echo $erro->getMessage();
         die();
      }
   }

   // Criei essa função para selecionar todos os dados da tabela referenciada
   function selecionaTodos($conn, $tabela, $coluna){
      try {
         $query = $conn->prepare("SELECT * FROM $tabela ORDER BY $coluna ASC");
   
         $query->execute();
   
         if(!$query) {
            throw new Exception("Não foi possível recuperar os dados");
         }

         $dados = $query->fetchAll(PDO::FETCH_ASSOC);

         return $dados;

      } catch (Exception $erro) {
         echo $erro->getMessage();
         die();
      }
   }

   function retornaMeses(bool $completos) {
      if($completos) {
         $meses = ['01' => 'Janeiro',
                   '02' => 'Fevereiro', 
                   '03' => 'Março', 
                   '04' => 'Abril', 
                   '05' => 'Maio', 
                   '06' => 'Junho', 
                   '07' => 'Julho', 
                   '08' => 'Agosto', 
                   '09' => 'Setembro', 
                   '10' => 'Outubro', 
                   '11' => 'Novembro', 
                   '12' => 'Dezembro'];
      } else {
         $meses = ['01' => 'Jan',
                   '02' => 'Fev', 
                   '03' => 'Mar', 
                   '04' => 'Abr', 
                   '05' => 'Mai', 
                   '06' => 'Jun', 
                   '07' => 'Jul', 
                   '08' => 'Ago', 
                   '09' => 'Set', 
                   '10' => 'Out', 
                   '11' => 'Nov', 
                   '12' => 'Dez'];
      }

      return $meses;
   }
?>