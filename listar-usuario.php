<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $sqlDel = "DELETE FROM usuarios WHERE id_usuario = ?";
    $stmtDel = $conn->prepare($sqlDel);
    $stmtDel->bind_param("i", $id);
    $stmtDel->execute();
    header("Location: listar-usuario.php?msg=" . urlencode("Usuário excluído com sucesso"));
    exit;
}

$sql = "SELECT * FROM usuarios ORDER BY nome_usuario";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
</head>
<body>
    <h1>Usuários da Biblioteca</h1>

    <p><a href="cadastrar-usuario.php">+ Novo Usuário</a></p>

    <?php if (isset($_GET['msg'])): ?>
        <p style="color: green;"><?php echo htmlspecialchars($_GET['msg']); ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Data de Nascimento</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_usuario']; ?></td>
                <td><?php echo htmlspecialchars($row['nome_usuario']); ?></td>
                <td><?php echo htmlspecialchars($row['cpf_usuario']); ?></td>
                <td><?php echo htmlspecialchars($row['email_usuario']); ?></td>
                <td><?php echo htmlspecialchars($row['telefone_usuario']); ?></td>
                <td>
                    <?php
                        if (!empty($row['dat_nasc_usuario'])) {
                            echo date('d/m/Y', strtotime($row['dat_nasc_usuario']));
                        }
                    ?>
                </td>
                <td>
                    <a href="editar-usuario.php?id=<?php echo $row['id_usuario']; ?>">Editar</a> |
                    <a href="listar-usuario.php?acao=excluir&id=<?php echo $row['id_usuario']; ?>"
                       onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
                       Excluir
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p><a href="index.php">Voltar ao início</a></p>
</body>
</html>
