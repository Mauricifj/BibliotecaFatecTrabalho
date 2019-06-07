<?php

$title = "ADICIONAR EDITORA";

include '../componentes/header.php';

if (!isset($_SESSION['logado'])) {
    header('Location: index.php');
}

if (isset($_POST['adicionar'])) {
    if (empty($_POST['nome'])) {
        $erro = "É necessário preencher as informações";
    } else {
        require '../conexao.php';
        try {
            $nome = $_POST['nome'];

            $procedure = $conexao->prepare("CALL adicionarEditora(:nome)");
            $procedure->bindParam(':nome', $nome);
            if ($procedure->execute()) {
                header('Location: index.php');
            } else {
                $erro = "Não foi possível adicionar a editora";
            }
        } catch (PDOException $exception) {
            $erro = "Erro ao adicionar a editora";
        }
    }
}?>

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
                <h2 class="font-weight-light">ADICIONAR EDITORA</h2>
                <form method="post">
                    <table class="table">
                        <tr>
                            <td><label for="nome">Nome</label></td>
                            <td><input type="text" id="nome" name="nome" placeholder="Informe o nome" required></td>
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