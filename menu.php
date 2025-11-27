<?php
if (!isset($paginaAtual)) {
    $paginaAtual = basename($_SERVER['PHP_SELF']);
}
?>
<header>
    <div class="header-top">
        <div class="logo">📚 Sistema de Biblioteca</div>

        <nav>
            <a href="index.php" class="<?php echo ($paginaAtual == 'index.php') ? 'active' : ''; ?>">Dashboard</a>
            <a href="listar-usuario.php" class="<?php echo ($paginaAtual == 'listar-usuario.php') ? 'active' : ''; ?>">Usuários</a>
            <a href="listar-funcionario.php" class="<?php echo ($paginaAtual == 'listar-funcionario.php') ? 'active' : ''; ?>">Funcionários</a>
            <a href="listar-editora.php" class="<?php echo ($paginaAtual == 'listar-editora.php') ? 'active' : ''; ?>">Editoras</a>
            <a href="listar-livro.php" class="<?php echo ($paginaAtual == 'listar-livro.php') ? 'active' : ''; ?>">Livros</a>
            <a href="listar-emprestimo.php" class="<?php echo ($paginaAtual == 'listar-emprestimo.php') ? 'active' : ''; ?>">Empréstimos</a>
        </nav>
    </div>
</header>
