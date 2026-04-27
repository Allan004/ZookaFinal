<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zooka PetShop - Gatos</title>
    <link rel="stylesheet" href="Web/css/produtos.css">
</head>
<body>

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
                    <div class="product-card">
                        <div class="product-image">
                            <span class="badge-off">15% OFF</span>
                            <img src="https://via.placeholder.com/180" alt="Produto">
                            <button class="add-cart">+</button>
                        </div>
                        <div class="product-info">
                            <p class="product-name">Areia Higiênica Viva Verde Grãos Finos para Gatos</p>
                            <p class="old-price">A partir de R$ 69,90</p>
                            <p class="price">R$ 62,91 <span class="sync-icon">🔄</span></p>
                            <p class="subscriber-price">para assinantes</p>
                        </div>
                    </div>

                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://via.placeholder.com/180" alt="Produto">
                            <button class="add-cart">+</button>
                        </div>
                        <div class="product-info">
                            <p class="product-name">Purê Churu Atum e Salmão para Gatos 56g</p>
                            <p class="price-only">R$ 24,99</p>
                            <p class="price">R$ 22,49 <span class="sync-icon">🔄</span></p>
                            <p class="subscriber-price">para assinantes</p>
                        </div>
                    </div>

                    </div>
            </section>
        </main>
    </div>

</body>
</html>