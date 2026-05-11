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
    'codigo_produto' => $_POST['codigo_produto'] ?? '',
    'filtros_produto' => $_POST['filtros_produto'] ?? '',
    'Imagens' => $_POST['Imagens'] ?? ''
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produtos • Zooka</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<div id="conteudo" class="<?= !$logado ? 'blur' : '' ?>">

<header>
    <div class="brand">
        <div class="logo">
            <img src="../Assets/logo_ico.png" class="imagel" alt="">
        </div>
        <div>Zooka • Sistema Interno</div>
    </div>

    <div class="user-area">
        <?php if ($logado): ?>
            <span>Olá, <?= htmlspecialchars($_SESSION['usuario']) ?></span>

            <form method="post" class="form-reset">
                <button type="submit" name="logout" class="btn">Sair</button>
            </form>

        <?php else: ?>
            <span>Olá, visitante</span>
        <?php endif; ?>
    </div>
</header>

<main class="layout">

<nav>
    <a class="nav-item" href="../index.php"><span><i class="fa-solid fa-house"></i></span> Início</a>
    <a class="nav-item" href="clientes_e_pets.php"><span><i class="fa-solid fa-dog"></i></span> Clientes & Pets</a>
    <a class="nav-item" href="agendamento.php"><span><i class="fa-solid fa-calendar"></i></span> Agendamento</a>
    <a class="nav-item" href="servicos.php"><span><i class="fa-solid fa-scissors"></i></span> Serviços</a>
    <a class="nav-item active" href="produtos.php"><span><i class="fa-solid fa-bag-shopping"></i></span> Produtos</a>
    <a class="nav-item" href="estoque.php"><span><i class="fa-solid fa-boxes-stacked"></i></span> Estoque</a>
    <a class="nav-item" href="caixa.php"><span><i class="fa-solid fa-money-bill"></i></span> Caixa</a>
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
      <input type="text" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? ($produto_editar['nome'] ?? '')) ?>" required>
    </div>

    <div class="field">
      <label>Descrição</label>
      <input type="text" name="descricao" value="<?= htmlspecialchars($_POST['descricao'] ?? ($produto_editar['descricao'] ?? '')) ?>" required>
    </div>

    <div class="field">
      <label>Preço</label>
      <input type="text" name="preco" value="<?= htmlspecialchars($_POST['preco'] ?? ($produto_editar['preco'] ?? '')) ?>" required>
    </div>

    <div class="field">
      <label>Estoque</label>
      <input type="number" name="estoque" value="<?= htmlspecialchars($_POST['estoque'] ?? ($produto_editar['estoque'] ?? 0)) ?>" min="0" required>
    </div>

    <div class="field">
      <label>Código do Produto</label>
      <input type="text" name="codigo_produto" value="<?= htmlspecialchars($_POST['codigo_produto'] ?? ($produto_editar['codigo_produto'] ?? '')) ?>" required>
    </div>

    <div class="field">
      <label>Filtros do Produto</label>
      <input type="text" name="filtros_produto" value="<?= htmlspecialchars($_POST['filtros_produto'] ?? ($produto_editar['filtros_produto'] ?? '')) ?>" required>
    </div>

    <div class="field">
      <label>Imagem (URL ou caminho)</label>
      <input type="text" name="Imagens" value="<?= htmlspecialchars($_POST['Imagens'] ?? ($produto_editar['Imagens'] ?? '')) ?>" required>
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
                                <button class="btn btn-sm danger" name="deletar_produto" type="submit">
                                    Excluir
                                </button>
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

<?php if (!$logado): ?>
<div class="login-overlay">
    <form method="post" action="/ZookaFinal/php/login.php">

        <div class="login-brand">
            <div class="logo logo--primary">Z</div>
            <div>
                <strong>Zooka</strong>
                <div class="muted">Sistema Interno</div>
            </div>
        </div>

        <h2>Acesso ao sistema</h2>

        <div class="field">
            <label>Usuário</label>
            <input type="text" name="usuario" required>
        </div>

        <div class="field">
            <label>Senha</label>
            <input type="password" name="senha" required>
        </div>

        <button class="btn btn-block">Entrar</button>

        <?php if (isset($_GET['erro'])): ?>
            <div class="login-error">
                Usuário ou senha inválidos
            </div>
        <?php endif; ?>

    </form>
</div>
<?php endif; ?>

</body>
</html>