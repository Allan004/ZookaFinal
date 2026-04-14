<?php

function conectar(){
    $host = "10.37.44.29:3306";
    $db = "zookaheva";
    $usuario = "root";
    $senha = "";

        try {

            $pdo = new PDO("mysql:host=$host;dbname=$db",$usuario,$senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;

            
        } catch (PDOException $e) {
            echo "Erro ao conectar: " . $e->getMessage();
        };
}
?>