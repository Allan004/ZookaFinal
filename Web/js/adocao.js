
    // Função que faz a conta subir
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
        threshold: 0.1 // Dispara assim que 10% do número aparecer
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const endValue = parseFloat(target.getAttribute('data-target'));
                animateValue(target, 0, endValue, 2000);
                observer.unobserve(target); // Garante que anime só uma vez
            }
        });
    }, observerOptions);

    // Inicialização manual para garantir que rode
    window.onload = () => {
        document.querySelectorAll('.counter').forEach(el => {
            el.innerHTML = "0"; // Zera antes de começar
            observer.observe(el);
        });
    };
