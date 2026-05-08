<?php
session_start();
require_once '../php/carrinho.php';

$metodoEntrega = $_GET['metodo_entrega'] ?? 'padrao';
$totais = calcular_totais_carrinho($metodoEntrega);
$nomeCliente = $_SESSION['usuario_nome'] ?? 'Cliente Zooka';
$codigoBanco = '237-2';
$agenciaCodigo = '0001 / 99999-9';
$beneficiario = 'Família Zooka LTDA';
$localPagamento = 'Pagável em qualquer banco até o vencimento.';
$vencimento = date('d/m/Y', strtotime('+3 days'));
$nossoNumero = $_GET['nosso_numero'] ?? str_pad((string) rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
$valorDocumento = number_format($totais['total'] ?? 0, 2, ',', '.');
$linhaDigitavel = sprintf('23790.12345 60000.%06d 00000.0000%03d 1 %014s', rand(1, 999999), rand(1, 999), $nossoNumero);
$codigoBarras = str_replace(['.', ' '], '', $linhaDigitavel);
$codigoBarrasArray = str_split($codigoBarras);
?>
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

            <div class="codigo-banco" id="codigoBanco">
                <?php echo htmlspecialchars($codigoBanco, ENT_QUOTES, 'UTF-8'); ?>
            </div>

            <div class="linha-digitavel" id="linhaDigitavel">
                <?php echo htmlspecialchars($linhaDigitavel, ENT_QUOTES, 'UTF-8'); ?>
            </div>

        </div>

        <!-- TABELA -->
        <div class="tabela">

            <div class="campo grande">
                <span>Local de pagamento</span>
                <p id="localPagamento"><?php echo htmlspecialchars($localPagamento, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

            <div class="campo pequeno">
                <span>Vencimento</span>
                <p id="vencimento"><?php echo htmlspecialchars($vencimento, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

            <div class="campo grande">
                <span>Beneficiário</span>
                <p id="beneficiario"><?php echo htmlspecialchars($beneficiario, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

            <div class="campo pequeno">
                <span>Agência / Código</span>
                <p id="agenciaCodigo"><?php echo htmlspecialchars($agenciaCodigo, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

            <div class="campo grande">
                <span>Pagador</span>
                <p id="pagador"><?php echo htmlspecialchars($nomeCliente, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

            <div class="campo pequeno">
                <span>Nosso Número</span>
                <p id="nossoNumero"><?php echo htmlspecialchars($nossoNumero, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

            <div class="campo grande">
                <span>Uso do Banco</span>
                <p id="usoBanco">Carteira Simples</p>
            </div>

            <div class="campo pequeno">
                <span>Valor Documento</span>
                <p id="valorDocumento">R$ <?php echo htmlspecialchars($valorDocumento, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

        </div>

        <!-- AUTENTICAÇÃO -->
        <div class="autenticacao">
            Autenticação Mecânica
        </div>

        <!-- CÓDIGO DE BARRAS -->
        <div class="barcode" id="barcode" data-codigo="<?php echo htmlspecialchars($codigoBarras, ENT_QUOTES, 'UTF-8'); ?>">
            <?php
            $digits = array_map('intval', str_split(preg_replace('/\D/', '', $codigoBarras)));
            $totalBars = 200;
            $digitCount = count($digits);
            for ($i = 0; $i < $totalBars; $i++) {
                $digit = $digitCount ? $digits[$i % $digitCount] : 1;
                $width = 1.5 + (($digit % 4) * 0.5);
                $shortClass = $i % 6 === 0 ? ' short' : '';
                echo "<div class='barcode-bar{$shortClass}' style='width:{$width}px'></div>";
            }
            ?>
        </div>

        <div class="barcode-code">
            <?php echo htmlspecialchars($codigoBarras, ENT_QUOTES, 'UTF-8'); ?>
        </div>

        <div class="boleto-info" style="margin-top: 16px; font-size: 13px; color: #333;">
            <p><strong>Resumo da venda:</strong> R$ <?php echo htmlspecialchars($valorDocumento, ENT_QUOTES, 'UTF-8'); ?> | Entrega: <?php echo htmlspecialchars(ucfirst($metodoEntrega), ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Cliente:</strong> <?php echo htmlspecialchars($nomeCliente, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>

    </div>

    <button class="btn-download" id="baixarPDF">
        Baixar PDF
    </button>

</div>

</body>
</html>