<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

$id = $_GET['id'] ?? 0;
$id = (int) $id;

$sql = "SELECT * FROM editora WHERE id_editora = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$edit = $result->fetch_assoc();

if (!$edit) {
    die("Editora não encontrada.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Editora</title>
</head>
<body>
    <h1>Editar Editora</h1>

    <form action="salvar-editora.php" method="post">
        <input type="hidden" name="id_editora" value="<?php echo $edit['id_editora']; ?>">

        <label>Nome da Editora:</label><br>
        <input type="text" name="nome_editora"
               value="<?php echo htmlspecialchars($edit['nome_editora']); ?>" required><br><br>

        <button type="submit">Salvar Alterações</button>
        <a href="listar-editora.php">Voltar</a>
    </form>
</body>
</html>
