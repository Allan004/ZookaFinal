<?php
include "../../php/funcoes_ladingpage.php";
include "../../php/agendar_servico.php";

if (isset($_POST['logout'])) {
    logout();
    header("Location: agendamento.php");
    exit;
}

$buscaPet=busca_pet_cliente();
$buscaServico=busca_servico();
$buscaFuncionario=busca_funcionario();
$logado = usuario_logado();
$buscaAgendamento= busca_agendamento();
$controleinputs=false;
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
            $buscaAgendamentoEspecifico =
                busca_agendamento_especifico($_POST['id_edi_exclu']);
        }
    }

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar_agendamento'])) {

    $id = $_POST['id_agendamento'] ?? null;

    $dados = [
        'id_agendamento'    => !empty($id) ? (int)$id : null,
        'id_pet'            => $_POST['id_pet'],
        'id_servico'        => $_POST['id_servico'],
        'id_funcionario'    => $_POST['id_funcionario'],
        'dataagendamento'   => $_POST['data'],
        'hora'              => $_POST['hora'],
        'statusagendamento' => $_POST['status']
    ];

    inserir_agendamento($dados);

    header("Location: agendamento.php?salvo=1");
    exit;
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
      <a class="nav-item" href="../index.php"><span>🏠</span> Início</a>
      <a class="nav-item "  href="clientes_e_pets.php"><span>🐕</span> Clientes & Pets</a>
      <a class="nav-item active" href="agendamento.php"><span>📅</span> Agendamento</a>
      <a class="nav-item" href="servicos.php"><span>✂️</span> Serviços</a>
      <a class="nav-item" href="produtos.php"><span>🛍️</span> Produtos</a>
      <a class="nav-item" href="estoque.php"><span>📦</span> Estoque</a>
      <a class="nav-item" href="caixa.php"><span>💰</span> Caixa</a>
    </nav>

  <section class="content">

    <!-- NOVO AGENDAMENTO -->
     <form method="post">
    <div class="card">
      <h4>Novo agendamento</h4>

      <div class="two-col">

        <div class="field">
          <label>Pet</label>
          <select name='id_pet'>
            
            <?php 
                 if($controleinputs===true){
                   echo "<option value='".$buscaAgendamentoEspecifico[7]."'>".$buscaAgendamentoEspecifico[1]." | ".$buscaAgendamentoEspecifico[3]."</option>";

                  }else{
                    echo '<option>Selecione o pet</option>';
                  foreach($buscaPet as $busca){
                    echo "<option value='".$busca[2]."'>".$busca[0]." | ".$busca[1]."</option>";
                  };
                  };
            ?>
          </select>
        </div>

        <div class="field">
          <label>Serviço</label>
          <select name='id_servico'>
          
            <?php 
                 if($controleinputs===true){
                   echo "<option value='".$buscaAgendamentoEspecifico[8]."'>".$buscaAgendamentoEspecifico[2]."</option>";
                  foreach($buscaServico as $busca){
                   echo "<option value='".$busca[1]."'>".$busca[0]."</option>";
                  };
                  }else{
                    echo '<option>Selecione o Serviço</option>';
                   foreach($buscaServico as $busca){
                   echo "<option value='".$busca[1]."'>".$busca[0]."</option>";
                  };
                   };
            ?>
            
            
        
          </select>
        </div>

        <div class="field">
          <label>Funcionário</label>
          <select name='id_funcionario'>
            

             <?php 
             
                 if($controleinputs===true){
                   echo "<option value='".$buscaAgendamentoEspecifico[9]."'>".$buscaAgendamentoEspecifico[3]."</option>";
                  foreach($buscaFuncionario as $busca){
                  echo "<option value='".$busca[2]."'>".$busca[0]." | ".$busca[1]."</option>";
                  } ;
                  }else{
                    echo '<option>Selecione</option>';
                  foreach($buscaFuncionario as $busca){
              echo "<option value='".$busca[2]."'>".$busca[0]." | ".$busca[1]."</option>";
              } ;
                   };
            ?>
             
          </select>
        </div>

        <div class="field">
          <label>Data</label>
          <input type="date" name="data" value=<?php if($controleinputs===true){echo "'".$buscaAgendamentoEspecifico[4]."'";} ?> name='data'>
        </div>

        <div class="field">
          <label>Hora</label>
          <input type="time" name="hora" value=<?php if($controleinputs===true){echo "'".$buscaAgendamentoEspecifico[5]."'";} ?> name='hora'>
        </div>

        <div class="field">
          <label>Status</label>
          <select name='status'>
            <?php 
            
            if($controleinputs===true){echo "<option value='".$buscaAgendamentoEspecifico[6]."'>".$buscaAgendamentoEspecifico[6]."</option>";};
            ?>
            <option>Agendado</option>
            <option>Pendente</option>
            <option>Concluído</option>
            <option>Cancelado</option>
          </select>
        </div>

      </div>
      
      <input type="hidden" name="id_agendamento"
       value="<?= $buscaAgendamentoEspecifico['id_agendamento'] ?? '' ?>">


      <button class="btn btn-block" name="salvar_agendamento" style="margin-top:16px">
        Salvar agendamento
      </button>
    </div>
</form>
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