<?php
// Sempre iniciar sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">

<link rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
.menu {
    width: 240px;
    height: 100vh;
    background: #1B6FA8;
    padding: 20px;
    position: fixed;
    left: 0;
    top: 0;
    color: white;
    font-family: Arial;
}
.menu h2 {
    margin-top: 0;
    text-align: center;
    font-size: 22px;
}
.menu a {
    display: block;
    padding: 12px;
    color: white;
    text-decoration: none;
    margin: 10px 0;
    background: rgba(255,255,255,0.15);
    border-radius: 6px;
    transition: 0.3s;
}
.menu a:hover {
    background: rgba(255,255,255,0.35);
}
.conteudo {
    margin-left: 260px;
    padding: 25px;
}
</style>

</head>
<body>

<div class="menu">

    <h2><i class="fa-solid fa-book"></i> Biblioteca</h2>

    <!-- Caminhos RELATIVOS a partir da pasta pages -->
    <a href="dashboard.php">
        <i class="fa-solid fa-house"></i> Dashboard
    </a>

    <a href="livros.php">
        <i class="fa-solid fa-book-bookmark"></i> Livros
    </a>

    <a href="cadastrar_livro.php">
        <i class="fa-solid fa-plus"></i> Cadastrar Livro
    </a>

    <a href="emprestimos.php">
        <i class="fa-solid fa-arrow-right-arrow-left"></i> Empréstimos
    </a>

    <a href="../actions/logout.php">
        <i class="fa-solid fa-right-from-bracket"></i> Sair
    </a>

</div>


