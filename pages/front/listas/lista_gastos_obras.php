<?php
   require_once(__DIR__."/../../back/config.php");

   require_once(__DIR__."/../../back/_session.php");

   $nomePagina = isset($_GET['nomePag']) ? $_GET['nomePag'] : "Gastos obras";
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
            <h1>Lista dos gastos das obras</h1>

            <nav>
               <a href="<?= BASE_URL; ?>pages/front/cadastros/cadastrar_gasto_obra.php" class="btn nav">Cadastrar gasto</a>
            </nav>
         </div>

         <div class="row lista">

         </div>
      </div>
</body>
</html>