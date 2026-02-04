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
               <tr>
                  <th class="celula_info_obra">Obra</th>
                  <th class="celula_info_cliente">Cliente</th>
                  <th class="celula_valor_gasto">Valor gasto</th>
                  <th class="celula_mes_gasto">Mês</th>
                  <th class="celula_descricao_gasto">Descrição</th>
                  <th class="celula_botoes_acoes">Ações</th>
               </tr>

               <tr>
                  <td class="celula_info_obra">
                     <p class="">Nome da obra</p>
                  </td>
                  <td class="celula_info_cliente">Informações do cliente</td>
                  <td class="celula_valor_gasto valor_gasto">R$ 50.000,00</td>
                  <td class="celula_mes_gasto">Jan</td>
                  <td class="celula_descricao_gasto">Descrição do valor gasto para identificação</td>
                  <td class="celula_botoes_acoes">
                     <a href="<?= BASE_URL; ?>pages/front/edits/editar_obra.php?id=" class="btn editar">
                        <i class='bx bx-edit'></i>
                     </a>
                     <a
                        href="<?= BASE_URL; ?>pages/back/excluir/excluir_obradb.php?id=" 
                        class="btn excluir"
                        onclick="confirmarExclusao(event, '<?= $linha['nomeObra']; ?>')">
                        <i class='bx bx-message-alt-x'></i>
                     </a>
                  </td>
               </tr>
            </table>



            <!-- <div class="card card_gasto">
               <div class="particao particao_icon">
                  <i class='bx bx-check-circle'></i>
               </div>

               <div class="particao">

               </div>

               <div class="particao_btns_acao">
                     <a href="<?= BASE_URL; ?>pages/front/edits/editar_obra.php?id=" class="btn editar">
                        <i class='bx bx-edit'></i>
                        Editar
                     </a>
                     <a
                        href="<?= BASE_URL; ?>pages/back/excluir/excluir_obradb.php?id=" 
                        class="btn excluir"
                        onclick="confirmarExclusao(event, '<?= $linha['nomeObra']; ?>')">
                        <i class='bx bx-message-alt-x'></i>
                        Excluir
                     </a>
                  </div>
            </div> -->
         </div>
      </div>
</body>
</html>