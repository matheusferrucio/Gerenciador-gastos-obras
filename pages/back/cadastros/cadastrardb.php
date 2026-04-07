<?php
   if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      throw new Exception("Método de requisição inválido");
   }

   require_once(__DIR__."/../../conexao/connection.php");

   require_once(__DIR__."/../config.php");

   try {

      $nomeUsuario  = filter_input(INPUT_POST, 'nomeUsuario', FILTER_SANITIZE_SPECIAL_CHARS);
      $cpfUsuario = filter_input(INPUT_POST, 'cpfUsuario', FILTER_SANITIZE_SPECIAL_CHARS);
      $senhaUsuario = trim($_POST['senhaUsuario']);

      if (empty($nomeUsuario) || !filter_var($nomeUsuario, FILTER_VALIDATE_STRING) || empty($cpfUsuario) || !filter_var($cpfUsuario, FILTER_VALIDATE_INT) || empty($senhaUsuario)) {
         throw new Exception("Preencha todos os campos para cadastrar usuário");
      }
      
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

      if (!$query) {
         throw new Exception("Não foi possível cadastrar usuário");
      }

      session_start();

      $_SESSION['usuario'] = $cpfUsuario;
      $_SESSION['nomeUsuario'] = $nomeUsuario;
      
      header("location:".BASE_URL."pages/front/home.php");
      exit();

   } catch (PDOException $erro) {
      echo $erro->getMessage();
      die();
   }
?>