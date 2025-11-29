<?php
session_start();

// Caminho ABSOLUTO para garantir que o conf.php seja encontrado
require_once __DIR__ . "/../config/conf.php";

// Verificar se a variável $conexao realmente existe
if (!isset($conexao)) {
    die("ERRO GRAVE: conf.php foi carregado, mas NÃO criou a variável \$conexao");
}

$email = $_POST['email'];
$senha = $_POST['senha'];

// Consulta
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Verifica usuário
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    
    // Verifica senha
    if (password_verify($senha, $usuario['senha'])) {
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['nome']  = $usuario['nome'];

        header("Location: ../pages/home.php");
        exit;
    }
}

header("Location: ../pages/login.php?erro=1");
exit;













