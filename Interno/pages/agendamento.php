<?php
include "../../php/funcoes_ladingpage.php";

if (isset($_POST['logout'])) {
    logout();
    header("Location: agendamento.php");
    exit;
}

$logado = usuario_logado();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Agendamento • Zooka</title>
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
    <form method="post" style="margin:0">
      <button class="btn" name="logout">Sair</button>
    </form>
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

    <!-- NOVO AGENDAMENTO -->
    <div class="card">
      <h4>Novo agendamento</h4>

      <div class="two-col">

        <div class="field">
          <label>Pet</label>
          <select>
            <option>Selecione o pet</option>
            <option>Rex</option>
            <option>Mel</option>
          </select>
        </div>

        <div class="field">
          <label>Serviço</label>
          <select>
            <option>Selecione o serviço</option>
            <option>Banho</option>
            <option>Tosa</option>
          </select>
        </div>

        <div class="field">
          <label>Funcionário</label>
          <select>
            <option>Selecione</option>
            <option>João</option>
            <option>Maria</option>
          </select>
        </div>

        <div class="field">
          <label>Data</label>
          <input type="date">
        </div>

        <div class="field">
          <label>Hora</label>
          <input type="time">
        </div>

        <div class="field">
          <label>Status</label>
          <select>
            <option>Agendado</option>
            <option>Confirmado</option>
            <option>Concluído</option>
            <option>Cancelado</option>
          </select>
        </div>

      </div>

      <button class="btn btn-block" style="margin-top:16px">
        Salvar agendamento
      </button>
    </div>

    <!-- LISTA DE AGENDAMENTOS -->
    <div class="card">
      <h4>Agendamentos</h4>

      <table class="table">
        <thead>
          <tr>
            <th>Pet</th>
            <th>Serviço</th>
            <th>Funcionário</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Rex</td>
            <td>Banho</td>
            <td>João</td>
            <td>30/03/2026</td>
            <td>14:00</td>
            <td><span class="badge warn">Agendado</span></td>
            <td>
              <button class="btn btn-sm">Editar</button>
              <button class="btn btn-sm danger">Excluir</button>
            </td>
          </tr>

          <tr>
            <td>Mel</td>
            <td>Tosa</td>
            <td>Maria</td>
            <td>30/03/2026</td>
            <td>16:00</td>
            <td><span class="badge">Confirmado</span></td>
            <td>
              <button class="btn btn-sm">Editar</button>
              <button class="btn btn-sm danger">Excluir</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </section>
</main>
</div>

<?php if (!$logado): ?>
<div class="login-overlay">
  <form method="post" action="/ZookaFinal/php/login.php">
    <h2>Acesso ao sistema</h2>
    <div class="field">
      <label>Usuário</label>
      <input type="text" name="usuario">
    </div>
    <div class="field">
      <label>Senha</label>
      <input type="password" name="senha">
    </div>
    <button class="btn btn-block">Entrar</button>
  </form>
</div>
<?php endif; ?>

</body>
</html>
``