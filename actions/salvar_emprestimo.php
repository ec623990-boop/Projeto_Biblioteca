<?php
require_once __DIR__ . '/../includes/auth.php';
exigir_admin();
require_once __DIR__ . '/../config/conf.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/emprestimos.php');
    exit;
}

$idLivro = filter_input(INPUT_POST, 'id_livro', FILTER_VALIDATE_INT);
$idUsuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);
if (!$idLivro || !$idUsuario) {
    header('Location: ../pages/emprestimos.php?erro=DadosInvalidos');
    exit;
}

try {
    $pdo->beginTransaction();
    $livro = $pdo->prepare('SELECT id FROM livros WHERE id = ? FOR UPDATE');
    $livro->execute([$idLivro]);
    $usuario = $pdo->prepare("SELECT id FROM usuarios WHERE id = ? AND perfil = 'leitor'");
    $usuario->execute([$idUsuario]);
    if (!$livro->fetchColumn() || !$usuario->fetchColumn()) {
        $pdo->rollBack();
        header('Location: ../pages/emprestimos.php?erro=DadosInvalidos');
        exit;
    }
    $insert = $pdo->prepare("INSERT INTO emprestimos (id_livro, id_usuario, data_emprestimo, status) VALUES (?, ?, CURRENT_DATE, 'emprestado')");
    $insert->execute([$idLivro, $idUsuario]);
    $pdo->prepare("UPDATE livros SET status = 'emprestado' WHERE id = ?")->execute([$idLivro]);
    $pdo->commit();
    header('Location: ../pages/emprestimos.php?sucesso=1');
} catch (Throwable $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log('Falha ao registrar empréstimo.');
    header('Location: ../pages/emprestimos.php?erro=1');
}
exit;
