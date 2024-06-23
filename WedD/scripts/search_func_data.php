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
if (!isset($data['cpf_func'])) {
    http_response_code(400); // Bad Request
    die('Erro: Campos obrigatórios ausentes.');
}

$cpf_func = $data['cpf_func'];

// Prepara a consulta SQL para evitar injeção de SQL
$stmt = $conn->prepare("SELECT * FROM funcionarios WHERE cpf_funcionario = ?");
$stmt->bind_param("s", $cpf_func);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    // Verifica se há resultados
    if ($row = $result->fetch_assoc()) {
        // Organiza os dados em um array
        $resultados = array(
            'func_name' => $row["nome_funcionario"],
            'func_passw' => $row["senha_funcionario"],
            'cad_func_permiss' => $row["permissao_cadastro_func"],
            'cad_prod_permiss' => $row["permissao_cadastro_prod"],
            'gera_rel_permiss' => $row["permissao_gerar_rel"],
            'aj_estoq_permiss' => $row["permissao_ajuste_estoque"],
            'aj_estoq_comp_permiss' => $row["permissao_ajuste_estoque_compras"],
            'aj_estoq_said_permiss' => $row["permissao_ajuste_estoque_vendas"],
            'aj_estoq_aj_permiss' => $row["permissao_ajuste_estoque_ajuste"],
            'permiss_change_permiss' => $row["permissao_mudar_permissoes"]
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