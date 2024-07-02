<?php

    session_start();
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
    if (!isset($data['obs'])) {
        http_response_code(400); // Bad Request
        die('Erro: Campos obrigatórios ausentes.');
    }

    $obs = $data['obs'];
    $stmt = $conn->prepare("INSERT INTO batch_registros (observacoes_ajuste,funcionario_ajuste) 
    VALUES (?,?)");
    $stmt->bind_param("ss", $obs,$_SESSION['user_id']);

    if ($stmt->execute()) {
        // Verifica se há resultados
        $batch_id = $stmt->insert_id;
        $resultados = array(
        'batch_id' => $batch_id
        );
    
        // Converte o array associativo em formato JSON
        $jsonResultados = json_encode($resultados);

        // Retorna os resultados para o lado do cliente em formato JSON
        echo $jsonResultados;

    } else {
        //http_response_code(500); // Internal Server Error
        echo json_encode(array('error' => 'Erro na consulta ao banco de dados: ' . $conn->error));
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
