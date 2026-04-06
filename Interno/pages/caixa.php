<?php
include "../../php/funcoes_ladingpage.php";
$logado = usuario_logado();
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

<div class="two-col">

<div class="card">
<h4>Entrada de itens</h4>

<div class="field">
<label>Produto / Serviço</label>
<input type="text" placeholder="Código de barras ou nome">
</div>

<button class="btn btn-block">Adicionar</button>
</div>

<div class="card">
<h4>Venda atual</h4>

<table class="table">
<thead>
<tr>
 <th>Item</th>
 <th>Valor</th>
</tr>
</thead>
<tbody>
<tr>
 <td>Banho + Tosa</td>
 <td>R$ 120,00</td>
</tr>
<tr>
 <td>Shampoo</td>
 <td>R$ 29,90</td>
</tr>
</tbody>
</table>

<h3 style="margin-top:16px">Total: R$ 149,90</h3>

<button class="btn btn-block" style="margin-top:12px">
Finalizar venda
</button>

</div>

</div>

</section>
</main>
</div>
</body>
</html>
