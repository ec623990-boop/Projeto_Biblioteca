<?php
// config/conf.php
// Não imprimir nada aqui — somente conexão (mysqli + PDO)

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "formulario_pacient"; // ajuste se necessário

// --- Mysqli (procedural/OO) ---
$conexao = new mysqli($host, $user, $pass, $dbname);
if ($conexao->connect_error) {
    // ambiente dev: mostrar mensagem mais verbosa
    die("Erro ao conectar (mysqli): " . $conexao->connect_error);
}
$conexao->set_charset("utf8");

// --- PDO (para código que usa PDO) ---
try {
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Erro ao conectar (PDO): " . $e->getMessage());
}

// pronto — não echo nem print






