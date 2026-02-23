<?php
   if($_SERVER['REQUEST_METHOD'] == "POST") {
      require_once(__DIR__."/../config.php");

      require_once(__DIR__."/../utils.php");

      require_once(__DIR__."/../../conexao/connection.php");

      $idObra         = $_POST['id'];
      $nomeObra       = filter_input(INPUT_POST, 'nomeObra', FILTER_SANITIZE_SPECIAL_CHARS);
      $cpfCnpjCliente = filter_input(INPUT_POST, 'clienteObra', FILTER_SANITIZE_SPECIAL_CHARS);
      $cidadeObra     = filter_input(INPUT_POST, 'cidadeObra', FILTER_SANITIZE_SPECIAL_CHARS);
      $ruaObra        = filter_input(INPUT_POST, 'ruaObra', FILTER_SANITIZE_SPECIAL_CHARS);
      $numObra        = filter_input(INPUT_POST, 'numObra', FILTER_SANITIZE_SPECIAL_CHARS);
      $porcentagem    = filter_input(INPUT_POST, 'porcentagemCobrada', FILTER_SANITIZE_SPECIAL_CHARS);

      // Verifica se a cidade já foi cadastrada
      $cidadeExiste = selecionaPorKey(
         $conn,
         'cidades',
         'cidade',
         trim(ucfirst(strtolower($cidadeObra)))
      );

      // Dependendo se a cidade já está cadastrada ou não, ele executa uma inserção diferente no banco
      if($cidadeExiste) {

         $idCidadeObra = $cidadeExiste['id'];

         try {
            $query = $conn->prepare("UPDATE obras o
                                     SET
                                       nome                 = :nome,
                                       cpf_cnpj_cliente     = :cpf_cnpj_cliente,
                                       id_cidade            = :id_cidade,
                                       rua                  = :rua,
                                       numObra              = :numObra,
                                       porcentagem_cobranca = :porcentagem
                                     WHERE o.id         = :id");

            $query->execute([
               ":nome"             => $nomeObra,
               ":cpf_cnpj_cliente" => $cpfCnpjCliente,
               ":id_cidade"        => $idCidadeObra,
               ":rua"              => $ruaObra,
               ":numObra"          => $numObra,
               ":porcentagem"      => $porcentagem,
               ":id"               => $idObra
            ]);

            if($query) {
               header("location:".BASE_URL."pages/front/listas/lista_obras.php");
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
                                       cidade
                                   ) VALUES(
                                       :cidade
                                   )");

            $query->execute([
               ":cidade" => $cidadeObra
            ]);

            if($query) {

               $cidadeCadastrada = selecionaPorKey(
                  $conn,
                  'cidades',
                  'cidade',
                  trim(ucfirst(strtolower($cidadeObra)))
               );

               $query = $conn->prepare("UPDATE obras o
                                     SET
                                       nome             = :nome,
                                       cpf_cnpj_cliente = :cpf_cnpj_cliente,
                                       id_cidade        = :id_cidade,
                                       rua              = :rua,
                                       numObra          = :numObra
                                     WHERE o.id         = :id");

               $query->execute([
                  ":nome"             => $nomeObra,
                  ":cpf_cnpj_cliente" => $cpfCnpjCliente,
                  ":id_cidade"        => $cidadeCadastrada['id'],
                  ":rua"              => $ruaObra,
                  ":numObra"          => $numObra,
                  ":id"               => $idObra
               ]);

               if($query) {
                  header("location:".BASE_URL."pages/front/listas/lista_obras.php");
                  exit();
               }
            } else {
               echo 'Não foi possível cadastrar a cidade';
            }

         } catch (PDOException $erro) {
            echo "Não foi possível cadastrar a obra";
            exit();
         }

      }
   }
?>