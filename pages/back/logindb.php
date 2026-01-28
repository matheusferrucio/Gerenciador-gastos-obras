<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $cpfUsuario = filter_input(INPUT_POST, 'cpfUsuario', FILTER_SANITIZE_SPECIAL_CHARS);
      $senhaUsuario = trim($_POST['senhaUsuario']);
      
      try {
         require_once(__DIR__."/../conexao/connection.php");
         
         require_once(__DIR__."/config.php");

         $query = $conn->prepare("SELECT * FROM usuarios WHERE cpf = :cpf");
   
         $query->execute([
            ":cpf" => $cpfUsuario
         ]);
   
         if($query) {
            $linha = $query->fetch(PDO::FETCH_ASSOC);
            
            // Estava dando erro porque meu campo senha no banco de dados estava de um tamanho menor do que o mínimo
            // que a função de hash exige, que é 60 caracteres
            if(password_verify($senhaUsuario, $linha['senha'])) {

               session_start();
               
               $_SESSION['usuario'] = $cpfUsuario;
               $_SESSION['nome'] = $linha['nome'];
               
               header("location:".BASE_URL."pages/front/home.php");
               exit();
   
            }
         }

      } catch (PDOException $erro){
         echo "Não foi possível realizar login";
         exit();
      }

   }
?>