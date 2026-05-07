// Função para abrir o modal de endereço
function openAddressModal() {
    const modal = document.getElementById("modal-endereco");
    if (modal) {
        modal.style.display = "flex"; // Usamos flex para centralizar melhor o conteúdo
    }
}

// Função para fechar o modal de endereço
function closeAddressModal() {
    const modal = document.getElementById("modal-endereco");
    if (modal) {
        modal.style.display = "none";
    }
}

// Fechar o modal se o usuário clicar fora da caixa branca
window.onclick = function(event) {
    const modal = document.getElementById("modal-endereco");
    if (event.target === modal) {
        modal.style.display = "none";
    }
};