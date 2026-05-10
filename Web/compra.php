<?php
session_start();
require_once '../php/carrinho.php';

$erroFinalizacao = '';
$mensagemFinalizacao = '';
$metodoEntrega = $_GET['metodo_entrega'] ?? 'padrao';
$totais = calcular_totais_carrinho($metodoEntrega);
$enderecoCliente = obter_endereco_cliente_web();

if (!$totais) {
    $totais = [
        'itens' => [],
        'subtotal' => 0.00,
        'descontos' => 0.00,
        'subtotal_com_desconto' => 0.00,
        'taxa_servico' => 0.00,
        'frete' => 0.00,
        'metodo_entrega' => $metodoEntrega,
        'total' => 0.00,
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finalizar_pedido'])) {
    $metodoEntrega = $_POST['metodo_entrega'] ?? $metodoEntrega;
    $idPedido = finalizar_pedido($metodoEntrega);

    if ($idPedido) {
        header('Location: compra.php?pedido_finalizado=1&id_pedido=' . urlencode($idPedido));
        exit;
    }

    if (empty($totais['itens'])) {
        $erroFinalizacao = 'Seu carrinho está vazio. Adicione produtos antes de finalizar o pedido.';
    } elseif (!$enderecoCliente) {
        $erroFinalizacao = 'Atualize seu endereço antes de finalizar o pedido.';
    } else {
        $erroFinalizacao = 'Não foi possível finalizar o pedido. Tente novamente.';
    }
}

if (isset($_GET['pedido_finalizado'])) {
    $mensagemFinalizacao = 'Pedido finalizado com sucesso! ID do pedido: ' . htmlspecialchars($_GET['id_pedido'], ENT_QUOTES, 'UTF-8');
}
?>
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
                <a href="insdex.php" class="logo">
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

    <main class="checkout-container">
        <div class="checkout-content">
            <section class="payment-section">
                <h1 class="page-title"><i class="fa-solid fa-paw"></i> Pagamento</h1>

                <?php if (!empty($mensagemFinalizacao)): ?>
                    <div class="checkout-feedback success" style="margin-bottom: 16px; padding: 14px; border-radius: 8px; background: #e6ffec; color: #206a33;">
                        <?php echo $mensagemFinalizacao; ?>
                    </div>
                <?php elseif (!empty($erroFinalizacao)): ?>
                    <div class="checkout-feedback error" style="margin-bottom: 16px; padding: 14px; border-radius: 8px; background: #ffe6e6; color: #9d1f1f;">
                        <?php echo htmlspecialchars($erroFinalizacao, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php endif; ?>
                
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
                        <div class="summary-line"><span>Produtos</span><span>R$ <?php echo number_format($totais['subtotal'], 2, ',', '.'); ?></span></div>
                        <div class="summary-line"><span>Descontos</span><span class="discount-text">- R$ <?php echo number_format($totais['descontos'], 2, ',', '.'); ?></span></div>
                        <div class="summary-line"><span>Taxa de serviço</span><span>R$ <?php echo number_format($totais['taxa_servico'], 2, ',', '.'); ?></span></div>
                        <div class="summary-line"><span>Frete (<?php echo ucfirst($totais['metodo_entrega']); ?>)</span><span class="<?php echo $totais['frete'] == 0 ? 'free-text' : ''; ?>"><?php echo $totais['frete'] == 0 ? 'Grátis' : 'R$ ' . number_format($totais['frete'], 2, ',', '.'); ?></span></div>
                        <?php if (!empty($enderecoCliente)): ?>
                            <div class="summary-line"><span>Endereço de entrega</span><span><?php echo htmlspecialchars(($enderecoCliente['rua'] ?? '—') . ', ' . ($enderecoCliente['numero'] ?? '') . ' - ' . ($enderecoCliente['bairro'] ?? '—') . ', ' . ($enderecoCliente['cidade'] ?? '—') . '/' . ($enderecoCliente['estado'] ?? '—'), ENT_QUOTES, 'UTF-8'); ?></span></div>
                        <?php else: ?>
                            <div class="summary-line"><span>Endereço de entrega</span><span style="color: #9d1f1f;">Não informado</span></div>
                        <?php endif; ?>
                        <hr class="zooka-divider">
                        <div class="summary-line total-line">
                            <span>Total</span>
                            <span class="total-value">R$ <?php echo number_format($totais['total'], 2, ',', '.'); ?></span>
                        </div>
                    </div>
                    <form method="POST" action="compra.php<?php echo !empty($metodoEntrega) ? '?metodo_entrega=' . urlencode($metodoEntrega) : ''; ?>">
                        <input type="hidden" name="finalizar_pedido" value="1">
                        <input type="hidden" name="metodo_entrega" value="<?php echo htmlspecialchars($totais['metodo_entrega'], ENT_QUOTES, 'UTF-8'); ?>">
                        <button type="submit" class="btn-pay" <?php echo empty($totais['itens']) ? 'disabled' : ''; ?>>FINALIZAR COMPRA</button>
                    </form>
                </div>
            </aside>
        </div>
    </main>

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


    <div id="pixModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="pix-header">
                <i class="fa-brands fa-pix"></i>
                <h2>Pagamento via Pix</h2>
            </div>
            <p>Escaneie o QR Code para pagar:</p>
            <div class="qr-code-area">
                <img src="Assets/Rickrolling_QR_code.png" alt="QR Code Pix">
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