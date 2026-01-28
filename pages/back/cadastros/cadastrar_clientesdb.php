<?php
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      require_once(__DIR__."/../config.php");

      require_once(__DIR__."/../../conexao/connection.php");

      $cpfCnpjCliente = filter_input(INPUT_POST, 'cpfCnpjCliente', FILTER_SANITIZE_SPECIAL_CHARS);
      $nomeCliente    = filter_input(INPUT_POST, 'nomeCliente', FILTER_SANITIZE_SPECIAL_CHARS);
      $tipoCliente    = $_POST['tipoCliente'];

      try {
         $query = $conn->prepare("INSERT INTO clientes (
                                    cpf_cnpj,
                                    nome,
                                    tipo_cliente
                                 ) VALUES (
                                    :cpf_cnpj,
                                    :nome,
                                    :tipo_cliente
                                 )");

         $query->execute([
            ":cpf_cnpj"     => $cpfCnpjCliente,
            ":nome"         => $nomeCliente,
            ":tipo_cliente" => $tipoCliente
         ]);

         if($query) {
            header("location:".BASE_URL."pages/front/listas/lista_clientes.php");
            exit();
         } else {
            echo "Não foi possível cadastrar cliente";
            exit();
         }
         
      } catch (PDOException $erro) {
         echo "Não foi possível cadastrar cliente";
         exit();
      }
   } else {
      echo "Não foi possível recuperar os dados";
      exit();
   }
?>