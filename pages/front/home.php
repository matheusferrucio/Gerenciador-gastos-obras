<?php
   require_once(__DIR__."/../back/config.php");

   require_once(__DIR__."/../back/_session.php");

   $nomePagina = isset($_GET['nomePag']) ? $_GET['nomePag'] : "Início";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/reset.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/style.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/home.css">
      <title><?= $nomePagina; ?></title>
</head>
<body>
      <?php require_once(__DIR__."/menu.php"); ?>
      
      <div class="container dashboard">
            <div class="card">
                  <h1>Olá, <?= $_SESSION['nome']; ?></h1>
            </div>
            <div class="card">
                  <h1>Olá, <?= $_SESSION['nome']; ?></h1>
            </div>
            <div class="card">
                  <h1>Olá, <?= $_SESSION['nome']; ?></h1>
            </div>
      </div>
</body>
</html>