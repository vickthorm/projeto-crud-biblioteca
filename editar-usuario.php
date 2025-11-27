<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

$id = $_GET['id'] ?? 0;
$id = (int) $id;

$sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    die("Usuário não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário da Biblioteca</h1>

    <form action="salvar-usuario.php" method="post">
        <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">

        <label>Nome:</label><br>
        <input type="text" name="nome_usuario"
               value="<?php echo htmlspecialchars($usuario['nome_usuario']); ?>" required><br><br>

        <label>CPF (somente números):</label><br>
        <input type="text" name="cpf_usuario" maxlength="11"
               value="<?php echo htmlspecialchars($usuario['cpf_usuario']); ?>"><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email_usuario"
               value="<?php echo htmlspecialchars($usuario['email_usuario']); ?>"><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone_usuario"
               value="<?php echo htmlspecialchars($usuario['telefone_usuario']); ?>"><br><br>

        <label>Data de nascimento:</label><br>
        <input type="date" name="dat_nasc_usuario"
               value="<?php echo $usuario['dat_nasc_usuario']; ?>"><br><br>

        <button type="submit">Salvar Alterações</button>
        <a href="listar-usuario.php">Voltar</a>
    </form>
</body>
</html>
