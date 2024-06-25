-- Dropa o Database
DROP DATABASE IF EXISTS db_sge;

-- Cria o Database
CREATE DATABASE db_sge;

-- Indica para usar o Database
USE db_sge;

-- Cria a tabela de Tipos de Produtos
CREATE TABLE tipos_produto (
    tipo_produto VARCHAR(50) PRIMARY KEY
);

-- Cria a tabela de Produtos
CREATE TABLE produtos (
    codigo_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(50),
    custo_produto DOUBLE,
    modelo_produto VARCHAR(50),
    codigo_barras_produto BIGINT NOT NULL,
    quantidade_produtos INT,
    tipo_produto VARCHAR(50),
    FOREIGN KEY (tipo_produto) REFERENCES tipos_produto(tipo_produto)
);

-- Cria a tabela de Funcionários
CREATE TABLE funcionarios (
    cpf_funcionario BIGINT NOT NULL PRIMARY KEY,
    nome_funcionario VARCHAR(50),
    senha_funcionario VARCHAR(50),
    permissao_cadastro_func BOOLEAN,
    permissao_consultar_prod BOOLEAN,
    permissao_cadastro_prod BOOLEAN,
    permissao_gerar_rel BOOLEAN,
    permissao_tipos_produtos BOOLEAN,
    permissao_ajuste_estoque BOOLEAN,
    permissao_ajuste_estoque_compras BOOLEAN,
    permissao_ajuste_estoque_vendas BOOLEAN,
    permissao_ajuste_estoque_ajuste BOOLEAN,
    permissao_mudar_permissoes BOOLEAN
);

/*
Cria a tabela de Batch de Registros
Brief: agrupa diferentes registros, identificando o funcionário que o fez 
*/
CREATE TABLE batch_registros (
    id_batch INT AUTO_INCREMENT PRIMARY KEY,
    observacoes_ajuste VARCHAR(150),
    funcionario_ajuste BIGINT,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (funcionario_ajuste) REFERENCES funcionarios(cpf_funcionario)
);

/*
Cria a tabela de Registros
Brief: Mantém os diferentes registros feitos no estoque
*/
CREATE TABLE registros (
    id_registro INT AUTO_INCREMENT PRIMARY KEY,
    tipo_ajuste VARCHAR(25),
    id_batch INT,
    codigo_produto INT,
    quantidade_ajuste INT,
    preco_produto DOUBLE,
    desconto_produto DOUBLE,
    total_ajuste DOUBLE,
    FOREIGN KEY (id_batch) REFERENCES batch_registros(id_batch),
    FOREIGN KEY (codigo_produto) REFERENCES produtos(codigo_produto)
);

-- Inserindo dados em tipos_produto
INSERT INTO tipos_produto (tipo_produto) VALUES 
('Lentes de Contato'), 
('Óculos de Grau'), 
('Óculos de Sol');

-- Inserindo dados em produtos
INSERT INTO produtos (nome_produto, custo_produto, modelo_produto, codigo_barras_produto, quantidade_produtos, tipo_produto) 
VALUES 
('Lente de Contato Diária', 50.00, 'LenteDiaria2024', 7894561230123, 200, 'Lentes de Contato'),
('Óculos de Grau Clássico', 120.00, 'Classico2024', 7894561230124, 150, 'Óculos de Grau'),
('Óculos de Sol Aviador', 200.00, 'Aviador2024', 7894561230125, 100, 'Óculos de Sol');

-- Inserindo dados em funcionarios
INSERT INTO funcionarios (
    cpf_funcionario, 
    nome_funcionario, 
    senha_funcionario, 
    permissao_cadastro_func,
    permissao_consultar_prod,
    permissao_cadastro_prod,
    permissao_gerar_rel,
    permissao_tipos_produtos,
    permissao_ajuste_estoque,
    permissao_ajuste_estoque_compras,
    permissao_ajuste_estoque_vendas,
    permissao_ajuste_estoque_ajuste,
    permissao_mudar_permissoes) 
VALUES 
(12345678901, 'João Silva', 'senha123', TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
(98765432109, 'Maria Souza', 'senha456', TRUE, TRUE, TRUE, TRUE, TRUE, FALSE, TRUE, FALSE, TRUE, TRUE);

-- Inserindo dados em batch_registros
INSERT INTO batch_registros (observacoes_ajuste, funcionario_ajuste) 
VALUES 
('Ajuste mensal de estoque', 12345678901),
('Correção de inventário', 98765432109);

-- Inserindo dados em registros
INSERT INTO registros (tipo_ajuste, id_batch, codigo_produto, quantidade_ajuste, preco_produto, desconto_produto, total_ajuste) 
VALUES 
('Entrada', 1, 1, 50, 50.00, 0.00, 2500.00),
('Saída', 2, 2, 10, 120.00, 10.00, 1100.00),
('Entrada', 1, 3, 30, 200.00, 0.00, 6000.00),
('Saída', 2, 1, 20, 50.00, 5.00, 900.00);