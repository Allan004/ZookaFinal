<?php

        
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }



function usuario_logado(): bool
{
    return isset($_SESSION['usuario']);
}


function login(string $usuario, string $senha): bool
{   
        $pdo=conectar();
        $sql = "SELECT usuario, senha FROM login WHERE usuario = :usuario LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user['senha']==$senha) {
                $_SESSION['usuario'] = $user['usuario'];
                return true;
        }

        return false;
}


function logout(): void
{
    session_destroy();
}


    include "conexao.php";
    date_default_timezone_set('America/Sao_Paulo');

function verifica_baixo_estoque(){
        $pdo=conectar();
        $comando="SELECT COUNT(*) FROM produto WHERE estoque<10";
        $stmt=$pdo->prepare($comando);
        $stmt->execute();
        $total=$stmt->fetchColumn();
        return $total;
}

function agenda_hoje(){
        $data=date('Y-m-d');
        $pdo=conectar();
        $comando="SELECT COUNT(*) FROM agendamento WHERE dataagendamento='$data'";
        $stmt=$pdo->prepare($comando);
        $stmt->execute();
        $total=$stmt->fetchColumn();
        return $total;
}

function agenda_pendente(){
        $data=date('Y-m-d');
        $pdo=conectar();
        $comando="SELECT COUNT(*) FROM agendamento WHERE statusagendamento='pendente'";
        $stmt=$pdo->prepare($comando);
        $stmt->execute();
        $total=$stmt->fetchColumn();
        return $total;
}

function faturamentoh(){

        $datai=date('Y-m-d 00:00:00');
        $dataf=date('Y-m-d 23:59:59');
        $pdo=conectar();
        $comando="SELECT SUM(total) FROM venda WHERE data_venda BETWEEN '$datai' AND '$dataf'";
        $stmt=$pdo->prepare($comando);
        $stmt->execute();
        $total=$stmt->fetchColumn();
        return $total;

}

function listar_proximos_atendimentos(){

        $data=date('Y-m-d');
        $pdo=conectar();
        $comando="SELECT
                    p.nome,
                    a.hora,
                    s.nome
                    FROM agendamento a 
                    INNER JOIN pet p on a.id_pet = p.id
                    INNER JOIN servico s on a.id_servico = s.id
                    WHERE a.dataagendamento ='$data'
                    ORDER BY a.hora asc"
                    ;
        $total=$pdo->query($comando);
        return $total;
}

function listar_ultimos_clientes(){

        $data=date('Y-m-d');
        $pdo=conectar();
        $comando="SELECT
                    p.nome,
                    c.nome
                    FROM agendamento a 
                    INNER JOIN pet p on a.id_pet = p.id
                    INNER JOIN cliente c on a.id_servico = c.id
                    WHERE a.dataagendamento ='$data' AND LOWER(a.statusagendamento)='confirmado'
                    ORDER BY a.hora asc"
                    ;
        $total=$pdo->query($comando);
        return $total;
}




?>