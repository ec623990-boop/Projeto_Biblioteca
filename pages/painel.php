<?php
// pages/painel.php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../pages/login.php");
    exit;
}
require_once __DIR__ . "/../config/conf.php"; // ajusta caminho se necessário

$totLivros = $pdo->query("SELECT COUNT(*) FROM livros")->fetchColumn();
$totUsuarios = $pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
$livrosDisponiveis = $pdo->query("SELECT COUNT(*) FROM livros WHERE (status IS NULL OR status = 'disponivel')")->fetchColumn();
$livrosEmprestados = $pdo->query("SELECT COUNT(*) FROM emprestimos WHERE status = 'emprestado'")->fetchColumn();
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Painel - Biblioteca</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
    body{font-family:Poppins,Arial;background:#eef3f7;margin:0;padding:30px;}
    .wrap{max-width:1200px;margin:0 auto}
    .top{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px}
    .card-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px}
    .card{background:#fff;padding:20px;border-radius:12px;box-shadow:0 6px 18px rgba(0,0,0,.06);display:flex;flex-direction:column;gap:8px}
    .card .num{font-size:32px;color:#244673;font-weight:700}
    .card .label{color:#666}
    .card .small{font-size:13px;color:#999}
    .panel-actions{display:flex;gap:8px}
    .btn{padding:8px 12px;border-radius:8px;background:#3A6EA5;color:#fff;text-decoration:none}
    .btn.secondary{background:#b34646}
</style>
</head>
<body>
<div class="wrap">
    <div class="top">
        <h1>Painel</h1>
        <div class="panel-actions">
            <a class="btn" href="home.php">Início</a>
            <a class="btn" href="livros.php">Acervo</a>
            <a class="btn" href="emprestimos.php">Empréstimos</a>
        </div>
    </div>

    <div class="card-grid">
        <div class="card">
            <div class="label">Livros cadastrados</div>
            <div class="num"><?= (int)$totLivros ?></div>
            <div class="small">Total de títulos no acervo</div>
        </div>

        <div class="card">
            <div class="label">Usuários</div>
            <div class="num"><?= (int)$totUsuarios ?></div>
            <div class="small">Contagem de usuários cadastrados</div>
        </div>

        <div class="card">
            <div class="label">Livros disponíveis</div>
            <div class="num"><?= (int)$livrosDisponiveis ?></div>
            <div class="small">Títulos que podem ser emprestados</div>
        </div>

        <div class="card">
            <div class="label">Livros emprestados</div>
            <div class="num"><?= (int)$livrosEmprestados ?></div>
            <div class="small">Quantidade atualmente emprestada</div>
        </div>
    </div>

    <!-- Você pode adicionar gráficos aqui (Charts) futuramente -->
</div>
</body>
</html>


