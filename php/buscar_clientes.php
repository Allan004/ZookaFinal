<?php
include "conexao.php";

$termo = $_GET['termo'] ?? '';

$pdo = conectar();

$sql = "SELECT id, nome, cpf
        FROM cliente
        WHERE nome LIKE :termo
        ORDER BY id
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

echo '
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
';

foreach ($resultados as $cliente) {

    // Remove tudo que não for número
    $cpf_limpo = preg_replace('/\D/', '', $cliente['cpf']);

    // Formata CPF
    $cpf_formatado = preg_replace(
        "/(\d{3})(\d{3})(\d{3})(\d{2})/",
        "$1.$2.$3-$4",
        $cpf_limpo
    );

    echo "
        <tr>
            <th scope='row'>" . htmlspecialchars($cliente['id']) . "</th>

            <td>" . htmlspecialchars($cliente['nome']) . "</td>

            <td>" . htmlspecialchars($cpf_formatado) . "</td>

            <td>
                <a class='btn btn-block'
                   href='clientes_e_pets.php?editar_cliente=1&id_cliente_editar=" . urlencode($cliente['id']) . "'>
                    Editar
                </a>
            </td>
        </tr>
    ";
}

echo '
    </tbody>
</table>
';