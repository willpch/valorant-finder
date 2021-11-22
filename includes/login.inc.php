<?php

if(isset($_POST["submit"]) && $tentativas < 3) {

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    require_once '../conexao.php';
    require_once 'funcoes.inc.php';

    if (loginVazio($usuario, $senha) !== false) {
        header('Location: ../login.php?error=loginvazio');
        exit();
    }

    logarUsuario($mysqli, $usuario, $senha);

} else {
    header("Location: ../login.php");
    exit();
}

