<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function exigir_login(): void
{
    if (empty($_SESSION['email']) || empty($_SESSION['perfil'])) {
        header('Location: /pages/login.php');
        exit;
    }
}

function exigir_admin(): void
{
    exigir_login();
    if ($_SESSION['perfil'] !== 'admin') {
        header('Location: /pages/catalogo_vendas.php');
        exit;
    }
}

function exigir_leitor(): void
{
    exigir_login();
    if ($_SESSION['perfil'] !== 'leitor') {
        header('Location: /pages/home.php');
        exit;
    }
}

function h($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
