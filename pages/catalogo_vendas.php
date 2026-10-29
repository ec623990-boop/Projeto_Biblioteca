<?php
require_once __DIR__ . '/../includes/auth.php';
exigir_leitor();
require_once __DIR__ . '/../config/conf.php';

$stmt = $pdo->query('SELECT id, titulo, autor, ano, categoria, preco FROM livros ORDER BY titulo ASC');
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
$nome = $_SESSION['nome'] ?? 'Leitor';
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catálogo de vendas • Biblioteca</title>
    <style>
        :root{color-scheme:light;--azul:#244673;--fundo:#f1f4f9}*{box-sizing:border-box}
        body{margin:0;font-family:Arial,sans-serif;background:var(--fundo);color:#1f2937}
        header{background:var(--azul);color:#fff;padding:20px 5%;display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
        header h1{font-size:1.35rem;margin:0}header a{color:#fff}
        main{max-width:1120px;margin:32px auto;padding:0 20px}.intro{margin-bottom:22px}
        .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:18px}
        .card{background:#fff;border-radius:12px;padding:20px;box-shadow:0 3px 12px #00000012;display:flex;flex-direction:column;min-height:190px}
        .card h2{font-size:1.15rem;color:var(--azul);margin:0 0 8px}.meta{color:#5c6673;margin:3px 0}
        .price{font-size:1.15rem;font-weight:700;margin-top:auto;padding-top:18px;color:#17633a}
        .empty{background:#fff;padding:20px;border-radius:10px}
    </style>
</head>
<body>
<header>
    <h1>Catálogo de vendas</h1>
    <div>Olá, <?= h($nome) ?> · <a href="logout.php">Sair</a></div>
</header>
<main>
    <p class="intro">Consulte os livros disponíveis no catálogo. Esta área é somente para consulta; não há compra online.</p>
    <?php if (!$livros): ?>
        <p class="empty">Nenhum livro cadastrado no momento.</p>
    <?php else: ?>
        <section class="grid" aria-label="Livros à venda">
            <?php foreach ($livros as $livro): ?>
                <article class="card">
                    <h2><?= h($livro['titulo']) ?></h2>
                    <p class="meta">Autor: <?= h($livro['autor']) ?></p>
                    <?php if (!empty($livro['categoria'])): ?><p class="meta">Categoria: <?= h($livro['categoria']) ?></p><?php endif; ?>
                    <?php if (!empty($livro['ano'])): ?><p class="meta">Ano: <?= h($livro['ano']) ?></p><?php endif; ?>
                    <p class="price"><?php if ($livro['preco'] !== null): ?>R$ <?= number_format((float) $livro['preco'], 2, ',', '.') ?><?php else: ?>Preço sob consulta<?php endif; ?></p>
                </article>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
</main>
</body>
</html>
