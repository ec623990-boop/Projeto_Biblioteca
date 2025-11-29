<?php
session_start();

// Se não estiver logado, volta para o login
if (!isset($_SESSION['usuario'])) {
    header("Location: /Biblioteca%20nova/login.php");
    exit;
}

require_once "conexao.php";

// Verificar se veio o ID do livro
if (!isset($_GET['id'])) {
    echo "Livro não encontrado.";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM livros WHERE id = $id";
$resultado = $Conexao->query($sql);

if ($resultado->num_rows == 0) {
    echo "Livro não encontrado.";
    exit;
}

$livro = $resultado->fetch_assoc();

// MENU
include "menu.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Livro</title>

<!-- Fonte moderna -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<!-- Ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body {
    font-family: "Poppins", sans-serif;
    background: #f4f7fa;
}

.conteudo {
    padding: 40px;
}

.card {
    background: white;
    padding: 40px;
    border-radius: 18px;
    max-width: 600px;
    margin: auto;
    box-shadow: 0px 5px 20px rgba(0,0,0,0.15);
}

h2 {
    text-align: center;
    font-size: 28px;
    margin-bottom: 25px;
    color: #333;
}

/* Campos */
label {
    font-weight: bold;
    color: #444;
    margin-bottom: 5px;
    display: block;
}

input {
    width: 100%;
    padding: 12px;
    margin-bottom: 18px;
    border: 2px solid #3498DB;
    border-radius: 10px;
    transition: .3s;
}

input:focus {
    border-color: #1B6FA8;
}

/* Botão */
button {
    width: 100%;
    padding: 14px;
    border: none;
    background: #3498DB;
    color: white;
    border-radius: 10px;
    font-weight: bold;
    font-size: 17px;
    cursor: pointer;
    transition: .3s;
}

button:hover {
    background: #1B6FA8;
}

.back {
    text-align: center;
    margin-top: 20px;
}

.back a {
    text-decoration: none;
    color: #1B6FA8;
    font-weight: bold;
}

</style>

</head>
<body>

<div class="conteudo">

<div class="card">

    <h2><i class="fa-solid fa-pen"></i> Editar Livro</h2>

    <form action="/Biblioteca%20nova/actions/editar_livro.php" method="POST">

        <input type="hidden" name="id" value="<?= $livro['id'] ?>">

        <label>Título do Livro</label>
        <input type="text" name="titulo" value="<?= $livro['titulo'] ?>" required>

        <label>Autor</label>
        <input type="text" name="autor" value="<?= $livro['autor'] ?>" required>

        <label>Categoria</label>
        <input type="text" name="categoria" value="<?= $livro['categoria'] ?>" required>

        <label>Ano</label>
        <input type="number" name="ano" value="<?= $livro['ano'] ?>" required>

        <label>Quantidade Disponível</label>
        <input type="number" name="quantidade" min="1" value="<?= $livro['quantidade'] ?>" required>

        <button type="submit">Salvar Alterações</button>

    </form>

    <div class="back">
        <a href="/Biblioteca%20nova/livros.php">← Voltar</a>
    </div>

</div>

</div>

</body>
</html>

