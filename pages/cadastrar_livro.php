<?php
require_once __DIR__ . '/../includes/auth.php';
exigir_admin();
require_once __DIR__ . '/../config/conf.php';

$erro = $_GET['erro'] ?? '';
$mensagem = $erro === 'dados' ? 'Confira os dados e informe um preço válido.' : '';
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar livro • Biblioteca</title>
    <style>
        body{font-family:Arial,sans-serif;background:#f1f4f9;margin:0;color:#1f2937}.container{width:min(92%,760px);margin:32px auto}
        .card{background:#fff;padding:26px;border-radius:12px;box-shadow:0 4px 12px #0002}h1{color:#244673;margin-top:0}
        label{display:block;margin:14px 0 6px;font-weight:bold}input{box-sizing:border-box;width:100%;padding:10px;border:1px solid #c5ced8;border-radius:6px}
        .row{display:grid;grid-template-columns:1fr 1fr;gap:14px}.btn{display:inline-block;margin-top:18px;padding:10px 16px;background:#244673;color:white;border:0;border-radius:6px;text-decoration:none;cursor:pointer}
        .erro{color:#8d1717;background:#ffe3e3;padding:10px;border-radius:6px}@media(max-width:560px){.row{grid-template-columns:1fr}}
    </style>
</head>
<body><main class="container"><div class="card">
    <h1>Cadastrar livro</h1><p><a href="home.php">Início</a> · <a href="livros.php">Acervo</a></p>
    <?php if ($mensagem !== ''): ?><p class="erro"><?= h($mensagem) ?></p><?php endif; ?>
    <form action="../actions/salvar_livro.php" method="post">
        <label for="titulo">Título</label><input id="titulo" name="titulo" maxlength="200" required>
        <label for="autor">Autor</label><input id="autor" name="autor" maxlength="160" required>
        <div class="row"><div><label for="ano">Ano</label><input id="ano" type="number" name="ano" min="0" max="9999"></div>
        <div><label for="categoria">Categoria</label><input id="categoria" name="categoria" maxlength="120"></div></div>
        <label for="preco">Preço (R$)</label><input id="preco" type="number" name="preco" min="0" step="0.01" required>
        <button class="btn" type="submit">Salvar livro</button>
    </form>
</div></main></body></html>
