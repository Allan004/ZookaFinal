<?php
include "../../php/funcoes_ladingpage.php";
include "../../php/agendar_servico.php";

if (isset($_POST['logout'])) {
    logout();
    header("Location: agendamento.php");
    exit;
}

$buscaPet = busca_pet_cliente();
$buscaServico = busca_servico();
$buscaFuncionario = busca_funcionario();
$logado = usuario_logado();
$buscaAgendamento = busca_agendamento();
$controleinputs = false;
$formErrors = [];
$formValues = [
    'id_pet' => '',
    'id_servico' => '',
    'id_funcionario' => '',
    'data' => '',
    'hora' => '',
    'status' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* AÇÕES DE EDITAR / EXCLUIR */
    if (isset($_POST['acao'])) {

        if ($_POST['acao'] === 'excluir') {
            deletar_agendamento($_POST['id_edi_exclu']);
            header("Location: agendamento.php?excluido=1");
            exit;
        }

        if ($_POST['acao'] === 'editar') {
            $controleinputs = true;
            $buscaAgendamentoEspecifico = busca_agendamento_especifico($_POST['id_edi_exclu']);
            $formValues = [
                'id_pet' => $buscaAgendamentoEspecifico['id_pet'],
                'id_servico' => $buscaAgendamentoEspecifico['id_servico'],
                'id_funcionario' => $buscaAgendamentoEspecifico['id_funcionario'],
                'data' => $buscaAgendamentoEspecifico['dataagendamento'],
                'hora' => $buscaAgendamentoEspecifico['hora'],
                'status' => $buscaAgendamentoEspecifico['statusagendamento'],
            ];
        }
    }

    if (isset($_POST['salvar_agendamento'])) {
        $id = $_POST['id_agendamento'] ?? null;
        $formValues = [
            'id_pet' => $_POST['id_pet'] ?? '',
            'id_servico' => $_POST['id_servico'] ?? '',
            'id_funcionario' => $_POST['id_funcionario'] ?? '',
            'data' => $_POST['data'] ?? '',
            'hora' => $_POST['hora'] ?? '',
            'status' => $_POST['status'] ?? '',
        ];

        $dados = [
            'id_agendamento' => !empty($id) ? (int)$id : null,
            'id_pet' => $formValues['id_pet'],
            'id_servico' => $formValues['id_servico'],
            'id_funcionario' => $formValues['id_funcionario'],
            'dataagendamento' => $formValues['data'],
            'hora' => $formValues['hora'],
            'statusagendamento' => $formValues['status'],
        ];

        $result = inserir_agendamento($dados);

        if (!empty($result['success'])) {
            header("Location: agendamento.php?salvo=1");
            exit;
        }

        $formErrors = $result['errors'] ?? ['Não foi possível salvar o agendamento.'];
    }
}


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Agendamento • Zooka</title>
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
    <span>Olá, <?= $_SESSION['usuario'] ?></span>
    <form method="post" style="margin:0">
      <button class="btn" name="logout">Sair</button>
    </form>
  </div>
</header>

<main class="layout">
 
      <nav>
      <a class="nav-item " href="../index.php"><span><i class="fa-solid fa-house"></i></span> Início</a>
      <a class="nav-item" href="clientes_e_pets.php"><span><i class="fa-solid fa-dog"></i></span> Clientes & Pets</a>
      <a class="nav-item active" href="agendamento.php"><span><i class="fa-solid fa-calendar"></i></span> Agendamento</a>
      <a class="nav-item" href="servicos.php"><span><i class="fa-solid fa-scissors"></i></span> Serviços</a>
      <a class="nav-item" href="produtos.php"><span><i class="fa-solid fa-bag-shopping"></i></span> Produtos</a>
      <a class="nav-item" href="estoque.php"><span><i class="fa-solid fa-boxes-stacked"></i></span> Estoque</a>
      <a class="nav-item" href="caixa.php"><span><i class="fa-solid fa-money-bill"></i></span> Caixa</a>
  
    </nav>

  <section class="content">

    <!-- NOVO AGENDAMENTO -->
     <form method="post">
    <div class="card">
      <h4>Novo agendamento</h4>

      <?php if (!empty($formErrors)): ?>
      <div class="alert alert-danger">
        <ul>
          <?php foreach ($formErrors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>

      <div class="two-col">

        <div class="field">
          <label>Pet</label>
          <select name="id_pet">
            <option value="">Selecione o pet</option>
            <?php foreach ($buscaPet as $busca): ?>
              <option value="<?= htmlspecialchars($busca['id'] ?? $busca[2]) ?>"<?= ((string)($formValues['id_pet'] ?? '') === (string)($busca['id'] ?? $busca[2])) ? ' selected' : '' ?>>
                <?= htmlspecialchars(($busca['nome'] ?? $busca[0]) . ' | ' . ($busca['cpf'] ?? $busca[1])) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="field">
          <label>Serviço</label>
          <select name="id_servico">
            <option value="">Selecione o serviço</option>
            <?php foreach ($buscaServico as $busca): ?>
              <option value="<?= htmlspecialchars($busca['id'] ?? $busca[1]) ?>"<?= ((string)($formValues['id_servico'] ?? '') === (string)($busca['id'] ?? $busca[1])) ? ' selected' : '' ?>>
                <?= htmlspecialchars($busca['nome'] ?? $busca[0]) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="field">
          <label>Funcionário</label>
          <select name="id_funcionario">
            <option value="">Selecione o funcionário</option>
            <?php foreach ($buscaFuncionario as $busca): ?>
              <option value="<?= htmlspecialchars($busca['id'] ?? $busca[2]) ?>"<?= ((string)($formValues['id_funcionario'] ?? '') === (string)($busca['id'] ?? $busca[2])) ? ' selected' : '' ?> >
                <?= htmlspecialchars(($busca['nome'] ?? $busca[0]) . ' | ' . ($busca['cargo'] ?? $busca[1])) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="field">
          <label>Data</label>
          <input type="date" name="data" value="<?= htmlspecialchars($formValues['data']) ?>">
        </div>

        <div class="field">
          <label>Hora</label>
          <input type="time" name="hora" value="<?= htmlspecialchars($formValues['hora']) ?>">
        </div>

        <div class="field">
          <label>Status</label>
          <select name="status">
            <option value="">Selecione o status</option>
            <?php foreach (['Agendado','Pendente','Concluído','Cancelado'] as $status): ?>
              <option value="<?= htmlspecialchars($status) ?>"<?= ($formValues['status'] === $status) ? ' selected' : '' ?>>
                <?= htmlspecialchars($status) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

      </div>
      
      <input type="hidden" name="id_agendamento"
       value="<?= htmlspecialchars($_POST['id_agendamento'] ?? $buscaAgendamentoEspecifico['id_agendamento'] ?? '') ?>">


      <button class="btn btn-block" name="salvar_agendamento" style="margin-top:16px">
        Salvar agendamento
      </button>
    </div>
</form>
    
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
          
          <?php 

  
          foreach($buscaAgendamento as $busca){
          
          echo 
          "
          <tr>
            <td>".$busca[1]."</td>
           <td>".$busca[2]."</td>
            <td>".$busca[3]."</td>
            <td>".$busca[4]."</td>
            <td>".$busca[5]."</td>
            <td><span class='badge warn'>".$busca[6]."</span></td>
            <td>
            <form method='POST'>
              <input type='hidden' name='id_edi_exclu' value='".$busca[0]."' >
              <button class='btn btn-sm' name='acao' value='editar'>Editar</button>
              <button class='btn btn-sm danger' name='acao' value='excluir' >Excluir</button>
            </form>

            </td>
          </tr>
";     
          };
          ?>
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