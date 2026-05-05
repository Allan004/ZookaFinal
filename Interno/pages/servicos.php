<?php
include "../../php/funcoes_ladingpage.php";
include "../../php/servico_funcoes.php";

if (isset($_POST['logout'])) {
    logout();
    header("Location: servicos.php");
    exit;
}

$logado = usuario_logado();
$mensagens = [];
$servico_editar = null;

if (isset($_GET['editar_servico'])) {
    $servico_editar = buscar_servico((int)$_GET['editar_servico']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['salvar_servico'])) {
        $dados = [
            'id_servico' => $_POST['id_servico'] ?? null,
            'nome' => $_POST['nome'] ?? '',
            'descricao' => $_POST['descricao'] ?? '',
            'preco' => $_POST['preco'] ?? '',
        ];

        $resultado = salvar_servico($dados);
        if (!empty($resultado['success'])) {
            header('Location: servicos.php?sucesso=servico');
            exit;
        }

        $mensagens = $resultado['errors'] ?? ['Não foi possível salvar o serviço.'];
        if (!empty($dados['id_servico'])) {
            $servico_editar = buscar_servico((int)$dados['id_servico']);
        }
    }

    if (isset($_POST['deletar_servico'])) {
        if (deletar_servico((int)$_POST['id_servico'])) {
            header('Location: servicos.php?sucesso=servico');
            exit;
        }
        $mensagens = ['Não é possível excluir este serviço pois há agendamentos vinculados.'];
    }
}

$servicos = buscar_servicos();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Serviços • Zooka</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
    <form method="post">
      <button class="btn" name="logout">Sair</button>
    </form>
  </div>
</header>

<main class="layout">
    <nav>
      <a class="nav-item " href="../index.php"><span><i class="fa-solid fa-house"></i></span> Início</a>
      <a class="nav-item" href="clientes_e_pets.php"><span><i class="fa-solid fa-dog"></i></span> Clientes & Pets</a>
      <a class="nav-item" href="agendamento.php"><span><i class="fa-solid fa-calendar"></i></span> Agendamento</a>
      <a class="nav-item active" href="servicos.php"><span><i class="fa-solid fa-scissors"></i></span> Serviços</a>
      <a class="nav-item " href="produtos.php"><span><i class="fa-solid fa-bag-shopping"></i></span> Produtos</a>
      <a class="nav-item " href="estoque.php"><span><i class="fa-solid fa-boxes-stacked"></i></span> Estoque</a>
      <a class="nav-item" href="caixa.php"><span><i class="fa-solid fa-money-bill"></i></span> Caixa</a>
  
    </nav>

  <section class="content">

    <div class="card">
      <h4><?= $servico_editar ? 'Editar serviço' : 'Cadastrar serviço' ?></h4>

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
        <input type="hidden" name="id_servico" value="<?= htmlspecialchars($servico_editar['id'] ?? '') ?>">
        <div class="field">
          <label>Nome</label>
          <input type="text" name="nome" value="<?= htmlspecialchars($servico_editar['nome'] ?? '') ?>" required>
        </div>
        <div class="field">
          <label>Descrição</label>
          <input type="text" name="descricao" value="<?= htmlspecialchars($servico_editar['descricao'] ?? '') ?>" required>
        </div>
        <div class="field">
          <label>Preço</label>
          <input type="text" name="preco" value="<?= htmlspecialchars($servico_editar['preco'] ?? '') ?>" required>
        </div>
        <button class="btn btn-block" name="salvar_servico" style="margin-top:16px">
          <?= $servico_editar ? 'Atualizar serviço' : 'Salvar serviço' ?>
        </button>
      </form>
    </div>

    <div class="card">
      <h4>Serviços cadastrados</h4>

      <table class="table">
        <thead>
          <tr>
            <th>Serviço</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($servicos as $servico): ?>
          <tr>
            <td><?= htmlspecialchars($servico['nome']) ?></td>
            <td><?= htmlspecialchars($servico['descricao']) ?></td>
            <td>R$ <?= number_format($servico['preco'], 2, ',', '.') ?></td>
            <td>
              <a class="btn btn-sm" href="servicos.php?editar_servico=<?= $servico['id'] ?>">Editar</a>
              <form method="post" style="display:inline-block; margin:0;">
                <input type="hidden" name="id_servico" value="<?= $servico['id'] ?>">
                <button class="btn btn-sm danger" name="deletar_servico" type="submit">Excluir</button>
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
