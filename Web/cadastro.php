<?php
session_start();

require __DIR__ . '/../../php/conexao.php';
$pdo = conectar();

$erro = "";
$sucesso = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome     = $_POST['nome'] ?? '';
    $email    = $_POST['email'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $cpf      = $_POST['cpf'] ?? '';
    $senha    = $_POST['senha'] ?? '';
    $confirma = $_POST['confirma'] ?? '';

    if (empty($nome) || empty($email) || empty($senha) || empty($usuario)) {
        $erro = "Preencha os campos obrigatórios!";
    } elseif ($senha !== $confirma) {
        $erro = "As senhas não coincidem!";
    } else {
            $stmt = $pdo->prepare("SELECT id FROM loginweb WHERE usuario = ?");
            $stmt->execute([$usuario]);

if ($stmt->rowCount() > 0) {
    $erro = "Usuário já existe!";
} else {

    $hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO loginweb (usuario, senha) VALUES (?, ?)");
    $stmt->execute([$usuario, $hash]);
    $id_login = $pdo->lastInsertId();

    $stmt = $pdo->prepare("
    INSERT INTO clienteweb 
    (nome, telefone, email, cpf, nascimento, rua, numero, bairro, cidade, estado, cep, id_login)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

$stmt->execute([
    $nome,
    $telefone,
    $email,
    $cpf,
    $_POST['nascimento'] ?? '',
    $_POST['rua'] ?? '',
    $_POST['numero'] ?? '',
    $_POST['bairro'] ?? '',
    $_POST['cidade'] ?? '',
    $_POST['estado'] ?? '',
    $_POST['cep'] ?? '',
    $id_login
]);

    $sucesso = "Conta criada com sucesso!";
}

    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro | Zooka</title>
<link rel="stylesheet" href="css/stylelogin.css">
</head>

<body>

<header class="main-header">
<div class="header-top">

    <div class="logo-container">
        <a href="#"><img src="Assets/logo.png" class="banner-topo"></a>
    </div>

    <div class="ambiente-container">
        <div class="ambiente">
            <span class="texto-ambiente">|</span>
            <img src="Assets/ambiente.png" class="banner-seguro">
            <span class="texto-ambiente">Ambiente Seguro</span>
        </div>
    </div>

</div>

<main class="login-container">
<h2>Crie sua conta</h2>

<div class="login-wrapper">

<!-- FORM CADASTRO -->
<section class="login-access">

<form method="POST">

<!-- Tipo -->
<div style="display:flex; gap:20px; margin-bottom:10px;">

  <label style="display:flex; align-items:center; gap:5px;">
    <input type="radio" name="tipo" value="pf" checked>
    Pessoa Física
  </label>

  <label style="display:flex; align-items:center; gap:5px;">
    <input type="radio" name="tipo" value="pj">
    Pessoa Jurídica
  </label>

</div>

<hr>

<label>Nome e sobrenome</label>
<input type="text" name="nome" placeholder="Digite seu nome completo">

<label>E-mail</label>
<input type="text" name="email" placeholder="Digite seu e-mail">

<label>Usuário</label>
<input type="text" name="usuario" placeholder="Crie seu usuário de login">

<label>Celular</label>
<input type="text" name="telefone" placeholder="DDD + Celular">

<label>CPF</label>
<input type="text" name="cpf" placeholder="Digite seu CPF">

<label>Data de nascimento</label>
<input type="date" name="nascimento">

<hr>

<label>CEP</label>
<input type="text" name="cep" placeholder="Digite seu CEP">

<label>Rua</label>
<input type="text" name="rua" placeholder="Digite sua rua">

<label>Número</label>
<input type="text" name="numero" placeholder="Número">

<label>Bairro</label>
<input type="text" name="bairro" placeholder="Bairro">

<label>Cidade</label>
<input type="text" name="cidade" placeholder="Cidade">

<label>Estado</label>
<select name="estado" style="width:100%; padding:10px 15px; border-radius:6px; border:1px solid #ccc; margin-bottom:15px; font-size:14px;">
  <option value="">Selecione o estado</option>
  <option value="AC">AC</option>
  <option value="AL">AL</option>
  <option value="AP">AP</option>
  <option value="AM">AM</option>
  <option value="BA">BA</option>
  <option value="CE">CE</option>
  <option value="DF">DF</option>
  <option value="ES">ES</option>
  <option value="GO">GO</option>
  <option value="MA">MA</option>
  <option value="MT">MT</option>
  <option value="MS">MS</option>
  <option value="MG">MG</option>
  <option value="PA">PA</option>
  <option value="PB">PB</option>
  <option value="PR">PR</option>
  <option value="PE">PE</option>
  <option value="PI">PI</option>
  <option value="RJ">RJ</option>
  <option value="RN">RN</option>
  <option value="RS">RS</option>
  <option value="RO">RO</option>
  <option value="RR">RR</option>
  <option value="SC">SC</option>
  <option value="SP">SP</option>
  <option value="SE">SE</option>
  <option value="TO">TO</option>
</select>

<hr>

<div style="display:flex; gap:15px;">

  <div style="flex:1;">
    <label>Senha</label>
    <input type="password" name="senha" placeholder="Digite sua senha" style="width:100%;">
  </div>

  <div style="flex:1;">
    <label>Confirmar senha</label>
    <input type="password" name="confirma" placeholder="Confirme sua senha" style="width:100%;">
  </div>

</div>

<div style="display:flex; gap:30px; margin-top:10px; margin-bottom:10px; font-size:12px; color:#555;">

  <div>
    <strong style="display:block; margin-bottom:5px;">Padrão de Senha</strong>
    
    <div style="display:flex; gap:40px;">
      
      <!-- COLUNA ESQUERDA -->
      <ul style="padding-left:14px; margin:0;">
        <li>Mínimo 8 caracteres</li>
        <li>Letra Minúscula</li>
      </ul>

      <!-- COLUNA DIREITA -->
      <ul style="padding-left:14px; margin:0;">
        <li>Letra Maiúscula</li>
        <li>Números</li>
      </ul>

    </div>
  </div>

</div>


<label style="margin-top:10px; font-size:12px;">
  <input type="checkbox" name="termos">
  Concordo com os 
  <a href="#" style="color:#004a99; font-weight:600; text-decoration:none;">
    termos e condições
  </a>
</label>

<?php if($erro): ?>
  <p class="msg-erro"><?php echo $erro; ?></p>
<?php endif; ?>

<?php if($sucesso): ?>
  <p class="msg-sucesso"><?php echo $sucesso; ?></p>
<?php endif; ?>

<button type="submit" class="btn-login">Cadastrar</button>

</form>
</section>

<!-- LADO DIREITO (REUTILIZADO) -->
<section class="login-create">
<h3>Criar uma conta é rápido, fácil e gratuito</h3>
<p>
Com a sua conta da Zooka você tem acesso a ofertas exclusivas, descontos,
acompanhar pedidos e muito mais!
</p>
</section>

</div>
</main>
</header>

<footer class="main-footer">
    <p>Copyright© 2026 Zooka Petshop e Clínica Veterinária S/A<br>
    Todos os direitos reservados</p>
</footer>
<script>

/* TELEFONE (11) 99999-9999 */
document.querySelector('input[name="telefone"]').addEventListener('input', function(e){
  let v = e.target.value.replace(/\D/g,'').slice(0,11); // limita 11 números

  if (v.length > 10) {
    v = v.replace(/^(\d{2})(\d{5})(\d{0,4})$/, '($1) $2-$3');
  } else {
    v = v.replace(/^(\d{2})(\d{4})(\d{0,4})$/, '($1) $2-$3');
  }

  e.target.value = v.trim();
});


/* CPF 000.000.000-00 */
document.querySelector('input[name="cpf"]').addEventListener('input', function(e){
  let v = e.target.value.replace(/\D/g,'').slice(0,11); // limita 11

  v = v.replace(/^(\d{3})(\d)/, '$1.$2');
  v = v.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
  v = v.replace(/\.(\d{3})(\d)/, '.$1-$2');

  e.target.value = v;
});


/* CEP 00000-000 */
document.querySelector('input[name="cep"]').addEventListener('input', function(e){
  let v = e.target.value.replace(/\D/g,'').slice(0,8); // limita 8

  v = v.replace(/^(\d{5})(\d)/, '$1-$2');

  e.target.value = v;
});

</script>
</body>
</html>