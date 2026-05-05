<?php 

include "../php/buscar_produtos_web";

$filtro=$_GET['categoria']??'';
$nome=$_GET['filtro']??'';
$produtos=produtos_web($nome,$filtro);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zooka PetShop - Gatos</title>
    <link rel="stylesheet" href="css/produtos.css">
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
            <li><a href="produtos.php?categoria=cachorros&filtro=racao">Ração</a></li>
            <li><a href="produtos.php?categoria=cachorros&filtro=petiscos">Petiscos</a></li>
            <li><a href="produtos.php?categoria=cachorros&filtro=brinquedos">Brinquedos</a></li>
        </ul>
    </li>

    <!-- GATOS -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/gato1.png"> gatos
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=gatos&filtro=racao">Ração</a></li>
            <li><a href="produtos.php?categoria=gatos&filtro=areia">Areia</a></li>
            <li><a href="produtos.php?categoria=gatos&filtro=brinquedos">Brinquedos</a></li>
            <li><a href="produtos.php?categoria=gatos&filtro=arranhadores">Arranhadores</a></li>
        </ul>
    </li>

    <!-- PÁSSAROS -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/passaros1.png"> pássaros
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=passaros&filtro=sementes">Sementes</a></li>
            <li><a href="produtos.php?categoria=passaros&filtro=gaiolas">Gaiolas</a></li>
            <li><a href="produtos.php?categoria=passaros&filtro=acessorios">Acessórios</a></li>
        </ul>
    </li>

    <!-- PEIXES -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/peixe2.png"> peixes
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=peixes&filtro=racao">Ração</a></li>
            <li><a href="produtos.php?categoria=peixes&filtro=aquarios">Aquários</a></li>
            <li><a href="produtos.php?categoria=peixes&filtro=filtros">Filtros</a></li>
        </ul>
    </li>

    <!-- ROEDORES -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/roedor1.png"> roedores
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=roedores&filtro=racao">Ração</a></li>
            <li><a href="produtos.php?categoria=roedores&filtro=gaiolas">Gaiolas</a></li>
            <li><a href="produtos.php?categoria=roedores&filtro=brinquedos">Brinquedos</a></li>
        </ul>
    </li>

    <!-- FARMÁCIA -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/farmacia2.png"> farmácia
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=farmacia&filtro=antipulgas">Antipulgas</a></li>
            <li><a href="produtos.php?categoria=farmacia&filtro=vermifugos">Vermífugos</a></li>
            <li><a href="produtos.php?categoria=farmacia&filtro=vitaminas">Vitaminas</a></li>
        </ul>
    </li>

    <!-- HIGIENE -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/higiene1.png"> higiene
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=higiene&filtro=shampoo">Shampoo</a></li>
            <li><a href="produtos.php?categoria=higiene&filtro=tapetes">Tapetes</a></li>
            <li><a href="produtos.php?categoria=higiene&filtro=escovas">Escovas</a></li>
        </ul>
    </li>

    <!-- BRINQUEDOS -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/brinquedos1.png"> brinquedos
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=brinquedos&filtro=mordedores">Mordedores</a></li>
            <li><a href="produtos.php?categoria=brinquedos&filtro=bolinhas">Bolinhas</a></li>
        </ul>
    </li>

    <!-- CAMAS -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/camas1.png"> camas
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=camas&filtro=camas">Camas</a></li>
            <li><a href="produtos.php?categoria=camas&filtro=cobertores">Cobertores</a></li>
        </ul>
    </li>

    <!-- PROMOÇÕES -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/promocoes1.png"> promoções
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=promocoes&filtro=ofertas">Ofertas do dia</a></li>
        </ul>
    </li>

    <!-- ASSINATURA -->
    <li class="has-dropdown">
        <div class="category-item">
            <img src="Assets/assinatura1.png"> assinatura
        </div>
        <ul class="submenu">
            <li><a href="produtos.php?categoria=assinatura&filtro=planos">Planos</a></li>
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
        <aside class="sidebar">
            <div class="filter-header">
                <h3>Filtrar Produtos</h3>
                <span class="clear-filters">Limpar filtros 🗑️</span>
            </div>
            
            <div class="filter-group">
                <h4>Categorias</h4>
                <ul>
                    <li class="active">Ração</li>
                    <li>Petiscos e Ossos</li>
                    <li>Higiene</li>
                    <li>Brinquedos</li>
                </ul>
            </div>
        </aside>

        <main class="content">
            <header class="content-header">
                <h1>Gato</h1>
                <div class="sort">
                    <span>Ordenar por:</span>
                    <select>
                        <option>Mais relevantes</option>
                        <option>Menor preço</option>
                    </select>
                </div>
            </header>

            <section class="products-section">
                <h2>Mais comprados em Gato</h2>
                
                <div class="products-grid">
                    <?php 
                    
                    foreach($produtos as $produto){

                        echo '<div class="product-card">
                        <div class="product-image">
                            <span class="badge-off">15% OFF</span>
                            <img src="assets/imagens_produtos/'.$produto["id"].'.jpg" alt="Produto">
                            <button class="add-cart">+</button>
                        </div>
                        <div class="product-info">
                            <p class="product-name">'.$produto['nome'].'</p>
                            <p class="old-price">A partir de '.$produto['preco'].'</p>
                            <p class="price">'.$produto['preco']*0.9.'<span class="sync-icon">🔄</span></p>
                            <p class="subscriber-price">para assinantes</p>
                        </div>
                    </div>';


                    };
                    

                    
                    
                    ?>

                    </div>
            </section>
        </main>
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

</body>
</html>