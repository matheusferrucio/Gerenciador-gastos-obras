<?php
   require_once(__DIR__."/../../back/config.php");

   require_once(__DIR__."/../../back/_session.php");

   require_once(__DIR__."/../../back/listas/lista_clientesdb.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/reset.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/style.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/listas.css">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
      <script src="<?= BASE_URL; ?>js/script.js" defer></script>
      <title>Lista de obras</title>
</head>
<body>
      <?php require_once(__DIR__."/../menu.php"); ?>
      
      <div class="container container_lista">
         <div class="row rowTitulo">
            <h1>Lista das obras cadastradas</h1>
         </div>

         <div class="row">
            <nav>
               <a href="<?= BASE_URL; ?>pages/front/cadastros/cadastrar_obras.php" class="btn nav">Cadastrar obra</a>
            </nav>
         </div>

         <div class="row lista">

            <?php
               // foreach($dados as $linha) {
            ?>

               <!-- <div class="card">
                  <div class="particao_info_cliente">
                     <h3 class="titulo_card_lista"><?= $linha['nome']; ?></h3>
                     <p class="texto_card_lista"><?= $linha['cpf_cnpj']; ?></p>
                  </div>

                  <div class="particao_btns_acao">
                     <a href="<?= BASE_URL; ?>pages/front/edits/editar_cliente.php?cpfCnpj=<?= $linha['cpf_cnpj']; ?>" class="btn editar">Editar</a>
                     <a
                        href="<?= BASE_URL; ?>pages/back/excluir/excluir_cliente.php?cpfCnpj=<?= $linha['cpf_cnpj']; ?>" 
                        class="btn excluir"
                        onclick="confirmarExclusao(event, '<?= $linha['nome']; ?>')">
                        Excluir
                     </a>
                  </div>
               </div> -->

            <?php
               // }
            ?>
         </div>
      </div>
</body>
</html>