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
    <link rel="stylesheet" href="css/header.css">
    <script src="script.js" defer></script>
   
   
   
</head>
<body>
   
 
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
            <input type="text" name="filtro" class="search-input" placeholder="o que seu pet precisa hoje?" value="<?php echo htmlspecialchars($_GET['filtro'] ?? '', ENT_QUOTES); ?>">
            <?php if (!empty($_GET['ordenacao'])): ?>
                <input type="hidden" name="ordenacao" value="<?php echo htmlspecialchars($_GET['ordenacao'], ENT_QUOTES); ?>">
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
            <a href="#">Meus pedidos</a>
            <a href="#">Meus pets</a>
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
 
    <!-- CACHORROS -->
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
 
    <!-- GATOS -->
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
 
    <!-- PÁSSAROS -->
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
 
    <!-- PEIXES -->
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
 
    <!-- ROEDORES -->
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
 
    <!-- FARMÁCIA -->
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
 
    <!-- HIGIENE -->
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
 
    <!-- BRINQUEDOS -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/brinquedos1.png"> brinquedos
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=brinquedo&filtro=mordedor">Mordedores</a></li>
            <li><a href="produtos.php?categoria=brinquedo&filtro=bolinha">Bolinhas</a></li>
        </ul>
    </li>
 
    <!-- CAMAS -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/camas1.png"> camas
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=cama&filtro=camas">Camas</a></li>
            <li><a href="produtos.php?categoria=cama&filtro=cobertor">Cobertores</a></li>
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
        <h1>Seu pet merece cuidado, carinho e o melhor todos os dias</h1>
 
        <p>
            Rações premium, brinquedos, acessórios e tudo para o bem-estar
            do seu melhor amigo com entrega rápida e atendimento especializado.
        </p>
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
 

</body>
 