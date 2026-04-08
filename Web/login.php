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
      <form>
        <label for="email">E-mail ou CPF/CNPJ</label>
        <input type="email" id="email" name="email" placeholder="Digite seu e-mail ou CPF/CNPJ" required value="elenrayasenai@gmail.com">
<label for="senha">Senha</label>
<div class="senha-wrapper">
  <input type="password" id="senha" placeholder="Digite sua senha">

</div>

        <a href="#" class="forgot-password">Esqueci a senha</a>

        <button type="submit" class="btn-login">ENTRAR</button>
      </form>
    </section>
    <!-- Bloco Criar conta -->
    <section class="login-create">
      <h3>Criar uma conta é rápido, fácil e gratuito!</h3>
      <p>Com a sua conta da Petz você tem acesso a Ofertas exclusivas, descontos, pode criar e gerenciar a sua Assinatura Petz, acompanhar os seus pedidos e muito mais!</p>
      <button class="btn-create-account">Criar minha conta</button>
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