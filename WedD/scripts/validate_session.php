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
if (!isset($data['password']) || !isset($data['username'])) {
    http_response_code(400); // Bad Request
    die('Erro: Campos obrigatórios ausentes.');
}

$username = $data['username'];
$password = $data['password'];

// Consulta preparada para buscar a senha do usuário no banco de dados
$stmt = $conn->prepare("SELECT * FROM funcionarios WHERE cpf_funcionario=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    if ($result->num_rows > 0) {
        $rows = $result->fetch_assoc();
        $password_bd = $rows["senha_funcionario"];
        if ($password == $password_bd) {
            // A alterar pra esse
            // if(password_verify($password,$password_bd)){
            // Iniciar a sessão
            session_start();
            // Definir várias variáveis de sessão
            $_SESSION['user_id'] = $username;
            $_SESSION['podi_cad_func'] = $rows["permissao_cadastro_func"];
            $_SESSION['consult_prod'] = $rows["permissao_consultar_prod"];
            $_SESSION['podi_cad_prod'] = $rows["permissao_cadastro_prod"];
            $_SESSION['podi_ger_relt'] = $rows["permissao_gerar_rel"];
            $_SESSION['podi_ajs_prod'] = $rows["permissao_tipos_produtos"];
            $_SESSION['podi_ajs_estq'] = $rows["permissao_ajuste_estoque"];
            $_SESSION['podi_ajs_comp'] = $rows["permissao_ajuste_estoque_compras"];
            $_SESSION['podi_ajs_vend'] = $rows["permissao_ajuste_estoque_vendas"];
            $_SESSION['podi_ajs_ajst'] = $rows["permissao_ajuste_estoque_ajuste"];
            $_SESSION['podi_mud_perm'] = $rows["permissao_mudar_permissoes"];
            $_SESSION['user_connected'] = true;

            echo json_encode(array('sucess' => "Credenciais Corretas!"));
        } else {
            echo json_encode(array('error' => "Senha incorreta!"));
        }
    } else {
        echo json_encode(array('error' => "Usuário não cadastrado!"));
    }
} else {
    echo json_encode(array('error' => "Falha na requisição do banco de dados!"));
}

// Fecha o stmt
$stmt->close();
// Fecha a conexão
$conn->close();
