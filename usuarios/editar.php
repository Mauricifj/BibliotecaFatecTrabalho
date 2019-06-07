<?php

$title = "ATUALIZAR USUÁRIO";

include '../componentes/header.php';

if (!isset($_SESSION['logado']) || $_SESSION['ADMIN'] === false) {
    header('Location: index.php');
}

if (isset($_POST['atualizar'])) {
    if (empty($_POST['id']) || empty($_POST['nome']) || empty($_POST['login']) || empty($_POST['tipo'])) {
        $erro = "É necessário preencher as informações";
    } else {
        require '../conexao.php';
        try {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $login = $_POST['login'];
            $tipo = $_POST['tipo'];

            $procedure = $conexao->prepare("CALL atualizarUsuario(:id, :nome, :login, :tipo)");
            $procedure->bindValue(':id', $id);
            $procedure->bindValue(':nome', $nome);
            $procedure->bindValue(':login', $login);
            $procedure->bindValue(':tipo', $tipo);
            if ($procedure->execute()) {
                header('Location: index.php');
            } else {
                $erro = "Não foi possível atualizar o usuário";
            }
        } catch (PDOException $exception) {
            $erro = "Erro ao atualizar o usuário" . $exception->getMessage();
        }
    }
}

if (isset($_GET['id'])) {
    require '../conexao.php';
    try {
        $id = $_GET['id'];

        $procedure = $conexao->prepare("CALL buscarUsuario(:id)");
        $procedure->bindValue(':id', $id);
        if ($procedure->execute()) {
            $resultado = $procedure->fetch();
        } else {
            $erro = "Não foi possível mostrar o usuário";
        }
    } catch (PDOException $exception) {
        $erro = "Erro ao mostrar o usuário";
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
                <h2 class="font-weight-light">ATUALIZAR USUÁRIO</h2>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $resultado['ID'] ?>"/>
                    <table class="table">
                        <tr>
                            <td><label for="nome">Nome</label></td>
                            <td><input type="text" id="nome" name="nome" placeholder="Informe o nome" required value="<?= $resultado['NOME'] ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="login">Login</label></td>
                            <td><input type="text" id="login" name="login" placeholder="Informe o login" required value="<?= $resultado['LOGIN'] ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="tipo">Tipo</label></td>
                            <td>
                                <select id="tipo" name="tipo" required>
                                    <option <?= ($resultado['TIPO'] === 'ADMIN') ? 'selected' : '' ?> value="ADMIN">Administrador</option>
                                    <option <?= ($resultado['TIPO'] === 'USUARIO') ? 'selected' : '' ?> value="USUARIO">Usuário</option>
                                </select>
                            </td>
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