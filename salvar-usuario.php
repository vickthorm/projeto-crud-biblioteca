<link rel="stylesheet" href="style.css">
<script src="script.js"></script>

<?php
require_once 'config.php';

$id_usuario       = $_POST['id_usuario'] ?? '';
$nome_usuario     = $_POST['nome_usuario'] ?? '';
$cpf_usuario      = $_POST['cpf_usuario'] ?? '';
$email_usuario    = $_POST['email_usuario'] ?? '';
$telefone_usuario = $_POST['telefone_usuario'] ?? '';
$dat_nasc_usuario = $_POST['dat_nasc_usuario'] ?? null;

if ($id_usuario != '') {
    // UPDATE
    $sql = "UPDATE usuarios SET
                nome_usuario = ?,
                cpf_usuario = ?,
                email_usuario = ?,
                telefone_usuario = ?,
                dat_nasc_usuario = ?
            WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssi",
        $nome_usuario,
        $cpf_usuario,
        $email_usuario,
        $telefone_usuario,
        $dat_nasc_usuario,
        $id_usuario
    );
    $okMsg = "Usuário atualizado com sucesso";
} else {
    // INSERT
    $sql = "INSERT INTO usuarios (
                nome_usuario,
                cpf_usuario,
                email_usuario,
                telefone_usuario,
                dat_nasc_usuario
            ) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssss",
        $nome_usuario,
        $cpf_usuario,
        $email_usuario,
        $telefone_usuario,
        $dat_nasc_usuario
    );
    $okMsg = "Usuário cadastrado com sucesso";
}

if ($stmt->execute()) {
    header("Location: listar-usuario.php?msg=" . urlencode($okMsg));
    exit;
} else {
    echo "Erro ao salvar usuário: " . $stmt->error;
}
