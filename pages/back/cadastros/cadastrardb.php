<?php
   require_once(__DIR__."/../../conexao/connection.php");

   require_once(__DIR__."/../config.php");

   $nomeUsuario  = filter_input(INPUT_POST, 'nomeUsuario', FILTER_SANITIZE_SPECIAL_CHARS);
   $cpfUsuario = filter_input(INPUT_POST, 'cpfUsuario', FILTER_SANITIZE_SPECIAL_CHARS);
   $senhaUsuario = trim($_POST['senhaUsuario']);

   try {
      $query = $conn->prepare("INSERT INTO usuarios (
                                 cpf,
                                 nome,
                                 senha
                              ) VALUES (
                                 :cpf,
                                 :nome,
                                 :senha
                              )");

      $query->execute([
         ":cpf" => $cpfUsuario,
         ":nome"  => $nomeUsuario,
         ":senha" => password_hash($senhaUsuario, PASSWORD_DEFAULT)
      ]);

      if ($query) {
         session_start();

         $_SESSION['usuario'] = $cpfUsuario;
         $_SESSION['nomeUsuario'] = $nomeUsuario;
         
         header("location:".BASE_URL."pages/front/home.php");
         exit();
      }

   } catch (PDOException $erro) {
      echo "Não foi possível cadastrar usuário";
      exit();
   }
?>