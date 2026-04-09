<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
      require_once(__DIR__."/../conexao/connection.php");
         
      require_once(__DIR__."/config.php");
      
      try {

         $cpfUsuario = filter_input(INPUT_POST, 'hidden_cpf_cnpj', FILTER_SANITIZE_SPECIAL_CHARS);
         $senhaUsuario = trim($_POST['senhaUsuario']);

         if(empty($cpfUsuario) || !filter_var($cpfUsuario, FILTER_VALIDATE_INT) || empty($senhaUsuario)) {
            throw new Exception("Preencha todos os campos para realizar login");
         }

         $query = $conn->prepare("SELECT * FROM usuarios WHERE cpf = :cpf");
   
         $query->execute([
            ":cpf" => $cpfUsuario
         ]);

         if (!$query) {
            throw new Exception("Erro ao executar consulta");
         }
   
         $linha = $query->fetch(PDO::FETCH_ASSOC);

         if (!$linha || password_verify($senhaUsuario, $linha['senha']) === false) {
            throw new Exception("Usuário não encontrado");
         }

         session_start();
         
         $_SESSION['usuario'] = $cpfUsuario;
         $_SESSION['nome'] = $linha['nome'];
         
         header("location:".BASE_URL."pages/front/home.php");
         exit();

      } catch (Exception $erro){
         echo $erro->getMessage();
         die();
      }

   }
?>