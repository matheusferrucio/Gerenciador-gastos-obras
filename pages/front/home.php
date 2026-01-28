<?php
   require_once(__DIR__."/../back/config.php");

   require_once(__DIR__."/../back/_session.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/reset.css">
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/style.css">
      <title>Página de início</title>
</head>
<body>
      <?php require_once(__DIR__."/menu.php"); ?>
      
      <div class="container">
            <h1>Olá, <?= $_SESSION['nome']; ?></h1>
      </div>
</body>
</html>