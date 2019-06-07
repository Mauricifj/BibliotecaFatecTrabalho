<?php

$title = 'EDITORAS';

include '../componentes/header.php';

require '../conexao.php';
try {
    $query = $conexao->prepare("CALL buscarEditoras()");
    if (!$query->execute()) {
        $erro = "Não foi possível mostrar as editoras";
    }
} catch (PDOException $exception) {
    $erro = "Erro ao mostrar as editoras";
} ?>
    <div class="container text-center">
        <div class="card">
            <div class="card-body">
                <?php
                if (isset($erro)) {
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $erro; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                }
                ?>
                <h2 class="font-weight-light">EDITORAS</h2>

                <p><a href="../index.php" class="btn btn-secondary m-2 float-left mb-4">Voltar</a></p>
                <?php if (isset($_SESSION['logado'])) { ?>
                    <p><a href="adicionar.php" class="btn btn-primary m-2 float-right">Adicionar</a></p>
                <?php } ?>

                <table id="tabelaEditoras" class="table table-responsive-md">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <?php if (isset($_SESSION['logado']) && $_SESSION['ADMIN'] === true) { ?>
                            <th>Opções</th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($resultado = $query->fetch()){ ?>
                        <tr>
                            <td><?php echo $resultado['ID'] ?></a></td>
                            <td><?php echo $resultado['NOME'] ?></td>

                            <?php if (isset($_SESSION['logado']) && $_SESSION['ADMIN'] === true) { ?>
                                <td>
                                    <a class="btn btn-outline-primary" href="livros.php?id=<?= $resultado['ID'] ?>">Livros</a> -
                                    <a class="btn btn-outline-warning" href="editar.php?id=<?= $resultado['ID'] ?>">Editar</a> -
                                    <a class="btn btn-outline-danger" href="excluir.php?id=<?= $resultado['ID'] ?>">Excluir</a>
                                </td>
                            <?php } ?>

                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            $('#tabelaEditoras').DataTable({
                "language": {
                    "sEmptyTable": "Nenhum editora encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ editoras",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 editoras",
                    "sInfoFiltered": "(Filtrados de _MAX_ editoras)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ editoras por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum editora encontrado",
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