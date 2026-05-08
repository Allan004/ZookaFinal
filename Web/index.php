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
    <script src="script.js" defer></script>
   
   
   
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
    <input type="text" class="search-input" placeholder="o que seu pet precisa hoje?">
</div>

<div class="user-menu">

<?php if(isset($_SESSION['usuario_nome'])): ?>

    <div class="user-dropdown">
        <span class="user-name">
            Olá, <?php echo $_SESSION['usuario_nome']; ?>!
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

<a href="carrinho.php" class="btn-continue">🛒</a>

</div>
 
    </div>
</header>
       
       <nav class="category-nav">
<ul>
 
    <!-- CACHORROS -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/cachorro1.png"> cachorros
        </div>
        <ul class="submenu">
            <li><a href="#">Ração</a></li>
            <li><a href="#">Petiscos</a></li>
            <li><a href="#">Brinquedos</a></li>
        </ul>
    </li>
 
    <!-- GATOS -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/gato1.png"> gatos
        </div>
        <ul class="submenu">
            <li><a href="#">Ração</a></li>
            <li><a href="#">Areia</a></li>
            <li><a href="#">Brinquedos</a></li>
            <li><a href="#">Arranhadores</a></li>
        </ul>
    </li>
 
    <!-- PÁSSAROS -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/passaros1.png"> pássaros
        </div>
        <ul class="submenu">
            <li><a href="#">Sementes</a></li>
            <li><a href="#">Gaiolas</a></li>
            <li><a href="#">Acessórios</a></li>
        </ul>
    </li>
 
    <!-- PEIXES -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/peixe2.png"> peixes
        </div>
        <ul class="submenu">
            <li><a href="#">Ração</a></li>
            <li><a href="#">Aquários</a></li>
            <li><a href="#">Filtros</a></li>
        </ul>
    </li>
 
    <!-- ROEDORES -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/roedor1.png"> roedores
        </div>
        <ul class="submenu">
            <li><a href="#">Ração</a></li>
            <li><a href="#">Gaiolas</a></li>
            <li><a href="#">Brinquedos</a></li>
        </ul>
    </li>
 
    <!-- FARMÁCIA -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/farmacia2.png"> farmácia
        </div>
        <ul class="submenu">
            <li><a href="#">Antipulgas</a></li>
            <li><a href="#">Vermífugos</a></li>
            <li><a href="#">Vitaminas</a></li>
        </ul>
    </li>
 
    <!-- HIGIENE -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/higiene1.png"> higiene
        </div>
        <ul class="submenu">
            <li><a href="#">Shampoo</a></li>
            <li><a href="#">Tapetes</a></li>
            <li><a href="#">Escovas</a></li>
        </ul>
    </li>
 
    <!-- BRINQUEDOS -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/brinquedos1.png"> brinquedos
        </div>
        <ul class="submenu">
            <li><a href="#">Mordedores</a></li>
            <li><a href="#">Bolinhas</a></li>
        </ul>
    </li>
 
    <!-- CAMAS -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/camas1.png"> camas
        </div>
        <ul class="submenu">
            <li><a href="#">Camas</a></li>
            <li><a href="#">Cobertores</a></li>
        </ul>
    </li>
 
    <!-- PROMOÇÕES -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/promocoes1.png"> promoções
        </div>
        <ul class="submenu">
            <li><a href="#">Ofertas do dia</a></li>
        </ul>
    </li>
 
    <!-- ASSINATURA -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/assinatura1.png"> assinatura
        </div>
        <ul class="submenu">
            <li><a href="#">Planos</a></li>
        </ul>
    </li> 
 
    <!-- ADOÇÃO -->
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
        </div>

    <button class="carousel-btn next">❯</button>
</div>
    
    <div class="shelf-container">
        <div class="product-card">
            <div class="product-image">
                <img src="Assets/racao (1).png" alt="Ração Golden Special">
                <span class="wishlist-icon">♡</span>
            </div>
            <div class="product-info">
                <p class="brand">Zooka Food</p>
                <p class="name">Ração Golden Special Adulto 10,1kg</p>
                <p class="old-price">R$ 189,90</p>
                <p class="new-price">R$ 159,90 <span class="discount">-15%</span></p>
                <p class="installments">ou 3x de R$ 53,30 sem juros</p>
                <button class="btn-add">adicionar à sacola</button>
            </div>
        </div>

        <div class="product-card">
            <div class="product-image">
                <img src="Assets/racao (2).png" alt="Escova Removedora">
                <span class="wishlist-icon">♡</span>
            </div>
            <div class="product-info">
                <p class="brand">Zooka Care</p>
                <p class="name">Escova Removedora de Pelos</p>
                <p class="old-price">R$ 70,00</p>
                <p class="new-price">R$ 21,00 <span class="discount">-30%</span></p>
                <p class="installments">ou 2x de R$ 10.50 sem juros</p>
                <button class="btn-add">adicionar à sacola</button>
            </div>
        </div>

        <div class="product-card">
            <div class="product-image">
                <img src="Assets/antipulgas.jpg" alt="Simparic">
                <span class="wishlist-icon">♡</span>
            </div>
           
            <div class="product-info">
                <p class="brand">Zooka therapy</p>
                <p class="name">Antipulgas Simparic 10–20kg</p>
                <p class="new-price">R$ 113,00</p>
                <p class="installments">ou 2x de R$ 56,50 sem juros</p>
                <button class="btn-add">adicionar à sacola</button>
            </div>
        </div>

        <div class="product-card">
            <div class="product-image">
                <img src="Assets/racao (2).png" alt="Escova Removedora">
                <span class="wishlist-icon">♡</span>
            </div>
            <div class="product-info">
                <p class="brand">Zooka Care</p>
                <p class="name">Escova Removedora de Pelos</p>
                <p class="old-price">R$ 70,00</p>
                <p class="new-price">R$ 21,00 <span class="discount">-30%</span></p>
                <p class="installments">ou 2x de R$ 10.50 sem juros</p>
                <button class="btn-add">adicionar à sacola</button>
            </div>
        </div>
    </div>

  <button class="carousel-btn next">❯</button>

   
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
            
        </div>
    </div>
</section>




 
<footer class="main-footer">
    <div class="newsletter-section">
        <h3>quer receber nossas novidades e ofertas exclusivas?</h3>
        <p>cadastre-se e aproveite um cupom na sua primeira compra!</p>
        <form method="POST" class="newsletter-form">
    <div class="input-group">
        <label>nome: (*)</label>
        <input type="text" name="nome" placeholder="insira seu nome:" required>
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
    $celular = $_POST['celular'] ?? '';

    require_once 'PHPMailer/src/PHPMailer.php';
    require_once 'PHPMailer/src/SMTP.php';
    require_once 'PHPMailer/src/Exception.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ZookaPetshop@gmail.com';
        $mail->Password = 'juky tzsz dshp oncx'; // Lembre-se de manter esta senha segura
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8'; // Garante acentuação correta

        $mail->setFrom('ZookaPetshop@gmail.com', 'Zooka Petshop');
        $mail->addAddress($email);

        $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'Bem-vindo à Zooka, ' . $nome . '!';

    $mail->Body = '

<html>

<head>

<meta charset="UTF-8">

<style>

body{
    background:#f4f4f4;
    padding:30px;
    font-family:Arial,sans-serif;
}

.container{
    max-width:600px;
    margin:auto;
    background:#ffffff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

.banner img{
    width:100%;
    display:block;
}

.content{
    padding:40px;
    text-align:center;
}

.titulo{
    color:#ca7e4c;
    font-size:32px;
    font-weight:bold;
    margin-bottom:20px;
}

.texto{
    color:#666;
    font-size:16px;
    line-height:1.7;
    margin-bottom:30px;
}

.numero{
    color:#176668;
    font-weight:bold;
}

.botao{
    display:inline-block;
    background:#2eaeb0;
    color:white !important;
    text-decoration:none;
    padding:16px 28px;
    border-radius:10px;
    font-weight:bold;
    font-size:14px;
}

.footer{
    background:#fafafa;
    padding:20px;
    text-align:center;
    color:#999;
    font-size:12px;
    border-top:1px solid #eee;
}

</style>

</head>

<body>

<div class="container">

    <div class="banner">
        <img src="https://i.imgur.com/xwFq8GA.png">
    </div>

    <div class="content">

        <div class="titulo">
            Olá, '.$nome.'!
        </div>

        <div class="texto">

            Ficamos muito felizes com seu cadastro 💚

            <br><br>

            Recebemos seus dados com sucesso e em breve nossa equipe entrará em contato através do número:

            <br><br>

            <span class="numero">
                '.$celular.'
            </span>

        </div>


    </div>

    <div class="footer">
        © 2026 Zooka Petshop
    </div>

</div>

</body>

</html>

';

$mail->AltBody = "Olá, $nome! Recebemos seu cadastro com sucesso.";

    $mail->send();
        echo "E-mail enviado com sucesso!";

    } catch (Exception $e) {
        echo "Erro: {$mail->ErrorInfo}";
    }
}
?>

<div id="modal-carrinho" class="modal-overlay">
    <div class="modal-content">
        <button id="fechar-modal" class="close-btn">&times;</button>
        
        <div id="carrinho-vazio" class="cart-state">
            <h2>Sacola</h2>
            <div class="empty-content">
                <p>Você ainda não tem produtos adicionados à sacola.</p>
                <div class="icon-bag">🛍️<span class="badge">0</span></div>
                <p>Escolha tudo que o seu pet precisa e adicione à sacola para comprar.</p>
                <button class="btn-entendi" onclick="toggleModal()">Entendi</button>
            </div>
        </div>

        <div id="carrinho-com-itens" class="cart-state" style="display: none;">
            <h2>Confira sua compra</h2>
            <div class="items-list">
                </div>
            <div class="cart-footer">
                <div class="subtotal">
                    <span>Subtotal</span>
                    <span id="valor-subtotal">R$ 0,00</span>
                </div>
                <button class="btn-primary-modal">Ir para sacola</button>
                <button class="btn-back" onclick="toggleModal()">Voltar</button>
            </div>
        </div>
    </div>
</div>
</body>