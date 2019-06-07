<?php

$title = "ATUALIZAR LIVRO";

include '../componentes/header.php';

if (!isset($_SESSION['logado']) || $_SESSION['ADMIN'] === false) {
    header('Location: index.php');
}

if (isset($_POST['atualizar']))
{
    if (empty($_POST['id']) || empty($_POST['titulo']) || empty($_POST['publicacao'])) {
        $erro = "É necessário preencher as informações";
    } else {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $publicacao = $_POST['publicacao'];

        require '../conexao.php';
        try {
            $procedure = $conexao->prepare("CALL atualizarLivro(:id, :titulo, :publicacao)");
            $procedure->bindValue(':id', $id);
            $procedure->bindValue(':titulo', $titulo);
            $procedure->bindValue(':publicacao', $publicacao);

            if ($procedure->execute())
            {
                header('Location: index.php');
            } else {
                $erro = "Não foi possível atualizar o livro";
            }
        }
        catch (PDOException $exception) {
            $erro = "Erro ao atualizar o livro";
        }
    }
}

if (isset($_GET['id'])) {
    require '../conexao.php';
    try {
        $id = $_GET['id'];

        $procedure = $conexao->prepare("CALL buscarLivro(:id)");
        $procedure->bindValue(':id', $id);
        if ($procedure->execute())
        {
            $resultado = $procedure->fetch();
        } else {
            $erro = "Não foi possível mostrar o livro";
        }
    } catch (PDOException $exception) {
        $erro = "Erro ao mostrar o livro";
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
                <h2 class="font-weight-light">ATUALIZAR LIVRO</h2>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $resultado['ID'] ?>" />
                    <table class="table">
                        <tr>
                            <td><label for="titulo">Título</label></td>
                            <td><input type="text" id="titulo" name="titulo" placeholder="Informe o título" required value="<?= $resultado['TITULO'] ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="publicacao">Ano de publicação</label></td>
                            <td><input type="date" id="publicacao" name="publicacao" required value="<?= $resultado['PUBLICACAO'] ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="index.php" class="btn btn-danger">Voltar</a>
                                <button type="submit" class="btn btn-success" name="atualizar">Atualizar</button>
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