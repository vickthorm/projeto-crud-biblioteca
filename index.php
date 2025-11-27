<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Biblioteca</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: #f5f6fa;
            color: #333;
        }

        header {
            background: #2c3e50;
            padding: 25px;
            text-align: center;
            color: white;
        }

        h1 {
            margin: 0;
            font-weight: 600;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 25px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            transition: 0.2s;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.15);
        }

        .card i {
            font-size: 40px;
            margin-bottom: 15px;
            color: #34495e;
        }

        .card a {
            text-decoration: none;
            color: #2c3e50;
            font-weight: 600;
            display: block;
            margin-top: 10px;
            font-size: 17px;
        }

    </style>
</head>
<body>

<header>
    <h1>Sistema de Biblioteca</h1>
</header>

<div class="container">
    <div class="grid">

        <div class="card">
            <i class="fa-solid fa-user"></i>
            <a href="listar-usuario.php">Usuários</a>
        </div>

        <div class="card">
            <i class="fa-solid fa-user-tie"></i>
            <a href="listar-funcionario.php">Funcionários</a>
        </div>

        <div class="card">
            <i class="fa-solid fa-building"></i>
            <a href="listar-editora.php">Editoras</a>
        </div>

        <div class="card">
            <i class="fa-solid fa-book"></i>
            <a href="listar-livro.php">Livros</a>
        </div>

        <div class="card">
            <i class="fa-solid fa-book-open-reader"></i>
            <a href="listar-emprestimo.php">Empréstimos</a>
        </div>

    </div>
</div>

</body>
</html>
