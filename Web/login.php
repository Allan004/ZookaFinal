<?php
session_start();
 
require_once "../php/conexao.php";
$pdo = conectar();
 
$erro = "";
 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['recuperar_btn'])) {
 
    $usuario = $_POST['email'] ?? '';
    $senha   = $_POST['senha'] ?? '';
 
    $stmt = $pdo->prepare("SELECT * FROM loginweb WHERE usuario = ?");
    $stmt->execute([$usuario]);
 
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if ($user && password_verify($senha, $user['senha'])) {
 
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nome'] = $user['usuario'];
 
        header("Location: index.php");
        exit;
 
    } else {
        $erro = "Login inválido!";
    }
}
$msg_recuperar = "";
 
if (isset($_POST['recuperar_btn'])) {
 
    $usuario = $_POST['recuperar_usuario'] ?? '';
    $nova = $_POST['nova_senha'] ?? '';
    $confirma = $_POST['confirmar_senha'] ?? '';
 
    // limpa CPF
    $usuario = preg_replace('/\D/', '', $usuario);
 
    // busca no banco
    $stmt = $pdo->prepare("SELECT * FROM loginweb WHERE usuario = ?");
    $stmt->execute([$usuario]);
 
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if (!$user) {
        $msg_recuperar = "Usuário não encontrado!";
    } else {
 
        if (empty($nova)) {
            $msg_recuperar = "Digite a nova senha!";
        } elseif ($nova !== $confirma) {
            $msg_recuperar = "As senhas não coincidem!";
        } else {
 
            $hash = password_hash($nova, PASSWORD_DEFAULT);
 
            $stmt = $pdo->prepare("UPDATE loginweb SET senha = ? WHERE id = ?");
            $stmt->execute([$hash, $user['id']]);
 
            $msg_recuperar = "Senha redefinida com sucesso!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Zooka</title>
    <link rel="stylesheet" href="css/stylelogin.css">
</head>
<body>
 
   <header class="main-header">
    <div class="header-top">
       
        <div class="logo-container">
            <a href="index.php" class="logo">
                <img src="Assets/logo.png" class="banner-topo" alt="Zooka">
            </a>
        </div>
 
        <div class="ambiente-container">
            <div class="ambiente">
                <span class="texto-ambiente">|</span>
                <img src="Assets/ambiente.png" class="banner-seguro" alt="Ambiente Seguro">
                <span class="texto-ambiente">Ambiente Seguro</span>
            </div>
        </div>    
 
    </div>
</header>
 
<main class="login-container">
  <h2>Acessar ou criar conta</h2>
 
  <div class="login-wrapper">
 
    <!-- Bloco Acesse sua conta -->
    <section class="login-access">
      <h3>Acesse sua conta</h3>
      <?php if(isset($_SESSION['sucesso'])): ?>
    <p class="msg-sucesso">
      <?php echo $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
    </p>
  <?php endif; ?>
      <form method="POST">
        <label for="email">E-mail ou CPF/CNPJ</label>
        <input type="text" id="email" name="email" placeholder="Digite seu usuário ou CPF/CNPJ">
        <label for="senha">Senha</label>
        <div class="senha-wrapper">
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha">
        </div>
 
        <a href="#" class="forgot-password" onclick="abrirModalRecuperar(event)">
  Esqueci a senha
</a>
<?php if($erro): ?>
    <p class="msg-erro"><?php echo $erro; ?></p>
<?php endif; ?>
        <button type="submit" class="btn-login">ENTRAR</button>
      </form>
    </section>
    <!-- Bloco Criar conta -->
    <section class="login-create">
      <h3>Criar uma conta é rápido, fácil e gratuito!</h3>
      <p>Com a sua conta da Zooka você tem acesso a Ofertas exclusivas, acompanhar os seus pedidos e muito mais!</p>
      <button class="btn-create-account" onclick="window.location.href='cadastro.php'">Criar minha conta</button>
    </section>
 
  </div>
</header>
 
<footer class="main-footer">
    <p>Copyright© 2026 Zooka Petshop e Clínica Veterinária S/A<br>
    Todos os direitos reservados</p>
</footer>
<div id="modal-recuperar" class="modal-termos">
  <div class="modal-conteudo">
 
    <span class="fechar" onclick="fecharModalRecuperar()">&times;</span>
 
    <h3>Recuperar senha</h3>
 
    <form method="POST">
 
      <input type="text" name="recuperar_usuario"
        placeholder="Digite usuário ou CPF">
 
      <?php if(isset($_POST['recuperar_usuario'])): ?>
 
        <input type="password" name="nova_senha" placeholder="Nova senha">
        <input type="password" name="confirmar_senha" placeholder="Confirmar senha">
 
      <?php endif; ?>
 
      <?php if(!empty($msg_recuperar)): ?>
        <p class="msg-erro"><?= $msg_recuperar ?></p>
      <?php endif; ?>
 
      <button type="submit" name="recuperar_btn">
        Continuar
      </button>
 
    </form>
 
  </div>
</div>
<script>
function abrirModalRecuperar(e) {
  e.preventDefault();
  document.getElementById('modal-recuperar').style.display = 'block';
}
 
function fecharModalRecuperar() {
  document.getElementById('modal-recuperar').style.display = 'none';
}
</script>
</body>
</html>
 