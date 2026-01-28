<?php
      session_start();

      require_once(__DIR__."/pages/back/config.php");

      if(isset($_SESSION['usuario'])) {
            header("location:".BASE_URL."pages/front/home.php");
            exit();
      }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="favicon" type="image/x-icon" href="<?= BASE_URL; ?>assets/images/icons8-hard-hat-32.png">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/reset.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/style.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/forms.css">
      <title>Fazer Login</title>
</head>
<body>
      <div class="container">
            <div class="card_formulario">
                  <h1>Entre na sua conta</h1>

                  <form action="<?= BASE_URL; ?>pages/back/logindb.php" method="POST">
                        <div class="row">
                              <label for="cpfUsuario">Digite seu cpf abaixo</label>
                              <input type="text" name="cpfUsuario" id="cpfUsuario" placeholder="Ex: 111.222-33" maxlength="11" required>
                        </div>

                        <div class="row">
                              <label for="senhaUsuario">Digite sua senha</label>
                              <input type="password" name="senhaUsuario" id="senhaUsuario" required>
                        </div>

                        <div class="row">
                              <input type="submit" value="Entrar">
                        </div>

                        <div class="row">
                              <p>Ainda não tem conta? <a href="<?= BASE_URL; ?>pages/front/cadastros/cadastrar.php">Cadastre-se aqui</a></p>
                        </div>
                  </form>
            </div>
      </div>
</body>
</html>