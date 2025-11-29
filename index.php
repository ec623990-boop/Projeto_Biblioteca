<?php
// index.php — Dashboard da Biblioteca
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Biblioteca</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
            background: #f0f4f8;
        }
        header {
            background: #3A6EA5;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 28px;
            font-weight: 700;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 0 20px;
        }
        .card {
            background: #fff;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card h2 {
            margin: 10px 0;
            font-size: 22px;
            color: #333;
        }
        .card a {
            text-decoration: none;
            color: #3A6EA5;
            font-weight: bold;
            font-size: 16px;
        }
        .icon {
            font-size: 45px;
            margin-bottom: 10px;
            color: #3A6EA5;
        }
    </style>
</head>
<body>

<header>📚 Dashboard da Biblioteca</header>

<div class="container">
    <div class="card">
        <div class="icon">📘</div>
        <h2>Livros</h2>
        <a href="livros.php">Acessar</a>
    </div>

    <div class="card">
        <div class="icon">👥</div>
        <h2>Usuários</h2>
        <a href="usuarios.php">Acessar</a>
    </div>

    <div class="card">
        <div class="icon">📖</div>
        <h2>Empréstimos</h2>
        <a href="emprestimos.php">Acessar</a>
    </div>

    <div class="card">
        <div class="icon">📅</div>
        <h2>Reservas</h2>
        <a href="reservas.php">Acessar</a>
    </div>

    <div class="card">
        <div class="icon">⚙️</div>
        <h2>Configurações</h2>
        <a href="configuracoes.php">Acessar</a>
    </div>
</div>

</body>
</html>