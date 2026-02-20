<?php
   require_once(__DIR__."/../../back/config.php");

   require_once(__DIR__."/../../back/_session.php");

   // require_once(__DIR__."/../../back/listas/lista_gastos_obrasdb.php");

   // require_once(__DIR__."/../../back/utils.php");

   // $meses = retornaMeses(false);

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
      <link rel="stylesheet" href="<?= BASE_URL; ?>css/table.css">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
      <script src="<?= BASE_URL; ?>js/script.js" defer></script>
      <script src="<?= BASE_URL; ?>js/paginacao.js" defer></script>
      <title><?= $nomePagina; ?></title>
</head>
<body>
      <?php require_once(__DIR__."/../menu.php"); ?>
      
      <div class="container container_lista">
         <div class="row rowTitulo">
            <h1><i class='bx bx-dollar icon_titulo'></i> Lista dos gastos das obras</h1>

            <nav>
               <a href="<?= BASE_URL; ?>pages/front/cadastros/cadastrar_gasto_obra.php" class="btn nav">Cadastrar gasto</a>
            </nav>
         </div>

         <div class="row lista">
            <table class="tabela_gastos_obras">
               <thead>
                  <tr class="linha_cabecalho">
                     <th class="f2">Obra</th>
                     <th class="f2">Cliente</th>
                     <th class="f2">Valor gasto</th>
                     <th class="f-6">Mês</th>
                     <th class="f4">Descrição</th>
                     <th class="f1 celula_botoes_acoes">Ações</th>
                  </tr>
               </thead>
               
               <tbody id="corpo-tabela"></tbody>

            </table>
         </div>

      </div>

      <div class="container">
         <div id="paginacao">
            <span id="info_pagina"></span>
            <div id="botoes_pagina"></div>
         </div>
      </div>

      <script>
         // Criei essa constante porque o php é executado antes da página ser carregada,
         // mas quando o script js injeta os dados na página, os botões de ação passam uma url
         // como uma string e o servidor barra por achar que é um ataque, por isso defini a URL
         // básica no meu documento base
         const BASE_URL = "<?= BASE_URL; ?>";
      </script>
</body>
</html>