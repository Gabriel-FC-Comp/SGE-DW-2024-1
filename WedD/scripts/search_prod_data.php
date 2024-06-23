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
  $prodData = $conn->query("SELECT * FROM produtos WHERE codigo_produto=$prod_id");

  if ($prodData) {
    // Verifica se há resultados
    if ($row = $prodData->fetch_assoc()) {
      // Organiza os dados em um array
      $resultados = array(
        'prod_name' => $row["nome_produto"],
        'prod_cost' => $row["custo_produto"],
        'prod_model' => $row["modelo_produto"],
        'prod_barcode' => $row["codigo_barras_produto"],
        'prod_qtde' => $row["quantidade_produtos"],
        'prod_type' => $row["tipo_produto"]
      );

      // Converte o array associativo em formato JSON
      $jsonResultados = json_encode($resultados);

      // Retorna os resultados para o lado do cliente em formato JSON
      echo $jsonResultados;
    } else {
      echo json_encode(array('error' => 'Produto não encontrado.'));
    }
  } else {
    echo json_encode(array('error' => 'Erro na consulta ao banco de dados: ' . $conn->error));
    http_response_code(500); // Internal Server Error
  }

  // Fecha a conexão com o banco de dados
  $conn->close();
