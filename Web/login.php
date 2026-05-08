<?php
session_start();
if (!isset($_POST['enviar_codigo']) &&
    !isset($_POST['validar_codigo']) &&
    !isset($_POST['trocar_senha']) &&
    !isset($_POST['reenviar_codigo'])) {
 
    $_SESSION['etapa'] = 1;
    unset($_SESSION['recuperacao']);
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require_once "../php/conexao.php";
$pdo = conectar();
 
$erro = "";
 
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    !isset($_POST['enviar_codigo']) &&
    !isset($_POST['validar_codigo']) &&
    !isset($_POST['trocar_senha']) &&
    !isset($_POST['reenviar_codigo'])
) {
 
    $usuario = $_POST['login'] ?? '';
    $senha   = $_POST['senha'] ?? '';
 
$stmt = $pdo->prepare("
    SELECT 
        l.*,
        c.nome
    FROM loginweb l

    LEFT JOIN clienteweb c
        ON c.id_login = l.id

    WHERE l.usuario = ?
       OR c.email = ?
       OR c.cpf = ?
");
$stmt->execute([$usuario, $usuario, $usuario]);
 
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if ($user && password_verify($senha, $user['senha'])) {
 
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nome'] = $user['usuario'];
        $_SESSION['usuario_nome_real'] = $user['nome'];
 
        header("Location: index.php");
        exit;
 
    } else {
        $erro = "Login inválido!";
    }
}
if (isset($_POST['enviar_codigo'])) {
 
    $usuario = trim($_POST['recuperar_usuario'] ?? '');

    // remove máscara do cpf
    $cpfLimpo = preg_replace('/\D/', '', $usuario);

    $stmt = $pdo->prepare("
        SELECT loginweb.*, clienteweb.email
        FROM clienteweb
        INNER JOIN loginweb
            ON clienteweb.id_login = loginweb.id
        WHERE clienteweb.cpf = ?
           OR clienteweb.email = ?
    ");

    $stmt->execute([$cpfLimpo, $usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
if (!$user) {
    $msg_recuperar = "Usuário não encontrado!";
    $_SESSION['etapa'] = 1; // FICA NA ETAPA 1
} else {
 
    $codigo = random_int(100000, 999999);
 
        $_SESSION['recuperacao'] = [
            'usuario_id' => $user['id'],
            'codigo' => $codigo,
            'expira' => time() + 180
        ];
 
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/PHPMailer/src/Exception.php';
 
$mail = new PHPMailer(true);
 
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ZookaPetshop@gmail.com';
    $mail->Password = 'juky tzsz dshp oncx';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';
 
    $mail->setFrom('ZookaPetshop@gmail.com', 'Zooka Petshop');
    $mail->addAddress($user['email']);
 
    $mail->isHTML(true);
    $mail->Subject = 'Código de recuperação';
 
    $mail->Body = '

<html>

<head>

<meta charset="UTF-8">

<style>

body{
    background:#f4f4f4;
    padding:30px;
    font-family:Arial,sans-serif;
}

.container{
    max-width:600px;
    margin:auto;
    background:white;
    border-radius:16px;
    overflow:hidden;
}

.topo{
    padding:0;
    text-align:center;
    line-height:0;
    background:none;
}

.topo img{
    width:100%;
    max-width:600px;
    display:block;
}

.conteudo{
    padding:40px;
    text-align:center;
}

.titulo{
    font-size:28px;
    font-weight:bold;
    color:#333;
    margin-bottom:20px;
}

.texto{
    color:#666;
    font-size:15px;
    line-height:1.6;
    margin-bottom:30px;
}

.codigo{
    background:#f2fcfc;
    border:2px dashed #2eaeb0;
    color:#176668;

    font-size:40px;
    font-weight:bold;

    padding:20px 30px;
    border-radius:12px;

    letter-spacing:8px;

    display:inline-block;
}

.aviso{
    margin-top:25px;
    color:#999;
    font-size:13px;
}

.footer{
    background:#fafafa;
    padding:20px;
    text-align:center;
    color:#999;
    font-size:12px;
}

</style>

</head>

<body>

<div class="container">

    <div class="topo">

        <img src="https://i.imgur.com/xwFq8GA.png">

    </div>

    <div class="conteudo">

        <div class="titulo">
            Recuperação de senha
        </div>

        <div class="texto">
            Utilize o código abaixo para redefinir sua senha.
        </div>

        <div class="codigo">
            '.$codigo.'
        </div>


    </div>

    <div class="footer">
        © 2026 Zooka Petshop
    </div>

</div>

</body>

</html>

';
$mail->AltBody = "Seu código é: $codigo";
 
    $mail->send();
 
} catch (Exception $e) {
    echo "ERRO REAL: " . $mail->ErrorInfo;
    exit;
}
 
$_SESSION['etapa'] = 2;
$etapa = 2;
$msg_recuperar = "Código enviado!";
 
    } // fecha if (!$user)
} // fecha if (isset enviar_codigo)
 
if (isset($_POST['validar_codigo'])) {
 
    $codigo = $_POST['codigo'] ?? '';
 
    if (!isset($_SESSION['recuperacao'])) {
        $msg_recuperar = "Sessão expirada!";
    }
    elseif (time() > $_SESSION['recuperacao']['expira']) {
        $msg_recuperar = "Código expirado!";
    }
    elseif ($codigo != $_SESSION['recuperacao']['codigo']) {
        $msg_recuperar = "Código incorreto!";
    }
    else {
        $_SESSION['etapa'] = 3;
        $etapa = 3;
 
        $msg_recuperar = "Código validado!";
    }
}
 
if (isset($_POST['trocar_senha'])) {
 
    if (!isset($_SESSION['recuperacao'])) {
        $msg_recuperar = "Sessão inválida!";
    } else {
 
        $nova = $_POST['nova_senha'] ?? '';
        $confirma = $_POST['confirmar_senha'] ?? '';
 
        if (empty($nova)) {
            $msg_recuperar = "Digite a nova senha!";
        }
        elseif ($nova !== $confirma) {
            $msg_recuperar = "As senhas não coincidem!";
        }
        else {
 
            $hash = password_hash($nova, PASSWORD_DEFAULT);
            $id = $_SESSION['recuperacao']['usuario_id'];
 
            $stmt = $pdo->prepare("UPDATE loginweb SET senha = ? WHERE id = ?");
            $stmt->execute([$hash, $id]);
 
unset($_SESSION['recuperacao']);
unset($_SESSION['etapa']);

$_SESSION['sucesso'] = "Senha redefinida com sucesso! Faça login.";

echo "
<script>

sessionStorage.removeItem('modalRecuperar');

window.location.href='login.php';

</script>
";

exit;
        }
    }
}
 
if (($_POST['acao'] ?? '') === 'reenviar') {
 
    if (isset($_SESSION['recuperacao'])) {
 
        $codigo = random_int(100000, 999999);
 
        $_SESSION['recuperacao']['codigo'] = $codigo;
        $_SESSION['recuperacao']['expira'] = time() + 180;
 
        // 🔥 BUSCAR EMAIL DE NOVO
        $id = $_SESSION['recuperacao']['usuario_id'];
 
        $stmt = $pdo->prepare("
            SELECT clienteweb.email
            FROM clienteweb
            WHERE id_login = ?
        ");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
        if ($user) {
 
            require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
            require_once __DIR__ . '/PHPMailer/src/SMTP.php';
            require_once __DIR__ . '/PHPMailer/src/Exception.php';
 
            $mail = new PHPMailer(true);
 
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'ZookaPetshop@gmail.com';
                $mail->Password = 'juky tzsz dshp oncx';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->CharSet = 'UTF-8';
 
                $mail->setFrom('ZookaPetshop@gmail.com', 'Zooka Petshop');
                $mail->addAddress($user['email']);
 
                $mail->isHTML(true);
                $mail->Subject = 'Novo código de recuperação';
 
                $mail->isHTML(true);
$mail->Subject = 'Novo código de recuperação';

$mail->Body = '

<html>

<head>

<meta charset="UTF-8">

<style>

body{
    background:#f4f4f4;
    padding:30px;
    font-family:Arial,sans-serif;
}

.container{
    max-width:600px;
    margin:auto;
    background:white;
    border-radius:16px;
    overflow:hidden;
}

.topo{
    padding:0;
    text-align:center;
    line-height:0;
    background:none;
}

.topo img{
    width:100%;
    max-width:600px;
    display:block;
}

.conteudo{
    padding:40px;
    text-align:center;
}

.titulo{
    font-size:28px;
    font-weight:bold;
    color:#333;
    margin-bottom:20px;
}

.texto{
    color:#666;
    font-size:15px;
    line-height:1.6;
    margin-bottom:30px;
}

.codigo{
    background:#f2fcfc;
    border:2px dashed #2eaeb0;
    color:#176668;

    font-size:40px;
    font-weight:bold;

    padding:20px 30px;
    border-radius:12px;

    letter-spacing:8px;

    display:inline-block;
}

.aviso{
    margin-top:25px;
    color:#999;
    font-size:13px;
}

.footer{
    background:#fafafa;
    padding:20px;
    text-align:center;
    color:#999;
    font-size:12px;
}

</style>

</head>

<body>

<div class="container">

    <div class="topo">

        <img src="https://i.imgur.com/xwFq8GA.png">

    </div>

    <div class="conteudo">

        <div class="titulo">
            Novo código de recuperação
        </div>

        <div class="texto">
            Utilize o código abaixo para continuar a redefinição da sua senha.
        </div>

        <div class="codigo">
            '.$codigo.'
        </div>


    </div>

    <div class="footer">
        © 2026 Zooka Petshop
    </div>

</div>

</body>

</html>

';

$mail->AltBody = "Seu novo código é: $codigo";
 
                $mail->send();
 
                $msg_recuperar = "Novo código enviado para o e-mail!";
 
            } catch (Exception $e) {
                $msg_recuperar = "Erro ao reenviar e-mail: " . $mail->ErrorInfo;
            }
 
        } else {
            $msg_recuperar = "Erro ao encontrar e-mail do usuário!";
        }
    }
}
$etapa = $_SESSION['etapa'] ?? 1;
 
if (!isset($_SESSION['recuperacao'])) {
    $etapa = 1;
}
 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Zooka</title>
    <link rel="stylesheet" href="css/stylelogin.css">
</head>
<body>
 
   <header class="main-header">
    <div class="header-top">
       
        <div class="logo-container">
            <a href="index.php" class="logo">
                <img src="Assets/logo.png" class="banner-topo" alt="Zooka">
            </a>
        </div>
 
        <div class="ambiente-container">
            <div class="ambiente">
                <span class="texto-ambiente">|</span>
                <img src="Assets/ambiente.png" class="banner-seguro" alt="Ambiente Seguro">
                <span class="texto-ambiente">Ambiente Seguro</span>
            </div>
        </div>    
 
    </div>
</header>
 
<main class="login-container">
  <h2>Acessar ou criar conta</h2>
 
  <div class="login-wrapper">
 
    <!-- Bloco Acesse sua conta -->
    <section class="login-access">
      <h3>Acesse sua conta</h3>
      <?php if(isset($_SESSION['sucesso'])): ?>
    <p class="msg-sucesso">
      <?php echo $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
    </p>
  <?php endif; ?>
      <form method="POST">
        <label for="email">Usuário, CPF ou E-mail</label>
        <input type="text" id="email" name="login" placeholder="Digite seu usuário ou CPF/E-mail">
        <label for="senha">Senha</label>
        <div class="senha-wrapper">
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha">
        </div>
 
        <a href="#" class="forgot-password" onclick="abrirModalRecuperar(event)">
  Esqueci a senha
</a>
<?php if($erro): ?>
    <p class="msg-erro"><?php echo $erro; ?></p>
<?php endif; ?>
        <button type="submit" class="btn-login">ENTRAR</button>
      </form>
    </section>
    <!-- Bloco Criar conta -->
    <section class="login-create">
      <h3>Criar uma conta é rápido, fácil e gratuito!</h3>
      <p>Com a sua conta da Zooka você tem acesso a Ofertas exclusivas, acompanhar os seus pedidos e muito mais!</p>
      <button class="btn-create-account" onclick="window.location.href='cadastro.php'">Criar minha conta</button>
    </section>
 
  </div>
</header>
 
<footer class="main-footer">
    <p>Copyright© 2026 Zooka Petshop e Clínica Veterinária S/A<br>
    Todos os direitos reservados</p>
</footer>
<div id="modal-recuperar" class="modal-termos">
  <div class="modal-conteudo modal-recuperacao">
 
    <span class="fechar" onclick="fecharModalRecuperar()">&times;</span>
 
    <h3>Recuperar senha</h3>
 
    <form method="POST">
 <?php if(isset($msg_recuperar)): ?>
    <p class="msg-erro">
        <?= $msg_recuperar ?>
    </p>
<?php endif; ?>

<?php if ($etapa == 1): ?>

  <input type="text"
       id="recuperar_usuario"
       name="recuperar_usuario"
       placeholder="CPF ou e-mail">

  <button type="submit" name="enviar_codigo">
    Enviar código
  </button>

<?php elseif ($etapa == 2): ?>

  <div class="codigo-box">

    <input type="text"
           name="codigo"
           placeholder="Digite o código enviado"
           maxlength="6">

    <button type="submit"
            name="validar_codigo"
            class="btn-validar">

      Validar código

    </button>

<a href="#"
   class="btn-reenviar"
   onclick="event.preventDefault(); this.closest('form').querySelector('[name=acao]').value='reenviar'; this.closest('form').submit();">

   Reenviar código

</a>

<input type="hidden" name="acao" value="">
  </div>

<?php elseif ($etapa == 3): ?>

  <input type="password"
         name="nova_senha"
         placeholder="Nova senha">

  <input type="password"
         name="confirmar_senha"
         placeholder="Confirmar senha">

  <button type="submit"
          name="trocar_senha">

    Redefinir senha

  </button>

<?php endif; ?>
 
</form>
 
  </div>
</div>
<script>
function abrirModalRecuperar(e) {
  e.preventDefault();
  document.getElementById('modal-recuperar').style.display = 'block';
 
  // mantém sua lógica
  sessionStorage.setItem('modalRecuperar', '1');
}
 
function fecharModalRecuperar() {
  document.getElementById('modal-recuperar').style.display = 'none';
  sessionStorage.removeItem('modalRecuperar');
}
 
window.addEventListener('DOMContentLoaded', () => {
  const etapa = <?= json_encode($_SESSION['etapa'] ?? 1) ?>;
  const abriuManual = sessionStorage.getItem('modalRecuperar');
 
  // se estiver em etapa de recuperação OU abriu manual
  if (etapa > 1 || abriuManual === '1') {
    document.getElementById('modal-recuperar').style.display = 'block';
  }
});
</script>
</body>
</html>
<script>

document.addEventListener('input', function(e){

  if(e.target.id === 'recuperar_usuario'){

    let valor = e.target.value;

    // se tiver letra ou @ => email
    if(/[a-zA-Z@]/.test(valor)){
      return;
    }

    valor = valor.replace(/\D/g,'').slice(0,11);

    valor = valor.replace(/^(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
    valor = valor.replace(/\.(\d{3})(\d)/, '.$1-$2');

    e.target.value = valor;
  }

});

</script>

</body>
</html>