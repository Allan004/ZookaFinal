<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Boleto Bancário</title>

<link rel="stylesheet" href="css/boleto.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="JS/boleto.js" defer></script>
</head>

<body>

<div class="pagina">

    <div class="boleto">

        <!-- TOPO -->
        <div class="topo">

            <div class="logo">
                ZOOKA<br>BANK
            </div>

            <div class="codigo-banco">
                237-2
            </div>

            <div class="linha-digitavel">
                23790.12345 60000.000001 00000.000008 1 00000000000000
            </div>

        </div>

        <!-- TABELA -->
        <div class="tabela">

            <div class="campo grande">
                <span>Local de pagamento</span>
                <p>Pagável em qualquer banco até o vencimento.</p>
            </div>

            <div class="campo pequeno">
                <span>Vencimento</span>
                <p>00/00/0000</p>
            </div>

            <div class="campo grande">
                <span>Beneficiário</span>
                <p>Família Zooka LTDA</p>
            </div>

            <div class="campo pequeno">
                <span>Agência / Código</span>
                <p>0001 / 99999-9</p>
            </div>

            <div class="campo grande">
                <span>Pagador</span>
                <p>Cliente Teste</p>
            </div>

            <div class="campo pequeno">
                <span>Nosso Número</span>
                <p>0000000001</p>
            </div>

            <div class="campo grande">
                <span>Uso do Banco</span>
                <p>Carteira Simples</p>
            </div>

            <div class="campo pequeno">
                <span>Valor Documento</span>
                <p>R$ 0,00</p>
            </div>

        </div>

        <!-- AUTENTICAÇÃO -->
        <div class="autenticacao">
            Autenticação Mecânica
        </div>

        <!-- CÓDIGO DE BARRAS -->
        <div class="barcode">
            <div class="b1"></div>
            <div class="b2"></div>
            <div class="b3"></div>
            <div class="b4"></div>
            <div class="b5"></div>
            <div class="b2"></div>
            <div class="b1"></div>
            <div class="b4"></div>
            <div class="b3"></div>
            <div class="b5"></div>
            <div class="b2"></div>
            <div class="b4"></div>
            <div class="b1"></div>
            <div class="b3"></div>
            <div class="b5"></div>
            <div class="b2"></div>
            <div class="b4"></div>
            <div class="b1"></div>
            <div class="b3"></div>
            <div class="b5"></div>
            <div class="b2"></div>
            <div class="b1"></div>
            <div class="b4"></div>
            <div class="b3"></div>
            <div class="b5"></div>
            <div class="b2"></div>
            <div class="b4"></div>
            <div class="b1"></div>
            <div class="b3"></div>
        </div>

    </div>

    <button class="btn-download" id="baixarPDF">
        Baixar PDF
    </button>

</div>

</body>
</html>