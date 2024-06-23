<?php

// Inclui o arquivo db_access.php e obtém a conexão com o banco de dados
$conn = require_once './db_access.php';

// Recebe os dados enviados via POST
$jsonData = file_get_contents('php://input');

// Verifica se os dados foram recebidos corretamente
if (!$jsonData) {
    die(json_encode(array('error' => 'Erro: Nenhum dado Recebido.')));
}

// Converte os dados JSON em array associativo
$data = json_decode($jsonData, true);

// Verifica se os dados foram decodificados corretamente
if ($data === null) {
    die(json_encode(array('error' => 'Erro: Dados JSON inválidos.')));
}

// Verifica se os campos necessários estão presentes nos dados recebidos
if (
    !isset($data["prod_ID"]) ||
    !isset($data["prod_name"]) ||
    !isset($data["prod_type"]) ||
    !isset($data["prod_model"]) ||
    !isset($data["prod_barcode"])
) {
    die(json_encode(array('error' => 'Erro: Campos obrigatórios ausentes.')));
}

$sqlQuery = "SELECT * FROM produtos WHERE ";
$andFlag = false;
if (isset($data["prod_ID"]) && $data["prod_ID"] !== '') {
    if (!filter_var($data["prod_ID"], FILTER_VALIDATE_INT)) {
        die(json_encode(array('error' => 'Erro: ID de produto inválido!')));
    }
    $sqlQuery .= "codigo_produto=" . $data["prod_ID"];
    $andFlag = true;
}

if (isset($data["prod_name"]) && $data["prod_name"] !== '') {
    if ($andFlag) {
        $sqlQuery .= " AND ";
    }
    $sqlQuery .= "UPPER(nome_produto) LIKE '%" . strtoupper($data["prod_name"]) . "%'";
    $andFlag = true;
}

if (isset($data["prod_type"]) && $data["prod_type"] !== '') {
    if ($andFlag) {
        $sqlQuery .= " AND ";
    }
    $sqlQuery .= "tipo_produto='" . $data["prod_type"] . "'";
    $andFlag = true;
}

if (isset($data["prod_model"]) && $data["prod_model"] !== '') {
    if ($andFlag) {
        $sqlQuery .= " AND ";
    }
    $sqlQuery .= "modelo_produto='" . $data["prod_model"] . "'";
    $andFlag = true;
}

if (isset($data["prod_barcode"]) && $data["prod_barcode"] !== '') {
    if ($andFlag) {
        $sqlQuery .= " AND ";
    }
    $sqlQuery .= "codigo_barras_produto='" . $data["prod_barcode"] . "'";
    $andFlag = true;
}

if (!$andFlag) {
    die(json_encode(array('error' => 'Erro: Insira algum campo!')));
}

$sqlQuery .= ";";
$prodData = $conn->query($sqlQuery);

if ($prodData) {
    // Verifica se há resultados
    if ($prodData->num_rows > 0) {

        $returnData = array();
        // Organiza os dados em um array
        while ($row = $prodData->fetch_assoc()) {
            $returnData[] = $row;
        }

        // Converte o array associativo em formato JSON
        $jsonResultados = json_encode($returnData);

        // Retorna os resultados para o lado do cliente em formato JSON
        echo $jsonResultados;
    } else {
        echo json_encode(array('result' => 'Produto não encontrado.'));
    }
} else {
    echo json_encode(array('error' => 'Erro na consulta ao banco de dados: ' . $conn->error));
    // http_response_code(500); // Internal Server Error
}

// Fecha a conexão com o banco de dados
$conn->close();
