<?php
   require_once __DIR__."/../back/config.php";

   $title = isset($_GET['title']) ? $_GET['title'] : 'testando';

   $erro = isset($_GET['erro']) ? $_GET['erro'] : 'testando';

   $caminhoVolta = isset($_GET['caminho_volta']) ? $_GET['caminho_volta'] : '#';
?>
 
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/reset.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/style.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/home.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/error.css">
      <title><?= $title; ?></title>
   </head>
   <body>
      <div class="container">
         <div class="card">
            <h1><?= $erro ?></h1>
            <a href="<?= $caminhoVolta; ?>" class="btn">Voltar</a>
         </div>
      </div>
   </body>
</html>