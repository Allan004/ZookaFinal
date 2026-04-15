<?php
require_once "conexao.php";

function atualizar_pet($dados){
    $pdo = conectar();

    $tipoIdade = strtoupper(trim($dados['tipoIdade'] ?? ''));
    $validTypes = ['EXATA', 'APROXIMADA'];
    if (!in_array($tipoIdade, $validTypes, true)) {
        return false;
    }

    $idadeaprox = $dados['idadeaprox'] !== '' ? (int)$dados['idadeaprox'] : null;
    $nascimento = trim($dados['nascimento'] ?? '');
    if ($tipoIdade === 'APROXIMADA') {
        if ($idadeaprox === null || $idadeaprox <= 0) {
            return false;
        }
        $nascimento = null;
    } else {
        if ($nascimento === '') {
            return false;
        }
        $idadeaprox = null;
    }

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
    if ($nascimento === null) {
        $stmt->bindValue(':nascimento', null, PDO::PARAM_NULL);
    } else {
        $stmt->bindValue(':nascimento', $nascimento);
    }
    $stmt->bindValue(':tipoIdade', $tipoIdade);
    if ($idadeaprox === null) {
        $stmt->bindValue(':idadeaprox', null, PDO::PARAM_NULL);
    } else {
        $stmt->bindValue(':idadeaprox', $idadeaprox, PDO::PARAM_INT);
    }
    $stmt->bindValue(':especie', $dados['especie']);
    $stmt->bindValue(':raca', $dados['raca']);
    $stmt->bindValue(':observacao', $dados['observacao'] ?? null);

    try {
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return false;
    }
}