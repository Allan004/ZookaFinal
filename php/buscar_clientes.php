<?php
include "conexao.php";

$termo = $_GET['termo'] ?? '';

$pdo = conectar();

$sql = "SELECT nome, telefone
        FROM cliente
        WHERE nome LIKE :termo
        ORDER BY nome
        LIMIT 10";

$stmt = $pdo->prepare($sql);
$like = "%$termo%";
$stmt->bindParam(':termo', $like);
$stmt->execute();

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$resultados) {
    echo "<p class='muted'>Nenhum cliente encontrado</p>";
    exit;
}

foreach ($resultados as $cliente) {
    echo "
        <div class='item'>
            <span>{$cliente['nome']}</span>
            <span>{$cliente['telefone']}</span>
        </div>
    ";
}
