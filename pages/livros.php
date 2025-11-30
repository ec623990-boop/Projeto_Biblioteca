<?php 
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// -----------------------------------------------------------
//  CONEXÃO PDO
// -----------------------------------------------------------
require_once "../config/conf.php";

try {
    $stmt = $pdo->query("SELECT * FROM livros ORDER BY id DESC");
    $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Erro ao buscar livros: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros • Biblioteca</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f7;
            margin: 0;
        }

        .btn-home {
            display: inline-block;
            background: #244673;
            color: white;
            padding: 10px 10px;
            border-radius: 6px;
            text-decoration: none;
            margin: 12px 12px;
            font-weight: bold;
        }

        .container {
            width: 90%;
            margin: 30px auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.10);
        }

        h2 {
            margin-top: 0;
            color: #244673;
            font-size: 26px;
            font-weight: bold;
            border-left: 6px solid #244673;
            padding-left: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        table th {
            background: #244673;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 15px;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            background: #fafafa;
        }

        .btn {
            padding: 8px 14px;
            background: #244673;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.2s;
            font-size: 14px;
        }

        .btn:hover {
            background: #1d3a5c;
        }

        .btn-danger {
            background: #b32626;
        }

        .btn-danger:hover {
            background: #8a1d1d;
        }

        .actions a {
            margin-right: 8px;
        }

    </style>
</head>

<body>

<!-- 🔥 BOTÃO HOME -->
<a class="btn-home" href="../pages/home.php">🏠 Início</a>

<div class="container">
    <div class="card">

        <a href="cadastrar_livro.php" class="btn">Cadastrar Novo Livro</a>
        <br><br>

        <h2>Lista de Livros</h2>

        <?php if (empty($livros)): ?>
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

                            <!-- 🔧 EDITAR -->
                            <a class="btn" 
                               href="../actions/editar_livro.php?id=<?= $livro['id'] ?>">
                                Editar
                            </a>

                            <!-- ❌ EXCLUIR (OPÇÃO 2) -->
                            <a class="btn btn-danger"
                               href="../actions/deletar_livro.php?id=<?= $livro['id'] ?>"
                               onclick="return confirm('Tem certeza que deseja excluir este livro?')">
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



