// Espera toda a página HTML carregar antes de executar o JavaScript
document.addEventListener("DOMContentLoaded", function() {

    // Procura no HTML um elemento com id="conteudo-dinamico"
    // e guarda ele dentro da constante "container"
    const container = document.getElementById('conteudo-dinamico');


    // =====================================================================
    // 1. CARREGAMENTO AUTOMÁTICO DA HOME
    // =====================================================================

    // Verifica se o container realmente existe na página
    // Isso evita erros no console
    if (container) {

        // Faz uma requisição para buscar o arquivo home.php
        fetch('home.php')

            // Quando o arquivo chegar:
            // transforma a resposta em texto HTML
            .then(resposta => resposta.text())

            // Depois pega o HTML recebido
            .then(html => {

                // Coloca o HTML dentro do container
                // Isso "injeta" a home dinamicamente na página
                container.innerHTML = html;
            })

            // Caso aconteça algum erro:
            .catch(erro =>

                // Mostra o erro no console
                console.log("Erro ao carregar home.php:", erro)
            );
    }


    // =====================================================================
    // 2. CLIQUES DO MENU
    // =====================================================================

    // Procura TODOS os links <a> que estão dentro da navbar
    document.querySelectorAll('.category-nav a')

        // Para cada link encontrado:
        .forEach(link => {

            // Adiciona um evento de clique
            link.addEventListener('click', function(e) {


                // Pega o valor do href do link clicado
                // Exemplo: href="#"
                const linkDestino = this.getAttribute('href');


                // Se o link tiver destino real
                // ele deixa o navegador seguir normalmente
                if (linkDestino !== "#" && linkDestino !== "") return;


                // Impede o comportamento padrão do link
                // (evita recarregar a página)
                e.preventDefault();


                // Pega o texto do menu clicado
                // trim() remove espaços extras
                // toLowerCase() deixa tudo minúsculo
                const categoria = this.textContent.trim().toLowerCase();


                // Só continua se o container existir
                if (container) {

                    // Busca um arquivo com o nome da categoria
                    // Exemplo:
                    // "ração" -> racao.php
                    fetch(categoria + '.php')

                        // Converte resposta em texto HTML
                        .then(resposta => resposta.text())

                        // Quando o HTML chegar:
                        .then(html => {

                            // Coloca o conteúdo dentro do container
                            container.innerHTML = html;

                            // Faz a tela voltar para o topo
                            window.scrollTo(0, 0);
                        })

                        // Se der erro:
                        .catch(erro => {

                            // Mostra mensagem personalizada
                            container.innerHTML =
                                "<h2>Em breve teremos produtos para "
                                + categoria +
                                "!</h2>";
                        });
                }
            });
        });
});



// =====================================================================
// 3. BARRA DE PESQUISA
// =====================================================================

// Procura o input da pesquisa
const campoPesquisa = document.getElementById('searchInput');

// Procura todos os elementos com classe .item
const itens = document.querySelectorAll('.item');


// Verifica se o campo realmente existe
if (campoPesquisa) {

    // Quando o usuário digitar:
    campoPesquisa.addEventListener('input', () => {


        // Pega o texto digitado
        // e transforma em minúsculo
        const valorFiltro = campoPesquisa.value.toLowerCase();


        // Percorre todos os itens
        itens.forEach(item => {


            // Pega o texto do item
            // e transforma em minúsculo
            const textoItem = item.textContent.toLowerCase();


            // Verifica se o item contém o texto digitado
            if (textoItem.includes(valorFiltro)) {

                // Mostra o item
                item.style.display = "block";

            } else {

                // Esconde o item
                item.style.display = "none";
            }
        });
    });
}



// =====================================================================
// 4. CARROSSEL DE PRODUTOS
// =====================================================================

// Procura o container da prateleira
const prateleira = document.querySelector('.shelf-container');

// Procura todas as bolinhas do carrossel
const bolinhas = document.querySelectorAll('.dot');

// Índice do slide atual
let indiceAtual = 0;


// ---------------------------------------------------------------------
// Função que atualiza o carrossel
// ---------------------------------------------------------------------
function atualizarCarrossel() {

    // Se não existir prateleira, para tudo
    if (!prateleira) return;


    // Procura o primeiro card de produto
    const primeiroCard = prateleira.querySelector('.product-card');


    // Se não existir card, para tudo
    if (!primeiroCard) return;


    // Pega a largura do card
    // +20 por causa do gap/margem
    const larguraCard = primeiroCard.offsetWidth + 20;


    // Faz o scroll horizontal suavemente
    prateleira.scrollTo({

        // Calcula a posição horizontal
        left: indiceAtual * larguraCard,

        // Scroll suave
        behavior: 'smooth'
    });


    // Atualiza bolinhas ativas
    bolinhas.forEach((b, i) =>

        // Adiciona ou remove a classe active
        b.classList.toggle('active', i === indiceAtual)
    );
}


// ---------------------------------------------------------------------
// Vai para o próximo slide
// ---------------------------------------------------------------------
function proximoSlide() {

    // Se não tiver bolinhas, para
    if (bolinhas.length === 0) return;


    // Soma +1 no índice atual
    indiceAtual++;


    // Se passar do último slide:
    if (indiceAtual >= bolinhas.length)

        // volta para o primeiro
        indiceAtual = 0;


    // Atualiza o carrossel
    atualizarCarrossel();
}


// ---------------------------------------------------------------------
// Vai diretamente para um slide específico
// ---------------------------------------------------------------------
function irParaSlide(n) {

    // Define o índice
    indiceAtual = n;

    // Atualiza
    atualizarCarrossel();
}


// =====================================================================
// 5. AUTOPLAY DO CARROSSEL
// =====================================================================

// Só executa se existir carrossel
if (prateleira && bolinhas.length > 0) {


    // Faz o carrossel trocar sozinho a cada 4 segundos
    let reproducaoAutomatica =
        setInterval(proximoSlide, 4000);


    // Quando o mouse entra:
    prateleira.addEventListener('mouseenter', () =>

        // pausa o autoplay
        clearInterval(reproducaoAutomatica)
    );


    // Quando o mouse sai:
    prateleira.addEventListener('mouseleave', () =>

        // volta autoplay
        reproducaoAutomatica =
            setInterval(proximoSlide, 4000)
    );
}



// =====================================================================
// 6. CARROSSEL PRINCIPAL
// =====================================================================

// Espera HTML carregar
document.addEventListener('DOMContentLoaded', () => {


    // Procura elementos do carrossel
    const shelf = document.getElementById('shelf');
    const btnNext = document.getElementById('btnNext');
    const btnPrev = document.getElementById('btnPrev');
    const dots = document.querySelectorAll('.dot');


    // Só executa se tudo existir
    if (shelf && btnNext && btnPrev) {


        // =============================================================
        // BOTÃO PRÓXIMO
        // =============================================================
        btnNext.onclick = function() {


            // Procura um card
            const card = shelf.querySelector('.product-card');


            // Se existir:
            if (card) {

                // Calcula largura
                const cardWidth = card.offsetWidth + 20;


                // Faz scroll para direita
                shelf.scrollBy({
                    left: cardWidth,
                    behavior: 'smooth'
                });
            }
        };


        // =============================================================
        // BOTÃO ANTERIOR
        // =============================================================
        btnPrev.onclick = function() {

            const card = shelf.querySelector('.product-card');

            if (card) {

                const cardWidth = card.offsetWidth + 20;

                // Faz scroll para esquerda
                shelf.scrollBy({
                    left: -cardWidth,
                    behavior: 'smooth'
                });
            }
        };


        // =============================================================
        // ATUALIZA BOLINHAS CONFORME O SCROLL
        // =============================================================
        shelf.addEventListener('scroll', () => {

            const card = shelf.querySelector('.product-card');

            if (card) {

                // Posição atual do scroll
                const scrollLeft = shelf.scrollLeft;

                // Largura do item
                const itemWidth = card.offsetWidth;

                // Descobre qual slide está visível
                const index =
                    Math.round(scrollLeft / itemWidth);


                // Atualiza bolinhas
                dots.forEach((dot, i) => {

                    dot.classList.toggle(
                        'active',
                        i === index
                    );
                });
            }
        });



        // =============================================================
        // SISTEMA DE ARRASTAR COM O MOUSE
        // =============================================================

        // Variáveis de controle
        let isDown = false;
        let startX;
        let scrollLeft;


        // Quando clicar
        shelf.addEventListener('mousedown', (e) => {

            // Diz que o mouse está pressionado
            isDown = true;

            // Adiciona classe active
            shelf.classList.add('active');

            // Guarda posição inicial do mouse
            startX = e.pageX - shelf.offsetLeft;

            // Guarda posição do scroll
            scrollLeft = shelf.scrollLeft;
        });


        // Quando mouse sair
        shelf.addEventListener('mouseleave', () => {

            isDown = false;
        });


        // Quando soltar mouse
        shelf.addEventListener('mouseup', () => {

            isDown = false;
        });


        // Quando mover mouse
        shelf.addEventListener('mousemove', (e) => {


            // Se mouse não estiver pressionado:
            if (!isDown) return;


            // Impede seleção de texto
            e.preventDefault();


            // Nova posição X
            const x = e.pageX - shelf.offsetLeft;


            // Distância arrastada
            const walk = (x - startX) * 2;


            // Move scroll horizontal
            shelf.scrollLeft = scrollLeft - walk;
        });
    }
});




// =====================================================================
// 7. MODAL DO CARRINHO
// =====================================================================

// Função que abre/fecha modal
function toggleModal() {


    // Procura o modal
    const modal = document.getElementById('modal-carrinho');


    // Verifica se existe
    if (modal) {


        // Se estiver aberto:
        // fecha
        // senão abre
        modal.style.display =
            (modal.style.display === 'flex')
            ? 'none'
            : 'flex';
    }
}


// =====================================================================
// 8. FECHAR MODAL
// =====================================================================

// Escuta clique na página inteira
document.addEventListener('click', (e) => {


    // Se clicou no botão fechar
    if (e.target.id === 'fechar-modal') {


        // Fecha modal
        toggleModal();
    }
});