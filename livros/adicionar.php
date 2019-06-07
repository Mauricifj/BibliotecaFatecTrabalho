<?php
$title = "ADICIONAR LIVRO";

include '../componentes/header.php';

if (!isset($_SESSION['logado'])) {
    header('Location: index.php');
}

if (isset($_POST['adicionar'])) {
    if (empty($_POST['titulo']) || empty($_POST['publicacao'])) {
        $erro = "É necessário preencher as informações";
    } else {
        require '../conexao.php';
        try {
            $titulo = $_POST['titulo'];
            $publicacao = $_POST['publicacao'];

            $procedure = $conexao->prepare("CALL adicionarLivro(:titulo, :publicacao)");
            $procedure->bindValue(':titulo', $titulo);
            $procedure->bindValue(':publicacao', $publicacao);
            if ($procedure->execute()) {
                header('Location: index.php');
            } else {
                $erro = "Não foi possível adicionar o livro";
            }
        } catch (PDOException $exception) {
            $erro = "Erro ao adicionar o livro";
        }
    }
}
?>

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
            <h2 class="font-weight-light">ADICIONAR LIVRO</h2>
            <form method="post">
                <table class="table">
                    <tr>
                        <td><label for="titulo">Título</label></td>
                        <td><input type="text" id="titulo" name="titulo" placeholder="Informe o título" required></td>
                    </tr>
                    <tr>
                        <td><label for="publicacao">Ano de publicação</label></td>
                        <td><input type="date" id="publicacao" name="publicacao" required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="index.php" class="btn btn-danger">Voltar</a>
                            <button type="submit" class="btn btn-success" name="adicionar">Adicionar</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<?php include '../componentes/footer.php'; ?>