const { jsPDF } = window.jspdf;

document.addEventListener("DOMContentLoaded", renderBarcodeHTML);

document
    .getElementById("baixarPDF")
    .addEventListener("click", gerarPDF);

function renderBarcodeHTML() {
    const barcodeElement = document.getElementById('barcode');
    if (!barcodeElement || !barcodeElement.dataset.codigo) return;

    const codigo = barcodeElement.dataset.codigo;
    const digits = codigo.replace(/\D/g, '').split('').map(Number);
    const totalBars = 240;

    while (barcodeElement.firstChild) {
        barcodeElement.removeChild(barcodeElement.firstChild);
    }

    for (let i = 0; i < totalBars; i += 1) {
        const digit = Number.isNaN(digits[i % digits.length]) ? 1 : digits[i % digits.length];
        const bar = document.createElement('div');
        bar.classList.add('barcode-bar');

        const width = 1.0 + ((digit % 4) * 0.4); // 1px, 1.4px, 1.8px, 2.2px
        bar.style.width = `${width}px`;

        if (i % 7 === 0) {
            bar.classList.add('short');
        }

        barcodeElement.appendChild(bar);
    }
}

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

    const codigoBanco = document.getElementById('codigoBanco')?.textContent.trim() || '237-2';
    const linhaDigitavel = document.getElementById('linhaDigitavel')?.textContent.trim() || '23790.12345 60000.000001 00000.000008 1 00000000000000';

    // código banco
    doc.setFontSize(16);
    doc.text(codigoBanco, 62, 20);

    // linha digitável
    doc.setFontSize(12);
    doc.text(linhaDigitavel, 82, 20);

    // linha horizontal
    doc.setLineWidth(0.6);
    doc.line(10, 28, 200, 28);

    /* =========================
       CAMPOS
    ========================== */

    y = 28;

    const localPagamento = document.getElementById('localPagamento')?.textContent.trim() || 'Pagável em qualquer banco até o vencimento.';
    const vencimento = document.getElementById('vencimento')?.textContent.trim() || '00/00/0000';
    const beneficiario = document.getElementById('beneficiario')?.textContent.trim() || 'Família Zooka LTDA';
    const agenciaCodigo = document.getElementById('agenciaCodigo')?.textContent.trim() || '0001 / 99999-9';
    const pagador = document.getElementById('pagador')?.textContent.trim() || 'Cliente Teste';
    const nossoNumero = document.getElementById('nossoNumero')?.textContent.trim() || '0000000001';
    const usoBanco = document.getElementById('usoBanco')?.textContent.trim() || 'Carteira Simples';
    const valorDocumento = document.getElementById('valorDocumento')?.textContent.trim() || 'R$ 0,00';

    criarCampo(
        doc,
        10,
        y,
        140,
        18,
        "Local de pagamento",
        localPagamento
    );

    criarCampo(
        doc,
        150,
        y,
        50,
        18,
        "Vencimento",
        vencimento
    );

    y += 18;

    criarCampo(
        doc,
        10,
        y,
        140,
        18,
        "Beneficiário",
        beneficiario
    );

    criarCampo(
        doc,
        150,
        y,
        50,
        18,
        "Agência / Código",
        agenciaCodigo
    );

    y += 18;

    criarCampo(
        doc,
        10,
        y,
        140,
        18,
        "Pagador",
        pagador
    );

    criarCampo(
        doc,
        150,
        y,
        50,
        18,
        "Nosso Número",
        nossoNumero
    );

    y += 18;

    criarCampo(
        doc,
        10,
        y,
        140,
        18,
        "Uso do Banco",
        usoBanco
    );

    criarCampo(
        doc,
        150,
        y,
        50,
        18,
        "Valor Documento",
        valorDocumento
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


    desenharCodigoBarras(doc, 15, y, linhaDigitavel);

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

function desenharCodigoBarras(doc, x, y, codigo) {

    const digits = codigo.replace(/\D/g, '').split('').map(Number);
    let posX = x;

    if (digits.length === 0) {
        digits.push(1, 2, 1, 3, 1, 2, 1, 1);
    }

    const barCount = Math.min(80, digits.length * 2);
    for (let i = 0; i < barCount; i += 1) {
        const digit = digits[i % digits.length];
        const width = 0.9 + ((digit % 3) * 0.7);
        const height = 18 - ((i % 5 === 0) ? 2 : 0);

        if (i % 2 === 0) {
            doc.setFillColor(0, 0, 0);
            doc.rect(posX, y, width, height, "F");
        }

        posX += width + 0.35;
    }

    doc.setFont("helvetica", "normal");
    doc.setFontSize(8);
    doc.setTextColor(0);
    doc.text(codigo, x, y + 26);
}