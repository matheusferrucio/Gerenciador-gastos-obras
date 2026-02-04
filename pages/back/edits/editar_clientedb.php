<?php
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      require_once(__DIR__."/../config.php");

      require_once(__DIR__."/../../conexao/connection.php");

      $cpfCnpjClienteAntigo = filter_input(INPUT_POST, 'cpf_cnpj_antigo', FILTER_SANITIZE_SPECIAL_CHARS);
      $cpfCnpjCliente       = filter_input(INPUT_POST, 'cpfCnpjCliente', FILTER_SANITIZE_SPECIAL_CHARS);
      $nomeCliente          = filter_input(INPUT_POST, 'nomeCliente', FILTER_SANITIZE_SPECIAL_CHARS);
      $tipoCliente          = $_POST['tipoCliente'];

      // Verifica se o cpf_cnpj do cliente foi alterado ou não
      if($cpfCnpjClienteAntigo === $cpfCnpjCliente) {

         try {
            $query = $conn->prepare("UPDATE clientes
                                    SET 
                                       nome              = :nome,
                                       tipo_cliente      = :tipo_cliente
                                    WHERE 
                                       clientes.cpf_cnpj = :cpf_cnpj");

            $query->execute([
               ":nome"         => $nomeCliente,
               ":tipo_cliente" => $tipoCliente,
               ":cpf_cnpj"     => $cpfCnpjClienteAntigo
            ]);

            if($query) {
               echo 'Edição realizada com sucesso';
               
               header("location:".BASE_URL."pages/front/listas/lista_clientes.php");
               exit();
            }
         
         } catch (PDOException $erro) {
            echo $erro;
            echo "Não foi possível cadastrar cliente";
            exit();
         }

      } else {
         
         // Esse bloco de código é executado caso o cpf_cnpj for alterado
         try {
            $query = $conn->prepare("UPDATE clientes
                                    SET 
                                       cpf_cnpj     = :cpf_cnpj,
                                       nome         = :nome,
                                       tipo_cliente = :tipo_cliente
                                    WHERE
                                       cpf_cnpj     = :cpf_cnpj_key");

            $query->execute([
               ":cpf_cnpj"     => $cpfCnpjCliente,
               ":nome"         => $nomeCliente,
               ":tipo_cliente" => $tipoCliente,
               ":cpf_cnpj_key" => $cpfCnpjCliente
            ]);

            if($query) {
               echo 'Edição realizada com sucesso';
               
               header("location:".BASE_URL."pages/front/listas/lista_clientes.php");
               exit();
            }
         
         } catch (PDOException $erro) {
            echo $erro;
            echo "Não foi possível cadastrar cliente";
            exit();
         }
      }

   } else {
      echo "Não foi possível recuperar os dados";
      exit();
   }
?>