<?php
session_start();

// Destroi a sessão
session_unset();
session_destroy();

// Redireciona para tela de login
header("Location: login.php");
exit;
?>
