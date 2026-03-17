<?php
   /*
      Hoje (26/02) eu modifiquei esse arquivo para retornar os dados com base nos filtros, então:

      - Foram criadas variáveis para pegar os filtros selecionados
      - Foi criada uma variável para uma cláusula WHERE personalizada com base nos filtros
      - A variável stmtTotal executa uma query para contar a quantidade de registros no banco que atendam aos filtros
      - Inseri a variável $where para personalizar a query principal para que ela retorne apenas os valores que se encaixam nos filtros
      - Adicionei um foreach que insere os parâmetros, o limite e o offset na query

      Hoje (27/02) eu modifiquei a linha que conta o total de registros no banco:

      - A query está retornando um array com a quantidade de registros, mas faltava referenciar o índice de onde está esse contagem,
        agora estou referenciando o índice de onde está essa informação, por isso do [0]['total_registros']

      Alteração de hoje (04/03)

      - A variável que monta minha cláusula WHERE estava com espaços faltando, agora com os devidos espaços o código está funcionando
   */

   header("Content-type: application/json"); // especifica o formatao da resposta http

   require_once __DIR__."/../conexao/connection.php";

   $filtro_obra    = isset($_GET['obra']) ? $_GET['obra'] : '';
   $filtro_cliente = isset($_GET['cliente']) ? $_GET['cliente'] : '';
   $filtro_mes     = isset($_GET['mes']) ? $_GET['mes'] : '';
   $filtro_ano     = isset($_GET['ano']) ? $_GET['ano'] : '';

   $condicoes  = [];
   $parametros = [];

   if ($filtro_obra) {
      $condicoes[] = "g.id_obra = :obra";
      $parametros[':obra'] = $filtro_obra;
   }

   if ($filtro_cliente) {
      $condicoes[] = "c.cpf_cnpj = :cliente";
      $parametros[':cliente'] = $filtro_cliente;
   }

   if ($filtro_mes) {
      $condicoes[] = "MONTH(g.data_gasto) = :mes";
      $parametros[':mes'] = $filtro_mes;
   }

   if ($filtro_ano) {
      $condicoes[] = "YEAR(g.data_gasto) = :ano";
      $parametros[':ano'] = $filtro_ano;
   }

   $where = count($condicoes) > 0 ? 'WHERE ' . implode(' AND ', $condicoes) : '';

   $registros_por_pagina = 20;
   $pagina_atual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
   $offset = ($pagina_atual - 1) * $registros_por_pagina; // define a partir de qual linha os dados serão selecionados

   // Conta a quantidade de registros respeitando o(s) filtro(s)
   $stmtTotal = $conn->prepare("SELECT
                                    COUNT(*) AS total_registros
                                 FROM gastosobras g
                                 INNER JOIN obras o ON g.id_obra = o.id
                                 INNER JOIN clientes c ON o.cpf_cnpj_cliente = c.cpf_cnpj
                                 $where");

   $stmtTotal->execute($parametros);

   $total = $stmtTotal->fetchAll(PDO::FETCH_ASSOC)[0]['total_registros'];
                                 
   $total_paginas = ceil($total / $registros_por_pagina); // define quantas páginas terão

   // Query principal foi atualizada para puxar os dados com base nos filtros
   $stmt = $conn->prepare("SELECT 
                           o.nome AS nomeObra,
                           c.nome AS nomeCliente,
                           g.id AS id_gasto, 
                           g.valor_gasto, 
                           g.data_gasto, 
                           g.descricao
                        FROM gastosobras g
                        INNER JOIN obras o
                        ON g.id_obra = o.id
                        INNER JOIN clientes c
                        ON o.cpf_cnpj_cliente = c.cpf_cnpj
                        $where
                        ORDER BY g.data_gasto DESC, o.nome ASC
                        LIMIT :limite
                        OFFSET :offset");

   // Adiciona os parâmetros + limite + offset
   foreach ($parametros as $chave => $valor) {
      $stmt->bindValue($chave, $valor);
   }

   $stmt->bindValue(':limite', $registros_por_pagina, PDO::PARAM_INT);
   $stmt->bindvalue(':offset', $offset, PDO::PARAM_INT);
   
   $stmt->execute();

   if ($stmt) {
      $lista_gastos = $stmt->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode([
         'gastos'        => $lista_gastos,
         'pagina_atual'  => $pagina_atual,
         'total_paginas' => $total_paginas,
         'total'         => (int) $total
      ]);

      // echo '<pre>';
      // print_r($lista_gastos);
      // echo '</pre>';
   }

?>