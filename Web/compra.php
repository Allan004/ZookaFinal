<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento - Família Zooka</title>
    <link rel="stylesheet" href="css/compra.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="js/compra.js" defer></script>
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
                <a href="CarrinhoZooka.html" class="btn-continue">🛒</a>
            </div>
        </div>
    </header>

    <nav class="category-nav">
        <ul>
            <li class="has-dropdown">
                <div class="category-item"><img src="Assets/cachorro1.png"> cachorros</div>
                <ul class="submenu">
                    <li><a href="produtos.php?categoria=cachorro&filtro=racao">Ração</a></li>
                    <li><a href="produtos.php?categoria=cachorro&filtro=petisco">Petiscos</a></li>
                    <li><a href="produtos.php?categoria=cachorro&filtro=brinquedo">Brinquedos</a></li>
                </ul>
            </li>
            <li class="has-dropdown">
                <div class="category-item"><img src="Assets/gato1.png"> gatos</div>
                <ul class="submenu">
                    <li><a href="produtos.php?categoria=gato&filtro=racao">Ração</a></li>
                    <li><a href="produtos.php?categoria=gato&filtro=areia">Areia</a></li>
                </ul>
            </li>
            <li><a href="adocao.php" class="category-item"><img src="Assets/adocao2.png"> adoção</a></li>
        </ul>
    </nav>

    <div class="scrolling-ticker">
        <div class="ticker-content">
            <span>Frete grátis</span> <img src="Assets/patinhas1.png" alt="pata">
            <span>Brindes exclusivos</span> <img src="Assets/coroa1.png" alt="pata">
            <span>15% a 25% OFF</span> <img src="Assets/patinhas1.png" alt="pata">
        </div>
    </div>

    <main class="checkout-container">
        <div class="checkout-content">
            <section class="payment-section">
                <h1 class="page-title"><i class="fa-solid fa-paw"></i> Pagamento</h1>
                
                <div class="card-white main-payment-card">
                    <div class="payment-header">
                        <h3><i class="fa-solid fa-credit-card"></i> Formas de pagamento</h3>
                        <p class="safe-tag"><i class="fa-solid fa-shield-halved"></i> 100% Seguro</p>
                    </div>

                    <ul class="payment-list">
                        <li id="btnCartao" class="active" style="cursor: pointer;">
                            <div class="pay-info">
                                <i class="fa-solid fa-credit-card icon-pay"></i>
                                <span>Cartão de crédito</span>
                            </div>
                            <i class="arrow">›</i>
                        </li>
                        
                        <li id="btnPix" style="cursor: pointer;">
                            <div class="pay-info">
                                <i class="fa-brands fa-pix icon-pay"></i>
                                <span>Pix <small class="tag-green">Aprovação imediata</small></span>
                            </div>
                            <i class="arrow">›</i>
                        </li>

                        <li>
                            <a href="boleto.php" style="text-decoration: none; color: inherit; display: flex; width: 100%; align-items: center; justify-content: space-between;">
                                <div class="pay-info">
                                    <i class="fa-solid fa-barcode icon-pay"></i>
                                    <span>Boleto Bancário</span>
                                </div>
                                <i class="arrow">›</i>
                            </a>
                        </li>
                    </ul>

                    <div class="card-form">
                        <div class="input-group">
                            <label>Número do cartão</label>
                            <div class="input-with-icon">
                                <input type="text" placeholder="0000 0000 0000 0000">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Nome do titular</label>
                            <input type="text" placeholder="Como está impresso no cartão">
                        </div>
                        <div class="row">
                            <div class="input-group">
                                <label>Validade</label>
                                <input type="text" placeholder="MM/AA">
                            </div>
                            <div class="input-group">
                                <label>CVV <i class="fa-regular fa-circle-question"></i></label>
                                <input type="text" placeholder="000">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <aside class="sidebar-section">
                <div class="card-white summary-card">
                    <h3>Resumo do Pedido</h3>
                    <div class="summary-details">
                        <div class="summary-line"><span>Produtos</span><span>R$ 224,95</span></div>
                        <div class="summary-line"><span>Frete</span><span class="free-text">Grátis</span></div>
                        <hr class="zooka-divider">
                        <div class="summary-line total-line">
                            <span>Total</span>
                            <span class="total-value">R$ 202,45</span>
                        </div>
                    </div>
                    <button class="btn-pay">FINALIZAR COMPRA</button>
                </div>
            </aside>
        </div>
    </main>

    <footer>
        <div class="footer-links-container">
            <div class="logo-footer">zookapet</div>
        </div>
    </footer>

    <div id="pixModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="pix-header">
                <i class="fa-brands fa-pix"></i>
                <h2>Pagamento via Pix</h2>
            </div>
            <p>Escaneie o QR Code para pagar:</p>
            <div class="qr-code-area">
                <img src="Assets/qrcode.png" alt="QR Code Pix">
            </div>
            <div class="copy-paste-area">
                <p>Ou utilize o Pix Copia e Cola:</p>
                <div class="input-copy">
                    <input type="text" value="SUA-CHAVE-PIX-AQUI" id="pixCode" readonly>
                    <button onclick="copyPix()">Copiar</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>