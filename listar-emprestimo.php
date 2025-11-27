<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $sqlDel = "DELETE FROM emprestimos WHERE id_emprestimo = ?";
    $stmtDel = $conn->prepare($sqlDel);
    $stmtDel->bind_param("i", $id);
    $stmtDel->execute();
    header("Location: listar-emprestimo.php?msg=" . urlencode("Empréstimo excluído com sucesso"));
    exit;
}

$sql = "SELECT 
            e.id_emprestimo,
            e.data_emprestimo,
            e.data_prevista_devolucao,
            e.data_devolucao,
            u.nome_usuario,
            f.nome_funcionario,
            l.titulo_livro
        FROM emprestimos e
        INNER JOIN usuarios u ON u.id_usuario = e.usuarios_id_usuario
        INNER JOIN funcionario f ON f.id_funcionario = e.funcionario_id_funcionario
        INNER JOIN livro l ON l.id_livro = e.livro_id_livro
        ORDER BY e.data_emprestimo DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Empréstimos</title>
</head>
<body>
    <h1>Empréstimos</h1>

    <p><a href="cadastrar-emprestimo.php">+ Novo Empréstimo</a></p>

    <?php if (isset($_GET['msg'])): ?>
        <p style="color: green;"><?php echo htmlspecialchars($_GET['msg']); ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Livro</th>
            <th>Funcionário</th>
            <th>Data Empréstimo</th>
            <th>Prevista Devolução</th>
            <th>Data Devolução</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_emprestimo']; ?></td>
                <td><?php echo htmlspecialchars($row['nome_usuario']); ?></td>
                <td><?php echo htmlspecialchars($row['titulo_livro']); ?></td>
                <td><?php echo htmlspecialchars($row['nome_funcionario']); ?></td>
                <td>
                    <?php
                        if (!empty($row['data_emprestimo'])) {
                            echo date('d/m/Y', strtotime($row['data_emprestimo']));
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if (!empty($row['data_prevista_devolucao'])) {
                            echo date('d/m/Y', strtotime($row['data_prevista_devolucao']));
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if (!empty($row['data_devolucao'])) {
                            echo date('d/m/Y', strtotime($row['data_devolucao']));
                        }
                    ?>
                </td>
                <td>
                    <a href="editar-emprestimo.php?id=<?php echo $row['id_emprestimo']; ?>">Editar</a> |
                    <a href="listar-emprestimo.php?acao=excluir&id=<?php echo $row['id_emprestimo']; ?>"
                       onclick="return confirm('Tem certeza que deseja excluir este empréstimo?');">
                       Excluir
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p><a href="index.php">Voltar ao início</a></p>
</body>
</html>
