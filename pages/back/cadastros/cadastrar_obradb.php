<?php
   if($_SERVER['REQUEST_METHOD'] == "POST") {
      require_once(__DIR__."/../config.php");

      require_once(__DIR__."/../utils.php");

      require_once(__DIR__."/../../conexao/connection.php");

      $nomeObra       = filter_input(INPUT_POST, 'nomeObra', FILTER_SANITIZE_SPECIAL_CHARS);
      $cpfCnpjCliente = filter_input(INPUT_POST, 'cpfCnpjCliente', FILTER_SANITIZE_SPECIAL_CHARS);
      $cidadeObra     = filter_input(INPUT_POST, 'cidadeObra', FILTER_SANITIZE_SPECIAL_CHARS);
      $ruaObra        = filter_input(INPUT_POST, 'ruaObra', FILTER_SANITIZE_SPECIAL_CHARS);
      $numObra        = filter_input(INPUT_POST, 'numObra', FILTER_SANITIZE_SPECIAL_CHARS);

      // Verifica se a cidade já foi cadastrada
      $cidadeExiste = selecionaPorKey(
         $conn,
         'cidades',
         'cidade',
         trim(strtolower($cidadeObra))
      );

      // Dependendo se a cidade já está cadastrada ou não, ele executa uma inserção diferente no banco
      if($cidadeExiste) {
         $idCidadeObra = $cidadeExiste['id'];

         try {
            $query = $conn->prepare("INSERT INTO obras(
                                       nome,
                                       cpf_cnpj_cliente,
                                       id_cidade,
                                       rua,
                                       numObra
                                    ) VALUES(
                                       :nome,
                                       :cpf_cnpj_cliente,
                                       :id_cidade,
                                       :rua,
                                       :numObra
                                    )");

            $query->execute([
               ":nome"             => $nomeObra,
               ":cpf_cnpj_cliente" => $cpfCnpjCliente,
               ":id_cidade"        => $idCidadeObra,
               ":rua"              => $ruaObra,
               ":numObra"          => $numObra
            ]);

            if($query) {
               header("location".BASE_URL."pages/front/listas/lista_obras.php");
               exit();
            }

         } catch (PDOException $erro) {
            echo "Não foi possível cadastrar a obra";
            exit();
         }

      } else {

         // Bloco de código caso a cidade ainda não tenha sido cadastrada
         try {
            $query = $conn->prepare("INSERT INTO cidades(
                                       nome 
                                   ) VALUES(
                                       :nome
                                   )")

            $query->execute([
               ":nome" => $cidadeObra
            ]);

            if($query) {
               
            }

         } catch (PDOException $erro) {
            echo "Não foi possível cadastrar a obra";
            exit();
         }

      }
   }
?>