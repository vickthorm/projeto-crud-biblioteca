<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

$id_livro         = $_POST['id_livro'] ?? '';
$titulo_livro     = $_POST['titulo_livro'] ?? '';
$autor_livro      = $_POST['autor_livro'] ?? '';
$genero_livro     = $_POST['genero_livro'] ?? '';
$ano_publicacao   = $_POST['ano_publicacao'] ?? null;
$isbn_livro       = $_POST['isbn_livro'] ?? '';
$qtd_exemplares   = $_POST['qtd_exemplares'] ?? 0;
$editora_id       = $_POST['editora_id_editora'] ?? null;

if ($id_livro != '') {
    $sql = "UPDATE livro SET
                titulo_livro = ?,
                autor_livro = ?,
                genero_livro = ?,
                ano_publicacao = ?,
                isbn_livro = ?,
                qtd_exemplares = ?,
                editora_id_editora = ?
            WHERE id_livro = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssiis",
        $titulo_livro,
        $autor_livro,
        $genero_livro,
        $ano_publicacao,
        $isbn_livro,
        $qtd_exemplares,
        $editora_id,
        $id_livro
    );
    $okMsg = "Livro atualizado com sucesso";
} else {
    $sql = "INSERT INTO livro (
                titulo_livro,
                autor_livro,
                genero_livro,
                ano_publicacao,
                isbn_livro,
                qtd_exemplares,
                editora_id_editora
            ) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssis",
        $titulo_livro,
        $autor_livro,
        $genero_livro,
        $ano_publicacao,
        $isbn_livro,
        $qtd_exemplares,
        $editora_id
    );
    $okMsg = "Livro cadastrado com sucesso";
}

if ($stmt->execute()) {
    header("Location: listar-livro.php?msg=" . urlencode($okMsg));
    exit;
} else {
    echo "Erro ao salvar livro: " . $stmt->error;
}
