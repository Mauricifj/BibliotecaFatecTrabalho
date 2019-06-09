<?php
require '../conexao.php';
session_start();

if (isset($_POST['logar'])) {

    $login = $_POST['login'];
    $senha = sha1($_POST['senha']);

    try {
        $statement = $conexao->prepare("CALL logar(:login, :senha)");
        $statement->bindParam(':login', $login);
        $statement->bindParam(':senha', $senha);
        $statement->execute();

        if($statement->rowCount() > 0) {
            if ($resultado = $statement->fetch()) {
                $_SESSION['id'] = $resultado['ID'];
                $_SESSION['nome'] = $resultado['NOME'];
                $_SESSION['login'] = $resultado['LOGIN'];
                $_SESSION['tipo'] = $resultado['TIPO'];
                $_SESSION['logado'] = true;

                if ($_SESSION['tipo'] === 'ADMIN') {
                    $_SESSION['ADMIN'] = true;
                }
            }
        } else {
            session_unset();
            $erroLogin = "Usuário e/ou senha inválidos";
        }
    } catch (PDOException $e) {
        $erroLogin = "Erro no login";
    }
}

if (isset($_POST['logout'])) {
    session_unset();
}

echo '<!doctype html>
<html lang="pt-br" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="pt-br">
    ';

echo "<title>Biblioteca - $title</title>";

echo '
    <script src="/terceiros/jquery/jquery.js"></script>
    <script src="/terceiros/popper/popper.js"></script>
    <script src="/terceiros/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/terceiros/inputmask/inputmask.js"></script>
    <script src="/terceiros/datatables/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="/terceiros/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/terceiros/bootstrap/css/sticky-footer.css">
    <link rel="stylesheet" href="/terceiros/datatables/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="/terceiros/fontawesome/css/all.css" rel="stylesheet">
    
    <style>
        body {   
            background-color: #CCCCCC;
            font-family: \'Montserrat\', sans-serif;
        }
        .navbar-customizada {
            width: 100%;
            opacity: 0.7;        
            padding:10px;
            background-color: black;
        }
        
        .card {
            margin-bottom: 50px;
        }
         
    </style>
</head>
<body class="d-flex flex-column h-100">
    <header>    
        
        <nav class="navbar navbar-expand-xl navbar-customizada navbar-dark"> 
            <a class="navbar-brand" href="/index.php">BIBLIOTECA <i class="fas fa-book"></i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/home">HOME</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/livros/">LIVROS</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/editoras/">EDITORAS</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/autores/">AUTORES</a>
                    </li>
                ';

if (isset($_SESSION['logado']) && $_SESSION['ADMIN'] === true) {

    echo '                                   
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/usuarios/">USUÁRIOS</a>
                    </li>';
}

echo '                </ul>
            
                <ul class="navbar-nav ml-auto">';

if (!isset($_SESSION['logado'])) {

    echo '                                   
                    <form method="post" class="form-inline my-2 my-lg-0 p-2">
                        <input name="login" class="form-control mr-sm-2" type="text" placeholder="Usuário" aria-label="Usuário" required>
                        <input name="senha" class="form-control mr-sm-2" type="password" placeholder="Senha" aria-label="Senha" required>
                        <button name="logar" class="btn btn-outline-success my-2 my-sm-0" type="submit">Entrar</button>
                    </form>';
} else {
    echo '                                 
                    <form method="post" class="form-inline my-2 my-lg-0">
                        <span class="navbar-text p-3">
                            Bem vindo, '; echo $_SESSION['nome'];
echo '
                        </span>
                        <button name="logout" class="btn btn-outline-danger my-2 my-sm-0" type="submit">Sair</button>
                    </form>';
}
echo '
                </ul>          
            </div>
        </nav> 
    </header>
    <main role="main" class="flex-shrink-0">
    ';
if (isset($erroLogin)) {
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $erroLogin ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
}
