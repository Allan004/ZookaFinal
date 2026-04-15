<?php
include "../../php/funcoes_ladingpage.php";
include "../../php/produto_funcoes.php";

if (isset($_POST['logout'])) {
    logout();
    header('Location: produtos.php');
    exit;
}

$logado = usuario_logado();
$mensagens = [];
$produto_editar = null;

if (isset($_GET['editar_produto'])) {
    $produto_editar = buscar_produto((int)$_GET['editar_produto']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['salvar_produto'])) {
        $dados = [
            'id_produto' => $_POST['id_produto'] ?? null,
            'nome' => $_POST['nome'] ?? '',
            'descricao' => $_POST['descricao'] ?? '',
            'preco' => $_POST['preco'] ?? '',
            'estoque' => $_POST['estoque'] ?? 0,
        ];

        $resultado = salvar_produto($dados);
        if (!empty($resultado['success'])) {
            header('Location: produtos.php?sucesso=produto');
            exit;
        }

        $mensagens = $resultado['errors'] ?? ['Não foi possível salvar o produto.'];
        if (!empty($dados['id_produto'])) {
            $produto_editar = buscar_produto((int)$dados['id_produto']);
        }
    }

    if (isset($_POST['deletar_produto'])) {
        if (deletar_produto((int)$_POST['id_produto'])) {
            header('Location: produtos.php?sucesso=produto');
            exit;
        }
        $mensagens = ['Não é possível excluir este produto pois há vendas vinculadas.'];
    }
}

$produtos = buscar_produtos();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Produtos • Zooka</title>
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
  <form method="post"><button class="btn">Sair</button></form>
</div>
</header>

<main class="layout">
 <nav>
      <a class="nav-item" href="../index.php"><span>🏠</span> Início</a>
      <a class="nav-item" href="clientes_e_pets.php"><span>🐕</span> Clientes & Pets</a>
      <a class="nav-item" href="agendamento.php"><span>📅</span> Agendamento</a>
      <a class="nav-item" href="servicos.php"><span>✂️</span> Serviços</a>
      <a class="nav-item active" href="produtos.php"><span>🛍️</span> Produtos</a>
      <a class="nav-item" href="estoque.php"><span>📦</span> Estoque</a>
      <a class="nav-item" href="caixa.php"><span>💰</span> Caixa</a>
    </nav>

<section class="content">

<div class="card">
  <h4><?= $produto_editar ? 'Editar produto' : 'Cadastrar produto' ?></h4>

  <?php if (!empty($mensagens)): ?>
  <div class="alert alert-danger">
    <ul>
      <?php foreach ($mensagens as $mensagem): ?>
        <li><?= htmlspecialchars($mensagem) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endif; ?>

  <form method="post">
    <input type="hidden" name="id_produto" value="<?= htmlspecialchars($produto_editar['id'] ?? '') ?>">
    <div class="field">
      <label>Nome</label>
      <input type="text" name="nome" value="<?= htmlspecialchars($produto_editar['nome'] ?? '') ?>" required>
    </div>
    <div class="field">
      <label>Descrição</label>
      <input type="text" name="descricao" value="<?= htmlspecialchars($produto_editar['descricao'] ?? '') ?>" required>
    </div>
    <div class="field">
      <label>Preço</label>
      <input type="text" name="preco" value="<?= htmlspecialchars($produto_editar['preco'] ?? '') ?>" required>
    </div>
    <div class="field">
      <label>Estoque</label>
      <input type="number" name="estoque" value="<?= htmlspecialchars($produto_editar['estoque'] ?? 0) ?>" min="0" required>
    </div>
    <button class="btn btn-block" name="salvar_produto" style="margin-top:16px">
      <?= $produto_editar ? 'Atualizar produto' : 'Salvar produto' ?>
    </button>
  </form>
</div>

<div class="card">
  <h4>Produtos cadastrados</h4>
  <table class="table">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Preço</th>
        <th>Estoque</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($produtos as $produto): ?>
        <tr>
          <td><?= htmlspecialchars($produto['nome']) ?></td>
          <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
          <td><?= (int)$produto['estoque'] ?></td>
          <td>
            <a class="btn btn-sm" href="produtos.php?editar_produto=<?= $produto['id'] ?>">Editar</a>
            <form method="post" style="display:inline-block; margin:0;">
              <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>">
              <button class="btn btn-sm danger" name="deletar_produto" type="submit">Excluir</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

</section>
</main>
</div>
</body>
</html>
