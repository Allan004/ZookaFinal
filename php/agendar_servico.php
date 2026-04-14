<?php
 require_once "conexao.php";

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
    $pdo = conectar();

    if($dados['id_agendamento']===null){


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

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':id_pet',         (int)$dados['id_pet'], PDO::PARAM_INT);
    $stmt->bindValue(':id_servico',     (int)$dados['id_servico'], PDO::PARAM_INT);
    $stmt->bindValue(':id_funcionario', (int)$dados['id_funcionario'], PDO::PARAM_INT);
    $stmt->bindValue(':dataagendamento',$dados['dataagendamento']); // YYYY-MM-DD
    $stmt->bindValue(':hora',           $dados['hora']);             // HH:MM:SS
    $stmt->bindValue(':statusagendamento',$dados['statusagendamento']);

    return $stmt->execute();} else{


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

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':id',              (int)$dados['id_agendamento'], PDO::PARAM_INT);
            $stmt->bindValue(':id_pet',          (int)$dados['id_pet'], PDO::PARAM_INT);
            $stmt->bindValue(':id_servico',      (int)$dados['id_servico'], PDO::PARAM_INT);
            $stmt->bindValue(':id_funcionario',  (int)$dados['id_funcionario'], PDO::PARAM_INT);
            $stmt->bindValue(':dataagendamento', $dados['dataagendamento']); // YYYY-MM-DD
            $stmt->bindValue(':hora',            $dados['hora']);             // HH:MM ou HH:MM:SS
            $stmt->bindValue(':statusagendamento', $dados['statusagendamento']);

            return $stmt->execute();



};
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












