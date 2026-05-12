<?php
session_start();



require_once "../php/conexao.php";
$pdo = conectar();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id_login = $_SESSION['usuario_id'] ?? null;

if (!$id_login) {
    header("Location: login.php");
    exit;
}

/* 👇 PEGA MENSAGENS DEPOIS DE TUDO */
$erro = $_SESSION['erro'] ?? null;
$sucesso = $_SESSION['sucesso'] ?? null;

/* 👇 LIMPA SÓ DEPOIS DE PEGAR */
unset($_SESSION['erro']);
unset($_SESSION['sucesso']);

if (!$id_login) {
    header("Location: login.php");
    exit;
}

/* 👇 COLOCA AQUI */
$sql = $pdo->prepare("SELECT * FROM clienteweb WHERE id_login = ?");
$sql->execute([$id_login]);
$usuario = $sql->fetch(PDO::FETCH_ASSOC);

/* UPDATE */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? $usuario['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['erro'] = "E-mail inválido! Use um e-mail válido (ex: nome@site.com)";
        header("Location: meusdados.php");
        exit;
    }

    $cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
    $telefone = preg_replace('/\D/', '', $_POST['telefone'] ?? '');
    $cep = preg_replace('/\D/', '', $_POST['cep'] ?? '');

    $sql = $pdo->prepare("
        UPDATE clienteweb SET
            nome = ?,
            cpf = ?,
            email = ?,
            telefone = ?,
            nascimento = ?,
            cep = ?,
            rua = ?,
            numero = ?,
            bairro = ?,
            cidade = ?,
            estado = ?
        WHERE id_login = ?
    ");

    $sql->execute([
        $_POST['nome'] ?? $usuario['nome'],
        $cpf,
        $email,
        $telefone,
        $_POST['nascimento'] ?? $usuario['nascimento'],
        $cep,
        $_POST['rua'] ?? $usuario['rua'],
        $_POST['numero'] ?? $usuario['numero'],
        $_POST['bairro'] ?? $usuario['bairro'],
        $_POST['cidade'] ?? $usuario['cidade'],
        $_POST['estado'] ?? $usuario['estado'],
        $id_login
    ]);

    $_SESSION['sucesso'] = "Dados atualizados com sucesso!";
    header("Location: meusdados.php");
    exit;
}
/* busca dados atualizados */
$sql = $pdo->prepare("
    SELECT c.*, l.usuario
    FROM clienteweb c
    INNER JOIN loginweb l ON l.id = c.id_login
    WHERE c.id_login = ?
");
$sql->execute([$id_login]);
$usuario = $sql->fetch(PDO::FETCH_ASSOC);
if (!$usuario) {
    die("Usuário não encontrado no clienteweb. ID recebido: " . $id_login);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Dados - ZookaPet</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
<div class="top-promo">  
    10% OFF na primeira compra com o cupom <strong>BEMVINDOAUAU</strong>
</div>

<header class="main-header">

    <div class="header-top">

        <div class="logo-container">
            <a href="index.php" class="logo">
                <img src="Assets/logo.png" class="banner-topo" alt="Zooka">
            </a>
        </div>

        <div class="search-container">

            <form action="produtos.php" method="GET" class="search-form">

                <input 
                    type="text"
                    name="filtro"
                    class="search-input"
                    placeholder="o que seu pet precisa hoje?"
                    value="<?php echo htmlspecialchars($_GET['filtro'] ?? '', ENT_QUOTES); ?>"
                >

                <?php if (!empty($_GET['ordenacao'])): ?>

                    <input 
                        type="hidden"
                        name="ordenacao"
                        value="<?php echo htmlspecialchars($_GET['ordenacao'], ENT_QUOTES); ?>"
                    >

                <?php endif; ?>

            </form>

        </div>

        <div class="user-menu">

            <?php if(isset($_SESSION['usuario_nome'])): ?>

                <div class="user-dropdown">

                    <span class="user-name">
                        Olá, <?php echo $_SESSION['usuario_nome']; ?>!
                    </span>

                    <div class="dropdown-menu">
                        <a href="meuspedidoss.php">Meus pedidos</a>
                        <a href="meusdados.php">Meus dados</a>
                        <a href="logout.php">Sair</a>
                    </div>

                </div>

            <?php else: ?>

                <a href="login.php" class="user-link">
                    Entrar ou <br>Cadastrar
                </a>

            <?php endif; ?>

            <a href="carrinho2.php" class="btn-continue">🛒</a>

        </div>

    </div>

</header>

<nav class="category-nav">
<ul>

    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/cachorro1.png"> cachorros
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=cachorro&filtro=racao">Ração</a></li>
            <li><a href="produtos.php?categoria=cachorro&filtro=petisco">Petiscos</a></li>
            <li><a href="produtos.php?categoria=cachorro&filtro=brinquedo">Brinquedos</a></li>
        </ul>
    </li>

    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/gato1.png"> gatos
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=gato&filtro=racao">Ração</a></li>
            <li><a href="produtos.php?categoria=gato&filtro=areia">Areia</a></li>
            <li><a href="produtos.php?categoria=gato&filtro=brinquedo">Brinquedos</a></li>
            <li><a href="produtos.php?categoria=gato&filtro=arranhador">Arranhadores</a></li>
        </ul>
    </li>

    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/passaros1.png"> pássaros
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=passaro&filtro=racao">Sementes</a></li>
            <li><a href="produtos.php?categoria=passaro&filtro=gaiola">Gaiolas</a></li>
            <li><a href="produtos.php?categoria=passaro&filtro=acessorio">Acessórios</a></li>
        </ul>
    </li>

    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/peixe2.png"> peixes
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=peixe&filtro=racao">Ração</a></li>
            <li><a href="produtos.php?categoria=peixe&filtro=aquario">Aquários</a></li>
            <li><a href="produtos.php?categoria=peixe&filtro=filtro">Filtros</a></li>
        </ul>
    </li>

    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/roedor1.png"> roedores
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=roedor&filtro=racao">Ração</a></li>
            <li><a href="produtos.php?categoria=roedor&filtro=gaiola">Gaiolas</a></li>
            <li><a href="produtos.php?categoria=roedor&filtro=brinquedo">Brinquedos</a></li>
        </ul>
    </li>

    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/farmacia2.png"> farmácia
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=medicamento&filtro=antipulga">Antipulgas</a></li>
            <li><a href="produtos.php?categoria=men&filtro=vermifugo">Vermífugos</a></li>
            <li><a href="produtos.php?categoria=farmacia&filtro=vitamina">Vitaminas</a></li>
        </ul>
    </li>

    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/higiene1.png"> higiene
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=higiene&filtro=shampoo">Shampoo</a></li>
            <li><a href="produtos.php?categoria=higiene&filtro=tapete">Tapetes</a></li>
            <li><a href="produtos.php?categoria=higiene&filtro=escova">Escovas</a></li>
        </ul>
    </li>

    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/brinquedos1.png"> brinquedos
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=brinquedo&filtro=mordedor">Mordedores</a></li>
            <li><a href="produtos.php?categoria=brinquedo&filtro=bolinha">Bolinhas</a></li>
        </ul>
    </li>

    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/camas1.png"> camas
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=cama&filtro=camas">Camas</a></li>
            <li><a href="produtos.php?categoria=cama&filtro=cobertor">Cobertores</a></li>
        </ul>
    </li>

    <li>
        <a href="adocao.php" class="category-item">
            <img src="Assets/adocao2.png"> adoção
        </a>
    </li>

</ul>
</nav>

   <div class="scrolling-ticker">
    <div class="ticker-content">
        <span>Frete grátis</span> <img src="Assets/patinhas1.png" alt="pata">
        <span>Brindes exclusivos</span> <img src="Assets/coroa1.png" alt="pata">
        <span>15% a 25% OFF</span> <img src="Assets/patinhas1.png" alt="pata">
        <span>Frete grátis</span> <img src="Assets/coroa1.png" alt="pata">
        <span>Brindes exclusivos</span> <img src="Assets/patinhas1.png" alt="pata">
        <span>15% a 25% OFF</span> <img src="Assets/coroa1.png" alt="pata">
        <span>Frete grátis</span> <img src="Assets/patinhas1.png" alt="pata">
        <span>Brindes exclusivos</span> <img src="Assets/coroa1.png" alt="pata">
        <span>15% a 25% OFF</span> <img src="Assets/patinhas1.png" alt="pata">
    </div>
</div>

<!-- CONTEÚDO -->

<section class="area-cliente">

    <aside class="menu-cliente">

        <div class="cliente-box">
            <span>Olá,</span>
            <h3><?php echo $usuario['nome']; ?></h3>
        </div>

        <nav class="sidebar-links">
            <a href="#" class="active">Meus dados</a>
            <a href="meuspedidoss.php">Meus pedidos</a>
            <a href="logout.php">Sair da conta</a>
        </nav>

    </aside>

    <main class="conteudo-cliente">

        <div class="card-dados">

            <h1>Meus Dados</h1>

            <p class="subtitulo">
                Confira ou altere seus dados de cadastro.
            </p>
<?php if($erro): ?>
    <p class="msg-erro"><?= $erro ?></p>
<?php endif; ?>

<?php if($sucesso): ?>
    <p class="msg-sucesso"><?= $sucesso ?></p>
<?php endif; ?>

            <form class="form-dados" method="POST">

<div class="linha-form">

    <div class="grupo">
        <label>Nome completo</label>
        <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>">
    </div>

    <div class="grupo">
        <label>CPF</label>
        <input type="text" name="cpf" value="<?php echo $usuario['cpf']; ?>" readonly class="cpf-bloqueado" onfocus="this.blur()">
    </div>

<div class="grupo">
    <label>Usuário</label>
    <input type="text" value="<?php echo $usuario['usuario']; ?>" readonly class="cpf-bloqueado">
</div>

</div>

                <div class="linha-form">

                    <div class="grupo">
                        <label>E-mail</label>
                        <input type="text" name="email" value="<?php echo $usuario['email'] ?? $usuario['email']; ?>">
                    </div>

                    <div class="grupo">
                        <label>Telefone</label>
                        <input type="text" name="telefone" value="<?php echo $usuario['telefone']; ?>">
                    </div>

                </div>

                <div class="linha-form">

                    <div class="grupo">
                        <label>Data de nascimento</label>
                        <input type="date" name="nascimento" value="<?php echo $usuario['nascimento']; ?>">
                    </div>

                    <div class="grupo">
                        <label>CEP</label>
                        <input type="text" name="cep" value="<?php echo $usuario['cep']; ?>">
                    </div>

                </div>

                <div class="linha-form">

                    <div class="grupo grupo-maior">
                        <label>Rua</label>
                        <input type="text" name="rua" value="<?php echo $usuario['rua']; ?>">
                    </div>

                    <div class="grupo grupo-pequeno">
                        <label>Número</label>
                        <input type="text" name="numero" value="<?php echo $usuario['numero']; ?>">
                    </div>

                </div>

                <div class="linha-form">

                    <div class="grupo">
                        <label>Bairro</label>
                        <input type="text" name="bairro" value="<?php echo $usuario['bairro']; ?>">
                    </div>

                    <div class="grupo">
                        <label>Cidade</label>
                        <input type="text" name="cidade" value="<?php echo $usuario['cidade']; ?>">
                    </div>

                    <div class="grupo grupo-estado">
                        <label>Estado</label>
                        <input type="text" id="uf" name="estado" value="<?php echo $usuario['estado']; ?>">
                    </div>

                </div>

                <button type="submit" class="btn-salvar">
                    Salvar alterações
                </button>

            </form>

        </div>

    </main>

</section>
<script>
document.addEventListener('DOMContentLoaded', function(){

  /* CPF */
const cpf = document.querySelector('input[name="cpf"]');

function mascaraCPF(v) {
  v = v.replace(/\D/g,'').slice(0,11);
  v = v.replace(/^(\d{3})(\d)/, '$1.$2');
  v = v.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
  v = v.replace(/\.(\d{3})(\d)/, '.$1-$2');
  return v;
}

if (cpf) {
  cpf.value = mascaraCPF(cpf.value);

  cpf.addEventListener('input', function(e){
    e.target.value = mascaraCPF(e.target.value);
  });
}

  /* TELEFONE */
 const tel = document.querySelector('input[name="telefone"]');

function mascaraTel(v){
  v = v.replace(/\D/g,'').slice(0,11);

  if (v.length > 10) {
    v = v.replace(/^(\d{2})(\d{5})(\d{0,4})$/, '($1) $2-$3');
  } else {
    v = v.replace(/^(\d{2})(\d{4})(\d{0,4})$/, '($1) $2-$3');
  }

  return v.trim();
}

if (tel) {
  tel.value = mascaraTel(tel.value);

  tel.addEventListener('input', function(e){
    e.target.value = mascaraTel(e.target.value);
  });
}

  /* CEP */
const cep = document.querySelector('input[name="cep"]');

function mascaraCEP(v){
  v = v.replace(/\D/g,'').slice(0,8);
  v = v.replace(/^(\d{5})(\d)/, '$1-$2');
  return v;
}

if (cep) {
  cep.value = mascaraCEP(cep.value);

  cep.addEventListener('input', function(e){
    e.target.value = mascaraCEP(e.target.value);
  });
}
});
/* ===== API VIA CEP ===== */
const cepInput = document.querySelector('input[name="cep"]');

if (cepInput) {
  cepInput.addEventListener('blur', function () {
    let cep = cepInput.value.replace(/\D/g, '');

    if (cep.length !== 8) return;

    fetch(`https://viacep.com.br/ws/${cep}/json/`)
      .then(res => res.json())
      .then(data => {

        if (data.erro) {
          alert("CEP não encontrado!");
          return;
        }

        // preencher campos automaticamente
        document.querySelector('input[name="rua"]').value = data.logradouro || '';
        document.querySelector('input[name="bairro"]').value = data.bairro || '';
        document.querySelector('input[name="cidade"]').value = data.localidade || '';
        document.querySelector('input[name="estado"]').value = data.uf || '';

      })
      .catch(() => {
        alert("Erro ao buscar CEP");
      });
  });
}
</script>
</body>
</html>