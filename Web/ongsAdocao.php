<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Disponíveis - Adoção</title>
    <link rel="stylesheet" href="css/ongsAdocao.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="js/ongsAdocao.js" defer></script>
</head>
<body>

<div class="container">
    <aside class="sidebar">
        <h3>Filtros</h3>
        <div class="filter-section">
            <div class="filter-header">Estado* <span>^</span></div>
            <label><input type="radio" name="estado"> AM</label>
            <label><input type="radio" name="estado"> BA</label>
            <label><input type="radio" name="estado"> CE</label>
            <label><input type="radio" name="estado"> DF</label>
            <label><input type="radio" name="estado"> ES</label>
            <a href="#" class="view-more">Ver mais estados ></a>
        </div>
        <div class="filter-dropdown">Cidade* <span>v</span></div>
        <div class="filter-dropdown">Loja Petz <span>v</span></div>
        <div class="filter-dropdown">ONG <span>v</span></div>
    </aside>

    <main class="content">
        <h2>Pets disponíveis</h2>
        <div class="pet-grid">
            
            <div class="pet-card">
                <div class="pet-image" style="background-image: url('https://via.placeholder.com/250x250?text=Abruz');"></div>
                <div class="card-info">
                    <p class="ong-name">ASSOCIAÇÃO MEU AMIGO FOFINHO</p>
                    <div class="name-row">
                        <span class="pet-name">Abruz</span>
                        <div class="icons">
                            <i class="far fa-heart"></i>
                            <i class="fas fa-mars male"></i>
                        </div>
                    </div>
                    <p class="location">Petz Bandeirantes 24h, SÃO PAULO, SP</p>
                    <button class="btn-adopt">Quero adotar</button>
                </div>
            </div>

            <div class="pet-card">
                <div class="pet-image" style="background-image: url(Assets/cachorro1.png);"></div>
                <div class="card-info">
                    <p class="ong-name">ASSOCIAÇÃO MEU AMIGO FOFINHO</p>
                    <div class="name-row">
                        <span class="pet-name">Acos</span>
                        <div class="icons">
                            <i class="far fa-heart"></i>
                            <i class="fas fa-mars male"></i>
                        </div>
                    </div>
                    <p class="location">Petz Itaim, SÃO PAULO, SP</p>
                    <button class="btn-adopt">Quero adotar</button>
                </div>
            </div>

            <div class="pet-card">
                <div class="pet-image" style="background-image: url('https://via.placeholder.com/250x250?text=Adagia');"></div>
                <div class="card-info">
                    <p class="ong-name">ASSOCIAÇÃO MEU AMIGO FOFINHO</p>
                    <div class="name-row">
                        <span class="pet-name">Adágia</span>
                        <div class="icons">
                            <i class="far fa-heart"></i>
                            <i class="fas fa-venus female"></i>
                        </div>
                    </div>
                    <p class="location">Petz Itaim, SÃO PAULO, SP</p>
                    <button class="btn-adopt">Quero adotar</button>
                </div>
            </div>

        </div>
    </main>
</div>



<div id="petModal" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        
        <div class="modal-body">
            <div class="modal-image" style="background-image: url('https://via.placeholder.com/600x600?text=Abruz+Grande');"></div>
            
            <div class="modal-info">
                <p class="ong-title">ASSOCIAÇÃO DE PROTEÇÃO MEU AMIGO FOCINHO</p>
                
                <div class="modal-header-row">
                    <h2>Abruz</h2>
                    <i class="fas fa-mars male-icon"></i>
                </div>

                <div class="info-grid">
                    <div><strong>Peso</strong><p>4 kg</p></div>
                    <div><strong>Idade aproximada</strong><p>7 meses</p></div>
                    <div class="fav-icon"><i class="far fa-heart"></i></div>
                </div>

                <div class="info-block">
                    <strong>Microchip</strong>
                    <p>990000013736070</p>
                </div>

                <div class="info-grid">
                    <div><strong>Espécie</strong><p>Cachorro</p></div>
                    <div><strong>Porte</strong><p>Médio</p></div>
                </div>

                <div class="info-block">
                    <strong>Raça</strong>
                    <p>SRD MD PELO CURTO</p>
                </div>

                <div class="info-block">
                    <strong>Local</strong>
                    <p>Petz Bandeirantes 24h, SÃO PAULO, SP</p>
                </div>

                <div class="info-block">
                    <strong>Sobre o pet</strong>
                    <p>Filhote muito feliz e brincalhão</p>
                </div>

                <div class="modal-actions">
                    <button class="btn-adopt-large">Quero adotar</button>
                    <button class="btn-share"><i class="fas fa-share-alt"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>