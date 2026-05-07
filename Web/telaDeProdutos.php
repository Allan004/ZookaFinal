<?php

include "../php/buscar_produtos_web";

$id_produto=$_GET['idProduto'];
$produto=produto_espefico($id_produto);

?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produto</title>
    <link rel="stylesheet" href="css/telaDeProdutos.css">
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

<a href="CarrinhoZooka.html" class="btn-continue">🛒</a>

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




    <!-- LADO ESQUERDO (IMAGENS) -->
    <div class="galeria">

    <div class="thumbs">
        <img 
            src="<?php echo 'Assets/imagens_produtos/produto_'.$produto['id'].'/1.jpg' ?>" 
            class="thumb active"
        >

        <img 
            src="<?php echo 'Assets/imagens_produtos/produto_'.$produto['id'].'/2.jpg' ?>" 
            class="thumb"
        >
    </div>

    <div class="imagem-principal">

        <img 
            id="imagemPrincipal"
            src="<?php echo 'Assets/imagens_produtos/produto_'.$produto['id'].'/1.jpg' ?>"
        >

        <div class="dots">
            <span class="dot active"></span>
            <span class="dot"></span>
        </div>

    </div>

</div>

    <!-- LADO DIREITO (INFO) -->
    <div class="info">

      

        <h1>
           <?php echo $produto['nome']?>
        </h1>

        <p class="codigo"><?php echo 'Código: '.$produto['codigo_produto']?></p>

        <div class="avaliacao">
            ⭐ 4.4
        </div>

        <div class="preco">
            <span class="normal"><?php echo 'R$'.$produto['preco']?></span>
            <span class="assinante"><?php  echo 'R$'.$produto['preco']*0.9?></span>
        </div>

        <div class="opcoes-compra">
    <div class="pesos">
        <button class="peso active">VALOR 1</button>
        <button class="peso">VALOR 2</button>
    </div>

    <div class="compra-acoes">
    <div class="quantidade">
        <button class="qtd-btn">-</button>
        <span>1</span>
        <button class="qtd-btn">+</button>
    </div>

    <button class="comprar">adicionar à sacola</button>
</div>

        <div class="estoque">
            Quer comprar na loja física?<br>
            <a href="#">Consulte nosso estoque</a>
        </div>

    </div>

</div>

</div> <!-- FECHA opcoes-compra -->

    


<!-- CARACTERISTICAS DO PRODUTO -->



<!-- CARACTERISTICAS DO PRODUTO TERMINA AQUI -->



<!-- Descrição detalhada começa aqui -->


<section class="descricao-container">
    <h2>Descrição</h2>
    
    <div class="descricao-texto">
        <p>Seja bem-vindo à nossa loja! Estamos felizes em recebê-lo em um espaço dedicado a oferecer qualidade, inovação e tecnologia de ponta. Aqui, você encontrará uma experiência de compra única, com atendimento especializado e soluções que atendem às suas necessidades.</p>
        
        <p class="divisor">----------Descrição:</p>
        
        <p><?php echo $produto['descricao'] ?></p>
        
        <p class="divisor">----------Especificações:</p>
    </div>

    <a href="#" class="btn-ver-mais">
        Ver descrição completa 
        <span class="seta-baixo">⌄</span>
    </a>
</section>

<!-- e termina aqui viu -->

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

<script>

const thumbs = document.querySelectorAll('.thumb');
const imagemPrincipal = document.getElementById('imagemPrincipal');

thumbs.forEach((thumb) => {

    thumb.addEventListener('click', () => {

        
        imagemPrincipal.src = thumb.src;

        
        thumbs.forEach(img => {
            img.classList.remove('active');
        });

       
        thumb.classList.add('active');

    });

});

</script>

</body>
</html>