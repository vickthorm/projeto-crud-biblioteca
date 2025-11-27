<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

$id = $_GET['id'] ?? 0;
$id = (int) $id;

$sql = "SELECT * FROM funcionario WHERE id_funcionario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$func = $result->fetch_assoc();

if (!$func) {
    die("Funcionário não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Funcionário</title>
</head>
<body>
    <h1>Editar Funcionário</h1>

    <form action="salvar-funcionario.php" method="post">
        <input type="hidden" name="id_funcionario" value="<?php echo $func['id_funcionario']; ?>">

        <label>Nome:</label><br>
        <input type="text" name="nome_funcionario"
               value="<?php echo htmlspecialchars($func['nome_funcionario']); ?>" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone_funcionario"
               value="<?php echo htmlspecialchars($func['telefone_funcionario']); ?>"><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email_funcionario"
               value="<?php echo htmlspecialchars($func['email_funcionario']); ?>"><br><br>

        <button type="submit">Salvar Alterações</button>
        <a href="listar-funcionario.php">Voltar</a>
    </form>
</body>
</html>
