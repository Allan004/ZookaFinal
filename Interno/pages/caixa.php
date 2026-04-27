<?php
include "../../php/funcoes_ladingpage.php";
include "../../php/produto_funcoes.php";
include "../../php/servico_funcoes.php";
include "../../php/caixa_funcoes.php";

if (isset($_POST['logout'])) {
    logout();
    header('Location: caixa.php');
    exit;
}

$logado = usuario_logado();
$mensagens = [];
$sucesso = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao']) && $_POST['acao'] === 'adicionar_produto') {
        $id_produto = (int)($_POST['id_produto'] ?? 0);
        $quantidade = max(1, (int)($_POST['quantidade'] ?? 1));
        $produto = buscar_produto($id_produto);

        if (!$produto) {
            $mensagens[] = 'Produto não encontrado.';
        } elseif ($quantidade > (int)$produto['estoque']) {
            $mensagens[] = 'Não há estoque suficiente para este produto.';
        } else {
            adicionar_item_venda_sessao([
                'tipo' => 'produto',
                'id_produto' => $produto['id'],
                'nome' => $produto['nome'],
                'quantidade' => $quantidade,
                'preco' => $produto['preco'],
            ]);
            header('Location: caixa.php?sucesso=produto');
            exit;
        }
    }

    if (isset($_POST['acao']) && $_POST['acao'] === 'adicionar_produto_codigo') {
        $codigo_produto = trim($_POST['codigo_produto'] ?? '');
        $produto = buscar_produto_por_codigo($codigo_produto);
        $quantidade = 1;

        if (empty($codigo_produto)) {
            $mensagens[] = 'Informe o código do produto.';
        } elseif (!$produto) {
            $mensagens[] = 'Produto não encontrado para o código informado.';
        } elseif ($quantidade > (int)$produto['estoque']) {
            $mensagens[] = 'Não há estoque suficiente para este produto.';
        } else {
            adicionar_item_venda_sessao([
                'tipo' => 'produto',
                'id_produto' => $produto['id'],
                'nome' => $produto['nome'],
                'quantidade' => $quantidade,
                'preco' => $produto['preco'],
            ]);
            header('Location: caixa.php?sucesso=produto');
            exit;
        }
    }

    if (isset($_POST['acao']) && $_POST['acao'] === 'adicionar_servico') {
        $id_servico = (int)($_POST['id_servico'] ?? 0);
        $quantidade = max(1, (int)($_POST['quantidade'] ?? 1));
        $servico = buscar_servico($id_servico);

        if (!$servico) {
            $mensagens[] = 'Serviço não encontrado.';
        } else {
            adicionar_item_venda_sessao([
                'tipo' => 'servico',
                'id_servico' => $servico['id'],
                'nome' => $servico['nome'],
                'quantidade' => $quantidade,
                'preco' => $servico['preco'],
            ]);
            header('Location: caixa.php?sucesso=servico');
            exit;
        }
    }

    if (isset($_POST['acao']) && $_POST['acao'] === 'remover_item') {
        $indice = (int)($_POST['indice'] ?? -1);
        remover_item_venda_sessao($indice);
        header('Location: caixa.php?sucesso=removido');
        exit;
    }

    if (isset($_POST['acao']) && $_POST['acao'] === 'finalizar_venda') {
        $id_cliente = (int)($_POST['id_cliente'] ?? 0);
        $cliente = buscar_cliente($id_cliente);
        $carrinho = buscar_itens_venda_sessao();

        if (!$cliente) {
            $mensagens[] = 'Selecione um cliente para finalizar a venda.';
        } elseif (empty($carrinho)) {
            $mensagens[] = 'Adicione itens ao caixa antes de finalizar a venda.';
        } else {
            $resultado = criar_venda($id_cliente, $carrinho);
            if (!empty($resultado['success'])) {
                header('Location: caixa.php?sucesso=venda');
                exit;
            }
            $mensagens = $resultado['errors'] ?? ['Erro ao finalizar venda. Verifique o estoque e tente novamente.'];
        }
    }
}

$produtos = buscar_produtos();
$servicos = buscar_servicos();
$clientes = buscar_clientes();
$carrinho = buscar_itens_venda_sessao();
$total = 0;
foreach ($carrinho as $item) {
    $total += $item['preco'] * $item['quantidade'];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Caixa • Zooka</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div id="conteudo" class="<?= !$logado ? 'blur' : '' ?>">
<header>
<div class="brand">
<div class="logo"><img src="../Assets/logo_ico.png" class="imagel" alt=""></div>
<div>Zooka • Sistema Interno</div>
</div>
<div class="user-area">
<span>Olá, <?= $_SESSION['usuario'] ?></span>
<form method="post"><button class="btn" name="logout">Sair</button></form>
</div>
</header>

<main class="layout">

 <nav>
      <a class="nav-item" href="../index.php"><span>🏠</span> Início</a>
      <a class="nav-item" href="clientes_e_pets.php"><span>🐕</span> Clientes & Pets</a>
      <a class="nav-item" href="agendamento.php"><span>📅</span> Agendamento</a>
      <a class="nav-item" href="servicos.php"><span>✂️</span> Serviços</a>
      <a class="nav-item" href="produtos.php"><span>🛍️</span> Produtos</a>
      <a class="nav-item" href="estoque.php"><span>📦</span> Estoque</a>
      <a class="nav-item active" href="caixa.php"><span>💰</span> Caixa</a>
    </nav>

<section class="content">

<?php if (!empty($mensagens)): ?>
<div class="alert alert-danger">
<ul>
<?php foreach ($mensagens as $mensagem): ?>
<li><?= htmlspecialchars($mensagem) ?></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>

<div class="two-col">

<div class="card">
<h4>Adicionar produto</h4>
<form method="post">
  <input type="hidden" name="acao" value="adicionar_produto">
  <div class="field">
    <label>Produto</label>
    <select name="id_produto" required>
      <option value="">Selecione um produto</option>
      <?php foreach ($produtos as $produto): ?>
        <option value="<?= $produto['id'] ?>"><?= htmlspecialchars($produto['nome']) ?> (R$ <?= number_format($produto['preco'],2,',','.') ?>)</option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="field">
    <label>Quantidade</label>
    <input type="number" name="quantidade" value="1" min="1" required>
  </div>
  <button class="btn btn-block" type="submit">Adicionar produto</button>
</form>
</div>

<div class="card">
<h4>Adicionar por código</h4>
<form method="post" id="scannerCodigoForm">
  <input type="hidden" name="acao" value="adicionar_produto_codigo">
  <div class="field">
    <label>Código do produto</label>
    <input type="text" name="codigo_produto" id="codigoProdutoScanner" autocomplete="off" autofocus required>
  </div>
  <button class="btn btn-block" type="submit">Adicionar</button>
</form>
</div>

<div class="card">
<h4>Adicionar serviço</h4>
<form method="post">
  <input type="hidden" name="acao" value="adicionar_servico">
  <div class="field">
    <label>Serviço</label>
    <select name="id_servico" required>
      <option value="">Selecione um serviço</option>
      <?php foreach ($servicos as $servico): ?>
        <option value="<?= $servico['id'] ?>"><?= htmlspecialchars($servico['nome']) ?> (R$ <?= number_format($servico['preco'],2,',','.') ?>)</option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="field">
    <label>Quantidade</label>
    <input type="number" name="quantidade" value="1" min="1" required>
  </div>
  <button class="btn btn-block" type="submit">Adicionar serviço</button>
</form>
</div>

<div class="card">
<h4>Venda atual</h4>
<?php if (empty($carrinho)): ?>
  <p>Nenhum item adicionado.</p>
<?php else: ?>
  <table class="table">
    <thead>
      <tr>
        <th>Item</th>
        <th>Qtd</th>
        <th>Valor</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($carrinho as $indice => $item): ?>
        <tr>
          <td><?= htmlspecialchars($item['nome']) ?> <?= $item['tipo'] === 'servico' ? '(Serviço)' : '' ?></td>
          <td><?= (int)$item['quantidade'] ?></td>
          <td>R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?></td>
          <td>
            <form method="post" style="display:inline-block; margin:0;">
              <input type="hidden" name="acao" value="remover_item">
              <input type="hidden" name="indice" value="<?= $indice ?>">
              <button class="btn btn-sm danger" type="submit">Remover</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <h3 style="margin-top:16px">Total: R$ <?= number_format($total, 2, ',', '.') ?></h3>
  <form method="post">
    <input type="hidden" name="acao" value="finalizar_venda">
    <div class="field">
      <label>Cliente</label>
      <select name="id_cliente" required>
        <option value="">Selecione um cliente</option>
        <?php foreach ($clientes as $cliente): ?>
          <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nome']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <button class="btn btn-block" type="submit">Finalizar venda</button>
  </form>
<?php endif; ?>
</div>

</div>

</section>
</main>
</div>
</body>
</html>
