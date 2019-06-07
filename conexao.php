<?php

$servidor = "localhost";
$banco = "BIBLIOTECA";
$usuario = "root";
$senha = "";

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

//$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);