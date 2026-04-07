<?php
   require_once(__DIR__."/../../back/config.php");

   require_once(__DIR__."/../../back/_session.php");

   require_once(__DIR__."/../../back/utils.php");

   require_once(__DIR__."/../../conexao/connection.php");   

   require_once(__DIR__."/../../back/views/view_gasto_obradb.php");

   $listaObras = selecionaTodos(
      $conn,
      'obras',
      'nome'
   );

   // Formata a string de data recuperada pelo banco em um objeto timestamp aceito pelo HTML
   $dataFormatada = date('Y-m-d', strtotime($dados['data_gasto']));

   $nomePagina = isset($_GET['nomePag']) ? $_GET['nomePag'] : "Editar gasto obra";
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
                  <h1>Cadastrar obra</h1>
               </div>

               <form action="<?= BASE_URL; ?>pages/back/edits/editar_gastos_obrasdb.php" method="POST">
                  <input type="hidden" name="id" id="id" value="<?= $dados['id']; ?>">
                  
                  <div class="row">
                     <div class="particao">
                        <label for="obraGasto">Escolha a obra</label>
                        
                         <select 
                           name="obraGasto" 
                           id="obraGasto" 
                           value="<?= $dados['nomeObra']; ?>"
                           required>
                           <?php
                              foreach($listaObras as $lista) {
                           ?>

                           <option value="<?= $lista['id']; ?>" 
                              <?php
                                 // Criei esse if para que o valor padrão do select
                                 // no formulário de edição seja o mesmo valor guardado
                                 // no banco
                                 if($lista['nome'] == $dados['nomeObra']) {
                                    echo 'selected';
                                 }
                              ?>
                           ><?= $lista['nome']; ?></option>

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
                        <label for="dataGasto">Data gasto</label>
                        <input 
                           type="date" 
                           name="dataGasto" 
                           id="dataGasto" 
                           value="<?= $dataFormatada; ?>"
                           required>
                     </div>
                  </div>

                  <div class="row">
                     <div class="particao">
                        <label for="descricaoGasto">Descrição do valor gasto</label>
                        <input 
                           type="text" 
                           name="descricaoGasto" 
                           id="descricaoGasto" 
                           placeholder="Ex: referente a valor gasto com estrutura metálica" 
                           value="<?= $dados['descricao']; ?>"
                           required>
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