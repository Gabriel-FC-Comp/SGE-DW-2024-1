<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && array_key_exists('salvar', $_POST)) {

    $conn = require_once './db_access.php';

    echo "Conexão efetuada com sucesso!\n";
    // Prepara os dados para inserção no banco de dados
    $cpf = str_replace(['.', '-'], '', $_POST['cpf_func']);
    echo $cpf;
    $nome = $_POST['func_name'];
    $senha = $_POST['func_password'];
    $permissao_cadastro_func = isset($_POST['check_cad_func']) ? 1 : 0;
    $permissao_consultar_prod = isset($_POST['check_cons_prod']) ? 1 : 0;
    $permissao_cadastro_prod = isset($_POST['check_cad_prod']) ? 1 : 0;
    $permissao_gerar_rel = isset($_POST['check_gen_rel']) ? 1 : 0;
    $permissao_tipos_produtos = isset($_POST['check_type_prod']) ? 1 : 0;
    $permissao_ajuste_estoque = isset($_POST['check_ajust_estoq']) ? 1 : 0;
    $permissao_ajuste_estoque_compras = isset($_POST['check_ajust_compras']) ? 1 : 0;
    $permissao_ajuste_estoque_vendas = isset($_POST['check_ajust_vendas']) ? 1 : 0;
    $permissao_ajuste_estoque_ajuste = isset($_POST['check_ajust_correcoes']) ? 1 : 0;
    $permissao_mudar_permissoes = isset($_POST['check_permiss_func']) ? 1 : 0;
    echo "Aqui passou!\n";
    $stmt = $conn->prepare("SELECT * FROM funcionarios WHERE cpf_funcionario = ?");
    echo "Aqui passou!\n";
    $stmt->bind_param("s", $cpf);
    echo "Aqui passou!\n";
    $stmt->execute();
    echo "Aqui passou!\n";
    $result = $stmt->get_result();
    echo "Aqui passou!\n";
    if ($result) {
        if ($result->num_rows > 0) {
            echo "Funcionário encontrado. Atualizando Dados...\n";
            $sql = "
                UPDATE funcionarios
                SET nome_funcionario = '$nome',
                    permissao_cadastro_func = '$permissao_cadastro_func',
                    permissao_consultar_prod = '$permissao_consultar_prod',
                    permissao_cadastro_prod = '$permissao_cadastro_prod',
                    permissao_gerar_rel = '$permissao_gerar_rel',
                    permissao_tipos_produtos = '$permissao_tipos_produtos',
                    permissao_ajuste_estoque = '$permissao_ajuste_estoque',
                    permissao_ajuste_estoque_compras = '$permissao_ajuste_estoque_compras',
                    permissao_ajuste_estoque_vendas = '$permissao_ajuste_estoque_vendas',
                    permissao_ajuste_estoque_ajuste = '$permissao_ajuste_estoque_ajuste',
                    permissao_mudar_permissoes = '$permissao_mudar_permissoes'
                WHERE cpf_funcionario = '$cpf';
            ";
        } else {
            echo "Novo funcionário. Inserindo...\n";
            $sql = "INSERT INTO funcionarios (cpf_funcionario, nome_funcionario, senha_funcionario, permissao_cadastro_func,
                permissao_consultar_prod, permissao_cadastro_prod, permissao_tipos_produtos,
                permissao_gerar_rel, permissao_ajuste_estoque, permissao_ajuste_estoque_compras, 
                permissao_ajuste_estoque_vendas, permissao_ajuste_estoque_ajuste, permissao_mudar_permissoes) 
                VALUES ('$cpf', '$nome', '$senha', '$permissao_cadastro_func','$permissao_consultar_prod', 
                '$permissao_cadastro_prod', '$permissao_tipos_produtos','$permissao_gerar_rel', 
                '$permissao_ajuste_estoque', '$permissao_ajuste_estoque_compras', '$permissao_ajuste_estoque_vendas', 
                '$permissao_ajuste_estoque_ajuste', '$permissao_mudar_permissoes')";
        }
    } else {
        // Query SQL para inserir os dados na tabela de funcionários
        echo "OOPS, ALGO DEU ERRADO!\n";
    }


    // Executa a query
    if ($conn->query($sql) === TRUE) {
        echo "Ação realizada com Sucesso!";
        // Fecha a conexão com o banco de dados
        $conn->close();
        header("Location: ../cadastro_funcionarios.php");
        exit;
    } else {
        echo "Erro ao realizar ação: " . $conn->error;
        console.log("Erro ao realizar ação: " . $conn->error);
        $conn->close();
    }

    
}else if ($_SERVER["REQUEST_METHOD"] == "POST" && array_key_exists('deletar', $_POST)) {
    // echo "HUR HUR HU-HUR";
    $conn = require_once './db_access.php';
    echo "Conexão efetuada com sucesso!\n";
    $cpf = str_replace(['.', '-'], '', $_POST['cpf_func']);
    echo "Aqui passou!\n";
    $stmt = $conn->prepare("SELECT * FROM funcionarios WHERE cpf_funcionario = ?");
    echo "Aqui passou!\n";
    $stmt->bind_param("s", $cpf);
    echo "Aqui passou!\n";
    $stmt->execute();
    echo "Aqui passou!\n";
    $result = $stmt->get_result();
    echo "Aqui passou!\n";
    if ($result){
        if ($result->num_rows > 0) {
            echo "Funcionário encontrado. Removendo Dados...\n";
            $sql = "DELETE FROM funcionarios WHERE cpf_funcionario = '$cpf'";
        
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
    header("Location: ../cadastro_funcionarios.php");
    exit;

}else{
    echo "Algo deu ruim";
}
