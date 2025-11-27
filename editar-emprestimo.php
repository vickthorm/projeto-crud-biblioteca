<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

$id = $_GET['id'] ?? 0;
$id = (int) $id;

$sqlEmp = "SELECT * FROM emprestimos WHERE id_emprestimo = ?";
$stmt = $conn->prepare($sqlEmp);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultEmp = $stmt->get_result();
$emp = $resultEmp->fetch_assoc();

if (!$emp) {
    die("Empréstimo não encontrado.");
}

$sqlUsu = "SELECT id_usuario, nome_usuario FROM usuarios ORDER BY nome_usuario";
$usuarios = $conn->query($sqlUsu);

$sqlFunc = "SELECT id_funcionario, nome_funcionario FROM funcionario ORDER BY nome_funcionario";
$funcs = $conn->query($sqlFunc);

$sqlLiv = "SELECT id_livro, titulo_livro FROM livro ORDER BY titulo_livro";
$livros = $conn->query($sqlLiv);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Empréstimo</title>
</head>
<body>
    <h1>Editar Empréstimo</h1>

    <form action="salvar-emprestimo.php" method="post">
        <input type="hidden" name="id_emprestimo" value="<?php echo $emp['id_emprestimo']; ?>">

        <label>Usuário:</label><br>
        <select name="usuarios_id_usuario" required>
            <option value="">Selecione...</option>
            <?php while ($u = $usuarios->fetch_assoc()): ?>
                <option value="<?php echo $u['id_usuario']; ?>"
                    <?php echo ($u['id_usuario'] == $emp['usuarios_id_usuario']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($u['nome_usuario']); ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Funcionário:</label><br>
        <select name="funcionario_id_funcionario" required>
            <option value="">Selecione...</option>
            <?php while ($f = $funcs->fetch_assoc()): ?>
                <option value="<?php echo $f['id_funcionario']; ?>"
                    <?php echo ($f['id_funcionario'] == $emp['funcionario_id_funcionario']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($f['nome_funcionario']); ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Livro:</label><br>
        <select name="livro_id_livro" required>
            <option value="">Selecione...</option>
            <?php while ($l = $livros->fetch_assoc()): ?>
                <option value="<?php echo $l['id_livro']; ?>"
                    <?php echo ($l['id_livro'] == $emp['livro_id_livro']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($l['titulo_livro']); ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Data do Empréstimo:</label><br>
        <input type="date" name="data_emprestimo"
               value="<?php echo $emp['data_emprestimo']; ?>"><br><br>

        <label>Data Prevista de Devolução:</label><br>
        <input type="date" name="data_prevista_devolucao"
               value="<?php echo $emp['data_prevista_devolucao']; ?>"><br><br>

        <label>Data da Devolução:</label><br>
        <input type="date" name="data_devolucao"
               value="<?php echo $emp['data_devolucao']; ?>"><br><br>

        <button type="submit">Salvar Alterações</button>
        <a href="listar-emprestimo.php">Voltar</a>
    </form>
</body>
</html>
