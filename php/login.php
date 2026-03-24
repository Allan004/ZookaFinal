
<?php
require __DIR__ . "/funcoes_ladingpage.php";

$usuario = $_POST['usuario'] ?? '';
$senha   = $_POST['senha'] ?? '';

if ($usuario === '' || $senha === '') {
    header("Location: /ZookaFinal/Interno/index.php?erro=1");
    exit;
}

if (login($usuario, $senha)) {
    header("Location: /ZookaFinal/Interno/index.php");
    exit;
}

header("Location: /ZookaFinal/Interno/index.php?erro=1");
exit;
