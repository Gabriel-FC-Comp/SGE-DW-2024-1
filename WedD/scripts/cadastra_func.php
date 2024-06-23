<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = require_once './db_access.php';

    echo "Conexão efetuada com sucesso!\n";
    // Prepara os dados para inserção no banco de dados
    $cpf = str_replace(['.', '-'], '', $_POST['cpf_func']);
    echo $cpf;
    $nome = $_POST['func_name'];
    $senha = $_POST['func_password'];
    $permissao_cadastro_func = isset($_POST['checkCadastroFuncionario']) ? 1 : 0;
    $permissao_cadastro_prod = isset($_POST['checkCadastroProdutos']) ? 1 : 0;
    $permissao_gerar_rel = isset($_POST['checkGerarRelatorios']) ? 1 : 0;
    $permissao_ajuste_estoque_compras = isset($_POST['checkCompras']) ? 1 : 0;
    $permissao_ajuste_estoque_vendas = isset($_POST['checkVendas']) ? 1 : 0;
    $permissao_ajuste_estoque_ajuste = isset($_POST['checkCorrecao']) ? 1 : 0;
    $permissao_mudar_permissoes = isset($_POST['checkPermissoesFunc']) ? 1 : 0;
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
                    permissao_cadastro_prod = '$permissao_cadastro_prod',
                    permissao_gerar_rel = '$permissao_gerar_rel',
                    permissao_ajuste_estoque_compras = '$permissao_ajuste_estoque_compras',
                    permissao_ajuste_estoque_vendas = '$permissao_ajuste_estoque_vendas',
                    permissao_ajuste_estoque_ajuste = '$permissao_ajuste_estoque_ajuste',
                    permissao_mudar_permissoes = '$permissao_mudar_permissoes'
                WHERE cpf_funcionario = '$cpf';
            ";
        } else {
            echo "Novo funcionário. Inserindo...\n";
            $sql = "INSERT INTO funcionarios (cpf_funcionario, nome_funcionario, senha_funcionario, permissao_cadastro_func, permissao_cadastro_prod, permissao_gerar_rel, permissao_ajuste_estoque_compras, permissao_ajuste_estoque_vendas, permissao_ajuste_estoque_ajuste, permissao_mudar_permissoes) VALUES ('$cpf', '$nome', '$senha', '$permissao_cadastro_func', '$permissao_cadastro_prod', '$permissao_gerar_rel', '$permissao_ajuste_estoque_compras', '$permissao_ajuste_estoque_vendas', '$permissao_ajuste_estoque_ajuste', '$permissao_mudar_permissoes')";
        }
    } else {
        // Query SQL para inserir os dados na tabela de funcionários
        echo "BURRO, DEU TUDO ERRADO!\n";
    }


    // Executa a query
    if ($conn->query($sql) === TRUE) {
        echo "Ação realizada com Sucesso!";
    } else {
        echo "Erro ao realizar ação: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>