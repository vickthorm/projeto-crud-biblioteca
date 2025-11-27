<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

$id = $_GET['id'] ?? 0;
$id = (int) $id;

$sqlLivro = "SELECT * FROM livro WHERE id_livro = ?";
$stmt = $conn->prepare($sqlLivro);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultLivro = $stmt->get_result();
$livro = $resultLivro->fetch_assoc();

if (!$livro) {
    die("Livro não encontrado.");
}

$sqlEdit = "SELECT id_editora, nome_editora FROM editora ORDER BY nome_editora";
$resultEdit = $conn->query($sqlEdit);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
</head>
<body>
    <h1>Editar Livro</h1>

    <form action="salvar-livro.php" method="post">
        <input type="hidden" name="id_livro" value="<?php echo $livro['id_livro']; ?>">

        <label>Título:</label><br>
        <input type="text" name="titulo_livro"
               value="<?php echo htmlspecialchars($livro['titulo_livro']); ?>" required><br><br>

        <label>Autor:</label><br>
        <input type="text" name="autor_livro"
               value="<?php echo htmlspecialchars($livro['autor_livro']); ?>"><br><br>

        <label>Gênero:</label><br>
        <input type="text" name="genero_livro"
               value="<?php echo htmlspecialchars($livro['genero_livro']); ?>"><br><br>

        <label>Ano de Publicação:</label><br>
        <input type="number" name="ano_publicacao" min="1800" max="2100"
               value="<?php echo $livro['ano_publicacao']; ?>"><br><br>

        <label>ISBN:</label><br>
        <input type="text" name="isbn_livro"
               value="<?php echo htmlspecialchars($livro['isbn_livro']); ?>"><br><br>

        <label>Quantidade de Exemplares:</label><br>
        <input type="number" name="qtd_exemplares" min="0"
               value="<?php echo $livro['qtd_exemplares']; ?>"><br><br>

        <label>Editora:</label><br>
        <select name="editora_id_editora" required>
            <option value="">Selecione...</option>
            <?php while ($row = $resultEdit->fetch_assoc()): ?>
                <option value="<?php echo $row['id_editora']; ?>"
                    <?php echo ($row['id_editora'] == $livro['editora_id_editora']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['nome_editora']); ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <button type="submit">Salvar Alterações</button>
        <a href="listar-livro.php">Voltar</a>
    </form>
</body>
</html>
