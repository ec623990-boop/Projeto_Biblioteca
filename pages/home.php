<?php
session_start();

// Se não estiver logado, redireciona
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['nome'];
$email   = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Início - Biblioteca</title>

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

    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: .3s ease;
        text-align: center;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 18px rgba(0,0,0,0.15);
    }

    .card h3 {
        margin: 0;
        color: #274B73;
        font-size: 22px;
    }

    .card p {
        margin-top: 10px;
        font-size: 15px;
        color: #333;
    }

    .card a {
        display: inline-block;
        margin-top: 12px;
        padding: 10px 18px;
        background: #3A6EA5;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: .3s;
    }

    .card a:hover {
        background: #274B73;
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
    <a href="painel.php">📊 Painel</a>
    <a href="logout.php">🚪 Sair</a>
</div>

<!-- CONTEÚDO -->
<div class="content">

    <div class="topbar">
        <div>
            <strong>Bem-vindo, <?= $usuario ?> 👋</strong><br>
            <small><?= $email ?></small>
        </div>
    </div>

    <h2>📚 Bem-vindo(a) ao Sistema da Biblioteca</h2>
    <p>Aqui você encontra acesso rápido às principais funções do sistema.</p>

    <div class="cards">

        <div class="card">
            <h3>📘 Livros</h3>
            <p>Cadastre, edite e organize o acervo.</p>
            <a href="livros.php">Acessar</a>
        </div>

        <div class="card">
            <h3>👥 Usuários</h3>
            <p>Gerencie leitores cadastrados no sistema.</p>
            <a href="cadastro_usuario.php">Cadastrar</a>
        </div>

        <div class="card">
            <h3>📖 Empréstimos</h3>
            <p>Controle retiradas e devoluções.</p>
            <br>
            <a href="emprestimos.php">Gerenciar</a>
        </div>

        <div class="card">
            <h3>📂 Painel Geral</h3>
            <p>Veja um resumo completo do sistema.</p>
            <a href="painel.php">Abrir Painel</a>
        </div>

    </div>

</div>

</body>
</html>
