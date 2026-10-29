<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/conf.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/login.php');
    exit;
}

$email = strtolower(trim((string) ($_POST['email'] ?? '')));
$senha = (string) ($_POST['senha'] ?? '');
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $senha === '') {
    header('Location: ../pages/login.php?erro=1');
    exit;
}

$stmt = $pdo->prepare('SELECT id, nome, email, senha, perfil FROM usuarios WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$usuario || !password_verify($senha, $usuario['senha']) || !in_array($usuario['perfil'], ['admin', 'leitor'], true)) {
    header('Location: ../pages/login.php?erro=1');
    exit;
}

session_regenerate_id(true);
$_SESSION['usuario_id'] = (int) $usuario['id'];
$_SESSION['nome'] = $usuario['nome'];
$_SESSION['email'] = $usuario['email'];
$_SESSION['perfil'] = $usuario['perfil'];

header('Location: ' . ($usuario['perfil'] === 'admin' ? '../pages/home.php' : '../pages/catalogo_vendas.php'));
exit;
