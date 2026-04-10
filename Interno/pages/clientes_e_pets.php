<?php
include "../../php/funcoes_ladingpage.php";
include "../../php/editar_cliente.php";
include "../../php/salvar_cliente.php";
include "../../php/editar_pet.php";
include "../../php/salvar_pet.php";


if (isset($_POST['logout'])) {
    logout();
    header("Location: clientes_e_pets.php");
    exit;
}

$logado = usuario_logado();
$modalAberto = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['editar_pet'])) {
        $modalAberto = "pet";
        $consulta_pet = abrir_pet($_POST['id_pet_editar']);
    }

    if (isset($_POST['editar_cliente'])) {
        $modalAberto = "cliente";
        $consulta_cliente = abrir_cliente($_POST['id_cliente_editar']);
    }
    
    else{
      $modalAberto= null;
    };
};


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar_c'])) {

    $dados = [
        'id'         => $_POST['id_cliente'],
        'nome'       => trim($_POST['nome']),
        'telefone'   => trim($_POST['telefone']),
        'email'      => trim($_POST['email']),
        'cpf'        => trim($_POST['cpf']),
        'nascimento' => $_POST['nascimento'],
        'rua'        => trim($_POST['rua']),
        'numero'     => trim($_POST['numero']),
        'bairro'     => trim($_POST['bairro']),
        'cidade'     => trim($_POST['cidade']),
        'estado'     => trim($_POST['estado']),
        'cep'        => trim($_POST['cep'])
        
    ];

    if (atualizar_cliente($dados)) {
       
    } else {
        echo "Erro ao atualizar cliente.";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar_p'])) {

    $dados = [
        'id_pet'          => $_POST['id_pet'],
        'nome'        => trim($_POST['nome']),
        'nascimento'  => $_POST['nascimento'] ?: null,
        'tipoIdade'   => $_POST['tipoIdade'],
        'idadeaprox'  => $_POST['idadeaprox'] ?: null,
        'especie'     => trim($_POST['especie']),
        'raca'        => trim($_POST['raca']),
        'observacao'  => trim($_POST['observacao'])
    ];

    if (atualizar_pet($dados)) {
        echo "Pet atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar pet.";
    }
}



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
      <a class="nav-item active" href="clientes_e_pets.php"><span>🐕</span> Clientes & Pets</a>
      <a class="nav-item" href="agendamento.php"><span>📅</span> Agendamento</a>
      <a class="nav-item" href="servicos.php"><span>✂️</span> Serviços</a>
      <a class="nav-item" href="produtos.php"><span>🛍️</span> Produtos</a>
      <a class="nav-item" href="estoque.php"><span>📦</span> Estoque</a>
      <a class="nav-item" href="caixa.php"><span>💰</span> Caixa</a>
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
         <div id="resultadoClientes"><p class="muted">Digite para Encontrar</p></div>
         
        </div>
        <div class="list">
          <h3>Pets</h3>
         <div id="resultadoPets"><p class="muted">Digite para Encontrar</p></div>
       
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
      

<?php if ($modalAberto==="cliente"): ?>
<div class="editar-cliente-overlay">
  <form method="post"  class="editar-cliente-card">
        

        <div class="editar-cliente-brand">
            <div class="direito">
            <div class="logo-modal" ><img src="../Assets/logo_ico.png" alt=""></div>
            <div>
                <strong>Zooka</strong>
                <div class="muted">Editar conta</div>
            </div>
            </div>
            <div class="esquerdo">
              <button>X</button>
            </div>
        </div>

        <h2>Editar usuário</h2>
        <div class="editar-cliente-container">
        <div class="editar-cliente-direito">
        <div class="field">
            <label>Nome</label>
            <input type="text" value=<?php echo'"'.$consulta_cliente[1].'"'; ?> name="nome" required>
        </div>

        <div class="field">
            <label>Telefone</label>
            <input type="text" value=<?php echo'"'.$consulta_cliente[2].'"'; ?>  name="telefone" required>
        </div>

        <div class="field">
            <label>Email</label>
            <input type="email" value=<?php echo'"'.$consulta_cliente[3].'"'; ?>  name="email" required>
        </div>

        <div class="field">
            <label>CPF</label>
            <input type="text" value=<?php echo'"'.$consulta_cliente[4].'"'; ?>  name="cpf" required>
        </div>

        <div class="field">
            <label>Nascimento</label>
            <input type="text"  value=<?php echo'"'.$consulta_cliente[5].'"'; ?>  name="nascimento" required>
        </div>

         <div class="field">
            <label>CEP</label>
            <input type="text" value=<?php echo'"'.$consulta_cliente[11].'"'; ?>   name="cep" required>
        </div>
        </div>
        <div class="editar-cliente-direito">

        <div class="field">
            <label>Rua</label>
            <input type="text" value=<?php echo'"'.$consulta_cliente[6].'"'; ?>   name="rua" required>
        </div>

        <div class="field">
            <label>Numero</label>
            <input type="text" value=<?php echo'"'.$consulta_cliente[7].'"'; ?>   name="numero" required>
        </div>

        <div class="field">
            <label>Bairro</label>
            <input type="text" value=<?php echo'"'.$consulta_cliente[8].'"'; ?>   name="bairro" required>
        </div>

        <div class="field">
            <label>Cidade</label>
            <input type="text" value=<?php echo'"'.$consulta_cliente[9].'"'; ?>  name="cidade" required>
        </div>

         <div class="field">
            <label>Estado</label>
            <input type="text" value=<?php echo'"'.$consulta_cliente[10].'"'; ?>  name="estado" required>
        </div>
        <div class="editar-cliente-direito">
        </div>
        <input type="hidden" name="id_cliente" value="<?= $consulta_cliente[0]; ?>">

        <button class="btn btn-block" name='salvar_c'> Editar conta</button>

    </form>
</div>
<?php endif; ?>

<?php if ($modalAberto==="pet"): ?>
<div class="editar-cliente-overlay">
  <form method="post"  class="editar-cliente-card">
        

        <div class="editar-cliente-brand">
            <div class="direito">
            <div class="logo-modal" ><img src="../Assets/logo_ico.png" alt=""></div>
            <div>
                <strong>Zooka</strong>
                <div class="muted">Editar conta</div>
            </div>
            </div>
            <div class="esquerdo">
              <button>X</button>
            </div>
        </div>

        <h2>Editar usuário</h2>
        <div class="editar-cliente-container">
        <div class="editar-cliente-direito">
        <div class="field">
            <label>Nome</label>
            <input type="text" value=<?php echo'"'.$consulta_pet[1].'"'; ?> name="nome" required>
        </div>

        <div class="field">
            <label>Nascimento</label>
            <input type="date" value=<?php echo'"'.$consulta_pet[2].'"'; ?>  name="nascimento">
        </div>

        <div class="field">
            <label>Tipo Idade</label>
            <select name="tipo_idade" required>
                <option value="exata" <?php echo (strtolower($consulta_pet[3])=="exata") ? "selected":"" ;?>> exata </option>
                <option value="aproximada" <?php echo (strtolower($consulta_pet[3])=="aproximada") ? "selected":""; ?>>aproximada</option>
            </select>
        </div>
        </div>
        <div class="editar-cliente-direito">
        <div class="field">
            <label>Idade</label>
            <input type="int" value=<?php echo'"'.$consulta_pet[4].'"'; ?>  name="idade" required>
        </div>

        <div class="field">
            <label>Especie</label>
            <input type="text"  value=<?php echo'"'.$consulta_pet[5].'"'; ?>  name="especie" required>
        </div>

         <div class="field">
            <label>Raça</label>
            <input type="text" value=<?php echo'"'.$consulta_pet[7].'"'; ?>   name="raca" required>
        </div>
        </div>
        <input type="hidden" name="id_cliente" value="<?= $consulta_pet[0]; ?>">

        <button class="btn btn-block" name='salvar_p'> Editar conta</button>

    </form>
</div>
<?php endif; ?>

    </section>
  </main>
  <script src="../js/script.js"></script>
</body>
</html>