<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/conf.php';

$erro = $_GET['erro'] ?? '';
$mensagens = [
    'email' => 'Este e-mail já está cadastrado.',
    'dados' => 'Confira os dados e use uma senha com pelo menos 8 caracteres.',
    'servidor' => 'Não foi possível criar a conta agora. Tente novamente mais tarde.',
];
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar conta de leitor • Biblioteca</title>
    <style>
        body{font-family:Arial,sans-serif;background:#f1f4f9;margin:0;min-height:100vh;display:grid;place-items:center}
        main{width:min(92%,440px);background:#fff;padding:28px;border-radius:14px;box-shadow:0 5px 20px #0002}
        h1{color:#244673;font-size:1.6rem;margin-top:0}label{display:block;margin:14px 0 6px;font-weight:600}
        input{box-sizing:border-box;width:100%;padding:11px;border:1px solid #bbc6d3;border-radius:7px;font-size:1rem}
        button,a.botao{display:inline-block;margin-top:18px;padding:11px 16px;background:#244673;color:#fff;border:0;border-radius:7px;text-decoration:none;font-weight:600;cursor:pointer}
        .erro{padding:10px;background:#ffe3e3;color:#8d1717;border-radius:7px}.ajuda{color:#52606d;line-height:1.5}
    </style>
</head>
<body>
<main>
    <h1>Criar conta de leitor</h1>
    <p class="ajuda">A conta de leitor dá acesso somente ao catálogo de vendas.</p>
    <?php if (isset($mensagens[$erro])): ?><p class="erro"><?= h($mensagens[$erro]) ?></p><?php endif; ?>
    <form action="../actions/cadastrar_leitor.php" method="post">
        <label for="nome">Nome</label>
        <input id="nome" name="nome" type="text" maxlength="120" autocomplete="name" required>
        <label for="email">E-mail</label>
        <input id="email" name="email" type="email" maxlength="190" autocomplete="email" required>
        <label for="senha">Senha</label>
        <input id="senha" name="senha" type="password" minlength="8" autocomplete="new-password" required>
        <button type="submit">Criar conta</button>
    </form>
    <a class="botao" href="login.php">Voltar ao login</a>
</main>
</body>
</html>
