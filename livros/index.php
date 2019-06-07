<?php

$title = 'LIVROS';

include '../componentes/header.php';

require '../conexao.php';

try {
    $procedure = $conexao->prepare("CALL buscarLivros()");
    if (!$procedure->execute()) {
        $erro = "Não foi possível mostrar os livros";
    }
} catch (PDOException $exception) {
    $erro = "Erro ao mostrar os livros";
} ?>

<div class="container text-center">
    <div class="card">
        <div class="card-body">
            <?php
            if (isset($erro)) {
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $erro ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            ?>
            <h2 class="font-weight-light">LIVROS</h2>

            <p><a href="../index.php" class="btn btn-secondary m-2 float-left mb-4">Voltar</a></p>

            <?php if (isset($_SESSION['logado'])) { ?>
                <p><a href="adicionar.php" class="btn btn-primary m-2 float-right">Adicionar</a></p>
            <?php } ?>

            <table id="tabelaLivros" class="table table-responsive-md">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Título</th>
                        <th>Ano de publicação</th>
                        <?php if (isset($_SESSION['logado']) && $_SESSION['ADMIN'] === true) { ?>
                            <th>Opções</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($resultado = $procedure->fetch()){ ?>
                        <tr>
                            <td><?= $resultado['ID'] ?></a></td>
                            <td><?= $resultado['TITULO'] ?></td>
                            <td><?= $resultado['PUBLICACAO'] ?></td>

                            <?php if (isset($_SESSION['logado']) && $_SESSION['ADMIN'] === true) { ?>
                                <td>
                                    <a class="btn btn-outline-warning" href="editar.php?id=<?= $resultado['ID'] ?>">Editar</a> -
                                    <a class="btn btn-outline-danger" href="excluir.php?id=<?= $resultado['ID'] ?>">Excluir</a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        $('#tabelaLivros').DataTable({
            "language": {
                "sEmptyTable": "Nenhum livro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ livros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 livros",
                "sInfoFiltered": "(Filtrados de _MAX_ livros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ livros por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum livro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });

        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<?php

include '../componentes/footer.php';

?>