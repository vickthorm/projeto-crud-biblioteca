<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

$id_funcionario       = $_POST['id_funcionario'] ?? '';
$nome_funcionario     = $_POST['nome_funcionario'] ?? '';
$telefone_funcionario = $_POST['telefone_funcionario'] ?? '';
$email_funcionario    = $_POST['email_funcionario'] ?? '';

if ($id_funcionario != '') {
    $sql = "UPDATE funcionario SET
                nome_funcionario = ?,
                telefone_funcionario = ?,
                email_funcionario = ?
            WHERE id_funcionario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi",
        $nome_funcionario,
        $telefone_funcionario,
        $email_funcionario,
        $id_funcionario
    );
    $okMsg = "Funcionário atualizado com sucesso";
} else {
    $sql = "INSERT INTO funcionario (
                nome_funcionario,
                telefone_funcionario,
                email_funcionario
            ) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss",
        $nome_funcionario,
        $telefone_funcionario,
        $email_funcionario
    );
    $okMsg = "Funcionário cadastrado com sucesso";
}

if ($stmt->execute()) {
    header("Location: listar-funcionario.php?msg=" . urlencode($okMsg));
    exit;
} else {
    echo "Erro ao salvar funcionário: " . $stmt->error;
}
