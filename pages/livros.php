<?php
require_once __DIR__ . '/../includes/auth.php';
exigir_admin();
require_once __DIR__ . '/../config/conf.php';

$stmt = $pdo->query('SELECT id, titulo, autor, ano, categoria, quantidade, preco FROM livros ORDER BY id DESC');
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="pt-BR">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Acervo • Biblioteca</title>
<style>
body{font-family:Arial,sans-serif;background:#eef2f7;margin:0;color:#1f2937}.container{width:min(96%,1100px);margin:30px auto}.card{background:#fff;padding:24px;border-radius:12px;box-shadow:0 4px 18px #0002}
h1{color:#244673}.btn{display:inline-block;padding:8px 12px;background:#244673;color:#fff;border-radius:6px;text-decoration:none;border:0;cursor:pointer}.del{background:#a52727}
table{width:100%;border-collapse:collapse;margin-top:18px}th,td{padding:10px;text-align:left;border-bottom:1px solid #ddd}th{background:#244673;color:#fff}.actions{white-space:nowrap}
@media(max-width:720px){.table-wrap{overflow-x:auto}table{min-width:700px}}
</style></head><body><main class="container"><section class="card">
<p><a href="home.php">Início</a> · <a class="btn" href="cadastrar_livro.php">Cadastrar livro</a></p><h1>Acervo de vendas</h1>
<?php if (!$livros): ?><p>Nenhum livro cadastrado.</p><?php else: ?><div class="table-wrap"><table><thead><tr><th>Título</th><th>Autor</th><th>Ano</th><th>Categoria</th><th>Preço</th><th>Ações</th></tr></thead><tbody>
<?php foreach ($livros as $livro): ?><tr>
<td><?= h($livro['titulo']) ?></td><td><?= h($livro['autor']) ?></td><td><?= h($livro['ano'] ?? '') ?></td><td><?= h($livro['categoria'] ?? '') ?></td>
<td><?= $livro['preco'] === null ? 'Sob consulta' : 'R$ ' . number_format((float) $livro['preco'], 2, ',', '.') ?></td>
<td class="actions"><a class="btn" href="../actions/editar_livro.php?id=<?= (int) $livro['id'] ?>">Editar</a>
<a class="btn del" href="../actions/deletar_livro.php?id=<?= (int) $livro['id'] ?>" onclick="return confirm('Excluir este livro?')">Excluir</a></td></tr><?php endforeach; ?>
</tbody></table></div><?php endif; ?></section></main></body></html>
