<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/conf.php";

// Buscar todos os livros
$stmt = $pdo->query("SELECT * FROM livros ORDER BY id DESC");
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros • Biblioteca</title>
    <link rel="stylesheet" href="../assets/style.css">

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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        table th {
            background: #244673;
            color: white;
            padding: 10px;
            text-align: left;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .btn {
            padding: 8px 14px;
            background: #244673;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.2s;
        }

        .btn:hover {
            background: #1d3a5c;
        }

        .actions a {
            margin-right: 8px;
        }

        .top-buttons {
            margin-bottom: 15px;
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
            <div class="top-buttons">
                <a href="cadastro_livro.php" class="btn">Cadastrar Novo Livro</a>
            </div>

            <h2>Lista de Livros</h2>

            <?php if (count($livros) === 0): ?>
                <p>Nenhum livro cadastrado.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Ano</th>
                            <th>Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($livros as $livro): ?>
                        <tr>
                            <td><?= $livro['id'] ?></td>
                            <td><?= htmlspecialchars($livro['titulo']) ?></td>
                            <td><?= htmlspecialchars($livro['autor']) ?></td>
                            <td><?= htmlspecialchars($livro['ano']) ?></td>
                            <td><?= htmlspecialchars($livro['categoria']) ?></td>
                            <td class="actions">
                                <a class="btn" href="editar_livro.php?id=<?= $livro['id'] ?>">Editar</a>
                                <a class="btn" style="background:#b32626"
                                   href="remover_livro.php?id=<?= $livro['id'] ?>"
                                   onclick="return confirm('Remover este livro?')">
                                   Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>


