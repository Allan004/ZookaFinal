<?php
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


        $pdo=conectar();
        $comando="SELECT
                    p.nome,
                    a.hora,
                    s.nome
                    FROM agendamento a 
                    INNER JOIN pet p on a.id_pet = p.id
                    INNER JOIN servico s on a.id_servico = s.id
                    ORDER BY a.hora asc";
        $total=$pdo->query($comando);
        return $total;
}


?>