<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Disponíveis - Adoção</title>
    <link rel="stylesheet" href="css/queroadotar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        <div class="filter-dropdown">ONGs Parceiras <span>v</span></div>
    </aside>

    <main class="content">
        <h2>Pets disponíveis</h2>
        <div class="pet-grid">
            
            <div class="pet-card">
                <div class="pet-image" style="background-image: url('Assets/adocao/animais1.jpg');"></div>
                <div class="card-info">
                    <p class="ong-name">Amigo Não Se Compra</p>
                    <div class="name-row">
                        <span class="pet-name">Bem</span>
                        <div class="icons">
                            <i class="far fa-heart"></i>
                            <i class="fas fa-mars male"></i>
                        </div>
                    </div>
                    <p class="location">AdoteZooka 24h, Rio de Janeiro</p>
                    <button class="btn-adopt">Quero adotar</button>
                </div>
            </div>

            <div class="pet-card">
                <div class="pet-image" style="background-image: url('Assets/adocao/animais2.jpg');"></div>
                <div class="card-info">
                    <p class="ong-name">Amigo Não se Compra</p>
                    <div class="name-row">
                        <span class="pet-name">Algodão</span>
                        <div class="icons">
                            <i class="far fa-heart"></i>
                            <i class="fas fa-mars male"></i>
                        </div>
                    </div>
                    <p class="location">AdoteZooka 24h,Belford Roxo, Rio de Janeiro</p>
                    <button class="btn-adopt">Quero adotar</button>
                </div>
            </div>

            <div class="pet-card">
                <div class="pet-image" style="background-image: url('Assets/adocao/animais3.jpg');"></div>
                <div class="card-info">
                    <p class="ong-name">Amigo Não Se Compra</p>
                    <div class="name-row">
                        <span class="pet-name">Suzy</span>
                        <div class="icons">
                            <i class="far fa-heart"></i>
                            <i class="fas fa-venus female"></i>
                        </div>
                    </div>
                    <p class="location">AdoteZooka 24h, Santo André, São Paulo</p>
                    <button class="btn-adopt">Quero adotar</button>
                </div>
            </div>

             <div class="pet-card">
                <div class="pet-image" style="background-image: url('Assets/adocao/animais4.jpg');"></div>
                <div class="card-info">
                    <p class="ong-name">Amigo Não Se Compra</p>
                    <div class="name-row">
                        <span class="pet-name">Mina</span>
                        <div class="icons">
                            <i class="far fa-heart"></i>
                            <i class="fas fa-venus female"></i>
                        </div>
                    </div>
                    <p class="location">AdoteZooka 24h, Guarulhos, São Paulo</p>
                    <button class="btn-adopt">Quero adotar</button>
                </div>
            </div>
            
            <div class="pet-card">
                <div class="pet-image" style="background-image: url('Assets/adocao/animais4.jpg');"></div>
                <div class="card-info">
                    <p class="ong-name">Amigo Não Se Compra</p>
                    <div class="name-row">
                        <span class="pet-name">Mina</span>
                        <div class="icons">
                            <i class="far fa-heart"></i>
                            <i class="fas fa-venus female"></i>
                        </div>
                    </div>
                    <p class="location">AdoteZooka 24h, Guarulhos, São Paulo</p>
                    <button class="btn-adopt">Quero adotar</button>
                </div>
            </div>

        </div>
    </main>
</div>

</body>
</html>