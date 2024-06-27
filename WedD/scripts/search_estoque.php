<?php

    // Inclui o arquivo db_access.php e obtém a conexão com o banco de dados
    $conn = require_once './db_access.php';

    // Recebe os dados enviados via POST
    $jsonData = file_get_contents('php://input');

    // Verifica se os dados foram recebidos corretamente
    if (!$jsonData) {
    http_response_code(400); // Bad Request
    die('Erro: Nenhum dado recebido.');
    }

    // Converte os dados JSON em array associativo
    $data = json_decode($jsonData, true);

    // Verifica se os dados foram decodificados corretamente
    if ($data === null) {
    http_response_code(400); // Bad Request
    die('Erro: Dados JSON inválidos.');
    }

// Verifica se os campos necessários estão presentes nos dados recebidos
if (!isset($data['prod_id'])) {
    http_response_code(400); // Bad Request
    die('Erro: Campos obrigatórios ausentes.');
}

    $prod_id = $data['prod_id'];
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE codigo_produto= ?");
    $stmt->bind_param("s", $prod_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        // Verifica se há resultados
        if ($row = $result->fetch_assoc()) {
            // Organiza os dados em um array
            $resultados = array(
            'prod_cost' => $row["custo_produto"],
            'prod_qtde' => $row["quantidade_produtos"]
            );
        
            // Converte o array associativo em formato JSON
            $jsonResultados = json_encode($resultados);

            // Retorna os resultados para o lado do cliente em formato JSON
            echo $jsonResultados;
        } else {
            //http_response_code(404); // Not Found
            echo json_encode(array('error' => 'Funcionário não encontrado.'));
        }
    } else {
        //http_response_code(500); // Internal Server Error
        echo json_encode(array('error' => 'Erro na consulta ao banco de dados: ' . $conn->error));
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
