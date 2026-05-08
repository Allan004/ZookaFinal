document.addEventListener('DOMContentLoaded', () => {
    const openCoupon = document.getElementById('openCoupon');
    const closeCoupon = document.getElementById('closeCoupon');
    const couponModal = document.getElementById('couponModal');
    const couponField = document.getElementById('couponField');
    const btnAddCoupon = document.getElementById('btnAddCoupon');

    // Abrir o Modal de Cupom
    if (openCoupon) {
        openCoupon.addEventListener('click', (e) => {
            e.preventDefault();
            couponModal.style.display = 'block';
        });
    }

    // Fechar o Modal de Cupom
    if (closeCoupon) {
        closeCoupon.addEventListener('click', () => {
            couponModal.style.display = 'none';
        });
    }

    // Lógica para habilitar o botão de adicionar
    if (couponField) {
        couponField.addEventListener('input', () => {
            const value = couponField.value.trim();
            if (value.length > 0) {
                btnAddCoupon.disabled = false;
                btnAddCoupon.classList.add('active');
            } else {
                btnAddCoupon.disabled = true;
                btnAddCoupon.classList.remove('active');
            }
        });
    }

    // Fechar ao clicar fora do modal (opcional)
    window.addEventListener('click', (event) => {
        if (event.target === couponModal) {
            couponModal.style.display = 'none';
        }
    });
});