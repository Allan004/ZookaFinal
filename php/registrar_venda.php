-- =====================================
-- 1️⃣ CRIAR BANCO DE DADOS
-- =====================================
CREATE DATABASE IF NOT EXISTS zookaheva;
USE zookaheva;

-- =====================================
-- 2️⃣ CRIAR TABELAS
-- =====================================

-- Login
CREATE TABLE login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Cliente
CREATE TABLE cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    telefone VARCHAR(11) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    cpf VARCHAR(11) NOT NULL UNIQUE,
    nascimento DATE NOT NULL,
    rua VARCHAR(100) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    bairro VARCHAR(50) NOT NULL,
    cidade VARCHAR(50) NOT NULL,
    estado CHAR(2) NOT NULL,
    cep VARCHAR(8) NOT NULL,
    id_login INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_login) REFERENCES login(id)
);

-- Funcionário
CREATE TABLE funcionario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(11) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    cpf VARCHAR(11) NOT NULL UNIQUE,
    nascimento DATE NOT NULL,
    cargo VARCHAR(50) NOT NULL,
    setor VARCHAR(50) NOT NULL,
    rua VARCHAR(100) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    bairro VARCHAR(50) NOT NULL,
    cidade VARCHAR(50) NOT NULL,
    estado CHAR(2) NOT NULL,
    cep VARCHAR(8) NOT NULL,
    id_login INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_login) REFERENCES login(id)
);

-- Pet
CREATE TABLE pet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(30) NOT NULL,
    nascimento DATE NULL,
    tipoidade ENUM('EXATA','APROXIMADA') NOT NULL,
    idadeaprox INT NULL,
    especie VARCHAR(30) NOT NULL,
    raca VARCHAR(30) NOT NULL,
    id_cliente INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES cliente(id),
    CHECK (
        (tipoidade = 'EXATA' AND nascimento IS NOT NULL AND idadeaprox IS NULL)
        OR
        (tipoidade = 'APROXIMADA' AND nascimento IS NULL AND idadeaprox IS NOT NULL)
    )
);

-- Serviço
CREATE TABLE servico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Produto
CREATE TABLE produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Venda
CREATE TABLE venda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    data_venda DATETIME NOT NULL,
    total DECIMAL(10,2) NOT NULL DEFAULT 0,
    status ENUM('PENDENTE','CONCLUIDA','CANCELADA') DEFAULT 'PENDENTE',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES cliente(id)
);

-- Item de venda
CREATE TABLE item_venda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_venda INT NOT NULL,
    id_produto INT NULL,
    id_servico INT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_servico) REFERENCES servico(id),
    FOREIGN KEY (id_venda) REFERENCES venda(id) ON DELETE CASCADE,
    FOREIGN KEY (id_produto) REFERENCES produto(id),
    CHECK (id_produto IS NOT NULL OR id_servico IS NOT NULL)
);

-- Agendamento
CREATE TABLE agendamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pet INT NOT NULL,
    id_servico INT NOT NULL,
    id_funcionario INT NOT NULL,
    dataagendamento DATE NOT NULL,
    hora TIME NOT NULL,
    statusagendamento VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pet) REFERENCES pet(id),
    FOREIGN KEY (id_servico) REFERENCES servico(id),
    FOREIGN KEY (id_funcionario) REFERENCES funcionario(id)
);

-- =====================================
-- 3️⃣ POPULAR TABELAS
-- =====================================

-- Logins
INSERT INTO login (usuario, senha) VALUES ('livia.sato','Senha@12345');
INSERT INTO login (usuario, senha) VALUES ('elen.raya','Senha@12345');

-- Clientes
INSERT INTO cliente (
    nome, telefone, email, cpf, nascimento, rua, numero, bairro, cidade, estado, cep, id_login
) VALUES (
    'Lívia Raya Sato', '11911223344', 'liviarayasato@gmail.com', '12345678901', 
    '2000-05-05', 'Rua das Flores', '123', 'Jardim Cumbica', 'Guarulhos', 'SP', '07240001', 1
);

-- Funcionários
INSERT INTO funcionario (
    nome, telefone, email, cpf, nascimento, cargo, setor, rua, numero, bairro, cidade, estado, cep, id_login
) VALUES (
    'Elen Macario Raya','11941599013','elenraya@gmail.com','51144788859',
    '2001-12-22','Vendedor','Comercial','Rua Taquaritinga do Norte','111',
    'Jardim Cumbica','Guarulhos','SP','07240001',2
);

-- Pets
INSERT INTO pet (nome, nascimento, tipoidade, idadeaprox, especie, raca, id_cliente)
VALUES ('Snoopy','2012-01-01','EXATA',NULL,'Canino','SRD',1);

-- Serviços
INSERT INTO servico (nome, descricao, preco) VALUES ('Raio X','Exame de Raio X',109.90);

-- Produtos
INSERT INTO produto (nome, descricao, preco, estoque)
VALUES ('Shampoo Canino DogShow 300ml','Shampoo canino para todos os tipos de pelos, cruelty free e vegano.',29.90,10);

-- Agendamentos
INSERT INTO agendamento (id_pet, id_servico, id_funcionario, dataagendamento, hora, statusagendamento)
VALUES (1,1,1,'2026-03-20','14:00:00','Agendado');

-- =====================================
-- 4️⃣ CRIAR TRIGGERS
-- =====================================

DELIMITER $$

-- Set preço unitário ao inserir item
CREATE TRIGGER set_preco_unitario
BEFORE INSERT ON item_venda
FOR EACH ROW
BEGIN
    DECLARE v_preco DECIMAL(10,2);

    IF NEW.id_produto IS NOT NULL THEN
        SELECT preco INTO v_preco FROM produto WHERE id = NEW.id_produto;
        SET NEW.preco_unitario = v_preco;
    END IF;

    IF NEW.id_servico IS NOT NULL THEN
        SELECT preco INTO v_preco FROM servico WHERE id = NEW.id_servico;
        SET NEW.preco_unitario = v_preco;
    END IF;
END$$

-- Atualiza total da venda após inserir item
CREATE TRIGGER atualiza_total_venda
AFTER INSERT ON item_venda
FOR EACH ROW
BEGIN
    UPDATE venda
    SET total = (SELECT SUM(quantidade * preco_unitario) FROM item_venda WHERE id_venda = NEW.id_venda)
    WHERE id = NEW.id_venda;
END$$

-- Baixa estoque ao concluir venda
CREATE TRIGGER baixa_estoque_concluida
AFTER UPDATE ON venda
FOR EACH ROW
BEGIN
    IF OLD.status <> 'CONCLUIDA' AND NEW.status = 'CONCLUIDA' THEN
        UPDATE produto p
        JOIN item_venda i ON i.id_produto = p.id
        SET p.estoque = p.estoque - i.quantidade
        WHERE i.id_venda = NEW.id;
    END IF;
END$$

-- Devolve estoque ao cancelar venda
CREATE TRIGGER devolve_estoque_cancelada
AFTER UPDATE ON venda
FOR EACH ROW
BEGIN
    IF OLD.status <> 'CANCELADA' AND NEW.status = 'CANCELADA' THEN
        UPDATE produto p
        JOIN item_venda i ON i.id_produto = p.id
        SET p.estoque = p.estoque + i.quantidade
        WHERE i.id_venda = NEW.id;
    END IF;
END$$

DELIMITER ;

-- =====================================
-- 5️⃣ TESTES E INSERTS DE VENDA
-- =====================================

-- Crie uma nova venda
INSERT INTO venda (id_cliente, data_venda) VALUES (1, NOW());
SET @id_venda = LAST_INSERT_ID();

-- Adicione itens: produto e serviço
INSERT INTO item_venda (id_venda, id_produto, quantidade) VALUES (@id_venda, 1, 2);
INSERT INTO item_venda (id_venda, id_servico, quantidade) VALUES (@id_venda, 1, 1);

-- Veja estoque antes de concluir
SELECT * FROM produto;

-- Conclua a venda
UPDATE venda SET status = 'CONCLUIDA' WHERE id = @id_venda;

-- Verifique estoque e total
SELECT * FROM produto;
SELECT * FROM venda;

-- Cancele a venda
UPDATE venda SET status = 'CANCELADA' WHERE id = @id_venda;

-- Verifique estoque voltou e total permanece
SELECT * FROM produto;
SELECT * FROM venda;

-- =====================================
-- 6️⃣ CONSULTAS DE VERIFICAÇÃO
-- =====================================
SHOW TRIGGERS;
DESCRIBE venda;

SELECT 
    cliente.nome AS nome_cliente,
    pet.nome AS nome_pet
FROM pet
JOIN cliente ON pet.id_cliente = cliente.id;

SELECT * FROM login;
SELECT * FROM venda;
SELECT * FROM item_venda;