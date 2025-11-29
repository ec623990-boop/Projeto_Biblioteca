<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros — Biblioteca</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: #F3F6FD;
            margin: 0;
            padding: 0;
        }

        header {
            background: #3A6EA5;
            padding: 20px;
            color: white;
            font-size: 22px;
            font-weight: 700;
        }

        .container {
            padding: 30px;
            max-width: 1100px;
            margin: auto;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 26px;
        }

        .btn-add {
            display: inline-block;
            background: #3A6EA5;
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .btn-add:hover {
            background: #274B73;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }

        th {
            background: #3A6EA5;
            color: white;
            padding: 14px;
            text-align: left;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #F0F4FF;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }

        .editar { background: #2D9CDB; }
        .deletar { background: #EB5757; }
        .ver { background: #27AE60; }

        .editar:hover { background: #2079AB; }
        .deletar:hover { background: #C0392B; }
        .ver:hover { background: #1E874B; }

    </style>
</head>

<body>

<header>📚 Biblioteca — Lista de Livros</header>

<div class="container">

    <h2>Livros Cadastrados</h2>

    <a href="#" class="btn-add">➕ Adicionar Novo Livro</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Ano</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>

        <tr>
            <td>1</td>
            <td>O Senhor dos Anéis</td>
            <td>J.R.R. Tolkien</td>
            <td>1954</td>
            <td>Fantasia</td>
            <td>
                <a href="#" class="btn ver">Ver</a>
                <a href="#" class="btn editar">Editar</a>
                <a href="#" class="btn deletar">Excluir</a>
            </td>
        </tr>

        <tr>
            <td>2</td>
            <td>Dom Quixote</td>
            <td>Miguel de Cervantes</td>
            <td>1605</td>
            <td>Romance</td>
            <td>
                <a href="#" class="btn ver">Ver</a>
                <a href="#" class="btn editar">Editar</a>
                <a href="#" class="btn deletar">Excluir</a>
            </td>
        </tr>

        <tr>
            <td>3</td>
            <td>1984</td>
            <td>George Orwell</td>
            <td>1949</td>
            <td>Ficção</td>
            <td>
                <a href="#" class="btn ver">Ver</a>
                <a href="#" class="btn editar">Editar</a>
                <a href="#" class="btn deletar">Excluir</a>
            </td>
        </tr>

    </table>

</div>

</body>
</html>
