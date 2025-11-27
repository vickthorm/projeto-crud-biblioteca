document.addEventListener('DOMContentLoaded', function () {
    // 1) Confirmar links com data-confirm
    document.querySelectorAll('a[data-confirm]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            const msg = this.getAttribute('data-confirm') || 'Tem certeza?';
            if (!confirm(msg)) {
                e.preventDefault();
            }
        });
    });

    // 2) Envolver todas as tabelas em um .table-wrapper para aplicar o layout
    document.querySelectorAll('table').forEach(function (table) {
        // Se já estiver dentro de um .table-wrapper, não faz nada
        if (!table.closest('.table-wrapper')) {
            const wrapper = document.createElement('div');
            wrapper.className = 'table-wrapper';

            const parent = table.parentNode;
            parent.insertBefore(wrapper, table);
            wrapper.appendChild(table);
        }

        // Adiciona uma classe base para tabelas de dados
        table.classList.add('data-table');
    });

    // 3) Estilizar automaticamente coluna "Ações" e links Editar/Excluir
    document.querySelectorAll('table.data-table').forEach(function (table) {
        let acaoIndex = -1;

        // Tenta achar o índice da coluna "Ações"
        const headerRows = table.querySelectorAll('thead tr, tr:first-child');
        headerRows.forEach(function (tr) {
            tr.querySelectorAll('th').forEach(function (th, index) {
                const text = th.textContent.trim().toLowerCase();
                if (text === 'ações' || text === 'acao' || text === 'ação') {
                    acaoIndex = index;
                }
            });
        });

        if (acaoIndex === -1) {
            return; // não encontrou coluna de ações
        }

        // Marca as células da coluna de ações
        table.querySelectorAll('tr').forEach(function (tr, rowIndex) {
            const tds = tr.querySelectorAll('td');
            if (tds[acaoIndex]) {
                const td = tds[acaoIndex];
                td.classList.add('actions');

                td.querySelectorAll('a').forEach(function (a) {
                    const txt = a.textContent.trim().toLowerCase();
                    if (/editar/i.test(txt)) {
                        a.classList.add('edit');
                    }
                    if (/excluir|deletar|apagar/i.test(txt)) {
                        a.classList.add('delete');
                        // Se não tiver data-confirm, utiliza confirm padrão
                        if (!a.hasAttribute('data-confirm') && !a.onclick) {
                            a.addEventListener('click', function (e) {
                                if (!confirm('Tem certeza que deseja excluir este registro?')) {
                                    e.preventDefault();
                                }
                            });
                        }
                    }
                });
            }
        });
    });
});
