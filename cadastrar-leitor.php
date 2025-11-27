<div style="height: 100vh; width: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
    <div style="width: 350px;">
        <h1>Cadastrar Leitor</h1>
        <form action="?page=salvar-leitor" method="POST">
            <input type="hidden" name="acao" value="cadastrar">
            <div class="mb-3 text-start">
                <label>Nome: <input type="text" name="nome_leitor" class="form-control" required></label>
            </div>
            <div class="mb-3 text-start">
                <label>CPF: <input type="text" name="cpf_leitor" class="form-control" required></label>
            </div>
            <div class="mb-3 text-start">
                <label>Email: <input type="email" name="email_leitor" class="form-control"></label>
            </div>
            <div class="mb-3 text-start">
                <label>Telefone: <input type="text" name="telefone_leitor" class="form-control"></label>
            </div>
            <div class="mb-3 text-start">
                <label>Endereço: <input type="text" name="endereco_leitor" class="form-control"></label>
            </div>
            <div class="mb-3 text-start">
                <label>Data de Nascimento: <input type="date" name="dt_nasc_leitor" class="form-control"></label>
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-100">Enviar</button>
            </div>
        </form>
    </div>
</div>