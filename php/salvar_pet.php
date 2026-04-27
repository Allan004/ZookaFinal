<?php
require_once "conexao.php";

/**
 * Valida data no formato YYYY-MM-DD
 */
function validarDataPet($data) {
    if (empty($data)) {
        return false;
    }
    $d = DateTime::createFromFormat('Y-m-d', $data);
    return $d && $d->format('Y-m-d') === $data;
}

/**
 * Valida dados do pet antes de atualizar
 */
function validarDadosPet($dados) {
    $erros = [];
    
    // Validar nome
    if (empty($dados['nome']) || strlen($dados['nome']) < 2) {
        $erros[] = "Nome do pet deve ter no mínimo 2 caracteres";
    }
    if (strlen($dados['nome']) > 50) {
        $erros[] = "Nome do pet não pode exceder 50 caracteres";
    }
    
    // Validar tipo de idade
    $tipoIdade = strtoupper(trim($dados['tipoIdade'] ?? ''));
    $validTypes = ['EXATA', 'APROXIMADA'];
    if (!in_array($tipoIdade, $validTypes, true)) {
        $erros[] = "Tipo de idade deve ser EXATA ou APROXIMADA";
    }
    
    // Validar nascimento ou idade aproximada
    if ($tipoIdade === 'APROXIMADA') {
        $idadeaprox = $dados['idadeaprox'] ?? '';
        if ($idadeaprox === '' || (int)$idadeaprox <= 0) {
            $erros[] = "Idade aproximada deve ser um número positivo";
        }
        if ((int)$idadeaprox > 100) {
            $erros[] = "Idade aproximada não pode ser maior que 100 anos";
        }
    } else {
        $nascimento = trim($dados['nascimento'] ?? '');
        if (empty($nascimento)) {
            $erros[] = "Data de nascimento é obrigatória quando tipo é EXATA";
        } elseif (!validarDataPet($nascimento)) {
            $erros[] = "Data de nascimento inválida (use formato YYYY-MM-DD)";
        } else {
            $data = new DateTime($nascimento);
            $hoje = new DateTime();
            if ($data > $hoje) {
                $erros[] = "Data de nascimento não pode ser no futuro";
            }
        }
    }
    
    // Validar espécie
    if (empty($dados['especie']) || strlen($dados['especie']) < 2) {
        $erros[] = "Espécie deve ter no mínimo 2 caracteres";
    }
    if (strlen($dados['especie']) > 50) {
        $erros[] = "Espécie não pode exceder 50 caracteres";
    }
    
    // Validar raça
    if (empty($dados['raca']) || strlen($dados['raca']) < 2) {
        $erros[] = "Raça deve ter no mínimo 2 caracteres";
    }
    if (strlen($dados['raca']) > 50) {
        $erros[] = "Raça não pode exceder 50 caracteres";
    }
    
    // Validar observação (se fornecida)
    if (isset($dados['observacao']) && strlen($dados['observacao']) > 500) {
        $erros[] = "Observações não podem exceder 500 caracteres";
    }
    
    return $erros;
}

function atualizar_pet($dados){
    // Validar dados
    $erros = validarDadosPet($dados);
    if (!empty($erros)) {
        return ['sucesso' => false, 'erros' => $erros];
    }

    $pdo = conectar();

    $tipoIdade = strtoupper(trim($dados['tipoIdade'] ?? ''));
    $idadeaprox = $dados['idadeaprox'] !== '' ? (int)$dados['idadeaprox'] : null;
    $nascimento = trim($dados['nascimento'] ?? '');
    
    if ($tipoIdade === 'APROXIMADA') {
        $nascimento = null;
    } else {
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
        $stmt->execute();
        return ['sucesso' => true, 'erros' => []];
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return ['sucesso' => false, 'erros' => ['Erro ao atualizar pet no banco de dados']];
    }
}