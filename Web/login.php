<?php
session_start();

require __DIR__ . '/../../php/conexao.php';
$pdo = conectar();

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
            <a href="#" class="logo">
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
    <main class="login-container">
  <h2>Acessar ou criar conta</h2>
  
  <div class="login-wrapper">
  
    <!-- Bloco Acesse sua conta -->
    <section class="login-access">
      <h3>Acesse sua conta</h3>
      <form method="POST">
        <label for="email">E-mail ou CPF/CNPJ</label>
        <input type="text" id="email" name="email" placeholder="Digite seu usuário ou CPF/CNPJ">
        <label for="senha">Senha</label>
        <div class="senha-wrapper">
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha">
        </div>

        <a href="#" class="forgot-password">Esqueci a senha</a>
<?php if($erro): ?>
    <p style="color:red;"><?php echo $erro; ?></p>
<?php endif; ?>
        <button type="submit" class="btn-login">ENTRAR</button>
      </form>
    </section>
    <!-- Bloco Criar conta -->
    <section class="login-create">
      <h3>Criar uma conta é rápido, fácil e gratuito!</h3>
      <p>Com a sua conta da Zooka você tem acesso a Ofertas exclusivas, descontos, pode criar e gerenciar a sua Assinatura Petz, acompanhar os seus pedidos e muito mais!</p>
      <button class="btn-create-account" onclick="window.location.href='cadastro.php'">Criar minha conta</button>
    </section>
  
  </div>
</header>

<footer class="main-footer">

    <div class="footer-links-container">
        <div class="logo-footer">zookapet</div>
        <div class="footer-grid">
            <div class="footer-column">
                <h4>a zookapet</h4>
                <ul>
                    <li>bem estar bem</li>
                    <li>sustentabilidade</li>
                    <li>nossa história</li>
                    <li>trabalhe conosco</li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>atendimento</h4>
                <ul>
                    <li>encontre a zooka</li>
                    <li>ajuda e contato</li>
                    <li>ouvidoria</li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>suporte</h4>
                <ul>
                    <li>aviso de privacidade</li>
                    <li>política de cookies</li>
                    <li>trocas e devoluções</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</body>
</html>