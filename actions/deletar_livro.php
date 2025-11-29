<?php
require_once("../conexao.php");

if (!isset($_GET['id'])) {
    header("Location: ../livros.php?erro=id_missing");
    exit;
}

$id = intval($_GET['id']);

$stmt = $Conexao->prepare("DELETE FROM livros WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../livros.php?deletado=1");
} else {
    header("Location: ../livros.php?erro=db_error");
}
exit;
?>
