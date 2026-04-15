<?php
require_once "conexao.php";

function buscar_clientes() {
    $pdo = conectar();
    $sql = "SELECT id, nome FROM cliente ORDER BY nome";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscar_cliente($id) {
    $pdo = conectar();
    $sql = "SELECT id, nome FROM cliente WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function buscar_itens_venda_sessao() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return $_SESSION['caixa_itens'] ?? [];
}

function adicionar_item_venda_sessao($item) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['caixa_itens'])) {
        $_SESSION['caixa_itens'] = [];
    }

    $_SESSION['caixa_itens'][] = $item;
}

function remover_item_venda_sessao($indice) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['caixa_itens'][$indice])) {
        unset($_SESSION['caixa_itens'][$indice]);
        $_SESSION['caixa_itens'] = array_values($_SESSION['caixa_itens']);
    }
}

function limpar_caixa_sessao() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    unset($_SESSION['caixa_itens']);
}

function calcular_total_caixa() {
    $itens = buscar_itens_venda_sessao();
    $total = 0;
    foreach ($itens as $item) {
        $total += ($item['preco'] * $item['quantidade']);
    }
    return $total;
}

function criar_venda($id_cliente, $itens) {
    if (empty($itens) || empty($id_cliente)) {
        return ['success' => false, 'errors' => ['Selecione um cliente e adicione itens à venda.']];
    }

    $pdo = conectar();
    try {
        $pdo->beginTransaction();

        $total = 0;
        foreach ($itens as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        $sqlVenda = "INSERT INTO venda (id_cliente, data_venda, total, status) VALUES (:id_cliente, :data_venda, :total, 'CONCLUIDA')";
        $stmtVenda = $pdo->prepare($sqlVenda);
        $stmtVenda->bindValue(':id_cliente', (int)$id_cliente, PDO::PARAM_INT);
        $stmtVenda->bindValue(':data_venda', date('Y-m-d H:i:s'));
        $stmtVenda->bindValue(':total', number_format($total, 2, '.', ''));
        $stmtVenda->execute();
        $id_venda = $pdo->lastInsertId();

        foreach ($itens as $item) {
            $sqlItem = "INSERT INTO item_venda (id_venda, id_produto, id_servico, quantidade, preco_unitario) VALUES (:id_venda, :id_produto, :id_servico, :quantidade, :preco_unitario)";
            $stmtItem = $pdo->prepare($sqlItem);
            $stmtItem->bindValue(':id_venda', (int)$id_venda, PDO::PARAM_INT);
            $stmtItem->bindValue(':id_produto', isset($item['id_produto']) ? (int)$item['id_produto'] : null, PDO::PARAM_INT);
            $stmtItem->bindValue(':id_servico', isset($item['id_servico']) ? (int)$item['id_servico'] : null, PDO::PARAM_INT);
            $stmtItem->bindValue(':quantidade', (int)$item['quantidade'], PDO::PARAM_INT);
            $stmtItem->bindValue(':preco_unitario', number_format($item['preco'], 2, '.', ''));
            $stmtItem->execute();

            if (!empty($item['id_produto'])) {
                $sqlEstoque = "UPDATE produto SET estoque = estoque - :quantidade, updated_at = NOW() WHERE id = :id";
                $stmtEstoque = $pdo->prepare($sqlEstoque);
                $stmtEstoque->bindValue(':quantidade', (int)$item['quantidade'], PDO::PARAM_INT);
                $stmtEstoque->bindValue(':id', (int)$item['id_produto'], PDO::PARAM_INT);
                $stmtEstoque->execute();
            }
        }

        $pdo->commit();
        limpar_caixa_sessao();
        return ['success' => true];
    } catch (PDOException $e) {
        $pdo->rollBack();
        error_log($e->getMessage());
        return ['success' => false, 'errors' => ['Erro ao registrar a venda.']];
    }
}
