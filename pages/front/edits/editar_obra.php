<?php
   require_once(__DIR__."/../../back/config.php");

   require_once(__DIR__."/../../back/_session.php");

   require_once(__DIR__."/../../back/views/view_obradb.php");

   require_once(__DIR__."/../../back/utils.php");

   require_once(__DIR__."/../../conexao/connection.php");

   $listaClientes = selecionaTodos(
      $conn,
      'clientes',
      'nome'
   );

   $nomePagina = isset($_GET['nomePag']) ? $_GET['nomePag'] : "Editar obras";
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
                  <h1>Cadastrar obra</h1>
               </div>

               <form action="<?= BASE_URL; ?>pages/back/edits/editar_obradb.php" method="POST">
                  <input 
                     type="hidden" 
                     name="id" 
                     value="<?= $dados['id']; ?>">
                  
                  <div class="row">
                     <div class="particao">
                        <label for="nomeObra">Digite o nome da obra(algo para identifica-la)</label>
                        <input 
                           type="text" 
                           name="nomeObra" 
                           id="nomeObra" 
                           placeholder="Ex: Barracão três lagoas"
                           value="<?= $dados['nomeObra']; ?>"
                           required>
                     </div>   

                     <div class="particao">
                        <label for="clienteObra">Escolha o cliente dono da obra</label>
                        
                         <select 
                           name="clienteObra" 
                           id="clienteObra" 
                           value="<?= $dados['nomeCliente']; ?>">

                           <?php
                              foreach($listaClientes as $lista) {
                           ?>

                           <option value="<?= $lista['cpf_cnpj']; ?>"><?= $lista['nome']; ?></option>

                           <?php
                              }
                           ?>
                         </select>
                     </div>
                  </div>
                  
                  <div class="row">
                     <div class="particao">
                        <label for="cidadeObra">Digite a cidade</label>
                        <input 
                           type="text" 
                           name="cidadeObra" 
                           id="cidadeObra" 
                           placeholder="Ex: Araçatuba"
                           value="<?= ucfirst($dados['cidade']); ?>"
                           required>
                     </div>
                     
                     <div class="particao">
                        <label for="ruaObra">Digite a rua</label>
                        <input 
                           type="text" 
                           name="ruaObra" 
                           id="ruaObra" 
                           placeholder="Ex: Dr Raposo de Melo"
                           value="<?= $dados['rua']; ?>"
                           required>
                     </div>
                     
                     <div class="particao">
                        <label for="numObra">Digite o número</label>
                        <input 
                           type="text" 
                           name="numObra" 
                           id="numObra" 
                           placeholder="Ex: 101"
                           value="<?= $dados['numObra']; ?>"
                           required>
                     </div>

                     <div class="particao">
                        <label for="porcentagemCobrada">Digite a porcentagem cobrada</label>
                        <input 
                           type="text" 
                           name="porcentagemCobrada" 
                           id="porcentagemCobrada"
                           value="<?= $dados['porcentagem'] != null ? $dados['porcentagem'] : "Não atribuído"; ?>"
                           placeholder="Ex: 10%"
                           required>
                     </div>
                  </div>

                  <div class="row rowBtn">
                     <a 
                        href="<?= BASE_URL; ?>pages/front/listas/lista_obras.php" 
                        class="btn voltar">
                        Voltar
                     </a>

                     <input type="submit" value="Confirmar">
                  </div>
               </form>
            </div>
      </div>
</body>
</html>