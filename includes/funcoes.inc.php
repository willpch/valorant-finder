<?php
        // Validações e funções criar conta
function campoVazio($usuario, $email, $apelido, $contato, $senha, $repsenha) {
    $resultado = 0;

    if (empty($usuario) || empty($email) || empty($apelido) || 
        empty($contato) || empty($senha) || empty($repsenha)) {
        
        $resultado = true;
    } else {
        $resultado = false;
    }

    return $resultado;
}

function usuarioInvalido($usuario) {
    $resultado = 0;

    if (!preg_match("/^[a-zA-Z0-9]*$/", $usuario)) {
        
        $resultado = true;
    } else {
        $resultado = false;
    }

    return $resultado;
}

function emailInvalido($email) {
    $resultado = 0;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        $resultado = true;
    } else {
        $resultado = false;
    }

    return $resultado;
}

function senhaIgual($senha, $repsenha) {
    $resultado = 0;

    if ($senha !== $repsenha) {
        
        $resultado = true;
    } else {
        $resultado = false;
    }

    return $resultado;
}

function usuarioExistente($mysqli, $usuario, $email) {
    $sql = "SELECT * FROM jogadores WHERE usuario = ? OR email = ?;";
    $stmt = mysqli_stmt_init($mysqli);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../criar-conta.php?error=erroestadosql');
        exit();
    }
    // stmt = statement // Proteção de SQL Injection.
    // ss = "Significa que serão passadas 2 strings ("$usuario e $email").
    mysqli_stmt_bind_param($stmt, "ss", $usuario, $email);
    mysqli_stmt_execute($stmt);

    $resultadoDados = mysqli_stmt_get_result($stmt);

    if ($tupla = mysqli_fetch_assoc($resultadoDados)) {
        return $tupla;
    } else {
        $resultado = false;
        return $resultado;
    }

    mysqli_stmt_close($stmt);
}

function criarUsuario($mysqli, $usuario, $email, $apelido, $contato, $senha) {
    $sql = "INSERT INTO jogadores (usuario, email, apelido, contato, senha) 
    VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($mysqli);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../criar-conta.php?error=erroestadosql');
        exit();
    }
    
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $usuario, $email, $apelido, $contato, $senhaHash);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header('Location: ../criar-conta.php?error=none');
    exit();
}

        // Validações e funções login

function loginVazio($usuario, $senha) {
    $resultado = 0;

    if (empty($usuario) || empty($senha)) {
        
        $resultado = true;
    } else {
        $resultado = false;
    }

    return $resultado;
}

function logarUsuario($mysqli, $usuario, $senha) {
    $usuarioExiste = usuarioExistente($mysqli, $usuario, $usuario);

    if ($usuarioExiste === false) {
        header('Location: ../login.php?error=usuarioinexistente');
        exit();
    }

    $senhaHash = $usuarioExiste["senha"];
    $checarSenha = password_verify($senha, $senhaHash);

    if ($checarSenha === false) {
        header('Location: ../login.php?error=senhaincorreta');
        exit();
    }
    else if ($checarSenha === true) {
        session_start();
        $_SESSION["id"] = $usuarioExiste["id"];
        $_SESSION["usuario"] = $usuarioExiste["usuario"];
        header('Location: ../index.php');
    }
}