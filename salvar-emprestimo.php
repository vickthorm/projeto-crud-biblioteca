<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<?php
require_once 'config.php';

$id_emprestimo            = $_POST['id_emprestimo'] ?? '';
$usuarios_id_usuario      = $_POST['usuarios_id_usuario'] ?? null;
$funcionario_id_funcionario = $_POST['funcionario_id_funcionario'] ?? null;
$livro_id_livro           = $_POST['livro_id_livro'] ?? null;
$data_emprestimo          = $_POST['data_emprestimo'] ?? null;
$data_prevista_devolucao  = $_POST['data_prevista_devolucao'] ?? null;
$data_devolucao           = $_POST['data_devolucao'] ?? null;

if ($id_emprestimo != '') {
    $sql = "UPDATE emprestimos SET
                data_emprestimo = ?,
                data_prevista_devolucao = ?,
                data_devolucao = ?,
                usuarios_id_usuario = ?,
                funcionario_id_funcionario = ?,
                livro_id_livro = ?
            WHERE id_emprestimo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssiiii",
        $data_emprestimo,
        $data_prevista_devolucao,
        $data_devolucao,
        $usuarios_id_usuario,
        $funcionario_id_funcionario,
        $livro_id_livro,
        $id_emprestimo
    );
    $okMsg = "Empréstimo atualizado com sucesso";
} else {
    $sql = "INSERT INTO emprestimos (
                data_emprestimo,
                data_prevista_devolucao,
                data_devolucao,
                usuarios_id_usuario,
                funcionario_id_funcionario,
                livro_id_livro
            ) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssiii",
        $data_emprestimo,
        $data_prevista_devolucao,
        $data_devolucao,
        $usuarios_id_usuario,
        $funcionario_id_funcionario,
        $livro_id_livro
    );
    $okMsg = "Empréstimo cadastrado com sucesso";
}

if ($stmt->execute()) {
    header("Location: listar-emprestimo.php?msg=" . urlencode($okMsg));
    exit;
} else {
    echo "Erro ao salvar empréstimo: " . $stmt->error;
}
