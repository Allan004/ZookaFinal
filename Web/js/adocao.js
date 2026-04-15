// Função que faz a animação de contagem
function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        const isDecimal = obj.hasAttribute('data-decimal');
       
        const currentVal = progress * (end - start) + start;
       
        if (isDecimal) {
            obj.innerHTML = currentVal.toFixed(1).replace('.', ',');
        } else {
            obj.innerHTML = Math.floor(currentVal);
        }
       
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}
 
// Configuração do Observador
const observerOptions = {
    threshold: 0.1
};
 
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const target = entry.target;
            const endValue = parseFloat(target.getAttribute('data-target'));
           
            // Inicia a animação
            animateValue(target, 0, endValue, 2000);
           
            // REMOVEMOS o unobserve para que ele possa disparar de novo se sair e voltar
            // Mas para evitar bugs de várias animações ao mesmo tempo,
            
            // você pode decidir se quer que anime SEMPRE ou só uma vez.
        } else {
            // Opcional: Reseta o número para 0 quando ele sai da tela
            // Assim, ao voltar, ele anima do zero de novo.
            entry.target.innerHTML = "0";
        }
    });
}, observerOptions);
 
// Inicialização sem depender apenas do onload pesado
function initCounters() {
    document.querySelectorAll('.counter').forEach(el => {
        el.innerHTML = "0";
        observer.observe(el);
    });
}
 
// Roda assim que o DOM estiver pronto (mais rápido que o onload)
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCounters);
} else {
    initCounters();
}