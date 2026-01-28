<?php
   class Obra {
      private $conn;

      public function __construct($conn) {
         $this->$conn = $conn;
      }

      public function cadastrar($cpf_cnpj_cliente, $nomeObra, $id_cidade, $rua, $numObra) {
         $query = $this->$conn->prepare("INSERT INTO obras (
                     nome,
                     cpf_cnpj_cliente,
                     id_cidade,
                     rua,
                     numObra
                  ) VALUES (
                     :nome,
                     :cpf_cnpj,
                     :id_cidade,
                     :rua,
                     :numObra
                  )");

         $query->execute([
            ":nome"        => $nomeObra,
            ":cpf_cnpj"    => $cpf_cnpj_cliente,
            ":id_cidade"   => $id_cidade,
            ":rua"         => $rua,
            ":numObra"     => $numObra
         ]);

         if ($dados) {
            header("location:".__DIR__."/../../front/home.php");
            exit();
         }
      }

      public function buscarPorId($idObra) {
         $query = $this->$conn->prepare("SELECT * FROM obras
                                         WHERE obras.id = :id");
                              
         $query->execute([
            ":id" => $idObra
         ]);

         $dados = $query->fetch(PDO::FETCH_ASSOC);

         if ($dados) {
            return $dados;
         }
      }

      public function atualizar($idObra, $cpf_cnpj_cliente, $nomeObra, $id_cidade, $rua, $numObra) {
         $query = $this->$conn->prepare("UPDATE obras
                                         SET nome = :nome,
                                             cpf_cnpj_cliente = :cpf_cnpj,
                                             id_cidade = :id_cidade,
                                             rua = :rua,
                                             numObra = :numObra
                                       ");
                           
         $query->execute([
            ":nome"        => $nomeObra,
            ":cpf_cnpj"    => $cpf_cnpj_cliente,
            ":id_cidade"   => $id_cidade,
            ":rua"         => $rua,
            ":numObra"     => $numObra
         ]);

         if ($query) {
            header("location:".__DIR__."/");
            exit();
         }
      }
   }
?>