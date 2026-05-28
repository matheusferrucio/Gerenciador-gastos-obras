<?php
   require_once(__DIR__."/../../back/config.php");

   require_once(__DIR__."/../../back/_session.php");

   require_once __DIR__ . "/../../back/views/view_fornecedordb.php";
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
      <title>Editar fornecedor</title>
</head>
<body>
      <?php require_once(__DIR__."/../menu.php"); ?>
      
      <div class="container">
         <div class="card_formulario">
               <div class="row rowTitulo">
                  <h1>Editar fornecedor</h1>
               </div>

               <form action="<?= BASE_URL; ?>pages/back/edits/editar_fornecedoresdb.php" method="POST">
                  <input 
                     type="hidden" 
                     name="id-fornecedor"
                     value="<?= $dados['id_fornecedor']; ?>">
                  
                  <div class="row">
                     <div class="particao">
                        <label for="cpfCnpjCliente">Digite o CPF/CNPJ do fornecedor</label>
                        <input 
                           type="text" 
                           name="cpfCnpjCliente" 
                           id="cpfCnpjCliente" 
                           placeholder="Ex: 00.111.222/0001-33" 
                           maxlength="14" 
                           minlength="11"
                           value="<?= $dados['cpf_cnpj_fornecedor']; ?>"
                           required>
                     </div>

                     <div class="particao">
                        <label for="nomeFornecedor">Digite o nome do fornecedor</label>
                        <input 
                           type="text" 
                           name="nomeFornecedor" 
                           id="nomeFornecedor" 
                           placeholder="Digite aqui o nome do fornecedor" 
                           value="<?= $dados['nome_fornecedor']; ?>"
                           required>
                     </div>

                     <div class="particao">
                        <label for="telefoneFornecedor">Digite telefone do fornecedor</label>
                        <input 
                           type="text" 
                           name="telefoneFornecedor" 
                           id="telefoneFornecedor" 
                           placeholder="Ex: (18) 99999-9999" 
                           value="<?= $dados['telefone'] ?>"
                           required>
                     </div>

                     <div class="particao">
                        <label for="statusFornecedor">Status do Fornecedor</label>
                        <label class="switch">
                           <input 
                              type="checkbox" 
                              name="statusFornecedor" 
                              id="statusFornecedor" 
                              <?= $dados['status_fornecedor'] == "ativo" ? "checked" : ""; ?>>
                           <span class="slider round"></span>
                        </label>
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