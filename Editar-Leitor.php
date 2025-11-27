<?php include "config.php"; ?>
<h1>Editar Leitor</h1>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM leitor WHERE id_leitor = $id";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
    if ($row) { ?>
        <form action="?page=salvar-leitor" method="POST">
            <input type="hidden" name="acao" value="editar">
            <input type="hidden" name="id_leitor" value="<?php echo $row->id_leitor; ?>">
            <div class="mb-3">
                <label>Nome: <input type="text" name="nome_leitor" class="form-control" value="<?php echo $row->nome_leitor; ?>" required></label>
            </div>
            <div class="mb-3">
                <label>CPF: <input type="text" name="cpf_leitor" class="form-control" value="<?php echo $row->cpf_leitor; ?>" required></label>
            </div>
            <div class="mb-3">
                <label>Email: <input type="email" name="email_leitor" class="form-control" value="<?php echo $row->email_leitor; ?>"></label>
            </div>
            <div class="mb-3">
                <label>Telefone: <input type="text" name="telefone_leitor" class="form-control" value="<?php echo $row->telefone_leitor; ?>"></label>
            </div>
            <div class="mb-3">
                <label>Endereço: <input type="text" name="endereco_leitor" class="form-control" value="<?php echo $row->endereco_leitor; ?>"></label>
            </div>
            <div class="mb-3">
                <label>Data Nasc.: <input type="date" name="dt_nasc_leitor" class="form-control" value="<?php echo $row->dt_nasc_leitor; ?>"></label>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="?page=listar-leitor" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
<?php } else { echo "<p class='alert alert-danger'>Leitor não encontrado!</p>"; }
} else { echo "<p class='alert alert-danger'>ID não informado!</p>"; }
?>