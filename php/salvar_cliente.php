
<?php 

    require_once "conexao.php";

/**
 * Valida CPF usando o algoritmo oficial
 */
function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
    if (strlen($cpf) != 11) {
        return false;
    }
    
    if (preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }
    
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += $cpf[$i] * (10 - $i);
    }
    $resto = $soma % 11;
    $digito1 = $resto < 2 ? 0 : 11 - $resto;
    
    if ($cpf[9] != $digito1) {
        return false;
    }
    
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += $cpf[$i] * (11 - $i);
    }
    $resto = $soma % 11;
    $digito2 = $resto < 2 ? 0 : 11 - $resto;
    
    return $cpf[10] == $digito2;
}

/**
 * Valida email
 */
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Valida telefone brasileiro (com ou sem formatação)
 */
function validarTelefone($telefone) {
    $telefone = preg_replace('/[^0-9]/', '', $telefone);
    return strlen($telefone) >= 10 && strlen($telefone) <= 11;
}

/**
 * Valida CEP brasileiro
 */
function validarCEP($cep) {
    $cep = preg_replace('/[^0-9]/', '', $cep);
    return strlen($cep) === 8;
}

/**
 * Valida data no formato YYYY-MM-DD
 */
function validarData($data) {
    $d = DateTime::createFromFormat('Y-m-d', $data);
    return $d && $d->format('Y-m-d') === $data;
}

/**
 * Valida dados do cliente antes de atualizar
 */
function validarDadosCliente($dados) {
    $erros = [];
    
    // Validar nome
    if (empty($dados['nome']) || strlen($dados['nome']) < 3) {
        $erros[] = "Nome deve ter no mínimo 3 caracteres";
    }
    if (strlen($dados['nome']) > 100) {
        $erros[] = "Nome não pode exceder 100 caracteres";
    }
    
    // Validar email
    if (empty($dados['email'])) {
        $erros[] = "Email é obrigatório";
    } elseif (!validarEmail($dados['email'])) {
        $erros[] = "Email inválido";
    }
    
    // Validar telefone
    if (empty($dados['telefone'])) {
        $erros[] = "Telefone é obrigatório";
    } elseif (!validarTelefone($dados['telefone'])) {
        $erros[] = "Telefone deve conter 10 ou 11 dígitos";
    }
    
    // Validar CPF
    if (empty($dados['cpf'])) {
        $erros[] = "CPF é obrigatório";
    } elseif (!validarCPF($dados['cpf'])) {
        $erros[] = "CPF inválido";
    }
    
    // Validar data de nascimento
    if (empty($dados['nascimento'])) {
        $erros[] = "Data de nascimento é obrigatória";
    } elseif (!validarData($dados['nascimento'])) {
        $erros[] = "Data de nascimento inválida (use formato YYYY-MM-DD)";
    } else {
        $data = new DateTime($dados['nascimento']);
        $idade = $data->diff(new DateTime())->y;
        if ($idade < 0 || $idade > 150) {
            $erros[] = "Data de nascimento inválida";
        }
    }
    
    // Validar endereço
    if (empty($dados['rua']) || strlen($dados['rua']) < 3) {
        $erros[] = "Rua deve ter no mínimo 3 caracteres";
    }
    
    if (empty($dados['numero'])) {
        $erros[] = "Número é obrigatório";
    }
    
    if (empty($dados['bairro']) || strlen($dados['bairro']) < 2) {
        $erros[] = "Bairro deve ter no mínimo 2 caracteres";
    }
    
    if (empty($dados['cidade']) || strlen($dados['cidade']) < 2) {
        $erros[] = "Cidade deve ter no mínimo 2 caracteres";
    }
    
    if (empty($dados['estado']) || strlen($dados['estado']) != 2) {
        $erros[] = "Estado deve ter exatamente 2 caracteres";
    }
    
    if (empty($dados['cep'])) {
        $erros[] = "CEP é obrigatório";
    } elseif (!validarCEP($dados['cep'])) {
        $erros[] = "CEP inválido (deve conter 8 dígitos)";
    }
    
    return $erros;
}

function atualizar_cliente($dados){
    // Validar dados
    $erros = validarDadosCliente($dados);
    if (!empty($erros)) {
        return ['sucesso' => false, 'erros' => $erros];
    }

    $pdo = conectar();

    $sql = "
        UPDATE cliente SET
            nome       = :nome,
            telefone   = :telefone,
            email      = :email,
            cpf        = :cpf,
            nascimento = :nascimento,
            rua        = :rua,
            numero     = :numero,
            bairro     = :bairro,
            cidade     = :cidade,
            estado     = :estado,
            cep        = :cep,
            updated_at = NOW()
        WHERE id = :id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':id',        (int)$dados['id'], PDO::PARAM_INT);
    $stmt->bindValue(':nome',      $dados['nome']);
    $stmt->bindValue(':telefone',  preg_replace('/[^0-9]/', '', $dados['telefone']));
    $stmt->bindValue(':email',     strtolower($dados['email']));
    $stmt->bindValue(':cpf',       preg_replace('/[^0-9]/', '', $dados['cpf']));
    $stmt->bindValue(':nascimento',$dados['nascimento']);
    $stmt->bindValue(':rua',       $dados['rua']);
    $stmt->bindValue(':numero',    $dados['numero']);
    $stmt->bindValue(':bairro',    $dados['bairro']);
    $stmt->bindValue(':cidade',    $dados['cidade']);
    $stmt->bindValue(':estado',    strtoupper($dados['estado']));
    $stmt->bindValue(':cep',       preg_replace('/[^0-9]/', '', $dados['cep']));

    try {
        $stmt->execute();
        return ['sucesso' => true, 'erros' => []];
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return ['sucesso' => false, 'erros' => ['Erro ao atualizar cliente no banco de dados']];
    }
}

function criar_cliente($dados) {
    $erros = validarDadosCliente($dados);
    if (!empty($erros)) {
        return ['sucesso' => false, 'erros' => $erros];
    }

    $pdo = conectar();

    $sql = "
        INSERT INTO cliente (
            nome,
            telefone,
            email,
            cpf,
            nascimento,
            rua,
            numero,
            bairro,
            cidade,
            estado,
            cep,
            created_at,
            updated_at
        ) VALUES (
            :nome,
            :telefone,
            :email,
            :cpf,
            :nascimento,
            :rua,
            :numero,
            :bairro,
            :cidade,
            :estado,
            :cep,
            NOW(),
            NOW()
        )
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome',      $dados['nome']);
    $stmt->bindValue(':telefone',  preg_replace('/[^0-9]/', '', $dados['telefone']));
    $stmt->bindValue(':email',     strtolower($dados['email']));
    $stmt->bindValue(':cpf',       preg_replace('/[^0-9]/', '', $dados['cpf']));
    $stmt->bindValue(':nascimento',$dados['nascimento']);
    $stmt->bindValue(':rua',       $dados['rua']);
    $stmt->bindValue(':numero',    $dados['numero']);
    $stmt->bindValue(':bairro',    $dados['bairro']);
    $stmt->bindValue(':cidade',    $dados['cidade']);
    $stmt->bindValue(':estado',    strtoupper($dados['estado']));
    $stmt->bindValue(':cep',       preg_replace('/[^0-9]/', '', $dados['cep']));

    try {
        $stmt->execute();
        return ['sucesso' => true, 'erros' => [], 'id' => $pdo->lastInsertId()];
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return ['sucesso' => false, 'erros' => ['Erro ao criar cliente no banco de dados']];
    }
}
