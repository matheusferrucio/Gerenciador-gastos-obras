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
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
      <title>Cadastre-se</title>
      <style>
            body {
                  padding: 0 !important;
            }
      </style>
</head>
<body>
      <div class="container">
            <div class="card_formulario">
                  <h1>Cadastre-se</h1>

                  <form action="<?= BASE_URL; ?>pages/back/cadastros/cadastrardb.php" method="POST">
                        <div class="row">
                              <!-- <label for="nomeUsuario">Digite seu nome abaixo</label> -->
                              <div class="input_wrap">
                                    <span><i class='bx bx-user'></i></span>
                                    <input type="text" name="nomeUsuario" id="nomeUsuario" placeholder="Digite seu nome aqui" required>
                              </div>
                        </div>

                        <div class="row">
                              <!-- <label for="cpfUsuario">Digite seu cpf abaixo</label> -->
                              <div class="input_wrap">
                                    <span><i class='bx bxs-user-badge'></i></span>
                                    <input type="text" name="cpfUsuario" id="cpfUsuario" placeholder="Digite seu CPF aqui" maxlength="11" required>
                              </div>
                        </div>

                        <div class="row">
                              <!-- <label for="senhaUser">Digite sua senha</label> -->
                              <div class="input_wrap">
                                    <span><i class='bx bxs-lock' ></i></span>
                                    <input type="password" name="senhaUsuario" id="senhaUser" placeholder="Crie sua senha de acesso aqui" required>
                              </div>
                        </div>

                        <div class="row">
                              <button type="submit">Cadastrar</button>
                        </div>

                        <div class="row">
                              <p>Já possui conta? <a href="<?= BASE_URL; ?>">Entre aqui</a></p>
                        </div>
                  </form>
            </div>
      </div>
</body>
</html>