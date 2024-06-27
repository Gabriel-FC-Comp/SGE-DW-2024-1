<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && array_key_exists('salvar_prod', $_POST)) {

    $conn = require_once './db_access.php';

    echo "Conexão efetuada com sucesso!\n";
    // Prepara os dados para inserção no banco de dados
    $cod_produto = $_POST['prod_id'];
    echo $cod_produto;
    $nome = $_POST['prod_name'];
    $tipo = $_POST['prod_type'];
    $custo = str_replace(',', '.', $_POST['prod_cost']);
    $modelo = $_POST['prod_model'];
    $cod_barras = $_POST['prod_barcode'];
    echo "Aqui passou!\n";
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE codigo_produto = ?");
    echo "Aqui passou!\n";
    $stmt->bind_param("s", $cod_produto);
    echo "Aqui passou!\n";
    $stmt->execute();
    echo "Aqui passou!\n";
    $result = $stmt->get_result();
    echo "Aqui passou!\n";
    if ($result) {
        if ($result->num_rows > 0) {
            echo "Produto encontrado. Atualizando Dados...\n";
            $sql = "
                UPDATE produtos
                SET nome_produto = '$nome',
                    custo_produto = '$custo',
                    modelo_produto = '$modelo',
                    codigo_barras_produto = '$cod_barras',
                    tipo_produto = '$tipo'
                WHERE codigo_produto = '$cod_produto';
            ";
        } else {
            echo "Novo Produto. Inserindo...\n";
            $sql = "INSERT INTO produtos (codigo_produto,nome_produto,custo_produto,modelo_produto,codigo_barras_produto,quantidade_produtos,tipo_produto) VALUES ('$cod_produto','$nome','$custo','$modelo','$cod_barras',0,'$tipo')";
        }
    } else {
        // Query SQL para inserir os dados na tabela de funcionários
        echo "BURRO, DEU TUDO ERRADO!\n";
    }


    // Executa a query
    if ($conn->query($sql) === TRUE) {
        echo "Ação realizada com Sucesso!";
        // Fecha a conexão com o banco de dados
        $conn->close();
        header("Location: ../cadastro_produtos.php");
        exit;
    } else {
        echo "Erro ao realizar ação: " . $conn->error;
        console.log("Erro ao realizar ação: " . $conn->error);
        $conn->close();
    }

    
}else if ($_SERVER["REQUEST_METHOD"] == "POST" && array_key_exists('delete_prod', $_POST)) {
    $conn = require_once './db_access.php';
    echo "Conexão efetuada com sucesso!\n";
    $cod_produto = $_POST['prod_id'];
    echo "Aqui passou!\n";
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE codigo_produto = ?");
    echo "Aqui passou!\n";
    $stmt->bind_param("s", $cod_produto);
    echo "Aqui passou!\n";
    $stmt->execute();
    echo "Aqui passou!\n";
    $result = $stmt->get_result();
    echo "Aqui passou!\n";
    if ($result){
        if ($result->num_rows > 0) {
            echo "Funcionário encontrado. Removendo Dados...\n";
            $sql = "DELETE FROM produtos WHERE codigo_produto = '$cod_produto'";
        
            // Executa a query
            if ($conn->query($sql) === TRUE) {
                echo "Ação realizada com Sucesso!";

            } else {
                echo "Erro ao realizar ação: " . $conn->error;
                console.log("Erro ao realizar ação: " . $conn->error);
                // $conn->close();
            }
        }else{
            echo "Funcionário não cadastrado.\n";
        }
    }else{
        echo "Erro ao encontrar funcionário!\n";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
    header("Location: ../cadastro_produtos.php");
    exit;

}else{
    echo "Algo deu ruim";
}
