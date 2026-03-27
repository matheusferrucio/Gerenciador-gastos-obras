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
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/table.css">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
      <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js" defer></script>
      <script src="<?= BASE_URL; ?>js/script.js" defer></script>
      <title><?= $nomePagina; ?></title>
</head>
<body>
      <?php require_once(__DIR__."/../menu.php"); ?>
      
      <div class="container container_titulo">
         <div class="row rowTitulo">
            <h1><i class='bx bx-buildings icon_titulo' ></i> Lista das obras cadastradas</h1>

            <nav>
               <a href="<?= BASE_URL; ?>pages/front/cadastros/cadastrar_obras.php" class="btn nav"><i class='bx bx-plus'></i> Cadastrar obra</a>
            </nav>
         </div>           
      </div> <!-- container -->

      <?php
         foreach($obras as $linha) {
      ?>

      <div class="container container_lista">
         <div class="row titulo_obra">
            <div class="particao">
               <h2 class="titulo_card_obra"><?= $linha['nomeObra']; ?> <span>/ <?= $linha['nomeCliente']; ?></span></h2>
            </div>

            <div class="particao">
               <a href="<?= BASE_URL; ?>pages/front/edits/editar_obra.php?id=<?= $linha['id']; ?>" class="btn editar">
                  <i class='bx bx-edit'></i> Editar
               </a>

               <a
                  href="<?= BASE_URL; ?>pages/back/excluir/excluir_obradb.php?id=<?= $linha['id']; ?>" 
                  class="btn excluir"
                  onclick="confirmarExclusao(event, '')">
                  <i class='bx bx-message-alt-x'></i> Excluir
               </a>
            </div>
         </div>
         <div class="row info_obra">
            <div class="particao">
               <h3>Endereço da obra</h3>
               <p>Rua: <span><?= $linha['rua']; ?></span></p>
               <p>Número(s): <span><?= $linha['numObra']; ?></span></p>
               <!-- <p>Cidade: <span>Cidade da obra</span></p> -->
            </div>

            <div class="particao">
               <h3>Porcentagem cobrada</h3>
               <div class="box_porcentagem">
                  <span><?= $linha['porcentagem'] != null ? $linha['porcentagem'].'%' : "0%"; ?></span>
               </div>
            </div>
         </div>
         <!-- <div class="row dados_adm_obra">
            <h3>Dados de administração da obra</h3>
            <div class="particao">
               <div class="box_dado_adm_obra"></div>
            </div>
         </div> -->
      </div>

      <?php
         }
      ?>
</body>
</html>