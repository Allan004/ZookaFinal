<?php
include "conexao.php"


function buscar_clientes(string $termo): array
{
    $pdo = conectar();

    $sql = "SELECT id, nome, telefone
            FROM cliente
            WHERE nome LIKE :termo
            ORDER BY nome
            LIMIT 10";

    $stmt = $pdo->prepare($sql);
    $like = "%$termo%";
    $stmt->bindParam(':termo', $like);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


$termo = $_GET['termo'] ?? '';

$resultados = buscar_clientes($termo);

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

?>