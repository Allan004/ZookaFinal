/**
 * 1. ESTADO GLOBAL (Memória Temporária)
 * Criei um objeto para guardar as informações do animal que foram digitadas no formulário.
 * Ele começa vazio e só é preenchido quando clicamos em "Salvar" no Modal.
 */
let dadosTemporariosPet = {
    nome: "",
    raca: "",
    obs: "",
    cpf:""
};

/**
 * 2. INICIALIZAÇÃO
 * O 'DOMContentLoaded' garante que o código só vai rodar depois que todo o HTML estiver carregado.
 */
document.addEventListener('DOMContentLoaded', function () {
    gerarGradeVazia();             // Cria os quadradinhos da agenda
    atualizarCabecalhoAgenda();     // Coloca as datas corretas no topo (Seg, Ter, Qua...)
    configurarCliqueAgendamento();  // Prepara a agenda para receber os cliques e criar cards (E ESSA PORRA TA DANDO ERRO Q MERDAAAAAAAAAAA!)
    configurarModalObs();           // Prepara os botões de abrir/fechar/salvar o formulário
});

/**
 * 3. LÓGICA DO MODAL (FICHA MÉDICA)
 * Esta função controla a janela flutuante que aparece para preencher os dados do animal.
 */
function configurarModalObs() {
    // Peguei os elementos do HTML pelos IDs que eu criei
    const modal = document.getElementById("modalObs");
    const btnAbrir = document.getElementById("btn-abrir-obs");
    const spanFechar = document.querySelector(".close"); // O 'X' de fechar
    const btnSalvar = document.getElementById("btnSalvarObs");
    const form = document.getElementById("formAnimal");

    // Segurança: Se algum desses elementos não existir no HTML, o código para aqui e não dá erro
    if (!modal || !btnAbrir || !btnSalvar) return;

    // Quando clica no botão "Ficha do Animal", mostra o Modal (display: block)
    btnAbrir.onclick = () => {
        modal.style.display = "block";
    };

    // Quando clica no 'X', esconde o Modal (display: none)
    spanFechar.onclick = () => {
        modal.style.display = "none";
    };

    // Se a pessoa clicar fora da caixa branca (no fundo escuro), o modal também fecha
    window.onclick = (event) => {
        if (event.target == modal) modal.style.display = "none";
    };

    // AÇÃO DO BOTÃO SALVAR (DENTRO DO MODAL)
    btnSalvar.onclick = function () {
        // Buscamos os campos de entrada de texto dentro do formulário
        const inputs = form.querySelectorAll('input');
        const inputNome = inputs[0]; // Assume que o 1º input é o Nome
        const inputRaca = inputs[1]; // Assume que o 2º input é a Raça
        const inputObs = form.querySelector('textarea'); // Pega a única área de texto

        // Validação: Não deixa salvar se o nome estiver vazio
        if (!inputNome || inputNome.value.trim() === "") {
            alert("⚠️ Por favor, preencha ao menos o nome do Pet!");
            if (inputNome) inputNome.focus(); // Coloca o cursor no campo de nome
            return;
        }

        // Se estiver tudo ok, guarda os valores dos inputs na nossa memória global
        dadosTemporariosPet.nome = inputNome.value.trim();
        dadosTemporariosPet.raca = inputRaca ? inputRaca.value.trim() : "";
        dadosTemporariosPet.obs = inputObs ? inputObs.value.trim() : "";

        // Avisa o usuário que deu certo
        alert(`✅ Ficha de "${dadosTemporariosPet.nome}" preparada!\nAgora escolha o horário na agenda.`);

        // Fecha a janelinha
        modal.style.display = "none";

        // MUDA O VISUAL DO BOTÃO na tela principal para indicar que tem um pet "carregado"
        btnAbrir.innerHTML = `⭐ Pet: ${dadosTemporariosPet.nome}`;
        btnAbrir.style.backgroundColor = "#e8f5e9"; // Verde clarinho
        btnAbrir.style.color = "#2e7d32";           // Verde escuro
        btnAbrir.style.borderColor = "#4caf50";
        btnAbrir.style.fontWeight = "bold";
    };
}


function validarCPF(cpf) {
    // remove tudo que não é número
    cpf = cpf.replace(/[^\d]+/g, '');

    // CPF precisa ter 11 dígitos
    if (cpf.length !== 11) return false;

    // elimina CPFs inválidos conhecidos (11111111111, 00000000000, etc)
    if (/^(\d)\1+$/.test(cpf)) return false;

    let soma = 0;
    let resto;

    // validação do 1º dígito
    for (let i = 1; i <= 9; i++) {
        soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }

    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;

    if (resto !== parseInt(cpf.substring(9, 10))) return false;

    // validação do 2º dígito
    soma = 0;
    for (let i = 1; i <= 10; i++) {
        soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }

    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;

    if (resto !== parseInt(cpf.substring(10, 11))) return false;

    return true;
}
/**
 * 4. LÓGICA DA AGENDA (CLIQUE E CRIAÇÃO DE CARDS)
 */
function configurarCliqueAgendamento() {
    const grade = document.querySelector('.grade-slots'); // pega a grade inteira
    if (!grade) return; // segurança: se não existir, para tudo

    // pega TODOS os slots da grade (todos os quadradinhos)
    const slots = Array.from(document.querySelectorAll('.slot-hora'));

    // quantidade de colunas da sua agenda (VOCÊ DISSE QUE SÃO 6 DIAS)
    const colunas = 6;

    // "ouve" qualquer clique dentro da grade
    grade.addEventListener('click', function (e) {

        // evita clicar em um card já existente
        if (e.target.closest('.agendamento-card')) return;

        // identifica qual slot foi clicado
        const slot = e.target.closest('.slot-hora');
        if (!slot) return;

        // 🔴 REGRA 1: precisa preencher ficha antes
        if (dadosTemporariosPet.nome === "") {
            alert("📋 Primeiro preencha a 'Ficha do Animal'!");
            document.getElementById("modalObs").style.display = "block";
            return;
        }

        // pega o index salvo no HTML
        const index = parseInt(slot.getAttribute('data-index'));

        // descobre a posição REAL do slot na lista
        const posicaoReal = slots.indexOf(slot);

        // calcula o DIA baseado na posição
        // (0 = primeira coluna, 1 = segunda, etc...)
        const dia = posicaoReal % colunas;

        // 🔴 REGRA 2: bloquear domingo
        // 👉 AJUSTE AQUI se domingo for outro dia no seu layout
        // (normalmente o último → 5)
        if (dia === 5) {
            alert("🚫 Não realizamos agendamentos aos domingos!");
            return;
        }

        // calcula a LINHA (horário)
        const linha = Math.floor(posicaoReal / colunas);

        // converte linha em hora (começando às 8h)
        const hora = 8 + linha;

        // 🔴 REGRA 3: horário permitido (8h até 20h)
        if (hora < 8 || hora >= 21) {
            alert("⏰ Atendemos apenas das 08:00 às 20:00!");
            return;
        }

        // pega dados dos selects
        const profissional = document.getElementById('selectProfissional').value;
        const servico = document.getElementById('selectServico').value;

        // 🔴 REGRA 4: evitar conflito de profissional no mesmo slot
        const ocupado = document.querySelector(
            `.agendamento-card[data-slot="${index}"][data-prof="${profissional}"]`
        );

        if (ocupado) {
            alert(`❌ O profissional ${profissional} já tem um agendamento neste horário!`);
            return;
        }

        // ✅ CRIA O CARD
        const card = document.createElement('div');

        // define classe visual
        card.className = `agendamento-card card-${servico.toLowerCase()}`;

        // salva dados internos
        card.setAttribute('data-slot', index);
        card.setAttribute('data-prof', profissional);

        // ⚠️ CORREÇÃO MAIS IMPORTANTE:
        // em vez de usar gridColumn/gridRow (que quebrava tudo),
        // colocamos o card DENTRO do slot clicado
        slot.appendChild(card);

        // conteúdo visual do card
        card.innerHTML = `
            <div class="card-conteudo">
                <strong style="display:block; border-bottom:1px solid rgba(0,0,0,0.1); padding-bottom:2px; margin-bottom:2px;">
                    ${dadosTemporariosPet.nome}
                </strong>
                <small>${servico}</small><br>
                <span style="font-size:10px; font-style: italic;">${profissional}</span>
            </div>
        `;

        // remover com duplo clique
        card.addEventListener('dblclick', function () {
            if (confirm(`Deseja remover o agendamento de ${dadosTemporariosPet.nome}?`)) {
                this.remove();
            }
        });

        // limpa ficha após agendar
        limparFicha();
    });
}

/**
 * 5. LIMPEZA DOS DADOS
 * Reseta tudo para o estado original para que o próximo agendamento comece do zero.
 */
function limparFicha() {
    // 1. Reseta o objeto na memória do computador
    dadosTemporariosPet = { nome: "", raca: "", obs: "" };

    // 2. Limpa os textos escritos dentro do formulário do Modal
    const form = document.getElementById("formAnimal");
    if (form) form.reset();

    // 3. Volta o botão de "Ficha do Animal" para o visual branco original
    const btnAbrir = document.getElementById("btn-abrir-obs");
    if (btnAbrir) {
        btnAbrir.innerHTML = "📝 Ficha do Animal";
        btnAbrir.style.backgroundColor = "#fff";
        btnAbrir.style.color = "#444";
        btnAbrir.style.borderColor = "#dce1e7";
        btnAbrir.style.fontWeight = "normal";
    }
}

/**
 * 6. GERADORES DE INTERFACE (Grade e Cabeçalho)
 */
function gerarGradeVazia() {
    const grade = document.querySelector('.grade-slots');
    if (!grade) return;

    grade.innerHTML = ''; // Limpa antes de criar
    // Cria 78 quadradinhos (13 horas x 6 dias)
    for (let i = 0; i < 78; i++) {
        const slot = document.createElement('div');
        slot.classList.add('slot-hora');
        slot.setAttribute('data-index', i); // Cada um ganha um número de identidade
        grade.appendChild(slot);
    }
}

function atualizarCabecalhoAgenda() {
    const elementosNum = document.querySelectorAll('.num-dia');
    const elementosNome = document.querySelectorAll('.nome-dia');
    const hoje = new Date(); // Pega a data de hoje do computador
    const diasSemana = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];

    elementosNum.forEach((span, index) => {
        let dataExibida = new Date();
        // Soma os dias para mostrar a semana a partir de hoje
        dataExibida.setDate(hoje.getDate() + index);

        span.innerText = dataExibida.getDate(); // Coloca o número (ex: 15)

        if (elementosNome[index]) {
            elementosNome[index].innerText = diasSemana[dataExibida.getDay()]; // Coloca o nome (ex: Seg)
        }
    });
}