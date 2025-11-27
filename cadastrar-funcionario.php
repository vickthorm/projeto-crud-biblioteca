<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Funcionário</title>
</head>
<body>
    <h1>Cadastrar Funcionário (Bibliotecário)</h1>

    <form action="salvar-funcionario.php" method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome_funcionario" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone_funcionario"><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email_funcionario"><br><br>

        <button type="submit">Salvar</button>
        <a href="listar-funcionario.php">Voltar</a>
    </form>
</body>
</html>
