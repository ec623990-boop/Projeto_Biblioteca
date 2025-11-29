<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema Biblioteca</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #3A6EA5, #274B73);
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            width: 380px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.25);
            text-align: center;
            animation: fadeIn 0.4s ease-in-out;
        }

        .login-box h2 {
            margin-bottom: 20px;
            color: #274B73;
        }

        .login-box input {
            width: 100%;
            padding: 12px;
            border: 1px solid #bbb;
            border-radius: 6px;
            margin-bottom: 14px;
            font-size: 15px;
        }

        .login-box button {
            width: 100%;
            padding: 12px;
            background: #3A6EA5;
            border: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        .login-box button:hover {
            background: #274B73;
        }

        .msg {
            color: red;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .link-cadastro {
            margin-top: 10px;
            display: inline-block;
            color: #274B73;
            font-weight: bold;
            text-decoration: none;
        }
        .link-cadastro:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>

</head>
<body>

<div class="login-box">
    <h2>Login – Biblioteca</h2>

    <?php if (isset($_GET['erro'])) { ?>
        <div class="msg">E-mail ou senha incorretos</div>
    <?php } ?>

    <?php if (isset($_GET['sucesso'])) { ?>
        <div class="msg" style="color:green;">Cadastro realizado com sucesso!</div>
    <?php } ?>

    <form action="../actions/validar_login.php" method="POST">
        <input type="email" name="email" placeholder="Seu e-mail" required>
        <input type="password" name="senha" placeholder="Sua senha" required>

        <button type="submit">Entrar</button>
    </form>

    <!-- AJUSTE AQUI 100% -->
    <a href="cadastro_usuario.php" class="link-cadastro">Criar uma conta</a>
</div>

</body>
</html>


