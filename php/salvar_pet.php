<?php
require_once "conexao.php";

function atualizar_pet($dados){
    $pdo = conectar();

    $sql = "
        UPDATE pet SET
            nome = :nome,
            nascimento = :nascimento,
            tipoIdade = :tipoIdade,
            idadeaprox = :idadeaprox,
            especie = :especie,
            raca = :raca,
            observacao = :observacao,
            updated_at = NOW()
        WHERE id = :id
    ";

    $stmt = $pdo->prepare($sql);

   

$stmt->bindValue(':id', (int)$dados['id_pet'], PDO::PARAM_INT);
$stmt->bindValue(':nome', $dados['nome']);
$stmt->bindValue(':nascimento', $dados['nascimento']);
$stmt->bindValue(':tipoIdade', strtoupper($dados['tipoIdade'])); 
$stmt->bindValue(':idadeaprox', $dados['idadeaprox'] ?: null, PDO::PARAM_INT);
$stmt->bindValue(':especie', $dados['especie']);
$stmt->bindValue(':raca', $dados['raca']);
$stmt->bindValue(':observacao', $dados['observacao'] ?? null);



    return $stmt->execute();
}