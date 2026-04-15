<?php
include "../../php/funcoes_ladingpage.php";
include "../../php/produto_funcoes.php";

if (isset($_POST['logout'])) {
    logout();
    header('Location: estoque.php');
    exit;
}

$logado = usuario_logado();
$mensagens = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajustar_estoque'])) {
    $id_produto = (int)($_POST['id_produto'] ?? 0);
    $quantidade = (int)($_POST['quantidade'] ?? 0);
    $acao = $_POST['acao'] ?? '';

    if ($quantidade <= 0 || $id_produto <= 0) {
        $mensagens[] = 'Informe um produto válido e quantidade maior que zero.';
    } else {
        $total = $acao === 'entrada' ? $quantidade : -$quantidade;
        $resultado = ajustar_estoque($id_produto, $total);
        if ($resultado) {
            header('Location: estoque.php?sucesso=estoque');
            exit;
        }
        $mensagens[] = 'Erro ao atualizar estoque. Verifique os valores e tente novamente.';
    }
}

$produtos = buscar_produtos();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Estoque • Zooka</title>
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
      <a class="nav-item " href="../index.php"><span>🏠</span> Início</a>
      <a class="nav-item" href="clientes_e_pets.php"><span>🐕</span> Clientes & Pets</a>
      <a class="nav-item" href="agendamento.php"><span>📅</span> Agendamento</a>
      <a class="nav-item" href="servicos.php"><span>✂️</span> Serviços</a>
      <a class="nav-item" href="produtos.php"><span>🛍️</span> Produtos</a>
      <a class="nav-item active" href="estoque.php"><span>📦</span> Estoque</a>
      <a class="nav-item" href="caixa.php"><span>💰</span> Caixa</a>
    </nav>

<section class="content">

<div class="card">
  <h4>Controle de estoque</h4>

  <?php if (!empty($mensagens)): ?>
  <div class="alert alert-danger">
    <ul>
      <?php foreach ($mensagens as $mensagem): ?>
        <li><?= htmlspecialchars($mensagem) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endif; ?>

  <table class="table">
    <thead>
      <tr>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Status</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($produtos as $produto): ?>
      <tr>
        <td><?= htmlspecialchars($produto['nome']) ?></td>
        <td><?= (int)$produto['estoque'] ?></td>
        <td>
          <?php if ((int)$produto['estoque'] <= 5): ?>
            <span class="badge warn">Baixo</span>
          <?php else: ?>
            <span class="badge">OK</span>
          <?php endif; ?>
        </td>
        <td>
          <form method="post" style="display:inline-block; margin:0 8px 0 0;">
            <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>">
            <input type="hidden" name="acao" value="entrada">
            <input type="number" name="quantidade" value="1" min="1" style="width:60px; display:inline-block; margin-right:4px;">
            <button class="btn btn-sm" name="ajustar_estoque" type="submit">Entrada</button>
          </form>
          <form method="post" style="display:inline-block; margin:0;">
            <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>">
            <input type="hidden" name="acao" value="saida">
            <input type="number" name="quantidade" value="1" min="1" style="width:60px; display:inline-block; margin-right:4px;">
            <button class="btn btn-sm danger" name="ajustar_estoque" type="submit">Saída</button>
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