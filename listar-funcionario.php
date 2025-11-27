<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $sqlDel = "DELETE FROM funcionario WHERE id_funcionario = ?";
    $stmtDel = $conn->prepare($sqlDel);
    $stmtDel->bind_param("i", $id);
    $stmtDel->execute();
    header("Location: listar-funcionario.php?msg=" . urlencode("Funcionário excluído com sucesso"));
    exit;
}

$sql = "SELECT * FROM funcionario ORDER BY nome_funcionario";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Funcionários</title>
</head>
<body>
    <h1>Funcionários (Bibliotecários)</h1>

    <p><a href="cadastrar-funcionario.php">+ Novo Funcionário</a></p>

    <?php if (isset($_GET['msg'])): ?>
        <p style="color: green;"><?php echo htmlspecialchars($_GET['msg']); ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_funcionario']; ?></td>
                <td><?php echo htmlspecialchars($row['nome_funcionario']); ?></td>
                <td><?php echo htmlspecialchars($row['telefone_funcionario']); ?></td>
                <td><?php echo htmlspecialchars($row['email_funcionario']); ?></td>
                <td>
                    <a href="editar-funcionario.php?id=<?php echo $row['id_funcionario']; ?>">Editar</a> |
                    <a href="listar-funcionario.php?acao=excluir&id=<?php echo $row['id_funcionario']; ?>"
                       onclick="return confirm('Tem certeza que deseja excluir este funcionário?');">
                       Excluir
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p><a href="index.php">Voltar ao início</a></p>
</body>
</html>
