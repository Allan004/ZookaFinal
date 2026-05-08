<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Zooka Petshop</title>

    <link rel="stylesheet" href="css/carrinho2.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <main class="container">

        <!-- ========================= -->
        <!-- CARRINHO -->
        <!-- ========================= -->

        <section class="cart-section">

            <!-- HEADER -->
            <div class="cart-header">

                <span>Produtos</span>
                <span>Desconto</span>
                <span>Preço</span>
                <span>Quantidade</span>
                <span>Total</span>

            </div>

            <!-- PRODUTO -->
            <div class="cart-product">

                <!-- INFO -->
                <div class="product-info">

                    <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?q=80&w=300&auto=format&fit=crop"
                        alt="Produto">

                    <div class="product-text">

                        <h3>
                            Brinquedo Cansei de Ser Gato Ratinho com Catnip Amarelo
                        </h3>

                    </div>

                </div>

                <!-- DESCONTO -->
                <div class="discount">

                    <span>10% OFF</span>

                </div>

                <!-- PREÇO -->
                <div class="price">

                    <p class="old-price">
                        R$ 44,99
                    </p>

                    <p class="new-price">
                        R$ 40,49
                    </p>

                </div>

                <!-- QUANTIDADE -->
                <div class="quantity">

                    <button>-</button>

                    <span>1</span>

                    <button>+</button>

                </div>

                <!-- TOTAL -->
                <div class="total">

                    <span>R$ 40,49</span>

                    <i class="fa-regular fa-trash-can"></i>

                </div>

            </div>

            <!-- ========================= -->
            <!-- RECOMENDAÇÕES -->
            <!-- ========================= -->

            <div class="recommendations-section">

                <h2 class="section-title">
                    Recomendações para você
                </h2>

                <div class="recommendations-grid">

                    <!-- CARD -->
                    <div class="rec-card">

                        <img src="Assets/produto1.png" alt="Produto 1">

                        <div class="rec-info">

                            <h4>
                                Faqueiro Tramontina 24 Peças Inox Jogo De Talheres...
                            </h4>

                            <p class="rec-old-price">
                                R$ 99,90
                            </p>

                            <p class="rec-price">

                                R$ 96,90

                                <span class="discount">
                                    3% OFF
                                </span>

                            </p>

                            <span class="payment-tag">
                                20% OFF Saldo no Zooka
                            </span>

                            <p class="free-shipping">
                                Frete grátis
                            </p>

                        </div>

                    </div>

                    <!-- CARD -->
                    <div class="rec-card">

                        <img src="Assets/produto2.png" alt="Produto 2">

                        <div class="rec-info">

                            <h4>
                                Kit 10 Potes Vidro Hermético Aristus 640ml...
                            </h4>

                            <p class="rec-old-price">
                                R$ 189,99
                            </p>

                            <p class="rec-price">

                                R$ 114

                                <span class="discount">
                                    40% OFF
                                </span>

                            </p>

                            <span class="payment-tag">
                                20% OFF Saldo no Zooka
                            </span>

                            <p class="free-shipping">
                                Frete grátis
                            </p>

                        </div>

                    </div>

                    <!-- CARD -->
                    <div class="rec-card">

                        <img src="Assets/produto3.png" alt="Produto 3">

                        <div class="rec-info">

                            <h4>
                                Panela Pressão Brinox Cerâmica Indução Vanilla...
                            </h4>

                            <p class="rec-old-price">
                                R$ 329,90
                            </p>

                            <p class="rec-price">

                                R$ 258,63

                                <span class="discount">
                                    21% OFF
                                </span>

                            </p>

                            <span class="payment-tag">
                                20% OFF Saldo no Zooka
                            </span>

                            <p class="free-shipping">
                                Frete grátis
                            </p>

                        </div>

                    </div>

                    <!-- CARD -->
                    <div class="rec-card">

                        <img src="Assets/produto4.png" alt="Produto 4">

                        <div class="rec-info">

                            <h4>
                                19 Peças Kit Utensílios Cozinha Tábua Silicone...
                            </h4>

                            <p class="rec-old-price">
                                R$ 129
                            </p>

                            <p class="rec-price">

                                R$ 60,81

                                <span class="discount">
                                    52% OFF
                                </span>

                            </p>

                            <span class="payment-tag">
                                20% OFF Saldo no Zooka
                            </span>

                            <p class="free-shipping">
                                Frete grátis
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- ========================= -->
        <!-- ENTREGA -->
        <!-- ========================= -->

        <aside class="delivery-section">

            <h2>
                Escolha a forma de entrega
            </h2>

            <!-- ENTREGA -->
            <div class="delivery-option active">

                <div class="delivery-left">

                    <i class="fa-solid fa-check"></i>

                    <div>

                        <h4>Padrão</h4>

                        <p>Até amanhã</p>

                    </div>

                </div>

                <span>R$ 5,76</span>

            </div>

            <!-- EXPRESSA -->
            <div class="delivery-option">

                <div class="delivery-left">

                    <i class="fa-regular fa-clock"></i>

                    <div>

                        <h4>Expressa</h4>

                        <p>Em até 3 horas</p>

                    </div>

                </div>

                <span>R$ 10,27</span>

            </div>

            <!-- RETIRADA -->
            <div class="delivery-option"
                onclick="toggleSideModal()"
                style="cursor:pointer;">

                <div class="delivery-left">

                    <i class="fa-solid fa-store"></i>

                    <div>

                        <h4>Retire na Loja</h4>

                        <p>
                            Em algumas lojas a partir de 45 min
                        </p>

                    </div>

                </div>

                <span class="free">
                    Grátis
                </span>

            </div>

            <!-- ENDEREÇO -->
            <div class="address-box">

                <h3>
                    Endereço de entrega
                </h3>

                <div class="address-card">

                    <h4>
                        Minha Casa
                    </h4>

                    <p>
                        Avenida Três, 417
                    </p>

                    <p>
                        Guarulhos - SP
                    </p>

                    <p>
                        CEP: 07179-707
                    </p>

                </div>

                <a href="#" id="openModal">
                    Alterar endereço
                </a>

            </div>

            <!-- ========================= -->
            <!-- RESUMO -->
            <!-- ========================= -->

            <div class="summary-box">

                <h2>
                    Resumo do pedido
                </h2>

                <!-- LINHA -->
                <div class="summary-row">

                    <p>
                        Valor dos produtos
                        <strong>(5 itens)</strong>
                    </p>

                    <span>
                        R$ 224,95
                    </span>

                </div>

                <!-- LINHA -->
                <div class="summary-row">

                    <p class="info-text">

                        Taxa de serviço

                        <i class="fa-regular fa-circle-question"></i>

                    </p>

                    <span>
                        R$ 5,90
                    </span>

                </div>

                <!-- LINHA -->
                <div class="summary-row">

                    <p>
                        Prazo de entrega
                    </p>

                    <span>
                        Até 12/05/2026
                    </span>

                </div>

                <!-- LINHA -->
                <div class="summary-row">

                    <p>

                        Entrega para
                        <strong>07179-707</strong>

                    </p>

                    <span class="free-text">
                        Grátis
                    </span>

                </div>

                <!-- LINHA -->
                <div class="summary-row">

                    <p>

                        Total de descontos

                        <i class="fa-solid fa-chevron-down"></i>

                    </p>

                    <span class="discount-text">

                        - R$ 22,50

                    </span>

                </div>

                <!-- TOTAL -->
                <div class="summary-total">

                    <div>

                        <h3>
                            Total
                        </h3>

                    </div>

                    <div class="total-price">

                        <h2>
                            R$ 208,35
                        </h2>

                        <p>
                            ou 2x de R$ 104,18 sem juros
                        </p>

                    </div>

                </div>

                <!-- FRETE -->
                <div class="shipping-free">

                    <p>

                        <i class="fa-solid fa-truck"></i>

                        Frete grátis liberado!

                    </p>

                    <div class="shipping-bar">

                        <div class="shipping-progress"></div>

                    </div>

                </div>

                <!-- BOTÃO -->
                <button class="payment-btn">

                    Ir para pagamento

                </button>

                <!-- BOTÃO -->
                <button class="more-products-btn">

                    Escolher mais produtos

                </button>

            </div>

        </aside>

    </main>

    <script src="js/carrinho2.js"></script>

</body>

</html>