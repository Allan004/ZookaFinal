<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - ZookaPetShop</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/sobrenos.css">
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

    <section class="sobre-nos-grid">

       <div class="bloco azul-claro">
    <div class="card-personagem">
        <img class="foto-estatica" src="Assets/elen.png.png" alt="Elen Parada">
        <img class="foto-animada" src="Assets/elengif.gif" alt="Elen Acenando">

        <div class="redes-sociais">
            <a href="https://www.linkedin.com/in/elen-macario-raya-1a8231242/" target="_blank" class="link-social linkedin" title="LinkedIn">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="https://github.com/elenraya" target="_blank" class="link-social github" title="GitHub">
                <i class="fab fa-github"></i>
            </a>
        </div>
        
    </div>
</div>
        <div class="coluna-um"></div>
        <div class="bloco verde-agua">
            <div class="card-personagem henrique">
                <img class="foto-estatica" src="Assets\henrique.png" alt="Rapaz careca com sinal de positivo">
                <img class="foto-animada" src="Assets\henriquegif.gif" alt="Rapaz careca dando sinal positivo piscando">
            </div>
            <div class="redes-sociais">
            <a href="https://www.linkedin.com/in/allan-belchior-1a3ab1346/" target="_blank" class="link-social linkedin" title="LinkedIn">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="https://github.com/henriqueRochas" target="_blank" class="link-social github" title="GitHub">
                <i class="fab fa-github"></i>
            </a>
        </div>
        </div>


        <section class="secao-texto">
            <div class="texto-institucional">
                <p> A ZookaPetShop nasceu da paixão do grupo HEVA pela causa animal e da conexão especial que cada
                    integrante possui com seus pets, companheiros que fazem parte da família e transformam os dias com
                    amor,
                    carinho e lealdade. O nome “Zooka” representa acolhimento, cuidado e afeto, refletindo tudo aquilo
                    que
                    acreditamos quando pensamos no bem-estar dos animais.

                    O projeto também surgiu da preocupação com animais abandonados e vítimas de maus-tratos, que muitas
                    vezes não recebem a atenção, o cuidado e o amor que merecem. A ZookaPetShop foi criada com o
                    propósito
                    de incentivar a proteção animal, promover a conscientização e mostrar a importância de tratar cada
                    pet
                    com respeito, responsabilidade e muito carinho.</p>
                <p>Mais do que um pet shop, a Zooka deseja ser um lugar de confiança, amor e esperança, onde cada animal
                    seja visto como único e especial. Nosso maior objetivo é transmitir cuidado em cada detalhe e
                    fortalecer
                    ainda mais a conexão tão bonita entre os pets e seus tutores.</p>
            </div>
        </section>

        <div class="logo-zooka-container">
            <img src="Assets\nomeZooka.png" alt="Logo Zooka" class="imagem-logo-zooka">
        </div>


        <div class="bloco laranja">
            <div class="card-personagem allan">
                <img class="foto-estatica" src="Assets/allan.png" alt="Rapaz de cabelo comprido e camisa polo">
                <img class="foto-animada" src="Assets/allangif.gif" alt="Rapaz de cabelo comprido piscando">
            </div>
            <div class="redes-sociais">
            <a href="https://www.linkedin.com/in/allan-belchior-1a3ab1346/" target="_blank" class="link-social linkedin" title="LinkedIn">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="https://github.com/Allan004" target="_blank" class="link-social github" title="GitHub">
                <i class="fab fa-github"></i>
            </a>
        </div>
        </div>

        <div class="bloco salmao">
            <div class="card-personagem vitoria">
                <img class="foto-estatica" src="Assets\vitoria.png" alt="Menina de óculos escuros e cabelo cacheado">
                <img class="foto-animada" src="Assets\vitoriagif.gif" alt="Menina de óculos ajeitando a armação">
            </div>
            <div class="redes-sociais">
            <a href="https://www.linkedin.com/in/vitoria-macario-raya-1a8231242/" target="_blank" class="link-social linkedin" title="LinkedIn">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="https://github.com/vitoriacamposs06" target="_blank" class="link-social github" title="GitHub">
                <i class="fab fa-github"></i>
            </a>
        </div>
        </div>
        <div class="bloco marrom">
            <div class="marrom-conteudo">
                <img class="logo-redondo-z" src="Assets/logo_ico.png" alt="Logo Zooka circular">

                <div class="grupo-patinhas-dog">
                    <img class="patinhas-decoracao" src="Assets\patinhasZooka.png" alt="Pegadas de cachorro">
                    <img class="cachorrinho-ilustra" src="cachorrinho-zooka.png"
                        alt="Ilustração do cachorrinho da Zooka">
                </div>
            </div>
        </div>
        </div>

    </section>

</body>

</html>