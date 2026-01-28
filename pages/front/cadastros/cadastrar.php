<?php
      require_once(__DIR__."/../../back/config.php");

      session_start();

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
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/reset.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/style.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/forms.css">
      <title>Cadastre-se</title>
</head>
<body>
      <div class="container">
            <div class="card_formulario">
                  <h1>Cadastre-se</h1>

                  <form action="<?= BASE_URL; ?>pages/back/cadastros/cadastrardb.php" method="POST">
                        <div class="row">
                              <label for="nomeUsuario">Digite seu nome abaixo</label>
                              <input type="text" name="nomeUsuario" id="nomeUsuario" placeholder="Ex: Matheus da Cruz Ferrucio" required>
                        </div>

                        <div class="row">
                              <label for="cpfUsuario">Digite seu cpf abaixo</label>
                              <input type="text" name="cpfUsuario" id="cpfUsuario" placeholder="Ex: 111.222-33" maxlength="11" required>
                        </div>

                        <div class="row">
                              <label for="senhaUser">Digite sua senha</label>
                              <input type="password" name="senhaUsuario" id="senhaUser" required>
                        </div>

                        <div class="row">
                              <input type="submit" value="Cadastrar">
                        </div>

                        <div class="row">
                              <p>Já possui conta? <a href="<?= BASE_URL; ?>">Entre aqui</a></p>
                        </div>
                  </form>
            </div>
      </div>
</body>
</html>