document.addEventListener('DOMContentLoaded', function() {
    // --- DEFINIÇÃO DE ELEMENTOS ---
    const modalPix = document.getElementById("pixModal");
    const modalEndereco = document.getElementById("modal-endereco");
    
    const btnPix = document.getElementById("btnPix");
    const btnCartao = document.getElementById("btnCartao");
    
    // Selecionamos o formulário pela classe, como está no seu HTML
    const formCartao = document.querySelector(".card-form");
    const closeBtnPix = document.querySelector("#pixModal .close-modal");

    // --- LÓGICA DO PIX ---
    if (btnPix) {
        btnPix.onclick = function() {
            // 1. Abre o modal do Pix
            if (modalPix) {
                modalPix.style.display = "block";
                document.body.style.overflow = "hidden"; // Trava o scroll
            }
            
            // 2. ESCONDE O FORMULÁRIO DO CARTÃO
            if (formCartao) {
                formCartao.style.display = "none";
            }
            
            // 3. Atualiza o visual da lista (seleção)
            removerAtivos();
            btnPix.classList.add('active');
        };
    }

    // --- LÓGICA DO CARTÃO ---
    if (btnCartao) {
        btnCartao.onclick = function() {
            // 1. MOSTRA O FORMULÁRIO DO CARTÃO NOVAMENTE
            if (formCartao) {
                formCartao.style.display = "block";
            }
            
            // 2. Atualiza o visual da lista
            removerAtivos();
            btnCartao.classList.add('active');
        };
    }

    // Função para limpar a classe 'active' de todos os itens da lista
    function removerAtivos() {
        const itens = document.querySelectorAll('.payment-list li');
        itens.forEach(item => item.classList.remove('active'));
    }

    // --- FECHAMENTO DE MODAIS ---

    // Fechar Modal Pix no X
    if (closeBtnPix) {
        closeBtnPix.onclick = function() {
            modalPix.style.display = "none";
            document.body.style.overflow = "auto";
        };
    }

    // Fechar ao clicar fora da caixa branca
    window.onclick = function(event) {
        if (event.target == modalPix) {
            modalPix.style.display = "none";
            document.body.style.overflow = "auto";
        }
        if (event.target == modalEndereco) {
            modalEndereco.style.display = "none";
            document.body.style.overflow = "auto";
        }
    };
});

// --- FUNÇÕES DE ENDEREÇO (GLOBAIS) ---

function openAddressModal() {
    const modal = document.getElementById("modal-endereco");
    if (modal) {
        modal.style.display = "flex";
        document.body.style.overflow = "hidden";
    }
}

function closeAddressModal() {
    const modal = document.getElementById("modal-endereco");
    if (modal) {
        modal.style.display = "none";
        document.body.style.overflow = "auto";
    }
}

// --- FUNÇÃO DE COPIAR PIX ---

function copyPix() {
    const copyText = document.getElementById("pixCode");
    if (copyText) {
        copyText.select();
        copyText.setSelectionRange(0, 99999); // Mobile

        navigator.clipboard.writeText(copyText.value).then(() => {
            alert("Código Pix copiado com sucesso!");
        }).catch(() => {
            // Fallback para navegadores sem suporte à API Clipboard
            document.execCommand('copy');
            alert("Código Pix copiado!");
        });
    }
}