<?php

include_once "conexao.php"



function adicionar_carrinho($id){

$pdo=conectar();

 $sql = "
        INSERT INTO cliente (
            nome,
            telefone,
            email,
            cpf,
            nascimento,
            rua,
            numero,
            bairro,
            cidade,
            estado,
            cep,
            created_at,
            updated_at
        ) VALUES (
            :nome,
            :telefone,
            :email,
            :cpf,
            :nascimento,
            :rua,
            :numero,
            :bairro,
            :cidade,
            :estado,
            :cep,
            NOW(),
            NOW()
        )
    ";

}

?>