<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZookaPet - O melhor para o seu melhor amigo</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
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
                <input type="text" class="search-input" placeholder="o que seu pet precisa hoje?">
            </div>
            <div class="user-menu">
                <?php if(isset($_SESSION['usuario_nome'])): ?>
                    <div class="user-dropdown">
                        <span class="user-name">Olá, <?php echo $_SESSION['usuario_nome']; ?>!</span>
                        <div class="dropdown-menu">
                            <a href="#">Meus pedidos</a>
                            <a href="#">Meus pets</a>
                            <a href="#">Meus dados</a>
                            <a href="logout.php">Sair</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="user-link">Entrar ou <br>Cadastrar</a>
                <?php endif; ?>
                <a href="carrinho2.php" class="btn-continue">🛒</a>
            </div>
        </div>
       
        <nav class="category-nav">
            <ul>
                <li class="has-dropdown">
                    <div class="category-item">
                        <img src="Assets/cachorro1.png" alt="Cachorros"> cachorros
                    </div>
                    <ul class="submenu">
                        <li><a href="produtos.php?categoria=cachorro&filtro=racao">Ração</a></li>
                        <li><a href="produtos.php?categoria=cachorro&filtro=petisco">Petiscos</a></li>
                        <li><a href="produtos.php?categoria=cachorro&filtro=brinquedo">Brinquedos</a></li>
                    </ul>
                </li>
             
                <li class="has-dropdown">
                    <div class="category-item">
                        <img src="Assets/gato1.png" alt="Gatos"> gatos
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
                        <img src="Assets/passaros1.png" alt="Pássaros"> pássaros
                    </div>
                    <ul class="submenu">
                        <li><a href="produtos.php?categoria=passaro&filtro=racao">Sementes</a></li>
                        <li><a href="produtos.php?categoria=passaro&filtro=gaiola">Gaiolas</a></li>
                        <li><a href="produtos.php?categoria=passaro&filtro=acessorio">Acessórios</a></li>
                    </ul>
                </li>
             
                <li class="has-dropdown">
                    <div class="category-item">
                        <img src="Assets/peixe2.png" alt="Peixes"> peixes
                    </div>
                    <ul class="submenu">
                        <li><a href="produtos.php?categoria=peixe&filtro=racao">Ração</a></li>
                        <li><a href="produtos.php?categoria=peixe&filtro=aquario">Aquários</a></li>
                        <li><a href="produtos.php?categoria=peixe&filtro=filtro">Filtros</a></li>
                    </ul>
                </li>
             
                <li class="has-dropdown">
                    <div class="category-item">
                        <img src="Assets/roedor1.png" alt="Roedores"> roedores
                    </div>
                    <ul class="submenu">
                        <li><a href="produtos.php?categoria=roedor&filtro=racao">Ração</a></li>
                        <li><a href="produtos.php?categoria=roedor&filtro=gaiola">Gaiolas</a></li>
                        <li><a href="produtos.php?categoria=roedor&filtro=brinquedo">Brinquedos</a></li>
                    </ul>
                </li>
             
                <li class="has-dropdown">
                    <div class="category-item">
                        <img src="Assets/farmacia2.png" alt="Farmácia"> farmácia
                    </div>
                    <ul class="submenu">
                        <li><a href="produtos.php?categoria=medicamento&filtro=antipulga">Antipulgas</a></li>
                        <li><a href="produtos.php?categoria=medicamento&filtro=vermifugo">Vermífugos</a></li>
                        <li><a href="produtos.php?categoria=farmacia&filtro=vitamina">Vitaminas</a></li>
                    </ul>
                </li>
             
                <li class="has-dropdown">
                    <div class="category-item">
                        <img src="Assets/higiene1.png" alt="Higiene"> higiene
                    </div>
                    <ul class="submenu">
                        <li><a href="produtos.php?categoria=higiene&filtro=shampoo">Shampoo</a></li>
                        <li><a href="produtos.php?categoria=higiene&filtro=tapete">Tapetes</a></li>
                        <li><a href="produtos.php?categoria=higiene&filtro=escova">Escovas</a></li>
                    </ul>
                </li>
             
                <li class="has-dropdown">
                    <div class="category-item">
                        <img src="Assets/brinquedos1.png" alt="Brinquedos"> brinquedos
                    </div>
                    <ul class="submenu">
                        <li><a href="produtos.php?categoria=brinquedo&filtro=mordedor">Mordedores</a></li>
                        <li><a href="produtos.php?categoria=brinquedo&filtro=bolinha">Bolinhas</a></li>
                    </ul>
                </li>
             
                <li class="has-dropdown">
                    <div class="category-item">
                        <img src="Assets/camas1.png" alt="Camas"> camas
                    </div>
                    <ul class="submenu">
                        <li><a href="produtos.php?categoria=cama&filtro=camas">Camas</a></li>
                        <li><a href="produtos.php?categoria=cama&filtro=cobertor">Cobertores</a></li>
                    </ul>
                </li>
             
                <li class="has-dropdown">
                    <div class="category-item">
                        <img src="Assets/promocoes1.png" alt="Promoções"> promoções
                    </div>
                    <ul class="submenu">
                        <li><a href="produtos.php?categoria=promocao&filtro=oferta">Ofertas do dia</a></li>
                    </ul>
                </li>
             
                <li class="has-dropdown">
                    <div class="category-item">
                        <img src="Assets/assinatura1.png" alt="Assinatura"> assinatura
                    </div>
                    <ul class="submenu">
                        <li><a href="produtos.php?categoria=assinatura&filtro=plano">Planos</a></li>
                    </ul>
                </li> 
             
                <li>
                    <a href="adocao.php" class="category-item">
                        <img src="Assets/adocao2.png" alt="Adoção"> adoção
                    </a>
                </li>
            </ul>
        </nav>
    </header>
 
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
        </div>
     
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
                <div class="items-list"></div>
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
</html>