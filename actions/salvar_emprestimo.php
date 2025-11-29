<?php
// salvar_emprestimo.php – dentro da pasta /actions/

session_start();
include_once "../config/conexao.php"; // Caminho correto para a conexão

// Verifica se veio via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../emprestimos.php");
    exit;
}

// Dados enviados pelo formulário
$livro_id         = isset($_POST['livro_id']) ? intval($_POST['livro_id']) : 0;
$usuario_nome     = isset($_POST['usuario_nome']) ? trim($_POST['usuario_nome']) : '';
$data_emprestimo  = isset($_POST['data_emprestimo']) ? trim($_POST['data_emprestimo']) : date('Y-m-d');
$data_devolucao   = !empty($_POST['data_devolucao']) ? trim($_POST['data_devolucao']) : null;

// Validação simples
if ($livro_id <= 0 || empty($usuario_nome)) {
    header("Location: ../emprestimos.php?erro=DadosInvalidos");
    exit;
}

try {
    // Iniciar transação
    $conexao->begin_transaction();

    // Verificar se o livro existe e tem quantidade disponível
    $stmt = $conexao->prepare("SELECT quantidade FROM livros WHERE id = ? FOR UPDATE");
    $stmt->bind_param("i", $livro_id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows != 1) {
        $conexao->rollback();
        header("Location: ../emprestimos.php?erro=LivroNaoEncontrado");
        exit;
    }

    $livro = $res->fetch_assoc();

    if ($livro['quantidade'] <= 0) {
        $conexao->rollback();
        header("Location: ../emprestimos.php?erro=SemDisponibilidade");
        exit;
    }

    $stmt->close();

    // Inserir o empréstimo
    $status = "emprestado";

    $query = "INSERT INTO emprestimos (livro_id, usuario_nome, data_emprestimo, data_devolucao, status)
              VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($query);
    $stmt->bind_param("issss", $livro_id, $usuario_nome, $data_emprestimo, $data_devolucao, $status);
    $stmt->execute();
    $stmt->close();

    // Atualizar a quantidade de livros
    $stmt = $conexao->prepare("UPDATE livros SET quantidade = quantidade - 1 WHERE id = ?");
    $stmt->bind_param("i", $livro_id);
    $stmt->execute();
    $stmt->close();

    // Confirmar transação
    $conexao->commit();

    header("Location: ../emprestimos.php?sucesso=1");
    exit;

} catch (Exception $e) {

    // Caso ocorra erro, desfazer transação
    if ($conexao->in_transaction) {
        $conexao->rollback();
    }

    // Log interno
    error_log("Erro ao salvar empréstimo: " . $e->getMessage());

    header("Location: ../emprestimos.php?erro=1");
    exit;
}
