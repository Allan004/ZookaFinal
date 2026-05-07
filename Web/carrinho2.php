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

        <section class="cart-section">

            <div class="cart-header">
                <span>Produtos</span>
                <span>Desconto</span>
                <span>Preço</span>
                <span>Quantidade</span>
                <span>Total</span>
            </div>

            <div class="cart-product">

                <div class="product-info">

                    <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?q=80&w=300&auto=format&fit=crop"
                        alt="Brinquedo">

                    <div class="product-text">
                        <h3>
                            Brinquedo Cansei de Ser Gato Ratinho com Catnip Amarelo
                        </h3>
                    </div>

                </div>

                <div class="discount">
                    <span>10% OFF</span>
                </div>

                <div class="price">
                    <p class="old-price">R$ 44,99</p>
                    <p class="new-price">R$ 40,49</p>
                </div>

                <div class="quantity">
                    <button>-</button>
                    <span>1</span>
                    <button>+</button>
                </div>

                <div class="total">
                    <span>R$ 40,49</span>

                    <i class="fa-regular fa-trash-can"></i>
                </div>

            </div>

        </section>

        <aside class="delivery-section">

            <h2>Escolha a forma de entrega</h2>

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

            <div class="delivery-option"
                onclick="toggleSideModal()"
                style="cursor:pointer;">

                <div class="delivery-left">

                    <i class="fa-solid fa-store"></i>

                    <div>
                        <h4>Retire na Loja</h4>
                        <p>Em algumas lojas a partir de 45 min</p>
                    </div>

                </div>

                <span class="free">Grátis</span>

            </div>

            <div class="address-box">

                <h3>Endereço de entrega</h3>

                <div class="address-card">

                    <h4>Minha Casa</h4>

                    <p>Avenida Três, 417</p>
                    <p>Guarulhos - SP</p>
                    <p>CEP: 07179-707</p>

                </div>

                <a href="#" id="openModal">
                    Alterar endereço
                </a>

            </div>

            <div class="summary-box">

                <h2>Resumo do pedido</h2>

                <div class="summary-row">

                    <p>
                        Valor dos produtos
                        <strong>(5 itens)</strong>
                    </p>

                    <span>R$ 224,95</span>

                </div>

                <div class="summary-row">

                    <p class="info-text">

                        Taxa de serviço

                        <i class="fa-regular fa-circle-question"></i>

                    </p>

                    <span>R$ 5,90</span>

                </div>

                <div class="summary-row">

                    <p>Prazo de entrega</p>

                    <span>Até 12/05/2026</span>

                </div>

                <div class="summary-row">

                    <p>
                        Entrega para
                        <strong>07179-707</strong>
                    </p>

                    <span class="free-text">
                        Grátis
                    </span>

                </div>

                <div class="summary-row">

                    <p>

                        Total de descontos

                        <i class="fa-solid fa-chevron-down"></i>

                    </p>

                    <span class="discount-text">
                        - R$ 22,50
                    </span>

                </div>

                <div class="summary-total">

                    <div>

                        <h3>Total</h3>

                    </div>

                    <div class="total-price">

                        <h2>R$ 208,35</h2>

                        <p>
                            ou 2 vezes de R$ 104,18 sem juros
                        </p>

                    </div>

                </div>

                <div class="shipping-free">

                    <p>

                        <i class="fa-solid fa-truck"></i>

                        Frete grátis liberado!

                    </p>

                    <div class="shipping-bar">

                        <div class="shipping-progress"></div>

                    </div>

                </div>

                <button class="payment-btn">
                    Ir para pagamento
                </button>

                <button class="more-products-btn">
                    Escolher mais produtos
                </button>

            </div>

        </aside>

    </main>

    <div class="modal" id="addressModal">

        <div class="modal-content">

            <div class="modal-header">

                <h2>Cadastrar novo endereço</h2>

                <button id="closeModal">

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>

            <div class="address-option">

                <div class="address-left">

                    <div class="address-title">

                        <h3>minha casa</h3>

                        <i class="fa-solid fa-circle-check"></i>

                    </div>

                    <p>Rua dos Anjos</p>
                    <p>Guarulhos - SP</p>
                    <p>CEP: 07179-707</p>

                </div>

                <button class="edit-btn">

                    <i class="fa-regular fa-pen-to-square"></i>

                </button>

            </div>

            <button
                type="button"
                class="new-address"
                id="openRegisterModal">

                <i class="fa-solid fa-circle-plus"></i>

                Cadastrar endereço

            </button>

        </div>

    </div>

    <div id="sideModalOverlay" class="side-modal-overlay">

        <div class="side-modal-content">

            <div class="side-modal-header">

                <h3>Escolha a loja para retirar o pedido</h3>

                <span class="close-side-modal"
                    onclick="toggleSideModal()">

                    &times;

                </span>

            </div>

            <div class="side-modal-tabs">

                <button class="tab-btn active">
                    Lojas + próximas
                </button>

                <button class="tab-btn">
                    Lojas + rápidas
                </button>

            </div>

            <div class="side-modal-body">

                <div class="stores-list">

                    <div class="store-card selected">

                        <div class="store-card-header">

                            <strong>
                                Zooka Guarulhos Centro
                            </strong>

                            <span class="distance-tag">
                                4.5 km
                            </span>

                        </div>

                        <p class="store-address">
                            Avenida Exemplo, 123 - Centro
                        </p>

                        <div class="store-info">

                            <p>
                                <strong>
                                    Horário de Funcionamento:
                                </strong>

                                <br>

                                Segunda a sábado - das 08:00 às 22:00
                            </p>

                        </div>

                        <div class="delivery-time">

                            <i class="fas fa-clock"></i>

                            A partir de 45 minutos

                        </div>

                    </div>

                </div>

                <div id="googleMapContainer"
                    class="map-container">

                    <div class="map-placeholder">

                        <p>
                            Carregando mapa interativo...
                        </p>

                    </div>

                </div>

            </div>

            <div class="side-modal-footer">

                <p>

                    <i class="fas fa-info-circle"></i>

                    Prazo para retirada a partir da confirmação do pagamento.

                </p>

            </div>

        </div>

    </div>

    <div class="register-modal" id="registerModal">

        <div class="register-content">

            <div class="register-header">

                <h2>Cadastrar novo endereço</h2>

                <button id="closeRegisterModal">

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>

            <form class="address-form">

                <div class="form-group cep-group">

                    <label>Qual o CEP?</label>

                    <div class="cep-row">

                        <input type="text">

                        <a
                            href="https://buscacepinter.correios.com.br/app/endereco/index.php"
                            target="_blank">

                            Não sei meu cep

                        </a>

                    </div>

                </div>

                <div class="form-group">

                    <label>Endereço</label>

                    <input
                        type="text"
                        placeholder="Digite o nome da rua">

                </div>

                <div class="form-group">

                    <label>Número</label>

                    <div class="number-row">

                        <input
                            type="text"
                            placeholder="Digite o número">

                        <label class="checkbox">

                            <input type="checkbox">

                            <span>Sem número</span>

                        </label>

                    </div>

                </div>

                <div class="form-group">

                    <label>

                        Complemento

                        <span>opcional</span>

                    </label>

                    <input
                        type="text"
                        placeholder="Apartamento, bloco e outros">

                </div>

                <div class="form-group">

                    <label>Bairro</label>

                    <input
                        type="text"
                        placeholder="Digite o nome do bairro">

                </div>

                <div class="city-state">

                    <div class="form-group">

                        <label>Cidade</label>

                        <input type="text">

                    </div>

                    <div class="form-group">

                        <label>Estado</label>

                        <select>

                            <option></option>
                            <option>SP</option>
                            <option>RJ</option>
                            <option>MG</option>

                        </select>

                    </div>

                </div>

                <div class="form-group">

                    <label>

                        Referência

                        <span>opcional</span>

                    </label>

                    <input
                        type="text"
                        placeholder="Digite um ponto de referência">

                </div>

                <div class="form-group">

                    <label>
                        Apelido do endereço
                    </label>

                    <input
                        type="text"
                        placeholder="Dê um nome para o endereço">

                </div>

                <button type="submit" class="confirm-address-btn">
                    Confirmar
                </button>

            </form>

        </div>

    </div>

    <script src="js/carrinho2.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsLXJZMNJ8TrUQfLMaDYXZuhsfwzwMfOg&callback=initMap&libraries=marker&loading=async"
        defer></script>

</body>

</html>