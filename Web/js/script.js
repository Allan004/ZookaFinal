document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById('conteudo-dinamico');

    // 1. Carrega a Home automaticamente ao abrir o site
    fetch('home.php')
        .then(response => response.text())
        .then(html => {
            container.innerHTML = html;
        });

    // 2. Configura os cliques no menu
    document.querySelectorAll('.category-nav a').forEach(link => {
        link.addEventListener('click', function(e) {
            // Se for um link de verdade (tipo adocao.php), deixa o navegador ir
            const href = this.getAttribute('href');
            if (href !== "#" && href !== "") return;

            e.preventDefault();
            
            // Pega o nome da categoria e limpa espaços/acentos
            const categoria = this.textContent.trim().toLowerCase();

            // Busca o arquivo (ex: gatos.php, cachorros.php)
            fetch(categoria + '.php')
                .then(response => response.text())
                .then(html => {
                    container.innerHTML = html;
                    window.scrollTo(0, 0); // Sobe para o topo do conteúdo
                })
                .catch(err => {
                    container.innerHTML = "<h2>Em breve teremos produtos para " + categoria + "!</h2>";
                });
        });
    });
});


// Parte da barra de pesquisa


const searchInput = document.getElementById('searchInput');
const items = document.querySelectorAll('.item');

searchInput.addEventListener('input', () => {
    // 1. Pega o valor digitado e transforma em minúsculo para facilitar a busca
    const filterValue = searchInput.value.toLowerCase();

    items.forEach(item => {
        // 2. Pega o texto de dentro do item
        const text = item.textContent.toLowerCase();

        // 3. Verifica se o texto do item contém o que foi digitado
        if (text.includes(filterValue)) {
            item.style.display = "block"; // Mostra o item
        } else {
            item.style.display = "none";  // Esconde o item
        }
    });
});

const shelf = document.querySelector('.shelf-container');
const dots = document.querySelectorAll('.dot');
let index = 0;

function updateCarousel() {
    const cardWidth = shelf.querySelector('.product-card').offsetWidth + 20; // Largura + Gap
    shelf.scrollTo({
        left: index * cardWidth,
        behavior: 'smooth'
    });

    // Atualiza as bolinhas
    dots.forEach((d, i) => d.classList.toggle('active', i === index));
}

// Próximo Slide
function nextSlide() {
    index++;
    if (index >= dots.length) index = 0; // Volta ao início
    updateCarousel();
}

// Ir para slide específico (ao clicar na bolinha)
function currentSlide(n) {
    index = n;
    updateCarousel();
}

// Configura o Tempo (Muda a cada 4 segundos)
let autoPlay = setInterval(nextSlide, 4000);

// Para o autoplay quando o usuário mexe no carrossel
shelf.addEventListener('mouseenter', () => clearInterval(autoPlay));
shelf.addEventListener('mouseleave', () => autoPlay = setInterval(nextSlide, 4000));