<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdoteZooka</title>

    <link rel="stylesheet" href="css/adocao.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body>

<header>
    <nav class="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="Assets/logo.png" class="banner-topo" alt="Zooka">
            </a>
        </div>

        <div class="nav-buttons">
            <a href="queroadotar.php" class="btn-orange">Quero adotar</a>
            <a href="https://www.webdenuncia.sp.gov.br/depa" class="btn-orange" target="_blank" rel="noopener noreferrer">Denuncie</a>
            
        </div>
    </nav>
</header>

<section class="hero-banner">
    <div class="carousel">
        <div class="slide active">
            <a href="#">
                <img src="Assets/1.png" class="bg-slide" alt="Vantagens exclusivas para adotantes">
                <div class="slide-content"></div>
            </a>
        </div>

        <div class="slide">
            <a href="#">
                <img src="Assets/2.png" class="bg-slide" alt="O silêncio mata. Sua denúncia salva.">
                <div class="slide-content"></div>
            </a>
        </div>

        <div class="slide">
            <a href="#">
                <img src="Assets/3.png" class="bg-slide" alt="Denuncie maus-tratos">
                <div class="slide-content"></div>
            </a>
        </div>
    </div>

    <button class="prev" aria-label="Anterior">&#10094;</button>
    <button class="next" aria-label="Próximo">&#10095;</button>

    <div class="dots">
        <span class="dot active" onclick="irParaSlide(0)"></span>
        <span class="dot" onclick="irParaSlide(1)"></span>
        <span class="dot" onclick="irParaSlide(2)"></span>
    </div>
</section>

<section class="highlights">
    <div class="card">
        <h3>Adoção: um ato de amor</h3>
        <p>Mudar o destino de um animal transforma vidas.</p>
    </div>

    <div class="card">
        <h3>Responsabilidade</h3>
        <p>Ter um pet exige compromisso.</p>
    </div>

    <div class="card">
        <h3>Proteção Ativa</h3>
        <p>Denunciar maus-tratos é essencial.</p>
    </div>
</section>

<section class="stats-section">
    <div class="stats-banner">
        <div class="stats-overlay">
            <div class="stats-container">
                <div class="stat-item">
                    <h2 class="counter" data-target="30">0</h2>
                    <span class="unit">Milhões</span>
                    <p>Animais de rua no Brasil</p>
                </div>
                <div class="stat-item">
                    <h2 class="counter" data-target="180">0</h2>
                    <span class="unit">Mil</span>
                    <p>Resgatados por ONGs</p>
                </div>
                <div class="stat-item">
                    <h2 class="counter" data-target="13">0</h2>
                    <span class="unit">Denúncias</span>
                    <p>Média diária de casos</p>
                </div>
                <div class="stat-item">
                    <h2 class="counter" data-target="38">0</h2>
                    <span class="unit">Milhões</span>
                    <p>Retirados da natureza</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="how-it-works">
    <h2>Como funciona a adoção</h2>
    <div class="steps-grid">
        <div class="step">
            <div class="icon-box">🏠</div>
            <h4>Ache seu pet</h4>
            <p>Visite nossos espaços dedicados.</p>
        </div>
        <div class="step">
            <div class="icon-box">📋</div>
            <h4>Entrevista</h4>
            <p>Garantimos o melhor "match".</p>
        </div>
        <div class="step">
            <div class="icon-box">✅</div>
            <h4>Avaliação</h4>
            <p>Análise para adoção segura.</p>
        </div>
        <div class="step">
            <div class="icon-box">🐾</div>
            <h4>Lar Feliz</h4>
            <p>Comece uma nova história!</p>
        </div>
    </div>
</section>

<section class="help-section">
    <div class="help-content">
        <h2>Ajude nossa campanha:</h2>
        <ul>
            <li>Denuncie maus-tratos</li>
            <li>Ofereça um lar temporário</li>
            <li>Doe itens básicos</li>
            <li>Apadrinhe um animal</li>
        </ul>
        <a href="https://www.webdenuncia.sp.gov.br/depa" class="btn-continue">Saiba como Denunciar</a>
    </div>
    <div class="video-container">
        <video autoplay muted loop playsinline poster="Assets/VideoAdocao.mp4">
            <source src="Assets/VideoAdocao.mp4" type="video/mp4">
           
        </video>
    </div>
</section>

<section class="mural-saudade">

    <div class="titulo-mural">
        <span class="icone-coracao">♡</span>

        <h2>Mural da Saudade</h2>

        <p>
            Um espaço sagrado para homenagear os animais que perdeam suas vidas por maus-tratos. Cada história é um lembrete do impacto devastador da crueldade, mas também da importância de nossa missão. Que essas memórias inspirem a mudança e a proteção dos que ainda estão conosco.
        </p>
    </div>

    <div class="mural-container">

  
    

        <div class="cards-mural">

    <div class="card-mural">
        <img src="Assets/adocao/orelha.png" alt="Luc e Docinho">

        <div class="info-mural">
            <h3>Caso Orelha  🐾</h3>
            <span>O cachorro morreu após ser agredido a pauladas na Praia Brava.</span>
        </div>
    </div>

    <div class="card-mural">
        <img src="Assets/adocao/abacate.png" alt="Fred">

        <div class="info-mural">
            <h3>Abacate 🐾</h3>
            <span>  Abacate morreu após ser alvejado a tiros em uma do bairro Tocantins, em Toledo, no Oeste do Paraná.</span>
        </div>
    </div>

    <div class="card-mural">
        <img src="Assets/adocao/negao.png" alt="Mel">

        <div class="info-mural">
            <h3>Negão🐾</h3>
            <span> Negão foi morto após ser atropelado, o cachorro ficou ferido no pescoço, ainda caminhou até a calçada chorando, mas não resistiu.</span>
        </div>
    </div>

    <div class="card-mural">
        <img src="Assets/adocao/gatinhos.png" alt="Luna">

        <div class="info-mural">
            <h3>3 gatos 🐾</h3>
            <span>Três gatos foram vítimas de envenenamento na Vila José Lacerda, na Lapa, nos últimos dias.</span>
        </div>
    </div>

    <div class="card-mural">
        <img src="Assets/adocao/quintal.png" alt="Roi e Tica">

        <div class="info-mural">
            <h3>Envenenamento da melhor amiga🐾</h3>
            <span>Homem chora após segurar cahorra morta no colo " MATARAM MINHA MELHOR AMIGA".</span>
        </div>
    </div>

</div>

      

    </div>

</section>

<footer class="main-footer">
    <div class="footer-grid">
        <div class="footer-column">
            <h4>sobre nós</h4>
            <ul>
                <li>nossa história</li>
            </ul>
        </div>
    </div>
</footer>

<script src="js/adocao.js"></script>
</body>
</html>