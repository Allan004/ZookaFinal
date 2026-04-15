<?php
session_start();

require __DIR__ . '/../../php/conexao.php';
$pdo = conectar();

$erro = "";
$erro_usuario = false;
$sucesso = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome     = $_POST['nome'] ?? '';
    $email    = $_POST['email'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $cpf      = $_POST['cpf'] ?? '';
    $nascimento = $_POST['nascimento'] ?? '';
    $senha    = trim($_POST['senha'] ?? '');
    $confirma = trim($_POST['confirma'] ?? '');
    $cep = $_POST['cep'] ?? '';

    $cpf = preg_replace('/\D/', '', $cpf);
    $telefone = preg_replace('/\D/', '', $telefone);
    $cep = preg_replace('/\D/', '', $cep);

    if (empty($nome) || empty($email) || empty($senha) || empty($usuario) || empty($nascimento)) {
    $erro = "Preencha os campos obrigatórios!";

} elseif ($senha !== $confirma) {
    $erro = "As senhas não coincidem!";

} elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $senha)) {
    $erro = "A senha não atende aos requisistos mínimos.";

} elseif (empty($_POST['termos'])) {
    $erro = "Você precisa aceitar os termos e condições!";
} elseif (strtotime($nascimento) > strtotime('-18 years')) {
    $erro = "Você precisa ter pelo menos 18 anos para se cadastrar!";
} else {
            $stmt = $pdo->prepare("SELECT id FROM loginweb WHERE usuario = ?");
            $stmt->execute([$usuario]);
            // VERIFICA EMAIL
            $stmtEmail = $pdo->prepare("SELECT id FROM clienteweb WHERE email = ?");
            $stmtEmail->execute([$email]);
            // VERIFICA CPF
            $stmtCpf = $pdo->prepare("SELECT id FROM clienteweb WHERE cpf = ?");
            $stmtCpf->execute([$cpf]);

if ($stmtEmail->rowCount() > 0) {
    $erro = "E-mail já cadastrado!";

} elseif ($stmtCpf->rowCount() > 0) {
    $erro = "CPF já cadastrado!";

} elseif ($stmt->rowCount() > 0) {
    $erro = "Usuário já existe!";
    $erro_usuario = true;

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
    $nascimento,
    $_POST['rua'] ?? '',
    $_POST['numero'] ?? '',
    $_POST['bairro'] ?? '',
    $_POST['cidade'] ?? '',
    $_POST['estado'] ?? '',
    $cep,
    $id_login
]);

    $_SESSION['sucesso'] = "Conta criada com sucesso! Faça login para continuar.";
header("Location: login.php");
exit;
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
    <a href="index.php">
        <img src="Assets/logo.png" class="banner-topo" alt="Zooka">
    </a>
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

<section class="login-access">

<form method="POST">

<label>Nome e sobrenome</label>
<input type="text" name="nome"
value="<?= htmlspecialchars($nome ?? '') ?>"
placeholder="Digite seu nome completo">

<input type="text" name="email"
value="<?= htmlspecialchars($email ?? '') ?>"
placeholder="Digite seu e-mail">

<input type="text" name="usuario"
value="<?= htmlspecialchars($usuario ?? '') ?>"
placeholder="Crie seu usuário de login"
class="<?= $erro_usuario ? 'input-erro' : '' ?>">

<input type="text" name="telefone"
value="<?= htmlspecialchars($telefone ?? '') ?>"
placeholder="DDD + Celular">

<input type="text" name="cpf"
value="<?= htmlspecialchars($cpf ?? '') ?>"
placeholder="Digite seu CPF">

<input type="date" name="nascimento"
value="<?= htmlspecialchars($_POST['nascimento'] ?? '') ?>"
max="<?= date('Y-m-d', strtotime('-18 years')) ?>">

<hr>

<label>CEP</label>
<input type="text" id="cep" name="cep"
value="<?= htmlspecialchars($_POST['cep'] ?? '') ?>"
placeholder="Digite seu CEP" onblur="pesquisacep(this.value);">

<label>Rua</label>
<input type="text" id="rua" name="rua"
value="<?= htmlspecialchars($_POST['rua'] ?? '') ?>"
placeholder="Digite sua rua">

<label>Número</label>
<input type="text" name="numero"
value="<?= htmlspecialchars($_POST['numero'] ?? '') ?>"
placeholder="Número">

<label>Bairro</label>
<input type="text" id="bairro" name="bairro"
value="<?= htmlspecialchars($_POST['bairro'] ?? '') ?>"
placeholder="Bairro">

<label>Cidade</label>
<input type="text" id="cidade" name="cidade"
value="<?= htmlspecialchars($_POST['cidade'] ?? '') ?>"
placeholder="Cidade">

<label>Estado</label>
<select id="uf" name="estado" style="width:100%; padding:10px 15px; border-radius:6px; border:1px solid #ccc; margin-bottom:15px; font-size:14px;">
  <option value="">Selecione o estado</option>

  <option value="AC" <?= (($_POST['estado'] ?? '') == 'AC') ? 'selected' : '' ?>>AC</option>
  <option value="AL" <?= (($_POST['estado'] ?? '') == 'AL') ? 'selected' : '' ?>>AL</option>
  <option value="AP" <?= (($_POST['estado'] ?? '') == 'AP') ? 'selected' : '' ?>>AP</option>
  <option value="AM" <?= (($_POST['estado'] ?? '') == 'AM') ? 'selected' : '' ?>>AM</option>
  <option value="BA" <?= (($_POST['estado'] ?? '') == 'BA') ? 'selected' : '' ?>>BA</option>
  <option value="CE" <?= (($_POST['estado'] ?? '') == 'CE') ? 'selected' : '' ?>>CE</option>
  <option value="DF" <?= (($_POST['estado'] ?? '') == 'DF') ? 'selected' : '' ?>>DF</option>
  <option value="ES" <?= (($_POST['estado'] ?? '') == 'ES') ? 'selected' : '' ?>>ES</option>
  <option value="GO" <?= (($_POST['estado'] ?? '') == 'GO') ? 'selected' : '' ?>>GO</option>
  <option value="MA" <?= (($_POST['estado'] ?? '') == 'MA') ? 'selected' : '' ?>>MA</option>
  <option value="MT" <?= (($_POST['estado'] ?? '') == 'MT') ? 'selected' : '' ?>>MT</option>
  <option value="MS" <?= (($_POST['estado'] ?? '') == 'MS') ? 'selected' : '' ?>>MS</option>
  <option value="MG" <?= (($_POST['estado'] ?? '') == 'MG') ? 'selected' : '' ?>>MG</option>
  <option value="PA" <?= (($_POST['estado'] ?? '') == 'PA') ? 'selected' : '' ?>>PA</option>
  <option value="PB" <?= (($_POST['estado'] ?? '') == 'PB') ? 'selected' : '' ?>>PB</option>
  <option value="PR" <?= (($_POST['estado'] ?? '') == 'PR') ? 'selected' : '' ?>>PR</option>
  <option value="PE" <?= (($_POST['estado'] ?? '') == 'PE') ? 'selected' : '' ?>>PE</option>
  <option value="PI" <?= (($_POST['estado'] ?? '') == 'PI') ? 'selected' : '' ?>>PI</option>
  <option value="RJ" <?= (($_POST['estado'] ?? '') == 'RJ') ? 'selected' : '' ?>>RJ</option>
  <option value="RN" <?= (($_POST['estado'] ?? '') == 'RN') ? 'selected' : '' ?>>RN</option>
  <option value="RS" <?= (($_POST['estado'] ?? '') == 'RS') ? 'selected' : '' ?>>RS</option>
  <option value="RO" <?= (($_POST['estado'] ?? '') == 'RO') ? 'selected' : '' ?>>RO</option>
  <option value="RR" <?= (($_POST['estado'] ?? '') == 'RR') ? 'selected' : '' ?>>RR</option>
  <option value="SC" <?= (($_POST['estado'] ?? '') == 'SC') ? 'selected' : '' ?>>SC</option>
  <option value="SP" <?= (($_POST['estado'] ?? '') == 'SP') ? 'selected' : '' ?>>SP</option>
  <option value="SE" <?= (($_POST['estado'] ?? '') == 'SE') ? 'selected' : '' ?>>SE</option>
  <option value="TO" <?= (($_POST['estado'] ?? '') == 'TO') ? 'selected' : '' ?>>TO</option>
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
      
      <ul style="padding-left:14px; margin:0;">
        <li>Mínimo 8 caracteres</li>
        <li>Letra Minúscula</li>
      </ul>
      <ul style="padding-left:14px; margin:0;">
        <li>Letra Maiúscula</li>
        <li>Números</li>
      </ul>

    </div>
  </div>

</div>

<label style="margin-top:10px; font-size:12px;">
  <input type="checkbox" name="termos" required>
  Concordo com os 
<a href="#" class="link-termos" onclick="abrirModal(event)">
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

<!-- MÁSCARAS -->
<script>
document.addEventListener('DOMContentLoaded', function(){

  /* TELEFONE */
  const telefone = document.querySelector('input[name="telefone"]');
  if (telefone) {
    telefone.addEventListener('input', function(e){
      let v = e.target.value.replace(/\D/g,'').slice(0,11);

      if (v.length > 10) {
        v = v.replace(/^(\d{2})(\d{5})(\d{0,4})$/, '($1) $2-$3');
      } else {
        v = v.replace(/^(\d{2})(\d{4})(\d{0,4})$/, '($1) $2-$3');
      }

      e.target.value = v.trim();
    });
  }

  /* CPF */
  const cpf = document.querySelector('input[name="cpf"]');
  if (cpf) {
    cpf.addEventListener('input', function(e){
      let v = e.target.value.replace(/\D/g,'').slice(0,11);

      v = v.replace(/^(\d{3})(\d)/, '$1.$2');
      v = v.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
      v = v.replace(/\.(\d{3})(\d)/, '.$1-$2');

      e.target.value = v;
    });
  }

  /* CEP */
  const cep = document.querySelector('input[name="cep"]');
  if (cep) {
    cep.addEventListener('input', function(e){
      let v = e.target.value.replace(/\D/g,'').slice(0,8);
      v = v.replace(/^(\d{5})(\d)/, '$1-$2');
      e.target.value = v;
    });
  }

});
</script>

<!-- API VIA CEP -->
<script>
function limpa_formulario_cep() {
    document.getElementById('rua').value = "";
    document.getElementById('bairro').value = "";
    document.getElementById('cidade').value = "";
    document.getElementById('uf').value = "";
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        document.getElementById('rua').value = conteudo.logradouro;
        document.getElementById('bairro').value = conteudo.bairro;
        document.getElementById('cidade').value = conteudo.localidade;
        document.getElementById('uf').value = conteudo.uf;
    } else {
        limpa_formulario_cep();
        alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {
    var cep = valor.replace(/\D/g, '');

    if (cep !== "") {
        var validacep = /^[0-9]{8}$/;

        if (validacep.test(cep)) {

            document.getElementById('rua').value = "...";
            document.getElementById('bairro').value = "...";
            document.getElementById('cidade').value = "...";
            document.getElementById('uf').value = "...";

            var script = document.createElement('script');
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            document.body.appendChild(script);

        } else {
            limpa_formulario_cep();
            alert("CEP inválido");
        }
    } else {
        limpa_formulario_cep();
    }
}
</script>
<!-- MODAL TERMOS -->
<div id="modal-termos" class="modal-termos">
  <div class="modal-conteudo">

    <span class="fechar" onclick="fecharModal()">&times;</span>

    <h3>Termos e Condições</h3>

    <div class="termos-texto">

      <p>
        A Zooka coleta algumas informações para melhorar sua experiência no site.
      </p>

      <ul>
        <li>Seus dados são armazenados com segurança e não são vendidos</li>
        <li>Podem ser usados por parceiros apenas para entrega e pagamento</li>
        <li>Utilizamos cookies para personalizar conteúdos</li>
        <li>Você pode desativar cookies no navegador</li>
        <li>Você pode cancelar comunicações a qualquer momento</li>
      </ul>

      <p>
        A Zooka protege seus dados, mas é importante manter sua senha segura.
      </p>

      <p class="termos-final">
        Estes termos podem ser atualizados a qualquer momento.
      </p>

    </div>

  </div>
</div>
<script>
function abrirModal(e) {
  e.preventDefault();
  document.getElementById('modal-termos').style.display = 'block';
}

function fecharModal() {
  document.getElementById('modal-termos').style.display = 'none';
}

// fechar clicando fora
window.onclick = function(event) {
  const modal = document.getElementById('modal-termos');
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>
</html>