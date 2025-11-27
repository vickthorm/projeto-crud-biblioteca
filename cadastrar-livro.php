<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

$sqlEdit = "SELECT id_editora, nome_editora FROM editora ORDER BY nome_editora";
$resultEdit = $conn->query($sqlEdit);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Livro</title>
</head>
<body>
    <h1>Cadastrar Livro</h1>

    <form action="salvar-livro.php" method="post">
        <label>Título:</label><br>
        <input type="text" name="titulo_livro" required><br><br>

        <label>Autor:</label><br>
        <input type="text" name="autor_livro"><br><br>

        <label>Gênero:</label><br>
        <input type="text" name="genero_livro"><br><br>

        <label>Ano de Publicação:</label><br>
        <input type="number" name="ano_publicacao" min="1800" max="2100"><br><br>

        <label>ISBN:</label><br>
        <input type="text" name="isbn_livro"><br><br>

        <label>Quantidade de Exemplares:</label><br>
        <input type="number" name="qtd_exemplares" min="0"><br><br>

        <label>Editora:</label><br>
        <select name="editora_id_editora" required>
            <option value="">Selecione...</option>
            <?php while ($row = $resultEdit->fetch_assoc()): ?>
                <option value="<?php echo $row['id_editora']; ?>">
                    <?php echo htmlspecialchars($row['nome_editora']); ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <button type="submit">Salvar</button>
        <a href="listar-livro.php">Voltar</a>
    </form>
</body>
</html>
