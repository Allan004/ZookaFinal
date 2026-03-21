<?php
include funcoes_ladingpage.php;

$usuario = $_POST['usuario'] ?? '';
$senha   = $_POST['senha'] ?? '';

if ($usuario === '' || $senha === '') {
    header("Location: ../index.php?erro=1");
    exit;
}

if (login($usuario, $senha)) {
    header("Location: ../index.php");
    exit;
}

header("Location: index.php?erro=1");
exit;