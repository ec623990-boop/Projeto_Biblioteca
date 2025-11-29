<?php
require_once("../conexao.php");

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: ../livros.php?erro=invalid_request");
    exit;
}

$titulo = $_POST['titulo'] ?? '';
$autor = $_POST['autor'] ?? '';
$ano = $_POST['ano'] ?? '';
$quantidade = $_POST['quantidade'] ?? 0;

$stmt = $Conexao->prepare("INSERT INTO livros (titulo, autor, ano, quantidade) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssii", $titulo, $autor, $ano, $quantidade);

if ($stmt->execute()) {
    header("Location: ../livros.php?sucesso=1");
} else {
    header("Location: ../livros.php?erro=db_error");
}
exit;
?>

