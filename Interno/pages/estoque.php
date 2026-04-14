<?php
include "../../php/funcoes_ladingpage.php";
$logado = usuario_logado();
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
    <div class="logo">
      <img src="../Assets/logo_ico.png" class="imagel" alt="">
    </div>
    <div>Zooka • Sistema Interno</div>
  </div>
  <div class="user-area">
    <span>Olá, <?= $_SESSION['usuario'] ?></span>
    <form method="post"><button class="btn">Sair</button></form>
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
<tr>
  <td>Shampoo Pet</td>
  <td>5</td>
  <td><span class="badge warn">Baixo</span></td>
  <td>
    <button class="btn btn-sm">Entrada</button>
    <button class="btn btn-sm danger">Saída</button>
  </td>
</tr>
<tr>
  <td>Ração Premium</td>
  <td>32</td>
  <td><span class="badge">OK</span></td>
  <td>
    <button class="btn btn-sm">Entrada</button>
    <button class="btn btn-sm danger">Saída</button>
  </td>
</tr>
</tbody>
</table>

</div>
</section>
</main>
</div>
</body>
</html>