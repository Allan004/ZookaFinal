document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById('conteudo-dinamico');

    // 1. Só carrega a home se o container dinâmico existir na tela
    if (container) {
        fetch('home.php')
            .then(resposta => resposta.text())
            .then(html => {
                container.innerHTML = html;
            })
            .catch(erro => console.log("Erro ao carregar home.php:", erro));
    }

    // 2. Configura os cliques no menu
    document.querySelectorAll('.category-nav a').forEach(link => {
        link.addEventListener('click', function(e) {
            const linkDestino = this.getAttribute('href');
            if (linkDestino !== "#" && linkDestino !== "") return;

            e.preventDefault();
            
            const categoria = this.textContent.trim().toLowerCase();

            // Só tenta injetar o conteúdo se o container dinâmico existir
            if (container) {
                fetch(categoria + '.php')
                    .then(resposta => resposta.text())
                    .then(html => {
                        container.innerHTML = html;
                        window.scrollTo(0, 0); 
                    })
                    .catch(erro => {
                        container.innerHTML = "<h2>Em breve teremos produtos para " + categoria + "!</h2>";
                    });
            }
        });
    });
});


// Parte da barra de pesquisa (COM VERIFICAÇÃO DE SEGURANÇA)
const campoPesquisa = document.getElementById('searchInput');
const itens = document.querySelectorAll('.item');

if (campoPesquisa) {
    campoPesquisa.addEventListener('input', () => {
        const valorFiltro = campoPesquisa.value.toLowerCase();

        itens.forEach(item => {
            const textoItem = item.textContent.toLowerCase();
            if (textoItem.includes(valorFiltro)) {
                item.style.display = "block"; 
            } else {
                item.style.display = "none";  
            }
        });
    });
}


// Parte do carrossel (COM VERIFICAÇÕES DE SEGURANÇA)
const prateleira = document.querySelector('.shelf-container');
const bolinhas = document.querySelectorAll('.dot');
let indiceAtual = 0;

function atualizarCarrossel() {
    if (!prateleira) return;
    const primeiroCard = prateleira.querySelector('.product-card');
    if (!primeiroCard) return;

    const larguraCard = primeiroCard.offsetWidth + 20; 
    prateleira.scrollTo({
        left: indiceAtual * larguraCard,
        behavior: 'smooth'
    });

    bolinhas.forEach((b, i) => b.classList.toggle('active', i === indiceAtual));
}

function proximoSlide() {
    if (bolinhas.length === 0) return;
    indiceAtual++;
    if (indiceAtual >= bolinhas.length) indiceAtual = 0; 
    atualizarCarrossel();
}

function irParaSlide(n) {
    indiceAtual = n;
    atualizarCarrossel();
}

// Só ativa o autoplay se o carrossel/bolinhas existirem na página atual
if (prateleira && bolinhas.length > 0) {
    let reproducaoAutomatica = setInterval(proximoSlide, 4000);

    prateleira.addEventListener('mouseenter', () => clearInterval(reproducaoAutomatica));
    prateleira.addEventListener('mouseleave', () => 
        reproducaoAutomatica = setInterval(proximoSlide, 4000)
    );
}


// Carrossel do menu principal (Já estava seguro!)
document.addEventListener('DOMContentLoaded', () => {
    const shelf = document.getElementById('shelf');
    const btnNext = document.getElementById('btnNext');
    const btnPrev = document.getElementById('btnPrev');
    const dots = document.querySelectorAll('.dot');

    if (shelf && btnNext && btnPrev) {
        
        btnNext.onclick = function() {
            const card = shelf.querySelector('.product-card');
            if (card) {
                const cardWidth = card.offsetWidth + 20;
                shelf.scrollBy({ left: cardWidth, behavior: 'smooth' });
            }
        };

        btnPrev.onclick = function() {
            const card = shelf.querySelector('.product-card');
            if (card) {
                const cardWidth = card.offsetWidth + 20;
                shelf.scrollBy({ left: -cardWidth, behavior: 'smooth' });
            }
        };

        shelf.addEventListener('scroll', () => {
            const card = shelf.querySelector('.product-card');
            if (card) {
                const scrollLeft = shelf.scrollLeft;
                const itemWidth = card.offsetWidth;
                const index = Math.round(scrollLeft / itemWidth);

                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });
            }
        });

        let isDown = false;
        let startX;
        let scrollLeft;

        shelf.addEventListener('mousedown', (e) => {
            isDown = true;
            shelf.classList.add('active');
            startX = e.pageX - shelf.offsetLeft;
            scrollLeft = shelf.scrollLeft;
        });

        shelf.addEventListener('mouseleave', () => { isDown = false; });
        shelf.addEventListener('mouseup', () => { isDown = false; });

        shelf.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - shelf.offsetLeft;
            const walk = (x - startX) * 2; 
            shelf.scrollLeft = scrollLeft - walk;
        });
    }
});

// Função para o Modal do Carrinho
function toggleModal() {
    const modal = document.getElementById('modal-carrinho');
    if (modal) {
        modal.style.display = (modal.style.display === 'flex') ? 'none' : 'flex';
    }
}

document.addEventListener('click', (e) => {
    if (e.target.id === 'fechar-modal') {
        toggleModal();
    }
});