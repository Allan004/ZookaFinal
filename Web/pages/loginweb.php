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
        $sql = "SELECT usuario, senha FROM loginweb WHERE usuario = :usuario LIMIT 1";
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