document.addEventListener('DOMContentLoaded', () => {

    document.getElementById('buscaCliente').addEventListener('keyup', function () {
        fetch('../../php/buscar_clientes.php?termo=' + encodeURIComponent(this.value))
            .then(r => r.text())
            .then(html => {
                document.getElementById('resultadoClientes').innerHTML = html;
            });
    });

    document.getElementById('buscaPet').addEventListener('keyup', function () {
        fetch('../../php/buscar_pets.php?termo=' + encodeURIComponent(this.value))
            .then(r => r.text())
            .then(html => { 
                document.getElementById('resultadoPets').innerHTML = html;
            });
    });

});