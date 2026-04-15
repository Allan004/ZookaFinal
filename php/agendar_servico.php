<?php
 require_once "conexao.php";

function validar_agendamento($dados){
    $errors = [];

    if (empty($dados['id_pet']) || !is_numeric($dados['id_pet']) || (int)$dados['id_pet'] <= 0) {
        $errors[] = 'Selecione um pet válido.';
    }

    if (empty($dados['id_servico']) || !is_numeric($dados['id_servico']) || (int)$dados['id_servico'] <= 0) {
        $errors[] = 'Selecione um serviço válido.';
    }

    if (empty($dados['id_funcionario']) || !is_numeric($dados['id_funcionario']) || (int)$dados['id_funcionario'] <= 0) {
        $errors[] = 'Selecione um funcionário válido.';
    }

    if (empty($dados['dataagendamento']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dados['dataagendamento'])) {
        $errors[] = 'Informe uma data no formato correto.';
    }

    if (empty($dados['hora']) || !preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $dados['hora'])) {
        $errors[] = 'Informe uma hora no formato correto.';
    }

    if (empty($errors)) {
        $dateTimeString = $dados['dataagendamento'] . ' ' . $dados['hora'];
        $dateTime = DateTime::createFromFormat('Y-m-d H:i', $dateTimeString);
        if (!$dateTime) {
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateTimeString);
        }
        $now = new DateTime();
        if (!$dateTime || $dateTime < $now) {
            $errors[] = 'A data e hora devem ser iguais ou maiores que o momento atual.';
        }
    }

    $statusList = ['Agendado', 'Pendente', 'Concluído', 'Cancelado'];
    if (empty($dados['statusagendamento']) || !in_array($dados['statusagendamento'], $statusList, true)) {
        $errors[] = 'Selecione um status válido.';
    }

    return $errors;
}

function busca_pet_cliente(){
        $pdo=conectar();
        $comando="SELECT 
                    p.nome,
                    c.cpf,
                    p.id
        FROM pet p
        INNER JOIN cliente c on p.id_cliente=c.id";
        $stmt=$pdo->prepare($comando);
        $stmt->execute();
        $total=$stmt->fetchAll();
        return $total;
};

function busca_servico(){

        $pdo=conectar();
        $comando="SELECT nome,id FROM servico";
        $stmt=$pdo->prepare($comando);
        $stmt->execute();
        $total=$stmt->fetchall();
        return $total;

};

function busca_funcionario(){

        $pdo=conectar();
        $comando="SELECT nome,cargo,id FROM funcionario f";
        $stmt=$pdo->prepare($comando);
        $stmt->execute();
        $total=$stmt->fetchall();
        return $total;

};



function inserir_agendamento($dados){
    $dados['dataagendamento'] = trim($dados['dataagendamento']);
    $dados['hora'] = preg_replace('/\s+/', '', trim($dados['hora']));

    if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $dados['dataagendamento'], $matches)) {
        $dados['dataagendamento'] = sprintf('%s-%s-%s', $matches[3], $matches[2], $matches[1]);
    }

    if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $dados['hora'])) {
        $dados['hora'] = substr($dados['hora'], 0, 5);
    }

    $errors = validar_agendamento($dados);
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }

    $pdo = conectar();
    if (!$pdo) {
        return ['success' => false, 'errors' => ['Erro ao conectar com o banco.']];
    }

    try {
        if ($dados['id_agendamento'] === null) {
            $sql = "
                INSERT INTO agendamento (
                    id_pet,
                    id_servico,
                    id_funcionario,
                    dataagendamento,
                    hora,
                    statusagendamento
                ) VALUES (
                    :id_pet,
                    :id_servico,
                    :id_funcionario,
                    :dataagendamento,
                    :hora,
                    :statusagendamento
                )
            ";
        } else {
            $sql = "
                UPDATE agendamento SET
                    id_pet = :id_pet,
                    id_servico = :id_servico,
                    id_funcionario = :id_funcionario,
                    dataagendamento = :dataagendamento,
                    hora = :hora,
                    statusagendamento = :statusagendamento,
                    updated_at = NOW()
                WHERE id = :id
            ";
        }

        $stmt = $pdo->prepare($sql);
        if ($dados['id_agendamento'] !== null) {
            $stmt->bindValue(':id', (int)$dados['id_agendamento'], PDO::PARAM_INT);
        }
        $stmt->bindValue(':id_pet', (int)$dados['id_pet'], PDO::PARAM_INT);
        $stmt->bindValue(':id_servico', (int)$dados['id_servico'], PDO::PARAM_INT);
        $stmt->bindValue(':id_funcionario', (int)$dados['id_funcionario'], PDO::PARAM_INT);
        $stmt->bindValue(':dataagendamento', $dados['dataagendamento']);
        $stmt->bindValue(':hora', $dados['hora']);
        $stmt->bindValue(':statusagendamento', $dados['statusagendamento']);

        $stmt->execute();
        return ['success' => true];
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return ['success' => false, 'errors' => ['Erro ao salvar o agendamento.']];
    }
}


function busca_agendamento(){

        $pdo=conectar();
        $comando="SELECT
    a.id AS id_agendamento,
    p.nome AS pet,
    s.nome AS servico,
    f.nome AS funcionario,
    a.dataagendamento,
    a.hora,
    a.statusagendamento
FROM agendamento a
INNER JOIN pet p 
    ON a.id_pet = p.id
INNER JOIN servico s 
    ON a.id_servico = s.id
INNER JOIN funcionario f 
    ON a.id_funcionario = f.id
WHERE a.dataagendamento >= CURDATE()
ORDER BY a.hora;
";
        $stmt=$pdo->prepare($comando);
        $stmt->execute();
        $total=$stmt->fetchall();
        return $total;

};


function deletar_agendamento($id){

        $pdo=conectar();
        $comando="DELETE FROM agendamento WHERE id=:id";
        $stmt=$pdo->prepare($comando);
        $stmt->bindValue(':id',(int)$id, PDO::PARAM_INT);
        $stmt->execute();

}



function busca_agendamento_especifico($id){



        $pdo=conectar();
        $comando="SELECT
    a.id AS id_agendamento,
    p.nome AS pet,
    s.nome AS servico,
    f.nome AS funcionario,
    a.dataagendamento,
    a.hora,
    a.statusagendamento,
    a.id_pet,
    a.id_servico,
    a.id_funcionario
FROM agendamento a
INNER JOIN pet p 
    ON a.id_pet = p.id
INNER JOIN servico s 
    ON a.id_servico = s.id
INNER JOIN funcionario f 
    ON a.id_funcionario = f.id
WHERE a.id=:id";
        $stmt=$pdo->prepare($comando);
        $stmt->bindValue(':id',(int)$id, PDO::PARAM_INT);
        $stmt->execute();
        $total=$stmt->fetch();
        return $total;

};












