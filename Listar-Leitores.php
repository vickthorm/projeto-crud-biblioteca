<h1>Listar Leitores</h1>
<?php
$sql = "SELECT * FROM leitor";
$res = $conn->query($sql);
$qtd = $res->num_rows;

if ($qtd > 0) {
    print "<table class='table table-hover table-striped table-bordered'>";
    print "<tr><th>#</th><th>Nome</th><th>CPF</th><th>Email</th><th>Telefone</th><th>Ações</th></tr>";
    while ($row = $res->fetch_object()) {
        print "<tr>";
        print "<td>" . $row->id_leitor . "</td>";
        print "<td>" . $row->nome_leitor . "</td>";
        print "<td>" . $row->cpf_leitor . "</td>";
        print "<td>" . $row->email_leitor . "</td>";
        print "<td>" . $row->telefone_leitor . "</td>";
        print "<td>
                <button onclick=\"location.href='?page=editar-leitor&id=" . $row->id_leitor . "';\" class='btn btn-primary'>Editar</button>
                <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-leitor&acao=excluir&id=" . $row->id_leitor . "';}else{false;}\" class='btn btn-danger'>Excluir</button>
               </td>";
        print "</tr>";
    }
    print "</table>";
} else {
    print "<p class='alert alert-danger'>Não encontrou resultados!</p>";
}
?>