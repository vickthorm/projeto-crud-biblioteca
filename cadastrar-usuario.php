<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <h1>Cadastrar Usuário da Biblioteca</h1>

    <form action="salvar-usuario.php" method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome_usuario" required><br><br>

        <label>CPF (somente números):</label><br>
        <input type="text" name="cpf_usuario" maxlength="11"><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email_usuario"><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone_usuario"><br><br>

        <label>Data de nascimento:</label><br>
        <input type="date" name="dat_nasc_usuario"><br><br>

        <button type="submit">Salvar</button>
        <a href="listar-usuario.php">Voltar</a>
    </form>
</body>
</html>
