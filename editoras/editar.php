<?php

$title = "ATUALIZAR EDITORA";

include '../componentes/header.php';

if (!isset($_SESSION['logado']) || $_SESSION['ADMIN'] === false) {
    header('Location: index.php');
}

if (isset($_POST['atualizar'])) {
    if (empty($_POST['id']) || empty($_POST['nome'])) {
        $erro = "É necessário preencher as informações";
    } else {
        require '../conexao.php';
        try {
            $id = $_POST['id'];
            $nome = $_POST['nome'];

            $procedure = $conexao->prepare("CALL atualizarEditora(:id, :nome)");
            $procedure->bindParam(':id', $id);
            $procedure->bindParam(':nome', $nome);
            if ($procedure->execute()) {
                header('Location: index.php');
            } else {
                $erro = "Não foi possível atualizar a editora";
            }
        } catch (PDOException $exception) {
            $erro = "Erro ao atualizar a editora";
        }
    }
}

if (isset($_GET['id'])) {
    require '../conexao.php';
    try {
        $id = $_GET['id'];

        $procedure = $conexao->prepare("CALL buscarEditora(:id)");
        $procedure->bindValue(':id', $id);
        if ($procedure->execute())
        {
            $resultado = $procedure->fetch();
        } else {
            $erro = "Não foi possível mostrar a editora";
        }
    } catch (mysqli_sql_exception $exception) {
        $erro = "Erro ao mostrar a editora";
    } ?>

    <div class="container text-center">

        <div class="card">
            <div class="card-body">
                <?php
                if (isset($erro)) {
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $erro ?>
                    </div>
                    <?php
                }
                ?>
                <h2 class="font-weight-light">ATUALIZAR EDITORA</h2>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $resultado['ID'] ?>" />
                    <table class="table">
                        <tr>
                            <td><label for="nome">Nome</label></td>
                            <td><input type="text" id="nome" name="nome" placeholder="Informe o nome" required value="<?= $resultado['NOME'] ?>"></td>
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