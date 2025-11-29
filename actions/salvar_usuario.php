<?php
require_once __DIR__ . "/../config/conf.php";

$nome  = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Verificar se o e-mail já existe
$sql = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
$sql->bind_param("s", $email);
$sql->execute();
$sql->store_result();

if ($sql->num_rows > 0) {
    echo "<script>alert('Este e-mail já está cadastrado!'); history.back();</script>";
    exit;
}

// Inserir usuário
$insert = $conexao->prepare("
    INSERT INTO usuarios (nome, email, senha)
    VALUES (?, ?, ?)
");
$insert->bind_param("sss", $nome, $email, $senha);

if ($insert->execute()) {
    header("Location: ../pages/login.php?sucesso=1");
    exit();
} else {
    echo "Erro: " . $conexao->error;
}







