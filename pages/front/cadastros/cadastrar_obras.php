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
      <title>Cadastrar obras</title>
</head>
<body>
      <?php require_once(__DIR__."/../menu.php"); ?>
      
      <div class="container">
         <div class="card_formulario">
               <div class="row rowTitulo">
                  <h1>Cadastrar obra</h1>
               </div>

               <form action="<?= BASE_URL; ?>pages/back/cadastros/cadastrar_clientesdb.php" method="POST">
                  <div class="row">
                     <div class="particao">
                        <label for="nomeObra">Digite o nome da obra(algo para identifica-la)</label>
                        <input type="text" name="nomeObra" id="nomeObra" placeholder="Ex: Barracão três lagoas" required>
                     </div>   

                     <div class="particao">
                        <label for="cpfCnpjCliente">Digite o CPF/CNPJ do cliente</label>
                        <input type="text" name="cpfCnpjCliente" id="cpfCnpjCliente" placeholder="Ex: 11222333000144" required>
                     </div>
                  </div>
                  
                  <div class="row">
                     <div class="particao">
                        <label for="cidadeObra">Digite a cidade</label>
                        <input type="text" name="cidadeObra" id="cidadeObra" placeholder="Ex: Matheus da Cruz Ferrucio" required>
                     </div>
                     
                     <div class="particao">
                        <label for="ruaObra">Digite a rua</label>
                        <input type="text" name="ruaObra" id="ruaObra" placeholder="Ex: Matheus da Cruz Ferrucio" required>
                     </div>
                     
                     <div class="particao">
                        <label for="ruaObra">Digite a rua</label>
                        <input type="text" name="ruaObra" id="ruaObra" placeholder="Ex: Matheus da Cruz Ferrucio" required>
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