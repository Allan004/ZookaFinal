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

   echo '<table class="table">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>';

                    foreach($resultados as $cliente){

                        echo"
                            
                            <tr>
                            <th scope='row'>".$cliente['id']."</th>
                            <td>".$cliente['nome']."</td>
                            <td>".$cliente['cpf']."</td>
                            <td>
                            <a class='btn btn-block' href='clientes_e_pets.php?editar_cliente=1&id_cliente_editar={$cliente['id']}'>
                            Editar
                            </a>
                        </td>
                        </tr>";
                        
                    }; 

    echo '</tbody>
        </table>';


            


