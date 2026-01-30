<?php
   require_once(__DIR__."/../../back/config.php");

   require_once(__DIR__."/../../back/_session.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="favicon" type="image/x-icon" href="<?= BASE_URL; ?>assets/images/icons8-hard-hat-32.png">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/reset.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/style.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/formsCadastros.css">
      <title>Cadastrar clientes</title>
</head>
<body>
      <?php require_once(__DIR__."/../menu.php"); ?>
      
      <div class="container">
         <div class="card_formulario">
               <div class="row rowTitulo">
                  <h1>Cadastrar cliente</h1>
               </div>

               <form action="<?= BASE_URL; ?>pages/back/cadastros/cadastrar_clientesdb.php" method="POST">
                  <div class="row">
                     <div class="particao">
                        <label for="cpfCnpjCliente">Digite o CPF/CNPJ do cliente</label>
                        <input type="text" name="cpfCnpjCliente" id="cpfCnpjCliente" placeholder="Ex: 00.111.222/0001-33" maxlength="14" required>
                     </div>

                     <div class="particao">
                        <label for="nomeCliente">Digite o nome do cliente</label>
                        <input type="text" name="nomeCliente" id="nomeCliente" placeholder="Ex: Matheus da Cruz Ferrucio" required>
                     </div>

                     <div class="particao">
                        <label for="nomeCliente">O cliente é PF ou PJ?</label>
                        <div class="row">
                           <div class="particao inptRadio">
                              <input type="radio" name="tipoCliente" id="pf" value="pf">

                              <label for="pf">
                                 Pessoa física
                              </label>
                           </div>

                           <div class="particao inptRadio">
                              <input type="radio" name="tipoCliente" id="pj" value="pj">
                              
                              <label for="pj">
                                 Pessoa Jurídica
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row rowBtn">
                     <a href="<?= BASE_URL; ?>pages/front/listas/lista_clientes.php" class="btn voltar">Voltar</a>
                     <input type="submit" value="Cadastrar">
                  </div>
               </form>
            </div>
      </div>
</body>
</html>