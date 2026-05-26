<?php
   require_once(__DIR__."/../../back/config.php");

   require_once(__DIR__."/../../back/_session.php");

   $nomePagina = isset($_GET['nomePag']) ? $_GET['nomePag'] : "Cadastrar fornecedor";
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
      <title><?= $nomePagina; ?></title>
</head>
<body>
      <?php require_once(__DIR__."/../menu.php"); ?>
      
      <div class="container">
         <div class="card_formulario">
               <div class="row rowTitulo">
                  <h1>Cadastrar fornecedor</h1>
               </div>

               <form action="<?= BASE_URL; ?>pages/back/cadastros/cadastrar_fornecedordb.php" method="POST">
                  <div class="row">
                     <div class="particao">
                        <label for="cpfCnpjFornecedor">Digite o CPF/CNPJ do fornecedor</label>
                        <input type="text" name="cpfCnpjFornecedor" id="cpfCnpjFornecedor" placeholder="Ex: 00.111.222/0001-33" maxlength="14" minlength="11" required>
                     </div>

                     <div class="particao">
                        <label for="nomeFornecedor">Digite o nome do fornecedor</label>
                        <input type="text" name="nomeFornecedor" id="nomeFornecedor" placeholder="Ex: Matheus da Cruz Ferrucio" required>
                     </div>

                     <div class="particao">
                        <label for="telefoneFornecedor">Digite telefone do fornecedor</label>
                        <input type="text" name="telefoneFornecedor" id="telefoneFornecedor" placeholder="Ex: (18) 99999-9999" required>
                     </div>
                  </div>

                  <div class="row rowBtn">
                     <a href="<?= BASE_URL; ?>pages/front/listas/lista_fornecedores.php" class="btn voltar">Voltar</a>
                     <input type="submit" value="Cadastrar">
                  </div>
               </form>
            </div>
      </div>
</body>
</html>