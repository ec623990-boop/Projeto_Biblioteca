<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/conf.php";

// Se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $ano = $_POST["ano"];
    $categoria = $_POST["categoria"];

    $sql = $pdo->prepare("INSERT INTO livros (titulo, autor, ano, categoria) VALUES (?, ?, ?, ?)");
    $sql->execute([$titulo, $autor, $ano, $categoria]);

    header("Location: livros.php?sucesso=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f4f9;
            margin: 0;
        }

        .container {
            width: 90%;
            margin: 30px auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            color: #244673;
        }

        label {
            font-weight: bold;
            color: #244673;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .btn {
            padding: 10px 16px;
            background: #244673;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn:hover {
            background: #1d3a5c;
        }

        .back-btn {
            background: #777;
        }

        .back-btn:hover {
            background: #555;
        }
    </style>
</head>

<body>
<!-- 🔥 BOTÃO HOME -->
<a class="btn-home" href="/Bibioteca nova/pages/home.php" 
   style="
      display:inline-block;
      background:#244673;
      color:white;
      padding:10px 10px;
      border-radius:6px;
      text-decoration:none;
      margin:12px 2;
      font-weight:bold;
   ">
   🏠 Início
</a>

<div class="container">
    <div class="card">

        <h2>Cadastrar Novo Livro</h2>

        <form method="POST">

            <label>Título</label>
            <input type="text" name="titulo" required>

            <label>Autor</label>
            <input type="text" name="autor" required>

            <label>Ano</label>
            <input type="number" name="ano" min="1500" max="2099" required>

            <label>Categoria</label>
            <input type="text" name="categoria" required>

            <button type="submit" class="btn">Salvar</button>
            <a href="livros.php" class="btn back-btn">Voltar</a>

        </form>

    </div>
</div>

</body>
</html>



