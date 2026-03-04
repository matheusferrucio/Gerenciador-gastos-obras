<?php
   require_once(__DIR__."/../../back/config.php");

   require_once(__DIR__."/../../conexao/connection.php");

   require_once(__DIR__."/../../back/_session.php");

   require_once(__DIR__."/../../back/utils.php");
   
   // require_once(__DIR__."/../../back/buscar_dados.php");

   $listaObras = selecionaTodos($conn, 'obras', 'nome');

   $listaClientes = selecionaTodos($conn, 'clientes', 'nome');

   $listaMeses = retornaMeses(false);

   // echo '<pre>';
   // print_r($listaObras);
   // echo '</pre>';

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

            <div class="particao">
               <button id="btn_abrir_filtro" class="btn"><i class='bx bx-filter-alt'></i> Filtrar</button>
               
               <nav>
                  <a href="<?= BASE_URL; ?>pages/front/cadastros/cadastrar_gasto_obra.php" class="btn nav"><i class='bx bx-plus'></i> Cadastrar gasto</a>
               </nav>
            </div>

            <div class="overlay"></div>

            <div class="modal" id="modal" style="display: none;">
               <div class="conteudo_modal">
                  <div class="row">
                     <h2>Filtrar gastos</h2>
                     <button id="btn_fechar_filtro" class="btn btn_fechar"><i class='bx bx-x' ></i></button>
                  </div>

                  <div class="row">
                     <label for="filtro_obra">Por obra</label>
                     <select name="filtro_obra" id="filtro_obra">

                        <option value="" default>Todos as obras</option>
                     
                        <?php
                           foreach($listaObras as $linha) {
                        ?>
                        
                        <option value="<?= $linha['id'] ?>"><?= $linha['nome']; ?></option>
   
                        <?php
                           }
                        ?>
                     </select>
                  </div>

                  <div class="row">
                     <label for="filtro_cliente">Por cliente</label>
                     <select name="filtro_cliente" id="filtro_cliente">

                        <option value="" default>Todos os clientes</option>
                        
                        <?php
                           foreach($listaClientes as $linha) {
                        ?>
                        
                        <option value="<?= $linha['cpf_cnpj']; ?>"><?= $linha['nome']; ?></option>
   
                        <?php
                           }
                        ?>
                     </select>
                  </div>

                  <div class="row filtros_data">
                     <div class="particao f1">
                        <label for="filtro_mes">Por mês</label>
                        <select name="filtro_mes" id="filtro_mes">
                           
                           <option value="" default>Todos os meses</option>

                           <?php
                              foreach($listaMeses as $key => $value) {
                           ?>
                           
                           <option value="<?= $key; ?>"><?= $value; ?></option>
      
                           <?php
                              }
                           ?>
                        </select>
                     </div>
                           
                     <div class="particao f1">
                        <label for="filtro_ano">Por ano</label>
                        <input type="text" name="filtro_ano" id="filtro_ano" placeholder="Ex: 2025">
                     </div>
                  </div>

                  <div class="row">
                     <div class="botoes_modal">
                        <button id="btn_limpar_filtro" class="btn excluir"><i class='bx bx-brush'></i> Limpar</button>
                        <button id="btn_aplicar_filtro" class="btn"><i class='bx bx-filter-alt' ></i> Aplicar</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="row lista">
            <table class="tabela_gastos_obras">
               <thead>
                  <tr class="linha_cabecalho">
                     <th class="f2">Obra</th>
                     <th class="f2">Cliente</th>
                     <th class="f1-2">Valor gasto</th>
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