<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZookaPet - O melhor para o seu melhor amigo</title>
    <link rel="stylesheet" href="css/style.css">
    
    
</head>
<body>
   
 
    <div class="top-promo">
        10% OFF na primeira compra com o cupom <strong>BEMVINDOAUAU</strong>
    </div>
 
   <header class="main-header">
    <div class="header-top">
        
        <div class="logo-container">
            <a href="#" class="logo">
                <img src="Assets/logo.png" class="banner-topo" alt="Zooka">
            </a>
        </div>

        <div class="search-container">
            <input type="text" placeholder="o que seu pet precisa hoje?">
        </div>

    <div class="user-menu">
    <a href="#" class="user-link">Meus Pets</a>

    <?php if(isset($_SESSION['usuario_nome'])): ?>
        
        <div class="user-info">
            <span class="user-name">Olá, <?php echo $_SESSION['usuario_nome']; ?>!</span>
            <a href="logout.php" class="logout-link">Sair</a>
        </div>

    <?php else: ?>

        <a href="login.php" class="user-link">Entrar ou <br>Cadastrar</a>

    <?php endif; ?>

    <span class="cart-icon">🛒</span>
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
                <li><a href="#">Ração <span>&rsaquo;</span></a></li>
                <li><a href="#">Petiscos e Ossos <span>&rsaquo;</span></a></li>
                <li><a href="#">Farmácia <span>&rsaquo;</span></a></li>
                <li><a href="#">Brinquedos <span>&rsaquo;</span></a></li>
                <li><a href="#">Coleiras e Guias <span>&rsaquo;</span></a></li>
                <li><a href="#">Camas e Cobertores <span>&rsaquo;</span></a></li>
            </ul>
<<<<<<< HEAD
        </li>

        <li><img src="Assets/gato1.png"> gatos</li>
        <li><img src="Assets/passaros1.png"> pássaros</li>
        <li><img src="Assets/peixe2.png"> peixes</li>
        <li><img src="Assets/roedor1.png"> roedores</li>
        <li><img src="Assets/farmacia2.png"> farmácia</li>
        <li><img src="Assets/higiene1.png"> higiene</li>
        <li><img src="Assets/brinquedos1.png"> brinquedos</li>
        <li><img src="Assets/camas1.png"> camas</li>
        <li><img src="Assets/promocoes1.png"> promoções</li>
        <li><img src="Assets/assinatura1.png"> assinatura</li>
        <li><img src="Assets/adocao2.png"> <a href="adocao.php">Adoção</a></li>
    </ul>
</nav>
 
 
=======
        </nav>
  
>>>>>>> 76002e9c72f02239f794c3a5329ff91a3e64ba43
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
 
    <section class="hero-banner">
        <img src="Assets/zooka2.png" class="banner-media" alt="Banner Pet Shop">
        <div class="hero-content">
            <span class="tagline">exclusivo zookapet</span>
            <h1>Cuidado e Amor em cada detalhe</h1>
            <p>Rações Premium e acessórios com entrega rápida.</p>
            <a href="#" class="btn-primary">mimar meu pet</a>
        </div>
    </section>
 
    <section class="product-shelf">
    <h2 class="shelf-title">presentes favoritos para surpreender</h2>
    
    <div class="carousel-wrapper">
        <button class="carousel-btn prev">❮</button>
        
        <div class="shelf-container">
            <div class="product-card">
                <div class="product-image">
                    <img src="">
                    <span class="wishlist-icon">♡</span>
                </div>
                <div class="product-info">
                    <p class="brand">Zooka Care</p>
                    <p class="name">Presente Pet Conforto - Cama e Manta</p>
                    <p class="old-price">R$ 189,90</p>
                    <p class="new-price">R$ 159,90 <span class="discount">-15%</span></p>
                    <p class="installments">ou 3x de R$ 53,30 sem juros</p>
                    <button class="btn-add">adicionar à sacola</button>
                </div>
            </div>
            
            <div class="product-card">
                <div class="product-image">
                    <img src="img/Cat and Dog Hormones_ The Ultimate Guide.jpeg" alt="Produto">
                    <span class="wishlist-icon">♡</span>
                </div>
                <div class="product-info">
                    <p class="brand">Zooka Food</p>
                    <p class="name">Ração Natural de Frango e Vegetais 3kg</p>
                    <p class="old-price">R$ 120,00</p>
                    <p class="new-price">R$ 84,00 <span class="discount">-30%</span></p>
                    <p class="installments">ou 2x de R$ 42,00 sem juros</p>
                    <button class="btn-add">adicionar à sacola</button>
                </div>
            </div>
            
            </div>
 
        <button class="carousel-btn next">❯</button>
    </div>
    
    <div class="carousel-dots">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</section>
 
<section class="video-section">
    <div class="video-container">
        <video autoplay muted loop playsinline class="bg-video">
            <source src="Assets/ZookaWeb.mp4" type="video/mp4">
        </video>
        <div class="video-overlay">
            <h2>Momentos que Marcam</h2>
            <p>Conheça nossa nova linha de bem-estar animal com extratos naturais.</p>
            <a href="#" class="btn-secondary">eu quero</a>
        </div>
    </div>
</section>
 
<footer class="main-footer">
    <div class="newsletter-section">
        <h3>quer receber nossas novidades e ofertas exclusivas?</h3>
        <p>cadastre-se e aproveite um cupom na sua primeira compra!</p>
<<<<<<< HEAD
        <form method="POST" class="newsletter-form">
    <div class="input-group">
        <label>nome: (*)</label>
        <input type="text" name="nome" placeholder="insira seu nome:" required>
=======
        <form class="newsletter-form">
            <div class="input-group">
                <label>nome: (*)</label>
                <input type="text" placeholder="insira seu nome:">
            </div>
            <div class="input-group">
                <label>email: (*)</label>
                <input type="email" placeholder="insira seu email:">
            </div>
            <div class="input-group">
                <label>celular: (*)</label>
                <input type="tel" placeholder="insira seu celular:">
            </div>
            <button type="submit" class="btn-send">enviar</button>
        </form>
        <p class="disclaimer">ao se cadastrar, você concorda em receber comunicações ZookaPet de acordo com nossa <a href="index.php">política de privacidade</a>.</p>
>>>>>>> 76002e9c72f02239f794c3a5329ff91a3e64ba43
    </div>
    <div class="input-group">
        <label>email: (*)</label>
        <input type="email" name="email" placeholder="insira seu email:" required>
    </div>
    <div class="input-group">
        <label>celular: (*)</label>
        <input type="tel" name="celular" placeholder="insira seu celular:" required>
    </div>
    <button type="submit" class="btn-send">enviar</button>
</form>
 
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
<script type="module">
  import Typebot from 'https://cdn.jsdelivr.net/npm/@typebot.io/js@0/dist/web.js'

  Typebot.initBubble({
    typebot: "lead-generation-yz0zgkk",
    theme: {
      button: { backgroundColor: "#2eaeb0" },
      chatWindow: { backgroundColor: "#020202" },
      
    },
  });
</script>

<?php


if($_POST) {
$email = $_POST['email'] ?? '';
$nome  = $_POST['nome'] ?? '';
$celular  = $_POST['celular'] ?? '';
 
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';
 
$mail = new PHPMailer\PHPMailer\PHPMailer(true);
 
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ZookaPetshop@gmail.com';
    $mail->Password = 'juky tzsz dshp oncx';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
 
    $mail->setFrom('ZookaPetshop@gmail.com', 'Zooka');
    $mail->addAddress($email);
 
    $mail->isHTML(true);
    $mail->Subject = 'Verification code';
    $mail->Body = "
        <h2>Bem-vindo ao Quimera 🚀</h2>
        <p>Seu código de verificação é:</p>
        <h1 style='color:red;'>ok</h1>
    ";
 
    $mail->send();
 

 
} catch (Exception $e) {
    echo "Erro: {$mail->ErrorInfo}";
}
 
}
 
?>
</body>
