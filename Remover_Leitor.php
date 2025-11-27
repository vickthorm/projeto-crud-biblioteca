<?php
switch ($_REQUEST["acao"]) {
    case 'cadastrar':
        $nome = $_POST["nome_leitor"];
        $cpf = $_POST["cpf_leitor"];
        $email = $_POST["email_leitor"];
        $telefone = $_POST["telefone_leitor"];
        $dt_nasc = $_POST["dt_nasc_leitor"];
        $endereco = $_POST["endereco_leitor"];

        $sql = "INSERT INTO leitor (nome_leitor, cpf_leitor, email_leitor, telefone_leitor, dt_nasc_leitor, endereco_leitor) VALUES ('{$nome}', '{$cpf}', '{$email}', '{$telefone}', '{$dt_nasc}', '{$endereco}')";
        
        $res = $conn->query($sql);
        if($res==true){
            print "<script>alert('Cadastro com sucesso!');</script>";
            print "<script>location.href='?page=listar-leitor';</script>";
        }else{
            print "<script>alert('Não foi possível cadastrar');</script>";
            print "<script>location.href='?page=listar-leitor';</script>";
        }
        break;

    case 'editar':
        $nome = $_POST["nome_leitor"];
        $cpf = $_POST["cpf_leitor"];
        $email = $_POST["email_leitor"];
        $telefone = $_POST["telefone_leitor"];
        $endereco = $_POST["endereco_leitor"];
        $dt_nasc = $_POST["dt_nasc_leitor"];
        $id = $_POST["id_leitor"];

        $sql = "UPDATE leitor SET nome_leitor='{$nome}', cpf_leitor='{$cpf}', email_leitor='{$email}', telefone_leitor='{$telefone}', endereco_leitor='{$endereco}', dt_nasc_leitor='{$dt_nasc}' WHERE id_leitor={$id}";
        
        $res = $conn->query($sql);
        if($res==true){
            print "<script>alert('Editado com sucesso!');</script>";
            print "<script>location.href='?page=listar-leitor';</script>";
        }else{
            print "<script>alert('Não foi possível editar');</script>";
            print "<script>location.href='?page=listar-leitor';</script>";
        }
        break;

    case 'excluir':
        $id = $_REQUEST["id"];
        $sql = "DELETE FROM leitor WHERE id_leitor={$id}";
        $res = $conn->query($sql);
        
        if($res==true){
            print "<script>alert('Excluído com sucesso!');</script>";
            print "<script>location.href='?page=listar-leitor';</script>";
        }else{
            print "<script>alert('Não foi possível excluir');</script>";
            print "<script>location.href='?page=listar-leitor';</script>";
        }
        break;
}
?>