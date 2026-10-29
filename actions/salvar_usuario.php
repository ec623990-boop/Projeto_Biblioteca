<?php
require_once __DIR__ . '/../includes/auth.php';
exigir_admin();
require_once __DIR__ . '/../config/conf.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/cadastro_usuario.php');
    exit;
}

$nome = trim((string) ($_POST['nome'] ?? ''));
$email = strtolower(trim((string) ($_POST['email'] ?? '')));
$senha = (string) ($_POST['senha'] ?? '');
if ($nome === '' || mb_strlen($nome) > 120 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($senha) < 8) {
    header('Location: ../pages/cadastro_usuario.php?erro=dados');
    exit;
}

$check = $pdo->prepare('SELECT id FROM usuarios WHERE email = ? LIMIT 1');
$check->execute([$email]);
if ($check->fetchColumn()) {
    header('Location: ../pages/cadastro_usuario.php?erro=email');
    exit;
}

$hash = password_hash($senha, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, perfil) VALUES (?, ?, ?, 'admin')");
$stmt->execute([$nome, $email, $hash]);
header('Location: ../pages/cadastro_usuario.php?sucesso=1');
exit;
