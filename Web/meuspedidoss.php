<?php
session_start();
require_once "../php/conexao.php";

$pdo = conectar();

$id_login = $_SESSION['usuario_id'] ?? null;
$sqlUser = $pdo->prepare("SELECT nome FROM clienteweb WHERE id_login = ?");
$sqlUser->execute([$id_login]);
$usuario = $sqlUser->fetch(PDO::FETCH_ASSOC);

if (!$id_login) {
    header("Location: login.php");
    exit;
}

/* BUSCA PEDIDOS */
$sql = $pdo->prepare("
    SELECT *
    FROM pedido_web
    WHERE id_clienteweb = ?
    ORDER BY created_at DESC
");

$sql->execute([$id_login]);

$pedidos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Meus Pedidos - ZookaPet</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
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

                <input 
                    type="text"
                    name="filtro"
                    class="search-input"
                    placeholder="o que seu pet precisa hoje?"
                >

            </form>

        </div>

        <div class="user-menu">

            <?php if(isset($_SESSION['usuario_nome'])): ?>

                <div class="user-dropdown">

                    <span class="user-name">
                        Olá, <?php echo $_SESSION['usuario_nome']; ?>!
                    </span>

                    <div class="dropdown-menu">
                        <a href="meuspedidoss.php">Meus pedidos</a>
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

    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/brinquedos1.png"> brinquedos
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=brinquedo&filtro=mordedor">Mordedores</a></li>
            <li><a href="produtos.php?categoria=brinquedo&filtro=bolinha">Bolinhas</a></li>
        </ul>
    </li>

    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/camas1.png"> camas
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=cama&filtro=camas">Camas</a></li>
            <li><a href="produtos.php?categoria=cama&filtro=cobertor">Cobertores</a></li>
        </ul>
    </li>

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
<section class="area-cliente">

    <aside class="menu-cliente">

        <div class="cliente-box">
            <span>Olá,</span>
            <h3><?php echo $usuario['nome']; ?></h3>
        </div>

        <nav class="sidebar-links">
            <a href="meusdados.php">Meus dados</a>
            <a href="meuspedidoss.php" class="active">Meus pedidos</a>
            <a href="logout.php">Sair da conta</a>
        </nav>

    </aside>

    <main class="conteudo-cliente">

        <div class="card-dados">

            <h1>Meus pedidos</h1>

            <p class="subtitulo">
                Confira o histórico dos seus pedidos.
            </p>

            <?php if(count($pedidos) > 0): ?>

                <div class="pedidos-container">

                    <?php foreach($pedidos as $pedido): ?>

                        <div class="pedido-card">

                           <div class="pedido-topo">

    <div>
        <span class="pedido-label">Pedido</span>
        <h3>#<?php echo $pedido['id_pedido_web']; ?></h3>
    </div>

    <div>
        <span class="pedido-label">Data</span>

        <p>
            <?php echo date('d/m/Y', strtotime($pedido['created_at'])); ?>
        </p>
    </div>

    <div>
        <span class="pedido-label">Total</span>

        <strong class="pedido-total">
            R$ <?php echo number_format($pedido['total'], 2, ',', '.'); ?>
        </strong>
    </div>

</div>

<?php

$itens = $pdo->prepare("
    SELECT
        pedido_web_item.*,
        produto.nome,
        produto.Imagens
    FROM pedido_web_item

    INNER JOIN produto
        ON produto.id = pedido_web_item.id_produto

    WHERE pedido_web_item.id_pedido_web = ?
");

$itens->execute([$pedido['id_pedido_web']]);

$listaItens = $itens->fetchAll(PDO::FETCH_ASSOC);

?>

<button
    class="btn-detalhes"
    onclick="abrirModal(<?php echo $pedido['id_pedido_web']; ?>)"
>
    Ver detalhes
</button>

<div
    class="modal-pedido"
    id="modal-<?php echo $pedido['id_pedido_web']; ?>"
>

    <div class="modal-conteudo">

        <span
            class="fechar-modal"
            onclick="fecharModal(<?php echo $pedido['id_pedido_web']; ?>)"
        >
            ×
        </span>

<h2>
    Pedido #<?php echo $pedido['id_pedido_web']; ?>
</h2>


<div class="lista-itens">

        <div class="lista-itens">

            <?php foreach($listaItens as $item): ?>

                <div class="item-pedido">

    <div class="item-esquerda">

       <img
    src="Assets/imagens_produtos/produto_<?php echo $item['id_produto']; ?>/1.jpg"
    class="img-item"
>

        <div>

            <strong>
                <?php echo $item['nome']; ?>
            </strong>

            <p>
                Quantidade:
                <?php echo $item['quantidade']; ?>
            </p>

        </div>

    </div>

    <strong>
        R$
        <?php echo number_format($item['total_item'], 2, ',', '.'); ?>
    </strong>

</div>
            <?php endforeach; ?>
            </div>

<div class="bloco-info-pedido">

    <h3>Resumo do pedido</h3>

    <div class="resumo-grid">

        <div class="resumo-left">

            <div class="resumo-item">
                <span>Status</span>
                <strong><?php echo $pedido['status_pedido']; ?></strong>
            </div>

            <div class="resumo-item">
                <span>Data</span>
                <strong>
                    <?php echo date('d/m/Y H:i', strtotime($pedido['data_pedido'])); ?>
                </strong>
            </div>

            <div class="resumo-item">
                <span>Entrega</span>
                <strong><?php echo $pedido['metodo_entrega']; ?></strong>
            </div>

        </div>

        <div class="resumo-right">

            <div class="linha">
                <span>Subtotal</span>
                <strong>R$ <?php echo number_format($pedido['subtotal'], 2, ',', '.'); ?></strong>
            </div>

            <div class="linha">
                <span>Frete</span>
                <strong>R$ <?php echo number_format($pedido['frete'], 2, ',', '.'); ?></strong>
            </div>

            <div class="linha">
                <span>Descontos</span>
                <strong>- R$ <?php echo number_format($pedido['total_descontos'], 2, ',', '.'); ?></strong>
            </div>

            <div class="total-box">
                <span>Total</span>
                <strong>R$ <?php echo number_format($pedido['total'], 2, ',', '.'); ?></strong>
            </div>

        </div>

    </div>

</div>

<div class="endereco-pedido">

    <h3>Endereço de entrega</h3>

    <p>
        <?php echo $pedido['rua']; ?>,
        <?php echo $pedido['numero']; ?>
    </p>

    <p>
        <?php echo $pedido['bairro']; ?>
    </p>

    <p>
        <?php echo $pedido['cidade']; ?> -
        <?php echo $pedido['estado']; ?>
    </p>

    <p>
        CEP: <?php echo $pedido['cep']; ?>
    </p>

</div>

        </div>

    </div>

</div>

</div>
                    <?php endforeach; ?>

                </div>

            <?php else: ?>

                <div class="sem-pedidos">

                    <h2>Você ainda não possui pedidos.</h2>

                    <a href="index.php" class="btn-salvar">
                        Comprar agora
                    </a>

                </div>

            <?php endif; ?>

        </div>

    </main>

</section>
<script>

function abrirModal(id){

    const modal = document.getElementById('modal-' + id);

    modal.style.display = 'flex';
}

function fecharModal(id){

    const modal = document.getElementById('modal-' + id);

    modal.style.display = 'none';
}

window.addEventListener('click', function(e){

    document.querySelectorAll('.modal-pedido').forEach(modal => {

        if(e.target === modal){
            modal.style.display = 'none';
        }

    });

});

</script>
</body>
</html>