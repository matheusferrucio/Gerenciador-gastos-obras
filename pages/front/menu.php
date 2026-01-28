<?php require_once(__DIR__."/../back/config.php"); ?>

<head>
   <link rel="stylesheet" href="<?= BASE_URL; ?>css/menu.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<header>
   <div class="container">
      <nav>
         <ul>
            <li class="btnMenu"><a href="<?= BASE_URL; ?>">Início</a></li>
            <li class="btnMenu"><a href="<?= BASE_URL; ?>pages/front/listas/lista_clientes.php">Clientes</a></li>
            <li class="btnMenu"><a href="<?= BASE_URL; ?>pages/front/listas/lista_obras.php">Obras</a></li>
            <li class="btnMenu"><a href="<?= BASE_URL; ?>">Cadastrar gastos obras</a></li>
         </ul>

         <ul>
            <li class="btnMenu btnSair"><a href="<?= BASE_URL; ?>pages/back/exit.php"><i class='bx bx-exit'></i> Sair</a></li>
         </ul>
      </nav>
   </div>
</header>