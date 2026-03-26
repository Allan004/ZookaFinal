<?php
include "../php/funcoes_ladingpage.php";


if (isset($_POST['logout'])) {
    logout();
    header("Location: index.php");
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
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php

        
        $baixo_estoque=verifica_baixo_estoque();
        $agenda_hoje=agenda_hoje();
        $faturamento=faturamentoh();
        $lista_agenda_hoje= listar_proximos_atendimentos();
        $listar_ultimos_atendimentos=listar_ultimos_clientes();
        $agenda_pendente=agenda_pendente();
    ?>
<div id="conteudo" class="<?= !$logado ? 'blur' : '' ?>">
  <header>
    
    <div class="brand">
      <div class="logo"><img src="Assets/logo_ico.png" class="imagel" alt=""></div>
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
      <a class="nav-item active" href="#"><span>🏠</span> Início</a>
      <a class="nav-item" href="pages/clientes_e_pets.php"><span>🐕</span> Clientes & Pets</a>
      <a class="nav-item" href="pages/agendamento.php"><span>📅</span> Agendamento</a>
      <a class="nav-item" href="#"><span>✂️</span> Serviços</a>
      <a class="nav-item" href="#"><span>🛍️</span> Produtos</a>
      <a class="nav-item" href="#"><span>📦</span> Estoque</a>
      <a class="nav-item" href="#"><span>💰</span> Caixa</a>
    </nav>

    <section class="content">
      <div class="cards">
        <div class="card">
          <h4>Atendimentos do dia</h4>
          <div class="value"><?php echo $agenda_hoje; ?></div>
        </div>
        <div class="card">
          <h4>Agendamentos pendentes</h4>
          <div class="value"><?php echo $agenda_pendente ?></div>
        </div>
        <div class="card">
          <h4>Estoque baixo</h4>
          <div class="value"><?php echo $baixo_estoque; ?> <span class="badge warn">atenção</span></div>
        </div>
        <div class="card">
          <h4>Faturamento (hoje)</h4>
          <div class="value"><?php echo $faturamento ?></div>
        </div>
      </div>

      <div class="two-col">
        <div class="list">
          <h3>Próximos atendimentos</h3>
          <?php
            foreach ($lista_agenda_hoje as $linha){
              echo '<div class="item"><span>'.$linha[1].' • '.$linha[2].' – ('.$linha[0].')</span><span class="badge">#A-102</span></div>';
            }
          ?>
        </div>
        <div class="list">
          <h3>Últimos Atemdimentos
          </h3>
          <?php foreach($listar_ultimos_atendimentos as $linha) {
          echo '<div class="item"><span>'.$linha[1].' • '.$linha[0].'</span><span>Banho</span></div>';
          };
          ?>
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
</body>
</html>