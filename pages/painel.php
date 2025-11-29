<?php
session_start();
require_once __DIR__ . "/../config/conf.php";

// Se não estiver logado, redireciona
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$usuarioLogado = $_SESSION['nome'];
$emailLogado   = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<title>Painel - Sistema Biblioteca</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    body {
        margin: 0;
        font-family: "Poppins", sans-serif;
        background: #f5f6fa;
        display: flex;
    }

    /* MENU LATERAL */
    .sidebar {
        width: 240px;
        background: #274B73;
        color: white;
        height: 100vh;
        position: fixed;
        padding-top: 30px;
        box-shadow: 2px 0 8px rgba(0,0,0,0.15);
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 22px;
    }

    .sidebar a {
        display: block;
        padding: 15px 20px;
        text-decoration: none;
        color: white;
        font-size: 16px;
        transition: .3s;
    }

    .sidebar a:hover {
        background: rgba(255,255,255,0.15);
    }

    /* CONTEÚDO */
    .content {
        margin-left: 240px;
        padding: 25px;
        width: calc(100% - 240px);
    }

    .topbar {
        background: #3A6EA5;
        padding: 15px 22px;
        border-radius: 10px;
        margin-bottom: 25px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .card-box {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: .3s;
        text-align: center;
        cursor: pointer;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card h3 {
        margin: 0;
        color: #274B73;
        font-size: 22px;
    }

    .card p {
        margin-top: 10px;
        color: #444;
        font-size: 16px;
    }
</style>
</head>

<body>

<!-- MENU LATERAL -->
<div class="sidebar">
    <h2>Biblioteca</h2>

    <a href="home.php">🏠 Início</a>
    <a href="cadastro_usuario.php">👤 Usuários</a>
    <a href="cadastrar_livro.php">📚 Cadastrar Livro</a>
    <a href="livros.php">📖 Acervo de Livros</a>
    <a href="emprestimos.php">🔄 Empréstimos</a>
    <a href="logout.php">🚪 Sair</a>
</div>

<!-- CONTEÚDO PRINCIPAL -->
<div class="content">

    <div class="topbar">
        <div>
            <strong>Bem-vindo, <?= $usuarioLogado ?> 👋</strong><br>
            <small><?= $emailLogado ?></small>
        </div>
        <a href="logout.php" style="color:white; text-decoration:none; font-weight:bold;">Sair</a>
    </div>

    <h2>📌 Visão Geral</h2>

    <div class="card-box">

        <div class="card" onclick="window.location='cadastro_usuario.php'">
            <h3>Usuários</h3>
            <p>Gerencie leitores e funcionários.</p>
        </div>

        <div class="card" onclick="window.location='cadastrar_livro.php'">
            <h3>Livros</h3>
            <p>Cadastre, edite e visualize o acervo.</p>
        </div>

        <div class="card" onclick="window.location='emprestimos.php'">
            <h3>Empréstimos</h3>
            <p>Controle entradas e devoluções.</p>
        </div>

    </div>

</div>

</body>
</html>


