
<?php 

    require_once "conexao.php";


   
function atualizar_cliente($dados){
    $pdo = conectar();

    $sql = "
        UPDATE cliente SET
            nome       = :nome,
            telefone   = :telefone,
            email      = :email,
            cpf        = :cpf,
            nascimento = :nascimento,
            rua        = :rua,
            numero     = :numero,
            bairro     = :bairro,
            cidade     = :cidade,
            estado     = :estado,
            cep        = :cep,
            updated_at = NOW()
        WHERE id = :id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':id',        (int)$dados['id'], PDO::PARAM_INT);
    $stmt->bindValue(':nome',      $dados['nome']);
    $stmt->bindValue(':telefone',  $dados['telefone']);
    $stmt->bindValue(':email',     $dados['email']);
    $stmt->bindValue(':cpf',       $dados['cpf']);
    $stmt->bindValue(':nascimento',$dados['nascimento']);
    $stmt->bindValue(':rua',       $dados['rua']);
    $stmt->bindValue(':numero',    $dados['numero']);
    $stmt->bindValue(':bairro',    $dados['bairro']);
    $stmt->bindValue(':cidade',    $dados['cidade']);
    $stmt->bindValue(':estado',    $dados['estado']);
    $stmt->bindValue(':cep',       $dados['cep']);


    return $stmt->execute();

};