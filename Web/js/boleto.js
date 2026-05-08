const { jsPDF } = window.jspdf;

document
    .getElementById("baixarPDF")
    .addEventListener("click", gerarPDF);

function gerarPDF() {

    const doc = new jsPDF("p", "mm", "a4");

    let y = 15;

    /* =========================
       BORDA PRINCIPAL
    ========================== */

    doc.setLineWidth(0.4);
    doc.rect(10, 10, 190, 120);

    /* =========================
       TOPO
    ========================== */

    doc.setFont("helvetica", "bold");

    doc.setFontSize(18);
    doc.text("ZOOKA", 15, y);

    y += 8;

    doc.text("BANK", 15, y);

    // separadores
    doc.setLineWidth(0.8);

    doc.line(58, 13, 58, 25);
    doc.line(78, 13, 78, 25);

    // código banco
    doc.setFontSize(16);
    doc.text("237-2", 62, 20);

    // linha digitável
    doc.setFontSize(12);

    doc.text(
        "23790.12345 60000.000001 00000.000008 1 00000000000000",
        82,
        20
    );

    // linha horizontal
    doc.setLineWidth(0.6);
    doc.line(10, 28, 200, 28);

    /* =========================
       CAMPOS
    ========================== */

    y = 28;

    criarCampo(
        doc,
        10,
        y,
        140,
        18,
        "Local de pagamento",
        "Pagável em qualquer banco até o vencimento."
    );

    criarCampo(
        doc,
        150,
        y,
        50,
        18,
        "Vencimento",
        "00/00/0000"
    );

    y += 18;

    criarCampo(
        doc,
        10,
        y,
        140,
        18,
        "Beneficiário",
        "Família Zooka LTDA"
    );

    criarCampo(
        doc,
        150,
        y,
        50,
        18,
        "Agência / Código",
        "0001 / 99999-9"
    );

    y += 18;

    criarCampo(
        doc,
        10,
        y,
        140,
        18,
        "Pagador",
        "Cliente Teste"
    );

    criarCampo(
        doc,
        150,
        y,
        50,
        18,
        "Nosso Número",
        "0000000001"
    );

    y += 18;

    criarCampo(
        doc,
        10,
        y,
        140,
        18,
        "Uso do Banco",
        "Carteira Simples"
    );

    criarCampo(
        doc,
        150,
        y,
        50,
        18,
        "Valor Documento",
        "R$ 0,00"
    );

    y += 26;

    /* =========================
       INSTRUÇÕES
    ========================== */

    criarCampoGrande(
        doc,
        10,
        y,
        190,
        25,
        "Instruções",
        "Documento gerado automaticamente para demonstração do sistema Família Zooka."
    );

    y += 35;

    /* =========================
       AUTENTICAÇÃO
    ========================== */

    doc.setFontSize(8);

    doc.setFont("helvetica", "normal");

    doc.text("Autenticação Mecânica", 165, y);

    y += 6;

    /* =========================
       CÓDIGO DE BARRAS
    ========================== */

    desenharCodigoBarras(doc, 15, y);

    y += 28;

    /* =========================
       LINHA DE CORTE
    ========================== */

    doc.setDrawColor(130);

    for (let i = 10; i < 200; i += 4) {

        doc.line(i, y, i + 2, y);

    }

    y += 12;

    /* =========================
       RECIBO
    ========================== */

    doc.setFont("helvetica", "bold");

    doc.setFontSize(14);

    doc.text("RECIBO DO PAGADOR", 10, y);

    y += 10;

    doc.setFont("helvetica", "normal");

    doc.setFontSize(11);

    doc.text("Pagador: Cliente Teste", 10, y);

    y += 8;

    doc.text("Valor: R$ 0,00", 10, y);

    y += 8;

    doc.text("Vencimento: 00/00/0000", 10, y);

    /* =========================
       SALVAR PDF
    ========================== */

    doc.save("boleto-zooka.pdf");
}

/* ===================================
   CAMPO PEQUENO
=================================== */

function criarCampo(doc, x, y, w, h, titulo, valor) {

    doc.setLineWidth(0.2);

    doc.rect(x, y, w, h);

    // título
    doc.setFontSize(7);

    doc.setFont("helvetica", "normal");

    doc.setTextColor(90);

    doc.text(titulo, x + 2, y + 4);

    // valor
    doc.setFontSize(10);

    doc.setTextColor(0);

    doc.setFont("helvetica", "bold");

    doc.text(valor, x + 2, y + 11);
}

/* ===================================
   CAMPO GRANDE
=================================== */

function criarCampoGrande(doc, x, y, w, h, titulo, valor) {

    doc.setLineWidth(0.2);

    doc.rect(x, y, w, h);

    doc.setFontSize(7);

    doc.setTextColor(90);

    doc.setFont("helvetica", "normal");

    doc.text(titulo, x + 2, y + 4);

    doc.setFontSize(9);

    doc.setTextColor(0);

    doc.text(valor, x + 2, y + 11);
}

/* ===================================
   CÓDIGO DE BARRAS REALISTA
=================================== */

function desenharCodigoBarras(doc, x, y) {

    const padrao = [
        1,1,2,1,3,1,2,2,1,1,
        3,2,1,2,2,1,1,3,2,1,
        1,2,3,1,2,1,1,2,3,2,
        1,1,2,3,1,2,2,1,3,1,
        2,2,1,1,3,2,1,2,2,1,
        1,3,2,1,1,2,3,1,2,1
    ];

    let posX = x;

    for(let i = 0; i < padrao.length; i++){

        const largura = padrao[i] * 0.45;

        const altura = i % 3 === 0 ? 22 : 18;

        doc.setFillColor(0,0,0);

        doc.rect(posX, y, largura, altura, "F");

        posX += largura + 0.35;
    }
}