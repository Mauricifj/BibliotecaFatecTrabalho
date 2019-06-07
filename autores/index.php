<?php

$title = 'AUTORES';

include '../componentes/header.php';

require '../conexao.php';
try {
    $procedure = $conexao->prepare("CALL buscarAutores()");
    if (!$procedure->execute()) {
        $erro = "Não foi possível mostrar os autores";
    }
} catch (PDOException $exception) {
    echo "Erro ao mostrar os autores";
} ?>

    <div class="container text-center">
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-light">AUTORES</h2>
                <hr/>

                <p><a href="../index.php" class="btn btn-secondary m-2 float-left mb-4">Voltar</a></p>
                <p><a href="adicionar.php" class="btn btn-primary m-2 float-right">Adicionar</a></p>

                <table id="tabelaAutores" class="table table-responsive-md">
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
                    <?php while ($resultado = $procedure->fetch()) { ?>
                        <tr>
                            <td><?= $resultado['ID'] ?></a></td>
                            <td><?= $resultado['NOME'] ?></td>
                            <td>
                                <?php if (isset($_SESSION['logado']) && $_SESSION['ADMIN'] === true) { ?>
                                    <a class="btn btn-outline-primary" href="livros.php?id=<?= $resultado['ID'] ?>">Livros</a> -
                                    <a class="btn btn-outline-warning" href="editar.php?id=<?= $resultado['ID'] ?>">Editar</a> -
                                    <a class="btn btn-outline-danger"  href="excluir.php?id=<?= $resultado['ID'] ?>">Excluir</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            $('#tabelaAutores').DataTable({
                "language": {
                    "sEmptyTable": "Nenhum autor encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ autores",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 autores",
                    "sInfoFiltered": "(Filtrados de _MAX_ autores)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ autores por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum autor encontrado",
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