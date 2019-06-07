<?php

$title = "EXCLUIR USUÁRIO";

include '../componentes/header.php';

if (!isset($_SESSION['logado']) || $_SESSION['ADMIN'] === false) {
    header('Location: index.php');
}

if (isset($_POST['excluir']))
{
    require '../conexao.php';
    try {
        $id = $_POST['id'];

        $procedure = $conexao->prepare("CALL excluirUsuario(:id)");
        $procedure->bindValue(':id', $id);
        if ($procedure->execute())
        {
            header('Location: index.php');
        } else {
            $erro = "Não foi possível excluir o usuário";
        }
    }
    catch (PDOException $exception) {
        $erro = "Erro ao excluir o usuário";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    require '../conexao.php';
    try {
        $procedure = $conexao->prepare("CALL buscarUsuario(:id)");
        $procedure->bindValue(':id', $id);
        if ($query = $procedure->execute())
        {
            $resultado = $procedure->fetch();
        } else {
            $erro = "Não foi possível mostrar o usuário";
        }
    } catch (Exception $exception) {
        $erro = "Erro ao mostrar o usuário";
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
                <h2 class="font-weight-light">EXCLUIR USUÁRIO</h2>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $resultado['ID'] ?>" />
                    <table class="table">
                        <tr>
                            <td><label for="nome">Nome</label></td>
                            <td><input type="text" id="nome" readonly value="<?= $resultado['NOME'] ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="login">Login</label></td>
                            <td><input type="text" id="login" readonly value="<?= $resultado['LOGIN'] ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="tipo">Tipo</label></td>
                            <td><input type="text" id="login" readonly value="<?= $resultado['TIPO'] ?>"></td>
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