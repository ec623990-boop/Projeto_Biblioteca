<?php
require_once __DIR__ . '/../includes/auth.php';
exigir_admin();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/conf.php";

$mensagem = "";

// Cadastro
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome  = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    // Verificar se o email já existe
    $check = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        $mensagem = "❌ Este e-mail já está cadastrado!";
    } else {
        // Inserir usuário
        $sql = $pdo->prepare("
            INSERT INTO usuarios (nome, email, senha, perfil)
            VALUES (?, ?, ?, 'admin')
        ");

        if ($sql->execute([$nome, $email, $senha])) {
            $mensagem = "✔ Usuário cadastrado com sucesso!";
        } else {
            $mensagem = "❌ Erro ao salvar usuário.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastrar Usuário</title>

<style>
    body {
        background: #f1f4f9;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .container {
        width: 92%;
        margin: 30px auto;
    }

    .card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        margin-bottom: 25px;
    }

    h2 {
        color: #244673;
        margin-top: 0;
    }

    label {
        font-weight: bold;
        margin-top: 10px;
        display: block;
        color: #244673;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .btn {
        margin-top: 15px;
        padding: 12px 18px;
        background: #244673;
        color: white;
        border-radius: 6px;
        border: none;
        width: 100%;
        font-size: 16px;
        cursor: pointer;
    }

    .btn:hover {
        background: #1d3a5c;
    }

    .mensagem {
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 15px;
        font-weight: bold;
        text-align: center;
    }

    .erro {
        background: #ffdddd;
        color: #b30000;
        border: 1px solid #b30000;
    }

    .sucesso {
        background: #ddffdd;
        color: #1b8a3a;
        border: 1px solid #1b8a3a;
    }
</style>
</head>

<body>
<!-- 🔥 BOTÃO HOME -->
<a class="btn-home" href="/Bibioteca nova/pages/home.php" 
   style="
      display:inline-block;
      background:#244673;
      color:white;
      padding:10px 10px;
      border-radius:6px;
      text-decoration:none;
      margin:12px 2;
      font-weight:bold;
   ">
   🏠 Início
</a>    
<div class="container">

    <div class="card">

        <h2>Cadastro de Usuário</h2>

        <?php if ($mensagem != ""): ?>
            <div class="mensagem <?= str_contains($mensagem, '❌') ? 'erro' : 'sucesso' ?>">
                <?= $mensagem ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <label>Nome Completo:</label>
            <input type="text" name="nome" required>

            <label>E-mail:</label>
            <input type="email" name="email" required>

            <label>Senha:</label>
            <input type="password" name="senha" required minlength="4">

            <button class="btn" type="submit">Cadastrar Usuário</button>

        </form>

    </div>

</div>

</body>
</html>
