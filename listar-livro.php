<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $sqlDel = "DELETE FROM livro WHERE id_livro = ?";
    $stmtDel = $conn->prepare($sqlDel);
    $stmtDel->bind_param("i", $id);
    $stmtDel->execute();
    header("Location: listar-livro.php?msg=" . urlencode("Livro excluído com sucesso"));
    exit;
}

$sql = "SELECT 
            l.id_livro,
            l.titulo_livro,
            l.autor_livro,
            l.genero_livro,
            l.ano_publicacao,
            l.isbn_livro,
            l.qtd_exemplares,
            e.nome_editora
        FROM livro l
        INNER JOIN editora e ON e.id_editora = l.editora_id_editora
        ORDER BY l.titulo_livro";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Livros</title>
</head>
<body>
    <h1>Livros Cadastrados</h1>

    <p><a href="cadastrar-livro.php">+ Novo Livro</a></p>

    <?php if (isset($_GET['msg'])): ?>
        <p style="color: green;"><?php echo htmlspecialchars($_GET['msg']); ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Gênero</th>
            <th>Ano</th>
            <th>ISBN</th>
            <th>Qtd</th>
            <th>Editora</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_livro']; ?></td>
                <td><?php echo htmlspecialchars($row['titulo_livro']); ?></td>
                <td><?php echo htmlspecialchars($row['autor_livro']); ?></td>
                <td><?php echo htmlspecialchars($row['genero_livro']); ?></td>
                <td><?php echo $row['ano_publicacao']; ?></td>
                <td><?php echo htmlspecialchars($row['isbn_livro']); ?></td>
                <td><?php echo $row['qtd_exemplares']; ?></td>
                <td><?php echo htmlspecialchars($row['nome_editora']); ?></td>
                <td>
                    <a href="editar-livro.php?id=<?php echo $row['id_livro']; ?>">Editar</a> |
                    <a href="listar-livro.php?acao=excluir&id=<?php echo $row['id_livro']; ?>"
                       onclick="return confirm('Tem certeza que deseja excluir este livro?');">
                       Excluir
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p><a href="index.php">Voltar ao início</a></p>
</body>
</html>
