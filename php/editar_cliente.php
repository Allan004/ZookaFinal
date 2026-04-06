<?php 
    require_once "conexao.php";
    function abrir_cliente($id){
        $pdo=conectar();
        $comando="SELECT * FROM cliente WHERE id = :id ";
        $stmt=$pdo->prepare($comando);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        $total=$stmt->fetch();
        return $total;
};

