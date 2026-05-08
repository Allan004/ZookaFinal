/* ============================================================
   LÓGICA DO SIDE MODAL (ABRIR / FECHAR)
   ============================================================ */

function toggleSideModal() {
    const modal = document.getElementById('sideModalOverlay');
    
    // Se o modal estiver invisível ou sem estilo de display, ele abre
    if (modal.style.display === 'none' || modal.style.display === '') {
        modal.style.display = 'flex';
        // Impede o scroll da página de fundo quando o modal está aberto
        document.body.style.overflow = 'hidden';
    } else {
        modal.style.display = 'none';
        // Devolve o scroll para a página de fundo
        document.body.style.overflow = 'auto';
    }
}

/* FECHAR AO CLICAR FORA (NO OVERLAY) */
window.addEventListener('click', function(event) {
    const modal = document.getElementById('sideModalOverlay');
    // Se o alvo do clique for o fundo escuro e não o conteúdo branco
    if (event.target === modal) {
        toggleSideModal();
    }
});

/* LÓGICA DAS ABAS (TABS) DO MODAL */
document.querySelectorAll('.tab-btn').forEach(button => {
    button.addEventListener('click', () => {
        // Remove a classe ativa de todos os botões
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        // Adiciona ao botão clicado
        button.classList.add('active');
        
        // Aqui você poderia adicionar a lógica para filtrar a lista de lojas
        console.log("Filtrando lojas por: " + button.innerText);
    });
});

/* SELEÇÃO DE CARD DE LOJA */
document.querySelectorAll('.store-card').forEach(card => {
    card.addEventListener('click', () => {
        // Remove seleção de todos
        document.querySelectorAll('.store-card').forEach(c => c.classList.remove('selected'));
        // Seleciona o clicado
        card.classList.add('selected');
        
        // Dica: Aqui dispararíamos o movimento do mapa para as coordenadas da loja
        console.log("Loja selecionada!");
    });
});


// Parte do mapa (Google Maps API)

let map;

function initMap() {
    // Coordenadas da Zooka Pimentas
    const position = { lat: -23.4542, lng: -46.5340 };

    // Criando o mapa sem exigir Map ID
    map = new google.maps.Map(document.getElementById("googleMapContainer"), {
        zoom: 15,
        center: position,
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: false,
        // Ao não colocar mapId aqui, usamos o estilo padrão que não bloqueia
    });

    // Marcador padrão (funciona em todas as chaves)
    new google.maps.Marker({
        position: position,
        map: map,
        title: "Zooka Petshop - Pimentas",
        animation: google.maps.Animation.DROP
    });
}

// Função para disparar quando o modal abrir
function fixMapSize() {
    if (map) {
        google.maps.event.trigger(map, "resize");
        map.setCenter({ lat: -23.4542, lng: -46.5340 });
    }
}

function toggleSideModal() {
    const modal = document.getElementById('sideModalOverlay');
    
    if (modal.style.display === 'none' || modal.style.display === '') {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        
        // ESPERA 300ms (tempo da animação) E CARREGA O MAPA
        setTimeout(() => {
            if (typeof initMap === "function") {
                initMap(); // Chama a função que desenha o mapa
            }
        }, 300);

    } else {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}



// alterar endereço modal





// alterar endereço modal JS

    const modal = document.getElementById("addressModal");
    const openModal = document.getElementById("openModal");
    const closeModal = document.getElementById("closeModal");

    openModal.addEventListener("click", (e) => {
        e.preventDefault();
        modal.classList.add("active");
    });

    closeModal.addEventListener("click", () => {
        modal.classList.remove("active");
    });

    modal.addEventListener("click", (e) => {
        if(e.target === modal){
            modal.classList.remove("active");
        }
    });



    // MODAL CADASTRO

const registerModal = document.getElementById("registerModal");
const openRegisterModal = document.getElementById("openRegisterModal");
const closeRegisterModal = document.getElementById("closeRegisterModal");

openRegisterModal.addEventListener("click", () => {

    registerModal.classList.add("active");

});

closeRegisterModal.addEventListener("click", () => {

    registerModal.classList.remove("active");

});

registerModal.addEventListener("click", (e) => {

    if(e.target === registerModal){

        registerModal.classList.remove("active");

    }

});

// delivery option selection and summary update
const deliveryOptions = document.querySelectorAll('.delivery-option');
const shippingFee = document.getElementById('shippingFee');
const summaryTotal = document.getElementById('summaryTotal');
const summaryData = document.getElementById('summaryData');

if (deliveryOptions.length && shippingFee && summaryTotal && summaryData) {
    const serviceTax = parseFloat(summaryData.dataset.service) || 0;
    const productsTotal = parseFloat(summaryData.dataset.products) || 0;

    function formatBRL(value) {
        return value.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function updateTotals(shippingValue) {
        const totalValue = productsTotal + serviceTax + shippingValue;
        const displayShipping = shippingValue === 0 ? 'Grátis' : 'R$ ' + formatBRL(shippingValue);
        shippingFee.textContent = displayShipping;
        summaryTotal.textContent = 'R$ ' + formatBRL(totalValue);
    }

    deliveryOptions.forEach(option => {
        option.addEventListener('click', () => {
            deliveryOptions.forEach(item => item.classList.remove('active'));
            option.classList.add('active');

            const price = parseFloat(option.dataset.price || '0');
            const method = option.dataset.method || 'padrao';
            updateTotals(price);

            // Update hidden input for form submission
            const metodoEntregaInput = document.getElementById('metodoEntrega');
            if (metodoEntregaInput) {
                metodoEntregaInput.value = method;
            }
        });
    });
}