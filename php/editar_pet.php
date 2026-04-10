<?php 
    require_once "conexao.php";
    function abrir_pet($id){
        $pdo=conectar();
        $comando="SELECT * FROM pet WHERE id = :id ";
        $stmt=$pdo->prepare($comando);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        $total=$stmt->fetch();
        return $total;
};


    

