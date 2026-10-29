<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/conf.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/cadastro_leitor.php');
    exit;
}

$nome = trim((string) ($_POST['nome'] ?? ''));
$email = strtolower(trim((string) ($_POST['email'] ?? '')));
$senha = (string) ($_POST['senha'] ?? '');

if ($nome === '' || mb_strlen($nome) > 120 || !filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 190 || strlen($senha) < 8) {
    header('Location: ../pages/cadastro_leitor.php?erro=dados');
    exit;
}

try {
    $consulta = $pdo->prepare('SELECT id FROM usuarios WHERE email = ? LIMIT 1');
    $consulta->execute([$email]);
    if ($consulta->fetchColumn()) {
        header('Location: ../pages/cadastro_leitor.php?erro=email');
        exit;
    }

    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $inserir = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, perfil) VALUES (?, ?, ?, 'leitor')");
    $inserir->execute([$nome, $email, $hash]);

    session_regenerate_id(true);
    $_SESSION['usuario_id'] = (int) $pdo->lastInsertId();
    $_SESSION['nome'] = $nome;
    $_SESSION['email'] = $email;
    $_SESSION['perfil'] = 'leitor';
    header('Location: ../pages/catalogo_vendas.php');
    exit;
} catch (PDOException $e) {
    error_log('Falha ao criar conta de leitor.');
    header('Location: ../pages/cadastro_leitor.php?erro=servidor');
    exit;
}
