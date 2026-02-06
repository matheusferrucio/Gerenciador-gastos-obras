<?php
   require_once(__DIR__."/../../back/config.php");

   require_once(__DIR__."/../../back/_session.php");

   require_once(__DIR__."/../../back/listas/lista_gastos_obrasdb.php");

   require_once(__DIR__."/../../back/utils.php");

   $meses = retornaMeses();

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
            <table class="tabela_gastos_obras">
               <tr class="linha_cabecalho">
                  <th class="celula_info_obra">Obra</th>
                  <th class="celula_info_cliente">Cliente</th>
                  <th class="celula_valor_gasto">Valor gasto</th>
                  <th class="celula_mes_gasto">Mês</th>
                  <th class="celula_descricao_gasto">Descrição</th>
                  <th class="celula_botoes_acoes">Ações</th>
               </tr>

               <?php
                  foreach($dados as $linha) {
                     // criei essa variável para pegar a string contendo o número do mês retornado pelo baco
                     // e assim exibir o nome do mês abreviado passando esse número como chave do array de meses
                     $numMesGasto = date('m', strtotime($linha['data_gasto']));
               ?>
               
               <tr>
                  <td class="celula_info_obra">
                     <p class=""><?= $linha['nomeObra']; ?></p>
                  </td>
                  <td class="celula_info_cliente"><?= $linha['nomeCliente']; ?></td>
                  <td class="celula_valor_gasto valor_gasto">R$ <?= number_format($linha['valor_gasto'], 2, ',', '.'); ?></td>
                  <td class="celula_mes_gasto"><?= $meses[$numMesGasto]; ?></td>
                  <td class="celula_descricao_gasto"><?= $linha['descricao']; ?></td>
                  <td class="celula_botoes_acoes">
                     <a href="<?= BASE_URL; ?>pages/front/edits/editar_gasto_obra.php?id=<?= $linha['id']; ?>" class="btn editar">
                        <i class='bx bx-edit'></i>
                     </a>
                     <a
                        href="<?= BASE_URL; ?>pages/back/excluir/excluir_gasto_obradb.php?id=<?= $linha['id']; ?>" 
                        class="btn excluir"
                        onclick="confirmarExclusao(event, '')">
                        <i class='bx bx-message-alt-x'></i>
                     </a>
                  </td>
               </tr>

               <?php
                  }
               ?>
            </table>
         </div>
      </div>
</body>
</html>