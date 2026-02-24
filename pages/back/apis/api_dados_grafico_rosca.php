<?php
    error_reporting(0);

    header("Content-type: application/json");

    require_once __DIR__."/../../conexao/connection.php";

    try {
        $stmt = $conn->prepare("SELECT
                                    o.nome,
                                    SUM(g.valor_gasto * (o.porcentagem_cobranca / 100)) AS comissao_obra
                                FROM obras o
                                INNER JOIN gastosobras g
                                ON o.id = g.id_obra
                                GROUP BY o.nome
                                ORDER BY o.nome ASC");

        $stmt->execute();

        if($stmt) {
            $listaDados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $chaves = [];
            $valores = [];
            
            foreach($listaDados as $value) {
                array_push($chaves, $value['nome']);
                array_push($valores, $value['comissao_obra']);
            }

            $dados = [
                'labels' => array_values($chaves),
                'values' => array_values($valores)
            ];
            
            // echo '<pre>';
            // print_r($dados);
            // echo '</pre>';
            
            echo json_encode($dados);
        }
    } catch(PDOException $erro) {
        echo "Não foi possível recuperar os dados";
        exti();
    }
?>