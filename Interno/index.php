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
        include "../php/funcoes_ladingpage.php";


        $pdo=conectar();
        $baixo_estoque=verifica_baixo_estoque();
        $agenda_hoje=agenda_hoje();
        $faturamento=faturamentoh();
        $lista_agenda_hoje= listar_proximos_atendimentos();
    ?>
  <header>
    <div class="brand">
      <div class="logo"><img src="Assets/logo_ico.png" class="imagel" alt=""></div>
      <div>Zooka • Sistema Interno</div>
    </div>
    <div class="user-area">
      <span>Olá, Allan</span>
      <button class="btn">Sair</button>
    </div>
  </header>

  <main class="layout">
    <nav>
      <a class="nav-item active" href="#"><span>🏠</span> Início</a>
      <a class="nav-item" href="#"><span>🐕</span> Clientes & Pets</a>
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
          <div class="value">5</div>
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
          <h3>Últimos clientes</h3>
          <div class="item"><span>Felipe • Thor</span><span>Banho</span></div>
          <div class="item"><span>Marina • Mel</span><span>Tosa</span></div>
          <div class="item"><span>Júlia • Simba</span><span>Vacina</span></div>
          <div class="item"><span>Rafael • Bob</span><span>Banho</span></div>
        </div>
      </div>
    </section>
  </main>
</body>
</html>