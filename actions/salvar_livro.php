<?php
require_once __DIR__ . '/../includes/auth.php';
exigir_admin();
require_once __DIR__ . '/../config/conf.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/livros.php');
    exit;
}

$titulo = trim((string) ($_POST['titulo'] ?? ''));
$autor = trim((string) ($_POST['autor'] ?? ''));
$anoTexto = trim((string) ($_POST['ano'] ?? ''));
$categoria = trim((string) ($_POST['categoria'] ?? ''));
$precoTexto = trim((string) ($_POST['preco'] ?? ''));
$ano = $anoTexto === '' ? null : filter_var($anoTexto, FILTER_VALIDATE_INT);
$preco = filter_var($precoTexto, FILTER_VALIDATE_FLOAT);
if ($titulo === '' || mb_strlen($titulo) > 200 || $autor === '' || mb_strlen($autor) > 160 || mb_strlen($categoria) > 120 || ($anoTexto !== '' && ($ano === false || $ano < 0 || $ano > 9999)) || $preco === false || $preco < 0) {
    header('Location: ../pages/cadastrar_livro.php?erro=dados');
    exit;
}

$stmt = $pdo->prepare('INSERT INTO livros (titulo, autor, ano, categoria, preco) VALUES (?, ?, ?, ?, ?)');
$stmt->execute([$titulo, $autor, $ano, $categoria === '' ? null : $categoria, $preco]);
header('Location: ../pages/livros.php?sucesso=1');
exit;
