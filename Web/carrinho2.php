<?php
session_start();
include "../php/carrinho.php";

$erroEndereco = '';
$mensagemEndereco = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['acao']) && !empty($_POST['idCarrinho'])) {
        $idCarrinho = intval($_POST['idCarrinho']);
        if ($_POST['acao'] === 'increment') {
            alterar_quantidade_item_carrinho($idCarrinho, 1);
        } elseif ($_POST['acao'] === 'decrement') {
            alterar_quantidade_item_carrinho($idCarrinho, -1);
        } elseif ($_POST['acao'] === 'remove') {
            remover_item_carrinho($idCarrinho);
        }
        header('Location: carrinho2.php');
        exit;
    }

    if (!empty($_POST['idProduto'])) {
    $idProduto = intval($_POST['idProduto']);
    $quantidade = isset($_POST['quantidade']) ? max(1, intval($_POST['quantidade'])) : 1;

    if ($idProduto > 0) {
        adicionar_item_carrinho($idProduto, $quantidade);
    }

    header('Location: carrinho2.php');
    exit;
}

    if (!empty($_POST['atualizar_endereco'])) {
        $dadosEndereco = [
            'cep' => $_POST['cep'] ?? '',
            'rua' => $_POST['rua'] ?? '',
            'numero' => $_POST['numero'] ?? '',
            'bairro' => $_POST['bairro'] ?? '',
            'cidade' => $_POST['cidade'] ?? '',
            'estado' => $_POST['estado'] ?? '',
        ];

        if (atualizar_endereco_cliente_web($dadosEndereco)) {
            header('Location: carrinho2.php?endereco_atualizado=1');
            exit;
        }

        $erroEndereco = 'Não foi possível atualizar o endereço. Verifique os dados e tente novamente.';
    }
}

if (isset($_GET['endereco_atualizado'])) {
    $mensagemEndereco = 'Endereço atualizado com sucesso.';
}

if (isset($_GET['pedido_finalizado'])) {
    $mensagemEndereco = 'Pedido finalizado com sucesso! ID do pedido: ' . htmlspecialchars($_GET['id_pedido'], ENT_QUOTES, 'UTF-8');
}

$enderecoCliente = obter_endereco_cliente_web();
$itensCarrinho = buscar_itens_carrinho();
$quantidadeTotal = array_sum(array_column($itensCarrinho, 'quantidade'));
$valorProdutos = 0.0;
$valorDescontos = 0.0;
foreach ($itensCarrinho as $item) {
    $valorProdutos += $item['preco'] * $item['quantidade'];
    $valorDescontos += $item['preco'] * $item['quantidade'] * 0.1;
}
$valorProdutosComDesconto = max(0, $valorProdutos - $valorDescontos);
$taxaServico = 5.90;
$fretePadrao = 5.76;
$freteExpressa = 10.27;
$freteRetirada = 0.0;
$freteSelecionado = $fretePadrao;
$valorTotal = $valorProdutosComDesconto + $taxaServico + $freteSelecionado;
?>

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

<?php if (empty($itensCarrinho)): ?>
            <div class="cart-empty" style="padding: 24px; text-align: center; width: 100%;">
                <p>Seu carrinho está vazio. Adicione produtos na página de produtos.</p>
            </div>
        </section>
<?php else: ?>
            <?php foreach ($itensCarrinho as $item): ?>
                <?php
                    $oldPrice = number_format($item['preco'], 2, ',', '.');
                    $newPrice = number_format($item['preco'] * 0.9, 2, ',', '.');
                    $totalItem = number_format($item['preco'] * $item['quantidade'] * 0.9, 2, ',', '.');
                ?>
            <div class="cart-product">

                <div class="product-info">

                    <img src="Assets/imagens_produtos/produto_<?php echo $item['id_produto']; ?>/1.jpg"
                        alt="<?php echo htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8'); ?>">

                    <div class="product-text">
                        <h3><?php echo htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    </div>

                </div>

                <div class="discount">
                    <span>10% OFF</span>
                </div>

                <div class="price">
                    <p class="old-price">R$ <?php echo $oldPrice; ?></p>
                    <p class="new-price">R$ <?php echo $newPrice; ?></p>
                </div>

                <div class="quantity">
                    <form method="POST" action="carrinho2.php" style="display:inline-block;">
                        <input type="hidden" name="acao" value="decrement">
                        <input type="hidden" name="idCarrinho" value="<?php echo $item['id_carrinho']; ?>">
                        <button type="submit" class="quantity-btn">-</button>
                    </form>
                    <span><?php echo $item['quantidade']; ?></span>
                    <form method="POST" action="carrinho2.php" style="display:inline-block;">
                        <input type="hidden" name="acao" value="increment">
                        <input type="hidden" name="idCarrinho" value="<?php echo $item['id_carrinho']; ?>">
                        <button type="submit" class="quantity-btn">+</button>
                    </form>
                </div>

                <div class="total">
                    <span>R$ <?php echo $totalItem; ?></span>

                    <form method="POST" action="carrinho2.php" style="display:inline-block; margin-left: 12px;">
                        <input type="hidden" name="acao" value="remove">
                        <input type="hidden" name="idCarrinho" value="<?php echo $item['id_carrinho']; ?>">
                        <button type="submit" class="delete-cart-item" style="background:none; border:none; color:#333; cursor:pointer;">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </form>
                </div>

            </div>
            <?php endforeach; ?>

            <div class="continue-shopping-wrapper" style="width: 100%; text-align: center; margin: 24px 0;">
                <a href="produtos.php" class="continue-shopping-btn" style="display: inline-block; padding: 14px 24px; background: #2f8fef; color: #fff; border-radius: 8px; text-decoration: none; font-weight: 600;">Continuar comprando</a>
            </div>

        </section>
<?php endif; ?>

        <aside class="delivery-section">

            <h2>Escolha a forma de entrega</h2>

            <div class="delivery-option active" data-method="padrao" data-price="5.76">

                <div class="delivery-left">

                    <i class="fa-solid fa-check"></i>

                    <div>
                        <h4>Padrão</h4>
                        <p>Até amanhã</p>
                    </div>

                </div>

                <span class="shipping-price">R$ 5,76</span>

            </div>

            <div class="delivery-option" data-method="expressa" data-price="10.27">

                <div class="delivery-left">

                    <i class="fa-regular fa-clock"></i>

                    <div>
                        <h4>Expressa</h4>
                        <p>Em até 3 horas</p>
                    </div>

                </div>

                <span class="shipping-price">R$ 10,27</span>

            </div>

            <div class="delivery-option" data-method="retirada" data-price="0.00" style="cursor:pointer;">

                <div class="delivery-left">

                    <i class="fa-solid fa-store"></i>

                    <div>
                        <h4>Retire na Loja</h4>
                        <p>Em algumas lojas a partir de 45 min</p>
                    </div>

                </div>

                <span class="shipping-price free">Grátis</span>

            </div>

            <div class="address-box">

                <h3>Endereço de entrega</h3>

                <?php if (!empty($mensagemEndereco)): ?>
                    <div class="address-feedback" style="margin-bottom: 12px; padding: 12px; border-radius: 8px; background: #e6ffec; color: #206a33;">
                        <?php echo htmlspecialchars($mensagemEndereco, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php elseif (!empty($erroEndereco)): ?>
                    <div class="address-feedback" style="margin-bottom: 12px; padding: 12px; border-radius: 8px; background: #ffe6e6; color: #9d1f1f;">
                        <?php echo htmlspecialchars($erroEndereco, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php endif; ?>

                <div class="address-card">

                    <h4>Minha Casa</h4>

                    <p><?php echo htmlspecialchars($enderecoCliente['rua'] ?? 'Rua não informada', ENT_QUOTES, 'UTF-8'); ?>, <?php echo htmlspecialchars($enderecoCliente['numero'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                    <p><?php echo htmlspecialchars($enderecoCliente['bairro'] ?? 'Bairro não informado', ENT_QUOTES, 'UTF-8'); ?> - <?php echo htmlspecialchars($enderecoCliente['cidade'] ?? 'Cidade não informada', ENT_QUOTES, 'UTF-8'); ?></p>
                    <p>CEP: <?php echo htmlspecialchars($enderecoCliente['cep'] ?? '----', ENT_QUOTES, 'UTF-8'); ?></p>

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
                        <strong>(<?php echo $quantidadeTotal; ?> itens)</strong>
                    </p>

                    <span>R$ <?php echo number_format($valorProdutos, 2, ',', '.'); ?></span>

                </div>

                <div class="summary-row">

                    <p class="info-text">

                        Taxa de serviço

                        <i class="fa-regular fa-circle-question"></i>

                    </p>

                    <span>R$ <?php echo number_format($taxaServico, 2, ',', '.'); ?></span>

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

                    <span id="shippingFee" class="free-text">
                        R$ <?php echo number_format($freteSelecionado, 2, ',', '.'); ?>
                    </span>

                </div>

                <div id="summaryData" data-service="<?php echo $taxaServico; ?>" data-products="<?php echo $valorProdutosComDesconto; ?>" style="display:none"></div>

                <div class="summary-row">

                    <p>

                        Total de descontos

                        <i class="fa-solid fa-chevron-down"></i>

                    </p>

                    <span class="discount-text">
                        - R$ <?php echo number_format($valorDescontos, 2, ',', '.'); ?>
                    </span>

                </div>

                <div class="summary-total">

                    <div>

                        <h3>Total</h3>

                    </div>

                    <div class="total-price">

                        <h2 id="summaryTotal">R$ <?php echo number_format($valorTotal, 2, ',', '.'); ?></h2>

                        <p>
                            ou 2 vezes de R$ <?php echo number_format($valorTotal / 2, 2, ',', '.'); ?> sem juros
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

                <form method="GET" action="compra.php">
                    <input type="hidden" name="metodo_entrega" id="metodoEntrega" value="padrao">
                    <button type="submit" class="payment-btn">
                        Finalizar Pedido
                    </button>
                </form>

                <button class="more-products-btn">
                    Escolher mais produtos
                </button>

            </div>

        </aside>

    </main>

    <div class="modal" id="addressModal">

        <div class="modal-content">

            <div class="modal-header">

                <h2>Editar endereço</h2>

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

                Editar endereço

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

                <h2>Editar endereço</h2>

                <button id="closeRegisterModal">

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>

            <form class="address-form" method="POST" action="carrinho2.php">

                <input type="hidden" name="atualizar_endereco" value="1">

                <div class="form-group cep-group">

                    <label>Qual o CEP?</label>

                    <div class="cep-row">

                        <input type="text" name="cep" value="<?php echo htmlspecialchars($enderecoCliente['cep'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

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
                        name="rua"
                        value="<?php echo htmlspecialchars($enderecoCliente['rua'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Digite o nome da rua">

                </div>

                <div class="form-group">

                    <label>Número</label>

                    <div class="number-row">

                        <input
                            type="text"
                            name="numero"
                            value="<?php echo htmlspecialchars($enderecoCliente['numero'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
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
                        name="complemento"
                        placeholder="Apartamento, bloco e outros">

                </div>

                <div class="form-group">

                    <label>Bairro</label>

                    <input
                        type="text"
                        name="bairro"
                        value="<?php echo htmlspecialchars($enderecoCliente['bairro'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Digite o nome do bairro">

                </div>

                <div class="city-state">

                    <div class="form-group">

                        <label>Cidade</label>

                        <input type="text" name="cidade" value="<?php echo htmlspecialchars($enderecoCliente['cidade'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

                    </div>

                    <div class="form-group">

                        <label>Estado</label>

                        <select name="estado">

                            <option value="">Selecione</option>
                            <option value="SP" <?php echo (isset($enderecoCliente['estado']) && $enderecoCliente['estado'] === 'SP') ? 'selected' : ''; ?>>SP</option>
                            <option value="RJ" <?php echo (isset($enderecoCliente['estado']) && $enderecoCliente['estado'] === 'RJ') ? 'selected' : ''; ?>>RJ</option>
                            <option value="MG" <?php echo (isset($enderecoCliente['estado']) && $enderecoCliente['estado'] === 'MG') ? 'selected' : ''; ?>>MG</option>

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
                        name="referencia"
                        placeholder="Digite um ponto de referência">

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