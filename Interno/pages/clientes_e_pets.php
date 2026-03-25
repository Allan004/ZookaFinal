<?php
include "../../php/funcoes_ladingpage.php";


if (isset($_POST['logout'])) {
    logout();
    header("Location: clientes_e_pets.php");
    exit;
}

$logado = usuario_logado();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Zooka - Dashboard Essencial</title>
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
      <span>Olá, <?php echo $_SESSION['usuario'] ?></span>
      
<form method="post" style="margin:0">
    <button name="logout" class="btn">Sair</button>
</form>

    
    </div>
  </header>

  <main class="layout">
    <nav>
      <a class="nav-item" href="../index.php"><span>🏠</span> Início</a>
      <a class="nav-item active" href="#"><span>🐕</span> Clientes & Pets</a>
      <a class="nav-item" href="pages/agendamento.php"><span>📅</span> Agendamento</a>
      <a class="nav-item" href="#"><span>✂️</span> Serviços</a>
      <a class="nav-item" href="#"><span>🛍️</span> Produtos</a>
      <a class="nav-item" href="#"><span>📦</span> Estoque</a>
      <a class="nav-item" href="#"><span>💰</span> Caixa</a>
    </nav>

    <section class="content2">
      <div class="cards2">
        <div class="card2">
          <h4>Pesquisar Cliente</h4>
          <div class="value"><input type="text" id="buscaCliente"></div>
        </div>
        <div class="card2">
          <h4>Pesquisar Pet</h4>
          <div class="value"><input type="text" id="buscaPet"></div>
        </div>
      </div>

      <div class="two-col">
        <div class="list">
          <h3>Clientes</h3>
         <div id="resultadoClientes"></div>
         <p class="muted">Digite para Encontrar</p>
        </div>
        <div class="list">
          <h3>Pets</h3>
         <div id="resultadoPets"></div>
         <p class="muted">Digite para Encontrar</p>
        </div>
      </div>
</div>
      

<?php if (!$logado): ?>
<div class="login-overlay">
  <form method="post" action="/ZookaFinal/php/login.php">
        
        <div class="login-brand">
            <div class="logo" style="background:var(--primary)">Z</div>
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
            <div class="login-error">Usuário ou senha inválidos</div>
        <?php endif; ?>
    </form>
</div>
<?php endif; ?>
    </section>
  </main>
  <script src="../js/script.js"></script>
</body>
</html>