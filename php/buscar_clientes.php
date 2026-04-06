<?php
include "conexao.php";

$termo = $_GET['termo'] ?? '';

$pdo = conectar();

$sql = "SELECT id, nome, cpf
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
                            <form method='POST'> 
                            <input type='hidden' name='id_cliente_editar' value='".$cliente['id']."'</input>
                            <button class='btn btn-block' name='editar_cliente'>EDITAR</button>
                            </form></td>
                            </tr>";
                        
                    }; 

    echo '</tbody>
        </table>';


            


