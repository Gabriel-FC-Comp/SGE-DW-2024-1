<?php
$conn = require_once './db_access.php';

// Recebe os dados enviados via POST

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

$data_inicial = $data['dataInicial'];
$data_final = $data['dataFinal'];
$tipo = $data['tipoRelatorio'];

// Consulta os registros da tabela batch_registros dentro do intervalo de datas
$sql = "SELECT registros.tipo_ajuste, registros.id_batch, registros.codigo_produto, batch_registros.data_criacao, produtos.nome_produto, produtos.custo_produto, produtos.quantidade_produtos
FROM registros
JOIN batch_registros ON registros.id_batch = batch_registros.id_batch
JOIN produtos ON registros.codigo_produto = produtos.codigo_produto
WHERE DATE(batch_registros.data_criacao) BETWEEN ? AND ?";

if (!empty($tipo)) {
    $sql .= " AND registros.tipo_ajuste = ?";
}

// Preparar a consulta
$stmt = $conn->prepare($sql);

if (!empty($tipo)) {
    // Se o tipo de ajuste for fornecido, vincule os três parâmetros
    $stmt->bind_param('sss', $data_inicial, $data_final, $tipo);
} else {
    // Caso contrário, vincule apenas os dois parâmetros
    $stmt->bind_param('ss', $data_inicial, $data_final);
}

// Executar a consulta
$stmt->execute();

// Obter o resultado
$result = $stmt->get_result();

if ($result) {
    // Verifica se há resultados
    if ($result->num_rows > 0) {
        $returnData = array();
        // Organiza os dados em um array
        while ($row = $result->fetch_assoc()) {
            $returnData[] = $row;
        }
        // Converte o array associativo em formato JSON
        $jsonResultados = json_encode($returnData);
        echo $jsonResultados;
    } else {
        echo json_encode(array('result' => 'Produto não encontrado.'));
    }
} else {
    echo json_encode(array('error' => 'Erro na consulta ao banco de dados: ' . $conn->error));
    // http_response_code(500); // Internal Server Error
}

$stmt->close();
$conn->close();
