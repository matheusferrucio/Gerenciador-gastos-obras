<?php
   // Criei essa função para padronizar a exclusão dos dados com base em uma key
   function excluirPorKey($conn, $path, $tabela, $coluna, $key) {
      $query = $conn->prepare("DELETE FROM $tabela WHERE $tabela.$coluna = '$key'");

      $query->execute();

      if($query) {

         header("location:".$path);
         exit();

      }
   }

   // Criei essa função para conseguir buscar dados no banco com base em uma key
   function selecionaPorKey($conn, $tabela, $coluna, $key) {
      $query = $conn->prepare("SELECT * FROM $tabela WHERE $tabela.$coluna = '$key'");

      $query->execute();

      if($query) {

         $dados = $query->fetch(PDO::FETCH_ASSOC);

         return $dados;
      }
   }

   // Criei essa função para selecionar todos os dados da tabela referenciada
   function selecionaTodos($conn, $tabela, $coluna){
      try {
         $query = $conn->prepare("SELECT * FROM $tabela ORDER BY $coluna ASC");
   
         $query->execute();
   
         if($query) {

            $dados = $query->fetchAll(PDO::FETCH_ASSOC);

            return $dados;
         }

      } catch (PDOException $erro) {
         echo "Não foi possível recuperar os dados";
         exit();
      }
   }

   function retornaMeses() {
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

      return $meses;
   }
?>