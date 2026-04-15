<?php

function conectar(){
    $host = "localhost";
    $db = "zookaheva";
    $usuario = "root";
    $senha = "";

        try {

            $pdo = new PDO("mysql:host=$host;dbname=$db",$usuario,$senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;

            
        } catch (PDOException $e) {
            error_log("Erro ao conectar: " . $e->getMessage());
            return false;
        };
}
?>