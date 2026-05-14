/* ============================================================
   LÓGICA DO SIDE MODAL (ABRIR / FECHAR)
   ============================================================ */

// Função responsável por abrir e fechar o modal lateral
function toggleSideModal() {

    // Procura no HTML o elemento que possui o id "sideModalOverlay"
    const modal = document.getElementById('sideModalOverlay');
    
    // Verifica se o modal está escondido ou sem valor definido
    if (modal.style.display === 'none' || modal.style.display === '') {

        // Faz o modal aparecer usando display flex
        modal.style.display = 'flex';

        // Bloqueia o scroll da página enquanto o modal estiver aberto
        document.body.style.overflow = 'hidden';

    } else {

        // Esconde o modal
        modal.style.display = 'none';

        // Libera novamente o scroll da página
        document.body.style.overflow = 'auto';
    }
}

/* ============================================================
   FECHAR MODAL AO CLICAR FORA
   ============================================================ */

// Adiciona um evento de clique na janela inteira
window.addEventListener('click', function(event) {

    // Pega novamente o modal pelo id
    const modal = document.getElementById('sideModalOverlay');

    // Verifica se o clique foi exatamente no fundo escuro do modal
    if (event.target === modal) {

        // Fecha o modal chamando a função
        toggleSideModal();
    }
});

/* ============================================================
   LÓGICA DAS ABAS (TABS)
   ============================================================ */

// Seleciona todos os botões com a classe "tab-btn"
document.querySelectorAll('.tab-btn').forEach(button => {

    // Adiciona um evento de clique em cada botão
    button.addEventListener('click', () => {

        // Remove a classe "active" de todos os botões
        document.querySelectorAll('.tab-btn').forEach(btn => 
            btn.classList.remove('active')
        );

        // Adiciona a classe "active" apenas no botão clicado
        button.classList.add('active');
        
        // Exibe no console o nome da aba clicada
        console.log("Filtrando lojas por: " + button.innerText);
    });
});

/* ============================================================
   SELEÇÃO DE CARD DE LOJA
   ============================================================ */

// Seleciona todos os cards de loja
document.querySelectorAll('.store-card').forEach(card => {

    // Adiciona evento de clique em cada card
    card.addEventListener('click', () => {

        // Remove a classe "selected" de todos os cards
        document.querySelectorAll('.store-card').forEach(c => 
            c.classList.remove('selected')
        );

        // Adiciona a classe "selected" ao card clicado
        card.classList.add('selected');
        
        // Exibe mensagem no console
        console.log("Loja selecionada!");
    });
});


/* ============================================================
   GOOGLE MAPS API
   ============================================================ */

// Variável global que armazenará o mapa
let map;

// Função que inicializa o mapa
function initMap() {

    // Coordenadas da loja Zooka Pimentas
    const position = { lat: -23.4542, lng: -46.5340 };

    // Cria um novo mapa do Google Maps
    map = new google.maps.Map(
        
        // Elemento HTML onde o mapa será renderizado
        document.getElementById("googleMapContainer"),

        // Configurações do mapa
        {
            zoom: 15, // nível de zoom
            center: position, // centro do mapa
            mapTypeControl: false, // remove botão de tipo de mapa
            streetViewControl: false, // remove street view
            fullscreenControl: false // remove botão fullscreen
        }
    );

    // Cria um marcador no mapa
    new google.maps.Marker({

        // Posição do marcador
        position: position,

        // Define em qual mapa o marcador será exibido
        map: map,

        // Texto exibido ao passar o mouse
        title: "Zooka Petshop - Pimentas",

        // Animação de queda do marcador
        animation: google.maps.Animation.DROP
    });
}

/* ============================================================
   AJUSTAR MAPA AO ABRIR MODAL
   ============================================================ */

// Função que corrige o tamanho do mapa
function fixMapSize() {

    // Verifica se o mapa existe
    if (map) {

        // Força o Google Maps a recalcular o tamanho
        google.maps.event.trigger(map, "resize");

        // Centraliza novamente o mapa
        map.setCenter({ lat: -23.4542, lng: -46.5340 });
    }
}

/* ============================================================
   ABRIR MODAL + CARREGAR MAPA
   ============================================================ */

// Função para abrir e fechar modal junto com o mapa
function toggleSideModal() {

    // Seleciona o modal
    const modal = document.getElementById('sideModalOverlay');
    
    // Verifica se está fechado
    if (modal.style.display === 'none' || modal.style.display === '') {

        // Exibe o modal
        modal.style.display = 'flex';

        // Bloqueia scroll da página
        document.body.style.overflow = 'hidden';
        
        // Espera 300 milissegundos antes de carregar o mapa
        setTimeout(() => {

            // Verifica se a função initMap existe
            if (typeof initMap === "function") {

                // Inicializa o mapa
                initMap();
            }

        }, 300);

    } else {

        // Fecha o modal
        modal.style.display = 'none';

        // Libera scroll novamente
        document.body.style.overflow = 'auto';
    }
}


/* ============================================================
   MODAL ALTERAR ENDEREÇO
   ============================================================ */

// Seleciona o modal de endereço
const modal = document.getElementById("addressModal");

// Botão de abrir modal
const openModal = document.getElementById("openModal");

// Botão de fechar modal
const closeModal = document.getElementById("closeModal");

// Evento para abrir modal
openModal.addEventListener("click", (e) => {

    // Impede comportamento padrão do link
    e.preventDefault();

    // Adiciona classe active
    modal.classList.add("active");
});

// Evento para fechar modal
closeModal.addEventListener("click", () => {

    // Remove classe active
    modal.classList.remove("active");
});

// Fecha modal ao clicar fora
modal.addEventListener("click", (e) => {

    // Verifica se clicou no fundo
    if(e.target === modal){

        // Remove classe active
        modal.classList.remove("active");
    }
});


/* ============================================================
   MODAL CADASTRO
   ============================================================ */

// Modal de cadastro
const registerModal = document.getElementById("registerModal");

// Botão abrir cadastro
const openRegisterModal = document.getElementById("openRegisterModal");

// Botão fechar cadastro
const closeRegisterModal = document.getElementById("closeRegisterModal");

// Evento abrir modal cadastro
openRegisterModal.addEventListener("click", () => {

    // Ativa modal
    registerModal.classList.add("active");

});

// Evento fechar modal cadastro
closeRegisterModal.addEventListener("click", () => {

    // Remove modal
    registerModal.classList.remove("active");

});

// Fecha modal clicando fora
registerModal.addEventListener("click", (e) => {

    // Verifica se clicou no fundo
    if(e.target === registerModal){

        // Fecha modal
        registerModal.classList.remove("active");
    }
});


/* ============================================================
   DELIVERY E RESUMO DO PEDIDO
   ============================================================ */

// Seleciona todas as opções de entrega
const deliveryOptions = document.querySelectorAll('.delivery-option');

// Elemento onde aparece o valor do frete
const shippingFee = document.getElementById('shippingFee');

// Elemento do valor total
const summaryTotal = document.getElementById('summaryTotal');

// Elemento com dados do resumo
const summaryData = document.getElementById('summaryData');

// Verifica se todos os elementos existem
if (deliveryOptions.length && shippingFee && summaryTotal && summaryData) {

    // Pega valor da taxa de serviço
    const serviceTax = parseFloat(summaryData.dataset.service) || 0;

    // Pega valor total dos produtos
    const productsTotal = parseFloat(summaryData.dataset.products) || 0;

    // Função que formata números em reais
    function formatBRL(value) {

        // Converte para formato brasileiro
        return value.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    // Função que atualiza os totais
    function updateTotals(shippingValue) {

        // Soma total dos produtos + taxa + frete
        const totalValue = productsTotal + serviceTax + shippingValue;

        // Verifica se frete é grátis
        const displayShipping = shippingValue === 0
            ? 'Grátis'
            : 'R$ ' + formatBRL(shippingValue);

        // Atualiza texto do frete
        shippingFee.textContent = displayShipping;

        // Atualiza valor total
        summaryTotal.textContent = 'R$ ' + formatBRL(totalValue);
    }

    // Percorre todas opções de entrega
    deliveryOptions.forEach(option => {

        // Evento ao clicar na opção
        option.addEventListener('click', () => {

            // Remove classe active de todas
            deliveryOptions.forEach(item =>
                item.classList.remove('active')
            );

            // Adiciona active na selecionada
            option.classList.add('active');

            // Pega preço do frete
            const price = parseFloat(option.dataset.price || '0');

            // Pega método de entrega
            const method = option.dataset.method || 'padrao';

            // Atualiza totais
            updateTotals(price);

            // Input escondido do formulário
            const metodoEntregaInput =
                document.getElementById('metodoEntrega');

            // Verifica se o input existe
            if (metodoEntregaInput) {

                // Atualiza valor do input
                metodoEntregaInput.value = method;
            }
        });
    });
}