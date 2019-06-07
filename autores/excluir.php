<?php

$title = "EXCLUIR AUTOR";

include '../componentes/header.php';

if (!isset($_SESSION['logado']) || $_SESSION['ADMIN'] === false) {
    header('Location: index.php');
}

if (isset($_POST['excluir'])) {
    require '../conexao.php';
    try {
        $id = $_POST['id'];

        $procedure = $conexao->prepare("CALL excluirAutor(:id)");
        $procedure->bindValue(':id', $id);
        if ($procedure->execute()) {
            header('Location: index.php');
        } else {
            $erro = "Não foi possível excluir o autor";
        }
    } catch (PDOException $exception) {
        $erro = "Erro ao excluir o autor";
    }
}

if (isset($_GET['id'])) {
    require '../conexao.php';
    try {
        $id = $_GET['id'];

        $procedure = $conexao->prepare("CALL buscarAutor(:id)");
        $procedure->bindValue(':id', $id);
        if ($procedure->execute()) {
            $resultado = $procedure->fetch();
        } else {
            $erro = "Não foi possível mostrar o autor";
        }
    } catch (PDOException $exception) {
        $erro = "Erro ao mostrar o autor";
    } ?>

    <div class="container text-center">
        <div class="card">
            <div class="card-body">
                <?php
                if (isset($erro)) {
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $erro; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                }
                ?>
                <h2 class="font-weight-light">EXCLUIR AUTOR</h2>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $resultado['ID'] ?>"/>
                    <table class="table">
                        <tr>
                            <td><label for="nome">Nome</label></td>
                            <td><input type="text" id="nome" readonly value="<?= $resultado['NOME'] ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="index.php" class="btn btn-info">Voltar</a>
                                <button type="submit" class="btn btn-warning" name="excluir">Excluir</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <?php include '../componentes/footer.php';

} else {
    header('Location: index.php');
}
?>