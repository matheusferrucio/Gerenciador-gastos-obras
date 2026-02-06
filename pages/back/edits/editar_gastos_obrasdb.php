<?php
   if($_SERVER['REQUEST_METHOD'] == "POST") {
      require_once __DIR__."/../../conexao/connection.php";

      require_once __DIR__."/../config.php";

      $idGastoObra    = $_POST['id'];
      $idObra         = $_POST['obraGasto'];
      $valorGastoObra = filter_input(INPUT_POST, 'gastoObra', FILTER_SANITIZE_SPECIAL_CHARS);
      $dataGasto      = $_POST['dataGasto'];
      $descricao      = filter_input(INPUT_POST, 'descricaoGasto', FILTER_SANITIZE_SPECIAL_CHARS);

      try {
         $query = $conn->prepare("UPDATE gastosobras SET
                                    id_obra = :id_obra,
                                    valor_gasto = :valor_gasto,
                                    data_gasto = :data_gasto,
                                    descricao = :descricao
                                 WHERE gastosobras.id = :id 
                                 ");

         $query->execute([
            ":id_obra"     => $idObra,
            ":valor_gasto" => $valorGastoObra,
            ":data_gasto"  => $dataGasto,
            ":descricao"   => $descricao,
            ":id"          => $idGastoObra
         ]);

         if($query) {
            header("location:".BASE_URL."pages/front/listas/lista_gastos_obras.php");
            exit();
         }

      } catch(PDOException $erro) {
         echo "Não foi possível cadastrar o gasto da obra";
         exit();
      }

   } else {
      echo "Não foi possível cadastrar o gasto da obra";
      exit();
   }
?>