<script>
    const modal = document.getElementById("petModal");
    const closeBtn = document.querySelector(".close-button");

    // Adiciona evento de clique em todos os cards de pets
    document.querySelectorAll('.pet-card').forEach(card => {
        card.addEventListener('click', () => {
            modal.style.display = "block";
        });
    });

    // Fecha ao clicar no X
    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    // Fecha ao clicar fora do modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>