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

                        echo"
                            <tr>
                            <th scope='row'>".$pet['id']."</th>
                            <td>".$pet['pet']."</td>
                            <td>".$pet['dono']."</td>
                            <td>
                            <form method='POST'> 
                            <input type='hidden' name='id_pet_editar' value='".$pet['id']."'</input>
                            <button class='btn btn-block' name='editar_pet'>EDITAR</button>
                            </form></td>
                            </tr>";
                        
                    }; 

    echo '</tbody>
        </table>';

