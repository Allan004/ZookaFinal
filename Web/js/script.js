document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById('conteudo-dinamico');

    // 1. Carrega a página inicial automaticamente ao abrir o site
    fetch('home.php')
        .then(resposta => resposta.text())
        .then(html => {
            container.innerHTML = html;
        });

    // 2. Configura os cliques no menu
    document.querySelectorAll('.category-nav a').forEach(link => {
        link.addEventListener('click', function(e) {
            // Se for um link real (tipo adocao.php), deixa o navegador seguir
            const linkDestino = this.getAttribute('href');
            if (linkDestino !== "#" && linkDestino !== "") return;

            e.preventDefault();
            
            // Pega o nome da categoria e padroniza
            const categoria = this.textContent.trim().toLowerCase();

            // Busca o arquivo correspondente (ex: gatos.php, cachorros.php)
            fetch(categoria + '.php')
                .then(resposta => resposta.text())
                .then(html => {
                    container.innerHTML = html;
                    window.scrollTo(0, 0); // Volta para o topo
                })
                .catch(erro => {
                    container.innerHTML = "<h2>Em breve teremos produtos para " + categoria + "!</h2>";
                });
        });
    });
});


// Parte da barra de pesquisa

const campoPesquisa = document.getElementById('searchInput');
const itens = document.querySelectorAll('.item');

campoPesquisa.addEventListener('input', () => {
    // 1. Pega o valor digitado e transforma em minúsculo
    const valorFiltro = campoPesquisa.value.toLowerCase();

    itens.forEach(item => {
        // 2. Pega o texto do item
        const textoItem = item.textContent.toLowerCase();

        // 3. Verifica se contém o que foi digitado
        if (textoItem.includes(valorFiltro)) {
            item.style.display = "block"; // Mostra
        } else {
            item.style.display = "none";  // Esconde
        }
    });
});


// Parte do carrossel

const prateleira = document.querySelector('.shelf-container');
const bolinhas = document.querySelectorAll('.dot');
let indiceAtual = 0;

function atualizarCarrossel() {
    const larguraCard = prateleira.querySelector('.product-card').offsetWidth + 20; // largura + espaço
    prateleira.scrollTo({
        left: indiceAtual * larguraCard,
        behavior: 'smooth'
    });

    // Atualiza as bolinhas indicadoras
    bolinhas.forEach((b, i) => b.classList.toggle('active', i === indiceAtual));
}

// Próximo slide
function proximoSlide() {
    indiceAtual++;
    if (indiceAtual >= bolinhas.length) indiceAtual = 0; // Volta ao início
    atualizarCarrossel();
}

// Ir para um slide específico
function irParaSlide(n) {
    indiceAtual = n;
    atualizarCarrossel();
}

// Configura o autoplay (a cada 4 segundos)
let reproducaoAutomatica = setInterval(proximoSlide, 4000);

// Pausa quando o usuário passa o mouse
prateleira.addEventListener('mouseenter', () => clearInterval(reproducaoAutomatica));
prateleira.addEventListener('mouseleave', () => 
    reproducaoAutomatica = setInterval(proximoSlide, 4000)
);



// carrosel do menu principal

/* script.js */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Seleção dos elementos usando IDs para maior precisão
    const shelf = document.getElementById('shelf');
    const btnNext = document.getElementById('btnNext');
    const btnPrev = document.getElementById('btnPrev');
    const dots = document.querySelectorAll('.dot');

    // Verificação de segurança: Só executa se os elementos existirem na página
    if (shelf && btnNext && btnPrev) {
        
        // Função para rolar para a DIREITA
        btnNext.onclick = function() {
            // Calcula a largura de um card dinamicamente (incluindo o gap)
            const cardWidth = shelf.querySelector('.product-card').offsetWidth + 20;
            
            shelf.scrollBy({
                left: cardWidth,
                behavior: 'smooth'
            });
        };

        // Função para rolar para a ESQUERDA
        btnPrev.onclick = function() {
            const cardWidth = shelf.querySelector('.product-card').offsetWidth + 20;
            
            shelf.scrollBy({
                left: -cardWidth,
                behavior: 'smooth'
            });
        };

        // --- EXTRAS: Funcionalidades Profissionais ---

        // 2. Atualizar as "Bolinhas" (Dots) conforme o usuário rola
        shelf.addEventListener('scroll', () => {
            const scrollLeft = shelf.scrollLeft;
            const itemWidth = shelf.querySelector('.product-card').offsetWidth;
            const index = Math.round(scrollLeft / itemWidth);

            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        });

        // 3. Suporte para arrastar com o mouse (Desktop Drag)
        let isDown = false;
        let startX;
        let scrollLeft;

        shelf.addEventListener('mousedown', (e) => {
            isDown = true;
            shelf.classList.add('active');
            startX = e.pageX - shelf.offsetLeft;
            scrollLeft = shelf.scrollLeft;
        });

        shelf.addEventListener('mouseleave', () => {
            isDown = false;
        });

        shelf.addEventListener('mouseup', () => {
            isDown = false;
        });

        shelf.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - shelf.offsetLeft;
            const walk = (x - startX) * 2; // Velocidade do arraste
            shelf.scrollLeft = scrollLeft - walk;
        });
    }
});

// Função para o Modal do Carrinho (que já estava no seu código)
function toggleModal() {
    const modal = document.getElementById('modal-carrinho');
    if (modal) {
        modal.style.display = (modal.style.display === 'flex') ? 'none' : 'flex';
    }
}

// Fechar modal no botão X
document.addEventListener('click', (e) => {
    if (e.target.id === 'fechar-modal') {
        toggleModal();
    }
});