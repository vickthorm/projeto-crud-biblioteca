<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $sqlDel = "DELETE FROM editora WHERE id_editora = ?";
    $stmtDel = $conn->prepare($sqlDel);
    $stmtDel->bind_param("i", $id);
    $stmtDel->execute();
    header("Location: listar-editora.php?msg=" . urlencode("Editora excluída com sucesso"));
    exit;
}

$sql = "SELECT * FROM editora ORDER BY nome_editora";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Editoras</title>
</head>
<body>
    <h1>Editoras</h1>

    <p><a href="cadastrar-editora.php">+ Nova Editora</a></p>

    <?php if (isset($_GET['msg'])): ?>
        <p style="color: green;"><?php echo htmlspecialchars($_GET['msg']); ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_editora']; ?></td>
                <td><?php echo htmlspecialchars($row['nome_editora']); ?></td>
                <td>
                    <a href="editar-editora.php?id=<?php echo $row['id_editora']; ?>">Editar</a> |
                    <a href="listar-editora.php?acao=excluir&id=<?php echo $row['id_editora']; ?>"
                       onclick="return confirm('Tem certeza que deseja excluir esta editora?');">
                       Excluir
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p><a href="index.php">Voltar ao início</a></p>
</body>
</html>
