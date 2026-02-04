<?php
   require_once(__DIR__."/../../back/config.php");

   require_once(__DIR__."/../../back/_session.php");

   require_once(__DIR__."/../../back/listas/lista_obrasdb.php");

   $nomePagina = isset($_GET['nomePag']) ? $_GET['nomePag'] : "Obras";
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
      <title><?= $nomePagina; ?></title>
</head>
<body>
      <?php require_once(__DIR__."/../menu.php"); ?>
      
      <div class="container container_lista">
         <div class="row rowTitulo">
            <h1>Lista das obras cadastradas</h1>

            <nav>
               <a href="<?= BASE_URL; ?>pages/front/cadastros/cadastrar_obras.php" class="btn nav">Cadastrar obra</a>
            </nav>
         </div>

         <div class="row lista">

            <?php
               foreach($obras as $linha) {
            ?>

               <div class="card">
                  <div class="particao_info">
                     <div class="row">
                        <h2 class="titulo_card_lista"><?= $linha['nomeObra']; ?></h2>
                     </div>

                     <div class="row">
                        <div class="particao">
                           <p class="texto_card_lista"><span class="bold">Rua:</span> <?= $linha['rua']; ?></p>
                           <p class="texto_card_lista"><span class="bold">Número:</span> <?= $linha['numObra']; ?></p>
                        </div>
                        
                        <div class="particao">
                           <p class="texto_card_lista"><span class="bold">Cliente:</span> <?= $linha['nomeCliente']; ?></p>
                           <p class="texto_card_lista endereco_obra"><span class="bold">CPF/CNPJ do cliente:</span> <?= $linha['cpf_cnpj']; ?></p>
                        </div>
                     </div>
                  </div>

                  <div class="particao_btns_acao">
                     <a href="<?= BASE_URL; ?>pages/front/edits/editar_obra.php?id=<?= $linha['id']; ?>" class="btn editar">Editar</a>
                     <a
                        href="<?= BASE_URL; ?>pages/back/excluir/excluir_obradb.php?id=<?= $linha['id']; ?>" 
                        class="btn excluir"
                        onclick="confirmarExclusao(event, '<?= $linha['nomeObra']; ?>')">
                        Excluir
                     </a>
                  </div>
               </div>

            <?php
               }
            ?>
         </div>
      </div>
</body>
</html>