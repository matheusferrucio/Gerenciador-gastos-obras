<?php
   require_once(__DIR__."/../../back/config.php");

   require_once(__DIR__."/../../back/_session.php");

   require_once(__DIR__."/../../back/utils.php");

   require_once(__DIR__."/../../conexao/connection.php");   

   $listaObras = selecionaTodos(
      $conn,
      'obras',
      'nome'
   );

   $nomePagina = isset($_GET['nomePag']) ? $_GET['nomePag'] : "Cadastrar gastos obra";

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
      <script src="<?= BASE_URL; ?>js/formatacao_input.js" defer></script>
      <title><?= $nomePagina; ?></title>
</head>
<body>
      <?php require_once(__DIR__."/../menu.php"); ?>
      
      <div class="container">
         <div class="card_formulario">
               <div class="row rowTitulo">
                  <h1>Cadastrar gasto de obra</h1>
               </div>

               <form action="<?= BASE_URL; ?>pages/back/cadastros/cadastrar_gastos_obrasdb.php" method="POST" class="form_cadastro">
                  <div class="row">
                     <div class="particao">
                        <label for="obraGasto">Escolha a obra</label>
                        
                         <select name="obraGasto" id="obraGasto" required>
                           <?php
                              foreach($listaObras as $lista) {
                           ?>

                           <option value="<?= $lista['id']; ?>"><?= $lista['nome']; ?></option>

                           <?php
                              }
                           ?>
                         </select>
                     </div>   

                     <div class="particao">
                        <label for="gastoObra">Digite o valor gasto</label>
                        <div class="input_wrap">
                           <span class="currency_prefix">R$</span>
                           <input 
                              type="text" 
                              id="valor" 
                              name="gastoObra" 
                              placeholder="0,00" 
                              inputmode="numeric"
                              autocomplete="off"
                              maxlength="22"
                              required>
                        </div>

                        <input type="hidden" name="valor" id="valor_numerico">
                     </div>
                     
                     <div class="particao">
                        <label for="dataGasto">Mês gasto</label>
                        <input type="date" name="dataGasto" id="dataGasto" required>
                     </div>
                  </div>

                  <div class="row">
                     <div class="particao">
                        <label for="descricaoGasto">Descrição do valor gasto</label>
                        <input type="text" name="descricaoGasto" id="descricaoGasto" placeholder="Ex: referente a valor gasto com estrutura metálica" required>
                     </div>
                  </div>

                  <div class="row rowBtn">
                     <a href="<?= BASE_URL; ?>pages/front/listas/lista_gastos_obras.php" class="btn voltar">Voltar</a>
                     <input type="submit" value="Cadastrar">
                  </div>
               </form>
            </div>
      </div>
</body>
</html>