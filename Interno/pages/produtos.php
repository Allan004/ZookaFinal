<?php
include "../../php/funcoes_ladingpage.php";
$logado = usuario_logado();
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
      <a class="nav-item active" href="#"><span>🏠</span> Início</a>
      <a class="nav-item" href="clientes_e_pets.php"><span>🐕</span> Clientes & Pets</a>
      <a class="nav-item" href="agendamento.php"><span>📅</span> Agendamento</a>
      <a class="nav-item" href="servicos.php"><span>✂️</span> Serviços</a>
      <a class="nav-item" href="produtos.php"><span>🛍️</span> Produtos</a>
      <a class="nav-item" href="estoque.php"><span>📦</span> Estoque</a>
      <a class="nav-item" href="caixa.php"><span>💰</span> Caixa</a>
    </nav>

<section class="content">

<div class="card">
<h4>Produtos</h4>

<table class="table">
<thead>
<tr>
 <th>Produto</th>
 <th>Preço</th>
 <th>Código de barras</th>
 <th>Ações</th>
</tr>
</thead>
<tbody>
<tr>
 <td>Shampoo Antipulgas</td>
 <td>R$ 29,90</td>
 <td>789456123</td>
 <td>
   <button class="btn btn-sm">Editar</button>
 </td>
</tr>
<tr>
 <td>Ração Premium</td>
 <td>R$ 189,90</td>
 <td>789999321</td>
 <td>
   <button class="btn btn-sm">Editar</button>
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
