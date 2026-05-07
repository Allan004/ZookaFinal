<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Carrinho de Compras</title>

    <link rel="stylesheet" href="css/carrinho.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script src="js/carrinho.js" defer></script>

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

            <a href="#">Meus pets</a>

            <a href="#">Meus dados</a>

            <a href="logout.php">Sair</a>

        </div>

    </div>



<?php else: ?>



    <a href="login.php" class="user-link">

        Entrar ou <br>Cadastrar

    </a>



<?php endif; ?>



<a href="CarrinhoZooka.html" class="cart-button">🛒</a>



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

<div class="container">



<div class="container">

    <div class="main-content">

        <section class="cart-card">

            <div class="cart-header">

                <label>

                    <input type="checkbox" checked>

                    <strong>Produtos <span class="full-tag"></span></strong>

                </label>

            </div>

           

            <div class="product-row">

                <input type="checkbox" checked>

                <img src="Assets/carrinho.png" alt="nome do produto">

                <div class="product-details">

                    <span class="offer-badge">OFERTA DO DIA</span>

                    <h3>Nome do produto...</h3>

                    <p class="variant">Detalhe do produto....</p>

                    <div class="quantity-selector">

    <button type="button" class="btn-qty">-</button>

    <input type="text" value="1" class="input-qty">

    <button type="button" class="btn-qty">+</button>

</div>

                </div>

                <div class="product-price">

                    <span class="old-price">R$ xxxxxxxx <span class="discount">x% OFF</span></span>

                    <span class="current-price">R$ xxxxxxx</span>

                </div>

            </div>



            <div class="shipping-info">

                <p>Frete <span class="old-shipping">R$xxxx</span> <span class="free-text">Grátis Para Todo O Brasil</span></p>

                <p class="shipping-tip">Aproveite o frete grátis adicionando mais produtos <span class="full-tag-small"></span>. <a href="#">Ver produtos</a></p>

            </div>

        </section>



        <h2 class="section-title">Recomendações para você</h2>

<div class="recommendations-grid">

    <div class="rec-card">

        <img src="Assets/produto1.png" alt="Produto 1">

        <div class="rec-info">

            <h4>Faqueiro Tramontina 24 Peças Inox Jogo De Talheres...</h4>

            <p class="rec-old-price">R$ 99,90</p>

            <p class="rec-price">R$ 96,90 <span class="discount">3% OFF</span></p>

            <span class="payment-tag">20% OFF Saldo no Zooka</span>

            <p class="free-shipping">Frete grátis</p>

        </div>

    </div>



    <div class="rec-card">

        <img src="Assets/produto2.png" alt="Produto 2">

        <div class="rec-info">

            <h4>Kit 10 Potes Vidro Hermético Aristus 640ml...</h4>

            <p class="rec-old-price">R$ 189,99</p>

            <p class="rec-price">R$ 114 <span class="discount">40% OFF</span></p>

            <span class="payment-tag">20% OFF Saldo no Zooka</span>

            <p class="free-shipping">Frete grátis</p>

        </div>

    </div>



    <div class="rec-card">

        <img src="Assets/produto3.png" alt="Produto 3">

        <div class="rec-info">

            <h4>Panela Pressão Brinox Cerâmica Indução Vanilla...</h4>

            <p class="rec-old-price">R$ 329,90</p>

            <p class="rec-price">R$ 258,63 <span class="discount">21% OFF</span></p>

            <span class="payment-tag">20% OFF Saldo no Zooka</span>

            <p class="free-shipping">Frete grátis</p>

        </div>

    </div>



    <div class="rec-card">

        <img src="Assets/produto4.png" alt="Produto 4">

        <div class="rec-info">

            <h4>19 Peças Kit Utensílios Cozinha Tábua Silicone...</h4>

            <p class="rec-old-price">R$ 129</p>

            <p class="rec-price">R$ 60,81 <span class="discount">52% OFF</span></p>

            <span class="payment-tag">20% OFF Saldo no Zooka</span>

            <p class="free-shipping">Frete grátis</p>

        </div>

    </div>

</div>

</div>

    <aside class="summary-card">

        <h3>Resumo da compra</h3>

        <div class="summary-line">

            <span>Produto</span>

            <span>R$ xxxxxx</span>

        </div>

        <div class="summary-line">

            <span>Frete</span>

            <span class="free-text">Grátis</span>

        </div>

        <div class="coupon-area">

            <a href="#" class="coupon-link" id="openCoupon">Inserir código do cupom</a>

        </div>

        <div class="summary-total">

            <span>Total</span>

            <span class="total-price">R$xxxxxxx</span>

        </div>

        <button class="btn-continue">Continuar</button>

    </aside>

</div>



<div id="couponModal" class="modal-overlay">

    <div class="modal-coupon-card">

        <div class="modal-header">

            <h2>Cupons</h2>

            <span class="close-coupon" id="closeCoupon">&times;</span>

        </div>

        <div class="coupon-input-container">

            <div class="input-wrapper">

                <i class="fas fa-ticket-alt coupon-icon"></i>

                <input type="text" placeholder="Inserir código do cupom" id="couponField">

            </div>

            <button class="btn-add-coupon" id="btnAddCoupon" disabled>Adicionar cupom</button>

        </div>

    </div>

</div>

</div>





<footer>

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