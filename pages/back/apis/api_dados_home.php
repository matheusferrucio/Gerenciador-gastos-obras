<?php
   /*
   |  Essa api basicamente seleciona os dados necessários para alimentar o dashboard com as informações necessárias
   |  para as devidas análises.
   |  
   |  Para isso, ela executa as seguintes ações:
   |  -> Recupera os filtros selecionados passados pela URL
   |  -> Monta um array para as condições SQL e um array com os valores para preencher as condições no execute
   |  -> Monta uma cláusula WHERE especial com base nos filtros selecionados
   |  -> Executa requisições diferentes para selecionar os dados para alimentar os cards de resumo, o gráfico de coluna, a tabela e o gráfico de rosca
   |  -> Organiza os dados recuperados em vários arrays separados e depois une todos em um único array que retorna todos os dados juntos(mas devidamente separados segundo suas responsabilidades)
   */

   header("Content-type: application/json");

   require_once __DIR__."/../../conexao/connection.php";

   // Valida se o valor do filtro foi setado, se é numérico ou se é igual a 'todos'
   $filtro_mes = isset($_GET['mes']) && (is_numeric($_GET['mes'])) || $_GET['mes'] === "todos" ? $_GET['mes'] : date('m');
   $filtro_ano = isset($_GET['ano']) && (is_numeric($_GET['ano'])) ? $_GET['ano'] : date('Y');

   $condicoes = [];
   $params = [];

   if($filtro_mes !== "todos") {
      $condicoes[] = "MONTH(g.data_gasto) = :mes";
      $params[":mes"] = $filtro_mes;
   }

   $condicoes[] = "YEAR(g.data_gasto) = :ano";
   $params[":ano"] = $filtro_ano;

   $where = "WHERE " . implode(" AND ", $condicoes);

   try {
      /* 
         Query que seleciona o total das comissões, o total dos gastos das obras, q quantidade de obras ativas e a média por obra
         com base no mês e ano selecionado.

         Obs: Estou utilizando LEFT JOIN para que todas as obras sejam incluídas na contagem independentemente se possuem
         gastos cadastrados ou não.
      */
      $stmtCards = $conn->prepare("SELECT
                                    SUM(g.valor_gasto * (o.porcentagem_cobranca / 100)) AS total_comissao_obras,
                                    SUM(g.valor_gasto) AS total_gastos_obras,
                                    COUNT(DISTINCT o.id) AS qtd_total_obras,
                                    SUM(g.valor_gasto * (o.porcentagem_cobranca / 100)) / COUNT(DISTINCT o.id) AS ticket_medio_obra
                                    FROM obras o
                                    LEFT JOIN gastosobras g
                                    ON o.id = g.id_obra
                                    $where");

      $stmtCards->execute($params);

      /*
         Seleciona a soma dos gastos, agrupa por obra e organiza de forma crescente
      */
      $stmtGraficoColuna = $conn->prepare("SELECT
                                             SUM(g.valor_gasto) AS soma_gastos_obra,
                                             o.nome AS nome_obra
                                           FROM gastosobras g
                                           INNER JOIN obras o
                                           ON g.id_obra = o.id
                                           $where
                                           GROUP BY o.nome
                                           ORDER BY o.nome ASC");

      $stmtGraficoColuna->execute($params);

      /* 
         Essa query pega o total de gastos por obra, a porcentagem de administração/comissão cobrada
         e a comissão que vamos ganhar por obra.
      */
      $stmtTabela = $conn->prepare("SELECT
                                       o.nome AS nome_obra,
                                       SUM(g.valor_gasto) AS total_obra,
                                       SUM(g.valor_gasto * (o.porcentagem_cobranca / 100)) AS comissao_obra,
                                       o.porcentagem_cobranca AS porcentagem
                                    FROM obras o
                                    INNER JOIN gastosobras g
                                    ON o.id = g.id_obra
                                    $where
                                    GROUP BY o.nome
                                    ORDER BY o.nome ASC");

      $stmtTabela->execute($params);

      /*
         Seleciona as comissões por obra e ordena na forma crescente
      */
      $stmtGraficoRosca = $conn->prepare("SELECT
                                             o.nome AS nome_obra,
                                             SUM(g.valor_gasto * (o.porcentagem_cobranca / 100)) AS comissao_obra
                                          FROM obras o
                                          INNER JOIN gastosobras g
                                          ON o.id = g.id_obra
                                          $where
                                          GROUP BY o.nome
                                          ORDER BY o.nome ASC");

      $stmtGraficoRosca->execute($params);
      
      /*
         Essa sessão é responsável por organizar os dados recuperados de maneira que garanta
         uma resposta organizada e adequada para o tratamento no arquivo javascript
      */
      $dadosCards = $stmtCards->fetch(PDO::FETCH_ASSOC);

      $dadosTabela = $stmtTabela->fetchAll(PDO::FETCH_ASSOC);

      // Lista dos dados para alimentar os gráficos
      $listaDadosGraficoColuna = $stmtGraficoColuna->fetchAll(PDO::FETCH_ASSOC);
      $listaDadosGraficoRosca = $stmtGraficoRosca->fetchAll(PDO::FETCH_ASSOC);

      // Arrays para organizar os dados dos gráficos recuperados do banco
      $labels = [];
      $valores = [];

      // Monta o array com os dados para alimentar o gráfico de COLUNAS
      foreach($listaDadosGraficoColuna as $value) {
         $labels[] = $value['nome_obra'];
         $valores[] = $value['soma_gastos_obra'];
      }

      $dadosGraficoColuna = [
         'labels' => array_values($labels),
         'values' => array_values($valores)
      ];

      // Reseta os valores desses arrays para reutiliza-los no próximo foreach
      $labels = [];
      $valores = [];

      // Monta o array com os dados para alimentar o gráfico de ROCA
      foreach($listaDadosGraficoRosca as $value) {
         $labels[] = $value['nome_obra'];
         $valores[] = $value['comissao_obra'];
      }

      $dadosGraficoRosca = [
         'labels' => array_values($labels),
         'values' => array_values($valores)
      ];

      /*
         Estou unindo todos os arrays de dados em um único array para retorna-lo como um arquivo json,
         assim meu arquivo javascript terá acesso a todos os dados necessários de uma vez
      */
      $dados = [
         "resumo" => $dadosCards,
         "grafico_colunas" => $dadosGraficoColuna,
         "tabela" => $dadosTabela,
         "grafico_rosca" => $dadosGraficoRosca
      ];
      
      echo json_encode($dados);

   } catch(PDOException $erro) {
      http_response_code(500);
      echo json_encode([
         "erro" => true,
         "mensagem" => "Não foi possível recuperar os dados"
      ]);
   }
?>