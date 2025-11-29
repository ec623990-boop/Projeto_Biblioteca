<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários - Biblioteca</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: #F5F7FA;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background: #2D3E50;
            color: white;
            height: 100vh;
            padding: 20px;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            display: block;
            padding: 12px;
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 8px;
        }
        .sidebar a:hover {
            background: #1B2938;
        }
        .content {
            flex: 1;
            padding: 30px;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #3A6EA5;
            color: white;
        }
        tr:hover {
            background: #f2f2f2;
        }
        .btn {
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }
        .btn-edit { background: #FFB74D; }
        .btn-delete { background: #E57373; }
        .btn-add { background: #3A6EA5; padding: 10px 18px; display: inline-block; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>📚 Biblioteca</h2>
        <a href="index.php">🏠 Dashboard</a>
        <a href="usuarios.php" style="background:#1B2938;">👥 Usuários</a>
        <a href="livros.php">📘 Livros</a>
        <a href="emprestimos.php">📄 Empréstimos</a>
        <a href="reservas.php">📅 Reservas</a>
        <a href="configuracoes.php">⚙ Configurações</a>
    </div>

    <div class="content">
        <h1>Usuários Cadastrados</h1>

        <a href="#" class="btn btn-add">+ Adicionar Usuário</a>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>João Silva</td>
                        <td>joao@email.com</td>
                        <td>(81) 99999-9999</td>
                        <td>
                            <a href="#" class="btn btn-edit">Editar</a>
                            <a href="#" class="btn btn-delete">Excluir</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Maria Souza</td>
                        <td>maria@email.com</td>
                        <td>(81) 98888-8888</td>
                        <td>
                            <a href="#" class="btn btn-edit">Editar</a>
                            <a href="#" class="btn btn-delete">Excluir</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
