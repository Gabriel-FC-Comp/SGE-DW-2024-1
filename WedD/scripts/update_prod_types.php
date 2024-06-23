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
  if (!isset($data['types_to_add']) || !isset($data['types_to_rmv'])) {
    http_response_code(400); // Bad Request
    die('Erro: Campos obrigatórios ausentes.');
  }

  // Lógica para adicionar os tipos de produto ao banco de dados
  foreach ($data['types_to_add'] as $type) {
    $conn->query("INSERT INTO tipos_produto (tipo_produto) VALUES ('$type')");
  }

  // Lógica para remover os tipos de produto do banco de dados
  foreach ($data['types_to_rmv'] as $type) {
    $conn->query("DELETE FROM tipos_produto WHERE tipo_produto='$type'");
  }

  // Fecha a conexão com o banco de dados
  $conn->close();
