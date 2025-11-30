<?php
session_start();

// Se não estiver logado, redireciona
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit;
}

// Carrega a conexão PDO corretamente
require_once __DIR__ . "/../config/conf.php";

// Verifica se a variável $pdo foi criada
if (!isset($pdo)) {
    die("❌ ERRO FATAL: a conexão PDO não foi criada pelo conf.php");
}

// ---------------------------------------------------------
//  REGISTRAR EMPRÉSTIMO
// ---------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_livro"], $_POST["id_usuario"])) {

    $idLivro = intval($_POST["id_livro"]);
    $idUsuario = intval($_POST["id_usuario"]);
    $dataEmprestimo = date("Y-m-d");
    $status = "emprestado";

    try {
        // Registrar empréstimo
        $sql = $pdo->prepare("
            INSERT INTO emprestimos (id_livro, id_usuario, data_emprestimo, status)
            VALUES (?, ?, ?, ?)
        ");
        $sql->execute([$idLivro, $idUsuario, $dataEmprestimo, $status]);

        // Atualizar status do livro
        $pdo->prepare("UPDATE livros SET status = 'emprestado' WHERE id = ?")
            ->execute([$idLivro]);

        header("Location: emprestimos.php?sucesso=1");
        exit;

    } catch (PDOException $e) {
        die("Erro ao registrar empréstimo: " . $e->getMessage());
    }
}

// ---------------------------------------------------------
//  BUSCAR LISTA DE LIVROS DISPONÍVEIS
// ---------------------------------------------------------
$livros = $pdo->query("
    SELECT * FROM livros
    WHERE status IS NULL OR status = 'disponivel'
    ORDER BY titulo ASC
");

// ---------------------------------------------------------
//  BUSCAR LISTA DE USUÁRIOS
// ---------------------------------------------------------
$usuarios = $pdo->query("
    SELECT id, nome FROM usuarios ORDER BY nome ASC
");

// ---------------------------------------------------------
//  BUSCAR LISTA DE EMPRÉSTIMOS
// ---------------------------------------------------------
$listaEmprestimos = $pdo->query("
    SELECT e.*, 
           l.titulo AS livro, 
           u.nome AS usuario
    FROM emprestimos e
    JOIN livros l ON e.id_livro = l.id
    JOIN usuarios u ON e.id_usuario = u.id
    ORDER BY e.id DESC
");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Empréstimos</title>

    <style>
        body {
            background: #f1f4f9;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* BOTÃO HOME FIXO */
        .btn-home {
            position: fixed;
            top: 20px;
            left: 20px;
            padding: 12px 20px;
            background: #244673;
            color: white;
            font-weight: bold;
            text-decoration: none;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.3);
        }
        

        .btn-home:hover {
            background: #1d3a5c;
        }

        .container {
            width: 92%;
            margin: 60px auto;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }

        h2 {
            color: #244673;
            margin-top: 0;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #244673;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 14px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #244673;
            color: white;
        }

        .btn {
            margin-top: 15px;
            padding: 10px 18px;
            background: #244673;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #1d3a5c;
        }

        .status-emp {
            background: #d9534f;
            padding: 6px 10px;
            border-radius: 6px;
            color: white;
            font-size: 13px;
        }

        .status-dev {
            background: #5cb85c;
            padding: 6px 10px;
            border-radius: 6px;
            color: white;
            font-size: 13px;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-weight: bold;
            color: #888;
        }
    </style>
</head>

<body>

<!-- BOTÃO HOME -->
<a class="btn-home" href="/Bibioteca nova/pages/home.php">🏠 Início</a>

<div class="container">

    <!-- FORMULÁRIO DE EMPRÉSTIMO -->
    <div class="card">
        <h2>Registrar Empréstimo</h2>

        <?php if ($livros->rowCount() == 0): ?>
            <p class="no-data">Nenhum livro disponível para empréstimo.</p>
        <?php else: ?>

        <form method="POST">

            <label>Livro:</label>
            <select name="id_livro" required>
                <option value="">Selecione um livro</option>
                <?php while ($l = $livros->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?= $l['id'] ?>"><?= htmlspecialchars($l['titulo']) ?></option>
                <?php endwhile; ?>
            </select>

            <label>Usuário:</label>
            <select name="id_usuario" required>
                <option value="">Selecione o usuário</option>
                <?php while ($u = $usuarios->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['nome']) ?></option>
                <?php endwhile; ?>
            </select>

            <button class="btn" type="submit">Registrar</button>
        </form>

        <?php endif; ?>
    </div>

    <!-- LISTA DE EMPRÉSTIMOS -->
    <div class="card">
        <h2>Empréstimos Registrados</h2>

        <?php if ($listaEmprestimos->rowCount() > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Livro</th>
                <th>Usuário</th>
                <th>Data Empréstimo</th>
                <th>Status</th>
            </tr>

            <?php while ($e = $listaEmprestimos->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= $e['id'] ?></td>
                <td><?= htmlspecialchars($e['livro']) ?></td>
                <td><?= htmlspecialchars($e['usuario']) ?></td>
                <td><?= date("d/m/Y", strtotime($e['data_emprestimo'])) ?></td>
                <td>
                    <span class="<?= $e['status'] === 'emprestado' ? 'status-emp' : 'status-dev' ?>">
                        <?= ucfirst($e['status']) ?>
                    </span>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <?php else: ?>
            <p class="no-data">Nenhum empréstimo registrado ainda.</p>
        <?php endif; ?>
    </div>

</div>

</body>
</html>
