<?php

$title = "LIVROS DO AUTOR";

include '../componentes/header.php';

if (isset($_GET['id'])) {
    require '../conexao.php';
    try {
        $id = $_GET['id'];

        $procedure = $conexao->prepare("CALL buscarLivrosPorEditora(:id)");
        $procedure->bindParam(':id', $id);
        if (!$procedure->execute()) {
            $erro = "Não foi possível mostrar os livros deste autor";
        }
    } catch (PDOException $exception) {
        $erro = "Erro ao mostrar os livros deste autor";
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
                <h2 class="font-weight-light">LIVROS DA AUTOR</h2>
                <a href="index.php" class="btn btn-danger m-3 float-left">Voltar</a>
                <table id="livrosAutor" class="table table-responsive-md">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($resultado = $procedure->fetch()) { ?>
                        <tr>
                            <td><?= $resultado['ID'] ?></a></td>
                            <td><?= $resultado['TITULO'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            $('#livrosAutor').DataTable({
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

    <?php include '../componentes/footer.php';

} else {
    header('Location: index.php');
}
?>