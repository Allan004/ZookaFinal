// =============================
// 🔢 ANIMAÇÃO DE CONTADORES
// =============================

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

const observerOptions = {
    threshold: 0.1
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const target = entry.target;
            const endValue = parseFloat(target.getAttribute('data-target'));

            animateValue(target, 0, endValue, 2000);
        } else {
            entry.target.innerHTML = "0";
        }
    });
}, observerOptions);

function initCounters() {
    document.querySelectorAll('.counter').forEach(el => {
        el.innerHTML = "0";
        observer.observe(el);
    });
}


// =============================
// Carousel
// =============================

let slideIndex = 0;
let slides = [];
let dots = [];
let carrosselTimer; // Variável para controlar o tempo

function mostrarSlide(n) {
    slides.forEach(s => s.classList.remove("active"));
    dots.forEach(d => d.classList.remove("active"));

    if (slides[n]) slides[n].classList.add("active");
    if (dots[n]) dots[n].classList.add("active");
    
    resetTimer(); // Reinicia o tempo sempre que mudar de slide
}

function proximoSlide() {
    slideIndex++;
    if (slideIndex >= slides.length) slideIndex = 0;
    mostrarSlide(slideIndex);
}

function voltarSlide() {
    slideIndex--;
    if (slideIndex < 0) slideIndex = slides.length - 1;
    mostrarSlide(slideIndex);
}

function irParaSlide(n) {
    slideIndex = n;
    mostrarSlide(slideIndex);
}

// Função para resetar o tempo (evita que o slide mude logo após o clique manual)
function resetTimer() {
    clearInterval(carrosselTimer);
    carrosselTimer = setInterval(proximoSlide, 6000); // 8 segundos para ficar bem lento
}

function iniciarCarrossel() {
    slides = document.querySelectorAll(".slide");
    dots = document.querySelectorAll(".dot");

    if (slides.length === 0) return;

    // Configuração dos botões
    document.querySelector(".next")?.addEventListener("click", proximoSlide);
    document.querySelector(".prev")?.addEventListener("click", voltarSlide);

    // Inicia o contador automático
    resetTimer();
}


// =============================
// 🚀 INICIALIZAÇÃO
// =============================

function init() {
    initCounters();
    iniciarCarrossel();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}