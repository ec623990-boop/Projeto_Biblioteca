<?php
session_start();

// Verifica login
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit;
}

// Conexão correta
require_once "../config/conf.php";   // GARANTIR QUE ESTE CAMINHO ESTÁ CORRETO

// =======================================================
// GET → EXIBE FORMULÁRIO COM OS DADOS DO LIVRO
// =======================================================
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (!isset($_GET['id'])) {
        echo "Livro não encontrado.";
        exit;
    }

    $id = intval($_GET['id']);

    $stmt = $pdo->prepare("SELECT * FROM livros WHERE id = ?");
    $stmt->execute([$id]);
    $livro = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$livro) {
        echo "Livro não encontrado.";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Editar Livro</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f1f4f9;
        margin: 0;
    }
    .container {
        width: 90%;
        max-width: 800px;
        margin: 40px auto;
    }
    .card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h2 {
        margin-top: 0;
        color: #244673;
    }
    label {
        display: block;
        font-weight: bold;
        margin-top: 15px;
        margin-bottom: 4px;
        color: #244673;
    }
    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 15px;
        box-sizing: border-box;
    }
    .row {
        display: flex;
        gap: 12px;
    }
    .col {
        flex: 1;
    }
    .btn {
        padding: 10px 20px;
        background: #244673;
        color: white;
        border-radius: 6px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 15px;
        margin-top: 20px;
    }
    .btn:hover { background: #1d375c; }
    .btn-home {
        display: inline-block;
        background: #244673;
        color: white;
        padding: 10px 14px;
        border-radius: 6px;
        text-decoration: none;
        margin: 12px;
        font-weight: bold;
    }
    .note { color:#666; font-size:14px; margin-top:8px; }
</style>
</head>
<body>

<a class="btn-home" href="../pages/home.php">🏠 Início</a>

<div class="container">
    <div class="card">
        <h2>Editar Livro</h2>

        <form action="../actions/editar_livro.php" method="POST">

            <input type="hidden" name="id" value="<?= $livro['id'] ?>">

            <label>Título</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($livro['titulo']) ?>" required>

            <label>Autor</label>
            <input type="text" name="autor" value="<?= htmlspecialchars($livro['autor']) ?>" required>

            <label>Categoria</label>
            <input type="text" name="categoria" value="<?= htmlspecialchars($livro['categoria']) ?>" required>

            <div class="row">
                <div class="col">
                    <label>Ano</label>
                    <input type="number" name="ano" value="<?= $livro['ano'] ?>" required>
                </div>
                <div class="col">
                    <label>Quantidade</label>
                    <input type="number" name="quantidade" value="<?= $livro['quantidade'] ?>" required>
                </div>
            </div>

            <button type="submit" class="btn">Salvar Alterações</button>
            <p class="note">Após salvar você será redirecionado para a lista de livros.</p>

        </form>

    </div>
</div>

</body>
</html>
<?php
exit;
}

// =======================================================
// POST → ATUALIZAR O LIVRO
// =======================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = intval($_POST['id']);
    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $categoria = trim($_POST['categoria']);
    $ano = intval($_POST['ano']);
    $quantidade = intval($_POST['quantidade']);

    if ($id <= 0 || $titulo === "" || $autor === "") {
        header("Location: ../pages/livros.php?erro=dados_invalidos");
        exit;
    }

    $stmt = $pdo->prepare("
        UPDATE livros 
        SET titulo=?, autor=?, categoria=?, ano=?, quantidade=?
        WHERE id=?
    ");

    $ok = $stmt->execute([
        $titulo, $autor, $categoria, $ano, $quantidade, $id
    ]);

    if ($ok) {
        header("Location: ../pages/livros.php?editado=1");
        exit;
    } else {
        header("Location: ../pages/livros.php?erro=db_error");
        exit;
    }
}
?>








