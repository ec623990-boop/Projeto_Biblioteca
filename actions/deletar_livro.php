<?php
// actions/deletar_livro.php
session_start();

// Verifica ID
if (!isset($_GET['id'])) {
    header("Location: ../pages/livros.php?erro=id_missing");
    exit;
}

$id = intval($_GET['id']);

// Carrega conf.php de forma inteligente
$confPaths = [
    __DIR__ . "/../config/conf.php",
    __DIR__ . "/../conexao.php",
    __DIR__ . "/../config/conexao.php"
];

$included = false;
foreach ($confPaths as $p) {
    if (file_exists($p)) {
        require_once $p;
        $included = true;
        break;
    }
}

if (!$included) {
    die("ERRO: Arquivo de configuração do banco não encontrado.");
}

/* ===========================================================
   OPÇÃO 2 — BLOQUEAR EXCLUSÃO SE O LIVRO TIVER EMPRÉSTIMOS
   =========================================================== */

// Detectar tipo de conexão (PDO ou MySQLi)
$mysqli = null;
if (isset($conexao) && $conexao instanceof mysqli) {
    $mysqli = $conexao;
} elseif (isset($Conexao) && $Conexao instanceof mysqli) {
    $mysqli = $Conexao;
}

// ---------- SE FOR PDO ----------
if (isset($pdo) && $pdo instanceof PDO) {
    try {
        // 1. Verificar se o livro tem empréstimos
        $check = $pdo->prepare("SELECT COUNT(*) FROM emprestimos WHERE id_livro = ?");
        $check->execute([$id]);
        $vinculos = $check->fetchColumn();

        if ($vinculos > 0) {
            header("Location: ../pages/livros.php?erro=livro_com_emprestimos");
            exit;
        }

        // 2. Excluir se não houver vínculos
        $stmt = $pdo->prepare("DELETE FROM livros WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: ../pages/livros.php?deletado=1");
        exit;

    } catch (PDOException $e) {
        die("Erro PDO: " . $e->getMessage());
    }
}

// ---------- SE FOR MYSQLI ----------
if ($mysqli !== null) {

    // 1. Verificar vínculos
    $sqlCheck = $mysqli->prepare("SELECT COUNT(*) FROM emprestimos WHERE id_livro = ?");
    $sqlCheck->bind_param("i", $id);
    $sqlCheck->execute();
    $sqlCheck->bind_result($vinculos);
    $sqlCheck->fetch();
    $sqlCheck->close();

    if ($vinculos > 0) {
        header("Location: ../pages/livros.php?erro=livro_com_emprestimos");
        exit;
    }

    // 2. Excluir
    $stmt = $mysqli->prepare("DELETE FROM livros WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../pages/livros.php?deletado=1");
    exit;
}

die("ERRO: Nenhuma conexão com o banco disponível.");

$included = false;
foreach ($confPaths as $p) {
    if (file_exists($p)) {
        require_once $p;
        $included = true;
        break;
    }
}

if (!$included) {
    // Não encontrou arquivo de conexão
    die("ERRO: Arquivo de configuração do banco não encontrado. Procure por config/conf.php ou conexao.php.");
}

// Se existir PDO ($pdo), usa PDO
if (isset($pdo) && $pdo instanceof PDO) {
    try {
        $stmt = $pdo->prepare("DELETE FROM livros WHERE id = ?");
        $ok = $stmt->execute([$id]);

        if ($ok) {
            header("Location: ../pages/livros.php?deletado=1");
            exit;
        } else {
            header("Location: ../pages/livros.php?erro=db_error");
            exit;
        }
    } catch (PDOException $e) {
        // debug (remova em produção)
        die("Erro PDO ao deletar: " . $e->getMessage());
    }
}

// Se existir mysqli ($conexao ou $Conexao), usa MySQLi
$mysqli = null;
if (isset($conexao) && $conexao instanceof mysqli) {
    $mysqli = $conexao;
} elseif (isset($Conexao) && $Conexao instanceof mysqli) {
    $mysqli = $Conexao;
}

if ($mysqli !== null) {
    $stmt = $mysqli->prepare("DELETE FROM livros WHERE id = ?");
    if (!$stmt) {
        die("Erro MySQLi prepare: " . $mysqli->error);
    }
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../pages/livros.php?deletado=1");
        exit;
    } else {
        $stmt->close();
        header("Location: ../pages/livros.php?erro=db_error");
        exit;
    }
}

// Se chegar aqui, nenhum driver de BD disponível
die("ERRO: Nenhuma conexão com o banco disponível (nem PDO nem MySQLi).");


