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
            <a href="#" class="btn-orange">Quero adotar</a>
            <a href="https://www.webdenuncia.sp.gov.br/depa" class="btn-orange" target="_blank" rel="noopener noreferrer">Denuncie</a>
            <button class="btn-outline">Entrar</button>
        </div>
    </nav>
</header>

<section class="hero-banner">
    <div class="carousel">
        <div class="slide active">
            <a href="#">
                <img src="Assets/bannerzooka.png" class="bg-slide" alt="Vantagens exclusivas para adotantes">
                <div class="slide-content"></div>
            </a>
        </div>

        <div class="slide">
            <a href="#">
                <img src="Assets/bannerzooka2 (1).png" class="bg-slide" alt="O silêncio mata. Sua denúncia salva.">
                <div class="slide-content"></div>
            </a>
        </div>

        <div class="slide">
            <a href="#">
                <img src="Assets/bannerzooka3.png" class="bg-slide" alt="Denuncie maus-tratos">
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
        <button class="btn-orange">Saiba como ajudar</button>
    </div>
    <div class="video-container">
        <video autoplay muted loop playsinline poster="Assets/VideoAdocao.mp4">
            <source src="Assets/VideoAdocao.mp4" type="video/mp4">
            Seu navegador não suporta vídeos.
        </video>
    </div>
</section>

<footer class="main-footer">
    <div class="footer-grid">
        <div class="footer-column">
            <h4>a zookapet</h4>
            <ul><li>bem estar bem</li><li>sustentabilidade</li><li>nossa história</li></ul>
        </div>
        <div class="footer-column">
            <h4>atendimento</h4>
            <ul><li>ajuda e contato</li><li>ouvidoria</li></ul>
        </div>
        <div class="footer-column">
            <h4>suporte</h4>
            <ul><li>privacidade</li><li>cookies</li><li>trocas</li></ul>
        </div>
    </div>
</footer>

<script src="js/adocao.js"></script>
</body>
</html>