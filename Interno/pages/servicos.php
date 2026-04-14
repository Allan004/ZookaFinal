<?php
include "../../php/funcoes_ladingpage.php";

if (isset($_POST['logout'])) {
    logout();
    header("Location: servicos.php");
    exit;
}

$logado = usuario_logado();

/* 🔧 Simulação – depois você liga no banco */
$servicos = [
    ['id'=>1, 'nome'=>'Banho', 'preco'=>'R$ 50,00', 'duracao'=>'40 min'],
    ['id'=>2, 'nome'=>'Tosa', 'preco'=>'R$ 70,00', 'duracao'=>'60 min'],
    ['id'=>3, 'nome'=>'Banho + Tosa', 'preco'=>'R$ 110,00', 'duracao'=>'90 min'],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Serviços • Zooka</title>
  <link rel="stylesheet" href="../css/style.css">
  
  
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
    <span>Olá, <?= $_SESSION['usuario'] ?></span>
    <form method="post">
      <button class="btn" name="logout">Sair</button>
    </form>
  </div>
</header>

<main class="layout">
    <nav>
      <a class="nav-item " href="../index.php"><span>🏠</span> Início</a>
      <a class="nav-item" href="clientes_e_pets.php"><span>🐕</span> Clientes & Pets</a>
      <a class="nav-item" href="agendamento.php"><span>📅</span> Agendamento</a>
      <a class="nav-item active" href="servicos.php"><span>✂️</span> Serviços</a>
      <a class="nav-item" href="produtos.php"><span>🛍️</span> Produtos</a>
      <a class="nav-item" href="estoque.php"><span>📦</span> Estoque</a>
      <a class="nav-item" href="caixa.php"><span>💰</span> Caixa</a>
    </nav>

  <section class="content">

    <div class="card">
      <h4>Serviços cadastrados</h4>

      <table class="table">
        <thead>
          <tr>
            <th>Serviço</th>
            <th>Duração</th>
            <th>Preço</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody>
        <?php foreach($servicos as $s): ?>
          <tr>
            <td><?= $s['nome'] ?></td>
            <td><?= $s['duracao'] ?></td>
            <td><?= $s['preco'] ?></td>
            <td>
              <button class="btn btn-sm">Editar</button>
              <button class="btn btn-sm danger">Excluir</button>
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