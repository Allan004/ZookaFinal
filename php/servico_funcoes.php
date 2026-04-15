<?php
require_once "conexao.php";

function buscar_servicos() {
    $pdo = conectar();
    $sql = "SELECT * FROM servico ORDER BY nome";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscar_servico($id) {
    $pdo = conectar();
    $sql = "SELECT * FROM servico WHERE id = :id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function salvar_servico($dados) {
    $nome = trim($dados['nome'] ?? '');
    $descricao = trim($dados['descricao'] ?? '');
    $preco = str_replace([',', ' '], ['.', ''], trim($dados['preco'] ?? ''));
    $errors = [];

    if ($nome === '') {
        $errors[] = 'Informe o nome do serviço.';
    }
    if ($descricao === '') {
        $errors[] = 'Informe a descrição do serviço.';
    }
    if ($preco === '' || !is_numeric($preco) || (float)$preco < 0) {
        $errors[] = 'Informe um preço válido para o serviço.';
    }

    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }

    $pdo = conectar();
    if (empty($dados['id_servico'])) {
        $sql = "INSERT INTO servico (nome, descricao, preco) VALUES (:nome, :descricao, :preco)";
    } else {
        $sql = "UPDATE servico SET nome = :nome, descricao = :descricao, preco = :preco, updated_at = NOW() WHERE id = :id";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->bindValue(':preco', number_format((float)$preco, 2, '.', ''));
    if (!empty($dados['id_servico'])) {
        $stmt->bindValue(':id', (int)$dados['id_servico'], PDO::PARAM_INT);
    }

    return ['success' => $stmt->execute()];
}

function deletar_servico($id) {
    $pdo = conectar();
    
    $sqlVerifica = "SELECT COUNT(*) FROM agendamento WHERE id_servico = :id";
    $stmtVerifica = $pdo->prepare($sqlVerifica);
    $stmtVerifica->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmtVerifica->execute();
    $count = $stmtVerifica->fetchColumn();
    
    if ($count > 0) {
        return false;
    }
    
    $sql = "DELETE FROM servico WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    return $stmt->execute();
}
