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
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <script src="<?= BASE_URL; ?>js/regex_input_cpfcnpj.js" defer></script>
      <title>Fazer Login</title>
      <style>
            body {
                  padding: 0 !important;
            }
      </style>
</head>
<body>
      <div class="container">
            <div class="card_formulario">
                  <h1>Entre na sua conta</h1>

                  <form action="<?= BASE_URL; ?>pages/back/logindb.php" method="POST">
                        <div class="row">
                              <div class="input_wrap">
                                    <span><i class='bx bxs-user-badge'></i></span>
                                    <input type="text" class="input_cpf_cnpj" name="cpfUsuario" id="cpfUsuario" placeholder="Digite seu CPF" maxlength="20" required>

                                    <input type="hidden" name="hidden_cpf_cnpj" class="hidden_cpf_cnpj" maxlength="14">
                              </div>
                        </div>

                        <div class="row">
                              <div class="input_wrap">
                                    <span><i class='bx bxs-lock' ></i></span>
                                    <input type="password" name="senhaUsuario" id="senhaUsuario" placeholder="Digite sua senha" required>
                              </div>
                        </div>

                        <div class="row">
                              <button type="submit">Entrar</i></button>
                        </div>

                        <div class="row">
                              <p>Ainda não tem conta? <a href="<?= BASE_URL; ?>pages/front/cadastros/cadastrar.php">Cadastre-se aqui</a></p>
                        </div>
                  </form>
            </div>
      </div>

      <script defer>
            const inputs = document.querySelectorAll("form .row .input_wrap input");

            inputs.forEach(function(el){
                  el.addEventListener('focus', function(){
                        this.parentElement.classList.add("focus");
                  });
                  
                  el.addEventListener('focusout', function(){
                        this.parentElement.classList.remove("focus");
                  });
            });
      </script>
</body>
</html>