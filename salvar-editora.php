<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

$id_editora   = $_POST['id_editora'] ?? '';
$nome_editora = $_POST['nome_editora'] ?? '';

if ($id_editora != '') {
    $sql = "UPDATE editora SET nome_editora = ? WHERE id_editora = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nome_editora, $id_editora);
    $okMsg = "Editora atualizada com sucesso";
} else {
    $sql = "INSERT INTO editora (nome_editora) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nome_editora);
    $okMsg = "Editora cadastrada com sucesso";
}

if ($stmt->execute()) {
    header("Location: listar-editora.php?msg=" . urlencode($okMsg));
    exit;
} else {
    echo "Erro ao salvar editora: " . $stmt->error;
}
