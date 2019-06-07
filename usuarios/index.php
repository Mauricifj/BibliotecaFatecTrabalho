<?php

$title = 'USUÁRIOS';

include '../componentes/header.php';

require '../conexao.php';

try {
    $procedure = $conexao->prepare("CALL buscarUsuarios()");
    if (!$procedure->execute()) {
        $erro = "Não foi possível mostrar os usuários";
    }
} catch (PDOException $exception) {
    $erro = "Erro ao mostrar os usuários";
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
            <h2 class="font-weight-light">USUÁRIOS</h2>

            <p><a href="../index.php" class="btn btn-secondary m-2 float-left mb-4">Voltar</a></p>

            <?php if (isset($_SESSION['logado']) && $_SESSION['ADMIN'] === true) { ?>
                <p><a href="adicionar.php" class="btn btn-primary m-2 float-right">Adicionar</a></p>
            <?php } ?>

            <table id="tabelaUsuarios" class="table table-responsive-md">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>Tipo</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($resultado = $procedure->fetch()){ ?>
                        <tr>
                            <td><?= $resultado['ID'] ?></a></td>
                            <td><?= $resultado['NOME'] ?></td>
                            <td><?= $resultado['LOGIN'] ?></td>
                            <td><?= $resultado['TIPO'] ?></td>
                            <td>
                                <a class="btn btn-outline-warning" href="editar.php?id=<?= $resultado['ID'] ?>">Editar</a> -
                                <a class="btn btn-outline-danger" href="excluir.php?id=<?= $resultado['ID'] ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        $('#tabelaUsuarios').DataTable({
            "language": {
                "sEmptyTable": "Nenhum usuário encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ usuários",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 usuários",
                "sInfoFiltered": "(Filtrados de _MAX_ usuários)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ usuários por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum usuário encontrado",
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

<?php include '../componentes/footer.php'; ?>