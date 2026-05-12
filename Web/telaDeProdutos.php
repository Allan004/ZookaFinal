<?php

include "../php/buscar_produtos_web";

$id_produto=$_GET['idProduto'];
$produto=produto_espefico($id_produto);



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produto</title>
    <link rel="stylesheet" href="css/telaDeProdutos.css">
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
 
    <!-- PROMOÇÕES -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/promocoes1.png"> promoções
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=promocao&filtro=oferta">Ofertas do dia</a></li>
        </ul>
    </li>
 
    <!-- ASSINATURA -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/assinatura1.png"> assinatura
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=assinatura&filtro=plano">Planos</a></li>
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

    <div class="compra-acoes">

        <div class="quantidade">
            <button type="button" class="qtd-btn" id="menos">-</button>
            <span id="qtd-numero">1</span>
            <button type="button" class="qtd-btn" id="mais">+</button>
        </div>

        <form action="carrinho2.php" method="POST" style="margin:0; padding:0; display:contents;">
            <input type="hidden" name="idProduto" value="<?php echo $produto['id']; ?>">
            <input type="hidden" name="quantidade" id="quantidadeInput" value="1">

            <button type="submit" class="comprar">
                adicionar à sacola
            </button>
        </form>

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
                      <a href="sobrenos.php" >Nossa História</a>
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

<!-- SUBSTITUA/APENAS ACRESCENTE NO FINAL DO SCRIPT -->
const btnMenos = document.getElementById('menos');
const btnMais = document.getElementById('mais');
const qtdNumero = document.getElementById('qtd-numero');
const quantidadeInput = document.getElementById('quantidadeInput');

let quantidade = 1;

btnMais.addEventListener('click', function () {
    quantidade++;
    qtdNumero.textContent = quantidade;
    quantidadeInput.value = quantidade;
});

btnMenos.addEventListener('click', function () {
    if (quantidade > 1) {
        quantidade--;
        qtdNumero.textContent = quantidade;
        quantidadeInput.value = quantidade;
    }
});

</script>

</body>
</html>