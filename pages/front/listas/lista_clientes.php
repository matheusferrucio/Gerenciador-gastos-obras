<?php
   require_once(__DIR__."/../../back/config.php");

   require_once(__DIR__."/../../back/_session.php");

   require_once(__DIR__."/../../back/listas/lista_clientesdb.php");

   $nomePagina = isset($_GET['nomePag']) ? $_GET['nomePag'] : "Clientes";
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
      
      <div class="container container_lista">
         <div class="row rowTitulo">
            <h1><i class='bx bx-male icon_titulo'></i> Lista dos clientes cadastrados</h1>

            <nav>
               <a href="<?= BASE_URL; ?>pages/front/cadastros/cadastrar_clientes.php" class="btn nav">Cadastrar cliente</a>
            </nav>
         </div>

         <div class="row lista">
            <table class="tabela_gastos_obras">
               <tr class="linha_cabecalho">
                  <th class="f1">CPF/CNPJ</th>
                  <th class="f2">Nome</th>
                  <th class="f-6">Tipo cliente</th>
                  <th class="f-5 celula_botoes_acoes">Ações</th>
               </tr>
               
               <?php
                  foreach($clientes as $linha) {
               ?>
               
               <tr>
                  <td class="f1">
                     <p class=""><?= $linha['cpf_cnpj']; ?></p>
                  </td>

                  <td class="f2">
                     <?= $linha['nome']; ?>
                  </td>

                  <td class="f-6">
                     <?= strtoupper($linha['tipo_cliente']); ?>
                  </td>

                  <td class="f-5 celula_botoes_acoes">
                     <a href="<?= BASE_URL; ?>pages/front/edits/editar_gasto_obra.php?id=<?= $linha['cpf_cnpj']; ?>" class="btn editar">
                        <i class='bx bx-edit'></i>
                     </a>
                     <a
                        href="<?= BASE_URL; ?>pages/back/excluir/excluir_gasto_obradb.php?id=<?= $linha['cpf_cnpj']; ?>" 
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