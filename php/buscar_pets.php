<?php
require "conexao.php";

$termo = $_GET['termo'] ?? '';

$pdo = conectar();

$sql = "SELECT p.id as id ,p.nome AS pet, c.nome AS dono
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
};




 echo '<table class="table">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Dono</th>
                    <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>';

                    foreach($resultados as $pet){

                        
                        echo "
                        <tr>
                        <th>{$pet['id']}</th>
                        <td>{$pet['pet']}</td>
                        <td>{$pet['dono']}</td>
                        <td>
                            <a class='btn btn-block' href='clientes_e_pets.php?editar_pet=1&id_pet_editar={$pet['id']}'>
                            Editar
                            </a>
                        </td>
                        </tr>";

                        
                    }; 

    echo '</tbody>
        </table>';

