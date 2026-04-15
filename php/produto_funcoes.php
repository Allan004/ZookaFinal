<?php
require_once "conexao.php";

function buscar_produtos() {
    $pdo = conectar();
    $sql = "SELECT * FROM produto ORDER BY nome";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscar_produto($id) {
    $pdo = conectar();
    $sql = "SELECT * FROM produto WHERE id = :id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function salvar_produto($dados) {
    $nome = trim($dados['nome'] ?? '');
    $descricao = trim($dados['descricao'] ?? '');
    $preco = str_replace([',', ' '], ['.', ''], trim($dados['preco'] ?? ''));
    $estoque = isset($dados['estoque']) ? (int)$dados['estoque'] : 0;
    $errors = [];

    if ($nome === '') {
        $errors[] = 'Informe o nome do produto.';
    }
    if ($descricao === '') {
        $errors[] = 'Informe a descrição do produto.';
    }
    if ($preco === '' || !is_numeric($preco) || (float)$preco < 0) {
        $errors[] = 'Informe um preço válido para o produto.';
    }
    if ($estoque < 0) {
        $errors[] = 'A quantidade em estoque não pode ser negativa.';
    }

    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }

    $pdo = conectar();
    if (empty($dados['id_produto'])) {
        $sql = "INSERT INTO produto (nome, descricao, preco, estoque) VALUES (:nome, :descricao, :preco, :estoque)";
    } else {
        $sql = "UPDATE produto SET nome = :nome, descricao = :descricao, preco = :preco, estoque = :estoque, updated_at = NOW() WHERE id = :id";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->bindValue(':preco', number_format((float)$preco, 2, '.', ''));
    $stmt->bindValue(':estoque', $estoque, PDO::PARAM_INT);
    if (!empty($dados['id_produto'])) {
        $stmt->bindValue(':id', (int)$dados['id_produto'], PDO::PARAM_INT);
    }

    return ['success' => $stmt->execute()];
}

function deletar_produto($id) {
    $pdo = conectar();
    
    $sqlVerifica = "SELECT COUNT(*) FROM item_venda WHERE id_produto = :id";
    $stmtVerifica = $pdo->prepare($sqlVerifica);
    $stmtVerifica->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmtVerifica->execute();
    $count = $stmtVerifica->fetchColumn();
    
    if ($count > 0) {
        return false;
    }
    
    $sql = "DELETE FROM produto WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    return $stmt->execute();
}

function ajustar_estoque($id, $quantidade) {
    $produto = buscar_produto($id);
    if (!$produto) {
        return false;
    }

    $novo_estoque = (int)$produto['estoque'] + (int)$quantidade;
    if ($novo_estoque < 0) {
        return false;
    }

    $pdo = conectar();
    $sql = "UPDATE produto SET estoque = :estoque, updated_at = NOW() WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':estoque', $novo_estoque, PDO::PARAM_INT);
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    return $stmt->execute();
}
