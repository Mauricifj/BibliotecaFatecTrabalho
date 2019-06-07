<?php
$title = "ADICIONAR USUÁRIO";

include '../componentes/header.php';

if (!isset($_SESSION['logado']) || $_SESSION['ADMIN'] === false) {
    header('Location: index.php');
}

if (isset($_POST['adicionar'])) {
    if (empty($_POST['nome']) || empty($_POST['login']) || empty($_POST['senha']) || empty($_POST['tipo'])) {
        $erro = "É necessário preencher as informações";
    } else {
        require '../conexao.php';
        try {
            $nome = $_POST['nome'];
            $login = $_POST['login'];
            $senha = sha1($_POST['senha']);
            $tipo = $_POST['tipo'];

            $procedure = $conexao->prepare("CALL adicionarUsuario(:nome, :login, :senha, :tipo)");
            $procedure->bindValue(':nome', $nome);
            $procedure->bindValue(':login', $login);
            $procedure->bindValue(':senha', $senha);
            $procedure->bindValue(':tipo', $tipo);
            if ($procedure->execute()) {
                header('Location: index.php');
            } else {
                $erro = "Não foi possível adicionar o usuário";
            }
        } catch (PDOException $exception) {
            $erro = "Erro ao adicionar o usuário";
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
            <h2 class="font-weight-light">ADICIONAR USUÁRIO</h2>
            <form method="post">
                <table class="table">
                    <tr>
                        <td><label for="nome">Nome</label></td>
                        <td><input type="text" id="nome" name="nome" placeholder="Informe o nome" required></td>
                    </tr>
                    <tr>
                        <td><label for="login">Login</label></td>
                        <td><input type="text" id="login" name="login" placeholder="Informe o login" required></td>
                    </tr>
                    <tr>
                        <td><label for="senha">Senha</label></td>
                        <td><input type="text" id="senha" name="senha" placeholder="Informe a senha" required></td>
                    </tr>
                    <tr>
                        <td><label for="tipo">Tipo</label></td>
                        <td>
                            <select id="tipo" name="tipo" required>
                                <option value="">Selecione...</option>
                                <option value="ADMIN">Administrador</option>
                                <option value="USUARIO">Usuário</option>
                            </select>
                        </td>
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