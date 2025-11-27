
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php

require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Editora</title>
</head>
<body>
    <h1>Cadastrar Editora</h1>

    <form action="salvar-editora.php" method="post">
        <label>Nome da Editora:</label><br>
        <input type="text" name="nome_editora" required><br><br>

        <button type="submit">Salvar</button>
        <a href="listar-editora.php">Voltar</a>
    </form>
</body>
</html>
