<?php

if (isset($_POST['submit'])) {
    $usuario = strtolower($_POST['usuario']);
    $email = strtolower($_POST['email']);
    $apelido = $_POST['apelido'];
    $contato = $_POST['contato'];
    $senha = $_POST['senha'];
    $repsenha = $_POST['repsenha'];
    
    require_once '../conexao.php';
    require_once 'funcoes.inc.php';

    if (campoVazio($usuario, $email, $apelido, $contato, $senha, $repsenha) !== false) {
        header('Location: ../criar-conta.php?error=campovazio');
        exit();
    }
    if (usuarioInvalido($usuario) !== false) {
        header('Location: ../criar-conta.php?error=usuarioinvalido');
        exit();
    }
    if (emailInvalido($email) !== false) {
        header('Location: ../criar-conta.php?error=emailinvalido');
        exit();
    }
    if (senhaIgual($senha, $repsenha) !== false) {
        header('Location: ../criar-conta.php?error=senhasdiferentes');
        exit();
    }
    if (usuarioExistente($mysqli, $usuario, $email) !== false) {
        header('Location: ../criar-conta.php?error=usuariojaexiste');
        exit();
    }

    criarUsuario($mysqli, $usuario, $email, $apelido, $contato, $senha);

} else {
    header('Location: ../criar-conta.php');
    exit();
}