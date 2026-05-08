<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'conexao.php';

function obter_id_cliente_web() {
    $idLogin = $_SESSION['usuario_id'] ?? null;
    if (!$idLogin) {
        return null;
    }

    $pdo = conectar();
    if (!$pdo) {
        return null;
    }

    $stmt = $pdo->prepare("SELECT id FROM clienteweb WHERE id_login = :id_login LIMIT 1");
    $stmt->execute([':id_login' => $idLogin]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    return $cliente['id'] ?? null;
}

function obter_endereco_cliente_web() {
    $pdo = conectar();
    if (!$pdo) {
        return null;
    }

    $idLogin = $_SESSION['usuario_id'] ?? null;
    if (!$idLogin) {
        return null;
    }

    $stmt = $pdo->prepare("SELECT rua, numero, bairro, cidade, estado, cep FROM clienteweb WHERE id_login = :id_login LIMIT 1");
    $stmt->execute([':id_login' => $idLogin]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

function atualizar_endereco_cliente_web($dados) {
    $pdo = conectar();
    if (!$pdo) {
        return false;
    }

    $idLogin = $_SESSION['usuario_id'] ?? null;
    if (!$idLogin) {
        return false;
    }

    $sql = "UPDATE clienteweb SET rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep WHERE id_login = :id_login";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':rua' => $dados['rua'] ?? '',
        ':numero' => $dados['numero'] ?? '',
        ':bairro' => $dados['bairro'] ?? '',
        ':cidade' => $dados['cidade'] ?? '',
        ':estado' => $dados['estado'] ?? '',
        ':cep' => preg_replace('/\D/', '', $dados['cep'] ?? ''),
        ':id_login' => $idLogin,
    ]);
}

function adicionar_item_carrinho($idProduto, $quantidade = 1) {
    $pdo = conectar();
    if (!$pdo) {
        return false;
    }

    $idProduto = (int) $idProduto;
    $quantidade = max(1, (int) $quantidade);

    $stmtProduto = $pdo->prepare("SELECT id FROM produto WHERE id = :id LIMIT 1");
    $stmtProduto->execute([':id' => $idProduto]);
    if (!$stmtProduto->fetch()) {
        return false;
    }

    $idCliente = obter_id_cliente_web();
    if (!$idCliente) {
        return false;
    }

    $stmt = $pdo->prepare(
        "SELECT id_carrinho, quantidade FROM carrinho WHERE id_produto = :id_produto AND id_cliente = :id_cliente AND status_carrinho = 'ativo' LIMIT 1"
    );
    $stmt->execute([':id_produto' => $idProduto, ':id_cliente' => $idCliente]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        $stmtUpdate = $pdo->prepare("UPDATE carrinho SET quantidade = quantidade + :quantidade WHERE id_carrinho = :id_carrinho");
        $stmtUpdate->execute([':quantidade' => $quantidade, ':id_carrinho' => $item['id_carrinho']]);
    } else {
        $stmtInsert = $pdo->prepare(
            "INSERT INTO carrinho (id_cliente, id_produto, quantidade, preco_unitario, status_carrinho) VALUES (:id_cliente, :id_produto, :quantidade, :preco_unitario, 'ativo')"
        );

        $stmtPreco = $pdo->prepare("SELECT preco FROM produto WHERE id = :id LIMIT 1");
        $stmtPreco->execute([':id' => $idProduto]);
        $produto = $stmtPreco->fetch(PDO::FETCH_ASSOC);
        $precoUnitario = $produto['preco'] ?? 0;

        $stmtInsert->execute([
            ':id_cliente' => $idCliente,
            ':id_produto' => $idProduto,
            ':quantidade' => $quantidade,
            ':preco_unitario' => $precoUnitario,
        ]);
    }

    return true;
}

function buscar_itens_carrinho() {
    $pdo = conectar();
    if (!$pdo) {
        return [];
    }

    $idCliente = obter_id_cliente_web();
    if (!$idCliente) {
        return [];
    }

    $sql = "SELECT c.id_carrinho, c.id_produto, c.quantidade, c.preco_unitario, p.nome, p.preco, p.descricao
            FROM carrinho c
            INNER JOIN produto p ON p.id = c.id_produto
            WHERE c.id_cliente = :id_cliente AND c.status_carrinho = 'ativo'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id_cliente' => $idCliente]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function alterar_quantidade_item_carrinho($idCarrinho, $delta) {
    $pdo = conectar();
    if (!$pdo) {
        return false;
    }

    $idCliente = obter_id_cliente_web();
    if (!$idCliente) {
        return false;
    }

    $idCarrinho = (int) $idCarrinho;
    $stmt = $pdo->prepare(
        "SELECT quantidade FROM carrinho WHERE id_carrinho = :id_carrinho AND id_cliente = :id_cliente AND status_carrinho = 'ativo' LIMIT 1"
    );
    $stmt->execute([':id_carrinho' => $idCarrinho, ':id_cliente' => $idCliente]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$item) {
        return false;
    }

    $novaQuantidade = (int) $item['quantidade'] + (int) $delta;
    if ($novaQuantidade <= 0) {
        return remover_item_carrinho($idCarrinho);
    }

    $stmtUpdate = $pdo->prepare("UPDATE carrinho SET quantidade = :quantidade WHERE id_carrinho = :id_carrinho");
    return $stmtUpdate->execute([':quantidade' => $novaQuantidade, ':id_carrinho' => $idCarrinho]);
}

function remover_item_carrinho($idCarrinho) {
    $pdo = conectar();
    if (!$pdo) {
        return false;
    }

    $idCliente = obter_id_cliente_web();
    if (!$idCliente) {
        return false;
    }

    $idCarrinho = (int) $idCarrinho;
    $stmt = $pdo->prepare(
        "DELETE FROM carrinho WHERE id_carrinho = :id_carrinho AND id_cliente = :id_cliente AND status_carrinho = 'ativo'"
    );
    return $stmt->execute([':id_carrinho' => $idCarrinho, ':id_cliente' => $idCliente]);
}

function calcular_totais_carrinho($metodoEntrega = 'padrao') {
    $itensCarrinho = buscar_itens_carrinho();
    if (empty($itensCarrinho)) {
        return null;
    }

    $subtotal = 0;
    foreach ($itensCarrinho as $item) {
        $subtotal += $item['quantidade'] * $item['preco_unitario'];
    }

    $totalDescontos = round($subtotal * 0.1, 2);
    $subtotalComDesconto = round($subtotal - $totalDescontos, 2);

    $taxaServico = 5.90;
    switch ($metodoEntrega) {
        case 'expressa':
            $frete = 10.27;
            break;
        case 'retirada':
            $frete = 0.00;
            break;
        case 'padrao':
        default:
            $frete = 5.76;
            $metodoEntrega = 'padrao';
            break;
    }

    $total = round($subtotalComDesconto + $taxaServico + $frete, 2);

    return [
        'itens' => $itensCarrinho,
        'subtotal' => $subtotal,
        'descontos' => $totalDescontos,
        'subtotal_com_desconto' => $subtotalComDesconto,
        'taxa_servico' => $taxaServico,
        'frete' => $frete,
        'metodo_entrega' => $metodoEntrega,
        'total' => $total,
    ];
}

function finalizar_pedido($metodoEntrega) {
    $pdo = conectar();
    if (!$pdo) {
        return false;
    }

    $idCliente = obter_id_cliente_web();
    if (!$idCliente) {
        return false;
    }

    $itensCarrinho = buscar_itens_carrinho();
    if (empty($itensCarrinho)) {
        return false;
    }

    $endereco = obter_endereco_cliente_web();
    if (!$endereco) {
        return false;
    }

    // Calcular totais
    $subtotal = 0;
    foreach ($itensCarrinho as $item) {
        $subtotal += $item['quantidade'] * $item['preco_unitario'];
    }

    $totalDescontos = round($subtotal * 0.1, 2);
    $subtotalComDesconto = round($subtotal - $totalDescontos, 2);
    $taxaServico = 5.90;

    switch ($metodoEntrega) {
        case 'expressa':
            $frete = 10.27;
            break;
        case 'retirada':
            $frete = 0.00;
            break;
        case 'padrao':
        default:
            $frete = 5.76;
            $metodoEntrega = 'padrao';
            break;
    }

    $total = round($subtotalComDesconto + $taxaServico + $frete, 2);

    // Inserir pedido
    $sqlPedido = "INSERT INTO pedido_web (id_clienteweb, metodo_entrega, taxa_servico, frete, subtotal, total_descontos, total, rua, numero, bairro, cidade, estado, cep) 
                  VALUES (:id_clienteweb, :metodo_entrega, :taxa_servico, :frete, :subtotal, :total_descontos, :total, :rua, :numero, :bairro, :cidade, :estado, :cep)";
    $stmtPedido = $pdo->prepare($sqlPedido);
    $stmtPedido->execute([
        ':id_clienteweb' => $idCliente,
        ':metodo_entrega' => $metodoEntrega,
        ':taxa_servico' => $taxaServico,
        ':frete' => $frete,
        ':subtotal' => $subtotal,
        ':total_descontos' => $totalDescontos,
        ':total' => $total,
        ':rua' => $endereco['rua'],
        ':numero' => $endereco['numero'],
        ':bairro' => $endereco['bairro'],
        ':cidade' => $endereco['cidade'],
        ':estado' => $endereco['estado'],
        ':cep' => $endereco['cep'],
    ]);

    $idPedido = $pdo->lastInsertId();

    // Inserir itens
    $sqlItem = "INSERT INTO pedido_web_item (id_pedido_web, id_produto, quantidade, preco_unitario, total_item) 
                VALUES (:id_pedido_web, :id_produto, :quantidade, :preco_unitario, :total_item)";
    $stmtItem = $pdo->prepare($sqlItem);
    foreach ($itensCarrinho as $item) {
        $totalItem = $item['quantidade'] * $item['preco_unitario'];
        $stmtItem->execute([
            ':id_pedido_web' => $idPedido,
            ':id_produto' => $item['id_produto'],
            ':quantidade' => $item['quantidade'],
            ':preco_unitario' => $item['preco_unitario'],
            ':total_item' => $totalItem,
        ]);
    }

    // Limpar carrinho
    $stmtLimpar = $pdo->prepare("DELETE FROM carrinho WHERE id_cliente = :id_cliente AND status_carrinho = 'ativo'");
    $stmtLimpar->execute([':id_cliente' => $idCliente]);

    return $idPedido;
}
