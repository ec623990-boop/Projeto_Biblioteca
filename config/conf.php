<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "formulario_pacient";

$conexao = new mysqli($host, $user, $pass, $dbname);

if ($conexao->connect_error) {
    die("Erro ao conectar ao banco: " . $conexao->connect_error);
}

$conexao->set_charset("utf8");

echo "<p style='color:green'>conf.php carregado ✔</p>";
?>




