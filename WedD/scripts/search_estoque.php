<?php

    session_start();
    //$_SESSION['user_id'] id do funcionario
    // Inclui o arquivo db_access.php e obtém a conexão com o banco de dados
    $conn = require_once './db_access.php';

    // Recebe os dados enviados via POST
    $jsonData = file_get_contents('php://input');

    // Verifica se os dados foram recebidos corretamente
    if (!$jsonData) {
    //http_response_code(400); // Bad Request
    die(json_encode(array('error' => 'Erro: Nenhum dado recebido.')));
    }

    // Converte os dados JSON em array associativo
    $data = json_decode($jsonData, true);

    // Verifica se os dados foram decodificados corretamente
    if ($data === null) {
    //http_response_code(400); // Bad Request
    die(json_encode(array('error' => 'Erro: Dados JSON inválidos.')));
    }

    // Verifica se os campos necessários estão presentes nos dados recebidos
    if (!isset($data['batch_id'])) {
        //http_response_code(400); // Bad Request
        die(json_encode(array('error' => 'Erro: Campos obrigatórios ausentes.')));
    }
    //
    $batch_id = $data['batch_id'];
    $prod_id = $data['prod_id'];
    $qdte_prod = intval($data['qtde_prod']);
    //die(json_encode(array('error' => 'qtde_prod' . $qdte_prod . 'Value' . $data['qtde_prod'])));
    $preco_prod = str_replace(',','.',$data['preco_prod']);
    $desconto_prod = str_replace(',','.',$data['desconto_prod']);
    $total_prod = str_replace(',','.',$data['total_prod']);
    $ajuste_type = $data['ajuste_type'];

    $stmt = $conn->prepare("INSERT INTO registros (tipo_ajuste, id_batch, codigo_produto, 
                                    quantidade_ajuste, preco_produto, desconto_produto, total_ajuste) 
    VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss", $ajuste_type, $batch_id, $prod_id, $qdte_prod, $preco_prod, $desconto_prod, $total_prod);

    if ($stmt->execute()) {
        if($ajuste_type == "Entrada"){
            $stmt = $conn->prepare("UPDATE produtos 
            SET quantidade_produtos = quantidade_produtos + ? WHERE codigo_produto = ?");
            $stmt->bind_param("ii",$qdte_prod,$prod_id);
            if($stmt->execute()){
                echo json_encode(array('sucesso' => 'Entrada OK'));
            }
            else{
                echo json_encode(array('error' => 'Erro na atualização do banco de dados: ' . $conn->error));
            }
        }else if($ajuste_type == "Saída"){
            $stmt = $conn->prepare("UPDATE produtos 
            SET quantidade_produtos = quantidade_produtos - ? WHERE codigo_produto = ?");
            $stmt->bind_param("ii",$qdte_prod,$prod_id);
            if($stmt->execute()){
                echo json_encode(array('sucesso' => 'Saída OK'));
            }
            else{
                echo json_encode(array('error' => 'Erro na atualização do banco de dados: ' . $conn->error));
            }
        }else if($ajuste_type == "Ajuste"){
            $stmt = $conn->prepare("UPDATE produtos 
            SET quantidade_produtos = ? WHERE codigo_produto = ?");
            $stmt->bind_param("ii",$qdte_prod,$prod_id);
            if($stmt->execute()){
                echo json_encode(array('sucesso' => 'Ajuste OK'));
            }
            else{
                echo json_encode(array('error' => 'Erro na atualização do banco de dados: ' . $conn->error));
            }
        }else{
            echo json_encode(array('error' => 'Algo deu errado!: ' . $conn->error));
        }
    } else {
        //http_response_code(500); // Internal Server Error
        echo json_encode(array('error' => 'Erro na inserção ao banco de dados: ' . $conn->error));
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
