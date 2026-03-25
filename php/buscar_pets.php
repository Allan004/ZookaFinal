<?php
require "conexao.php";

$termo = $_GET['termo'] ?? '';

$pdo = conectar();

$sql = "SELECT p.nome AS pet, c.nome AS dono
        FROM pet p
        INNER JOIN cliente c ON p.id_cliente = c.id
        WHERE p.nome LIKE :termo
        ORDER BY p.nome
        LIMIT 10";

$stmt = $pdo->prepare($sql);
$like = "%$termo%";
$stmt->bindParam(':termo', $like);
$stmt->execute();

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$resultados) {
    echo "<p class='muted'>Nenhum pet encontrado</p>";
    exit;
}

foreach ($resultados as $pet) {
    echo "
        <div class='item'>
            <span>{$pet['pet']}</span>
            <span>{$pet['dono']}</span>
        </div>
    ";
}
``