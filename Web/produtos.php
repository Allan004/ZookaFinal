<?php 

include "../php/buscar_produtos_web";

$filtro=$_GET['categoria']??'';
$nome=$_GET['filtro']??'';
$ordenar=$_GET['ordenacao']??'';
$produtos=produtos_web($nome,$filtro,$ordenar);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zooka PetShop - Produtos <?php echo ucfirst($_GET['categoria'] ?? "Produtos");?></title>
    <link rel="stylesheet" href="css/produtos.css">
</head>
<body>



 <div class="top-promo">  
        10% OFF na primeira compra com o cupom <strong>BEMVINDOAUAU</strong>
    </div>
 
   <header class="main-header">
    <div class="header-top">
       
        <div class="logo-container">
            <a href="index.php  " class="logo">
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
                <span class="clear-filters"><a class="sem_linha" href="produtos.php">Limpar filtros 🗑️</a></span>
            </div>
            
            <div class="filter-group">
                <h2>Categorias</h2>
                <ul class="menu">
                    <h3 class="h3_desce">Cachorros</h3>
                <ul>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=racao">Ração</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=filhote">Ração Filhote</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=sênior">Ração Sênior</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=petisco">Petiscos</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=brinquedo">Brinquedos</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=cama">Camas</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=coleira">Coleiras</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=antipulgas">Antipulgas</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=shampoo">Shampoos</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=filhote">Shampoo Filhote</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=higiene">Higiene</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=tapete">Tapete Higiênico</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=bebedouro">Bebedouros</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=comedouro">Comedouros</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=transporte">Transporte</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=cachorro&filtro=medicamento">Medicamentos</a></li>
                </ul>
                    <h3 class="h3_desce">Gatos</h3>
                <ul>
                    <li><a class="sem_linha" href="produtos.php?categoria=gato&filtro=racao">Ração</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=gato&filtro=adulto">Ração Adulto</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=gato&filtro=petisco">Petiscos</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=gato&filtro=areia">Areia Sanitária</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=gato&filtro=shampoo">Shampoos</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=gato&filtro=filhote">Shampoo Filhote</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=gato&filtro=antipulgas">Antipulgas</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=gato&filtro=higiene">Higiene</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=gato&filtro=comedouro">Comedouros</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=gato&filtro=bebedouro">Bebedouros</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=gato&filtro=transporte">Transporte</a></li>  
                </ul>
                    <h3 class="h3_desce">Aves</h3>
                <ul>
                    <li><a class="sem_linha" href="produtos.php?categoria=passaro&filtro=racao">Ração</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=passaro&filtro=calopsita">Ração Calopsita</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=passaro&filtro=gaiola">Gaiolas</a></li>
                </ul>
                    <h3 class="h3_desce">Peixes</h3>
                <ul>
                    <li><a class="sem_linha" href="produtos.php?categoria=peixe&filtro=racao">Ração</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=peixe&filtro=aquario">Aquários</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=peixe&filtro=filtro">Filtros</a></li>
                </ul>
                   <h3 class="h3_desce">Roedores</h3>
                <ul>
                    <li><a class="sem_linha" href="produtos.php?categoria=roedor&filtro=racao">Ração</a></li>
                </ul>
                    <h3 class="h3_desce">Outros</h3>
                <ul>
                    <li><a class="sem_linha" href="produtos.php?categoria=geral&filtro=higiene">Higiene</a></li>
                    <li><a class="sem_linha" href="produtos.php?categoria=geral&filtro=escova">Escovas</a></li>
                </ul>
                

            </div>
        </aside>

        <main class="content">
            <header class="content-header">
                <h1><?php
               echo ucfirst($_GET['categoria'] ?? "Produtos");
                ?></h1>
                <div class="sort">
                    <span>Ordenar por:</span>
                     <select onchange="atualizarOrdenacao(this.value)">
                        <option value="">Selecione Uma Categoria</option>
                        <option value="nome" <?= ($ordenar == "nome") ? "selected" : "" ?>>A-Z</option>
                        <option value="preco" <?= ($ordenar == "preco") ? "selected" : "" ?>>Menor preço</option>
                    </select>
                </div>
            </header>

            <section class="products-section">
                
                <div class="products-grid">
                    <?php 
                    
                    foreach($produtos as $produto){

   echo '
<div class="product-card"
     onclick="window.location.href=\'telaDeProdutos.php?idProduto='.$produto['id'].'\'">

    <div class="product-image">
        <span class="badge-off">15% OFF</span>

        <img src="assets/imagens_produtos/produto_'.$produto["id"].'/1.jpg" alt="Produto">

        <a class="add-cart"
           href="adicionarCarrinho.php?idProduto='.$produto['id'].'"
           onclick="event.stopPropagation();">
            +
        </a>
    </div>

    <div class="product-info">

        <p class="product-name">'.$produto['nome'].'</p>

        <p class="old-price">
            A partir de R$'.$produto['preco'].'
        </p>

        <p class="price">
            R$'.($produto['preco'] * 0.9).'
        </p>

    </div>

</div>';

}
                    
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


<script>

    function atualizarOrdenacao(valor) {
    let url = new URL(window.location.href);

    url.searchParams.set("ordenacao", valor);

    window.location.href = url.toString();
}
</script>

</body>
</html>