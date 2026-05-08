<?php
session_start();
require_once "../php/conexao.php";

$pdo = conectar();

$id_login = $_SESSION['usuario_id'] ?? null;

if (!$id_login) {
    header("Location: login.php");
    exit;
}

if (!$id_login) {
    header("Location: login.php");
    exit;
}

/* 🔥 UPDATE */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
    $_POST['cpf'] ?? $usuario['cpf'],
    $_POST['email'] ?? $usuario['email'],
    $_POST['telefone'] ?? $usuario['telefone'],
    $_POST['nascimento'] ?? $usuario['nascimento'],
    $_POST['cep'] ?? $usuario['cep'],
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

/* 🔥 SELECT (busca dados atualizados) */
$sql = $pdo->prepare("SELECT * FROM clienteweb WHERE id_login = ?");
$sql->execute([$id_login]);
$usuario = $sql->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Dados - ZookaPet</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="top-promo">
    10% OFF na primeira compra com o cupom <strong>BEMVINDOAUAU</strong>
</div>

<header class="main-header">

    <div class="header-top">

        <div class="logo-container">
            <a href="index.php" class="logo">
                <img src="Assets/logo.png" class="banner-topo" alt="ZookaPet">
            </a>
        </div>

        <div class="search-container">
            <input type="text" class="search-input" placeholder="o que seu pet precisa hoje?">
        </div>

        <div class="user-menu">

            <?php if(isset($_SESSION['usuario_nome'])): ?>

                <div class="user-dropdown">

                    <span class="user-name">
                        Olá, <?php echo $_SESSION['usuario_nome']; ?>
                    </span>

                    <div class="dropdown-menu">
                        <a href="#">Meus pedidos</a>
                        <a href="meusdados.php">Meus dados</a>
                        <a href="logout.php">Sair</a>
                    </div>

                </div>

            <?php else: ?>

                <a href="login.php" class="user-link">
                    Entrar ou <br>Cadastrar
                </a>

            <?php endif; ?>

            <a href="CarrinhoZooka.html" class="btn-continue">🛒</a>

        </div>

    </div>

</header>

<nav class="category-nav">
    <ul>
        <li>
            <a href="index.php" class="category-item">🏠 início</a>
        </li>
        <li>
            <a href="adocao.php" class="category-item">adoção</a>
        </li>
    </ul>
</nav>

<div class="scrolling-ticker">
    <div class="ticker-content">
        <span>Frete grátis</span>
        <span>Brindes exclusivos</span>
        <span>15% OFF</span>
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
            <a href="#">Meus pedidos</a>
            <a href="#">Favoritos</a>
            <a href="logout.php">Sair da conta</a>
        </nav>

    </aside>

    <main class="conteudo-cliente">

        <div class="card-dados">

            <h1>Meus Dados</h1>

            <p class="subtitulo">
                Confira ou altere seus dados de cadastro.
            </p>

            <form class="form-dados" method="POST">

                <div class="linha-form">

                    <div class="grupo">
                        <label>Nome completo</label>
                        <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>">
                    </div>

                    <div class="grupo">
                        <label>CPF</label>
                        <input type="text" name="cpf" value="<?php echo $usuario['cpf']; ?>">
                    </div>

                </div>

                <div class="linha-form">

                    <div class="grupo">
                        <label>E-mail</label>
                        <input type="text" name="email" value="<?php echo $usuario['email']; ?>">
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
                        <input type="text" name="estado" value="<?php echo $usuario['estado']; ?>">
                    </div>

                </div>

                <button type="submit" class="btn-salvar">
                    Salvar alterações
                </button>

            </form>

        </div>

    </main>

</section>

</body>
</html>