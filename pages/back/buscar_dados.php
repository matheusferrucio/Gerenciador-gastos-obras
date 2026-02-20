<?php
   error_reporting(0);

   header("Content-type: application/json"); // especifica o formatao da resposta http

   require_once __DIR__."/../conexao/connection.php";

   $registros_por_pagina = 20;
   $pagina_atual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
   $offset = ($pagina_atual - 1) * $registros_por_pagina; // define a partir de qual linha os dados serão selecionados

   $total = $conn->query("SELECT COUNT(*) FROM gastosobras")->fetchColumn();
   $total_paginas = ceil($total / $registros_por_pagina); // define quantas páginas terão

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
                        ORDER BY g.data_gasto DESC
                        LIMIT :limite
                        OFFSET :offset");

   $stmt->bindValue(':limite', $registros_por_pagina, PDO::PARAM_INT);
   $stmt->bindvalue(':offset', $offset, PDO::PARAM_INT);
   $stmt->execute();

   $lista_gastos = $stmt->fetchAll(PDO::FETCH_ASSOC);

   echo json_encode([
      'gastos'        => $lista_gastos,
      'pagina_atual'  => $pagina_atual,
      'total_paginas' => $total_paginas,
      'total'         => (int) $total
   ]);
?>