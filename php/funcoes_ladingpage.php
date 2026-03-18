<?php
    include "conexao.php";


function verifica_baixo_estoque(){
        $pdo=conectar();
        $comando="SELECT COUNT(*) FROM produto WHERE estoque<10";
        $stmt=$pdo->prepare($comando);
        $stmt->execute();
        $total=$stmt->fetchColumn();
        return $total;
}


?>