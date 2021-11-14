<?php

include_once 'includes/header.php';
?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,700;1,200;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/criar-conta.css">
    
<div class="principal">
    <div class="login-panel form-group">
        <h1>Criar conta</h1>

        <form action="includes/criar-conta.inc.php" method="post">
            
            <div class="txt-field">
                <div class="form-floating">
                    <input class="form-control" type="text" placeholder="Usuário" id="usr" name="usuario" maxlength="10">
                    <label for="usr">Usuário</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" id="email" type="text" placeholder="E-mail" name="email">
                    <label for="email">E-mail</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" id="apelido" type="text" placeholder="Nick do jogo" name="apelido">
                    <label for="apelido">Nick no jogo</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" id="social" type="text" placeholder="Rede social / contato" name="contato">
                    <label for="social">Rede Social/contato</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="password" placeholder="Senha" id="pw" name="senha">
                    <label for="pw">Senha</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="password" placeholder="Confirmar Senha" id="repsenha" name="repsenha">
                    <label for="repsenha">Repetir senha</label>
                </div>
            </div>

            <input type="submit" name="submit" value="Criar" id="btn-submit">
            
        </form>
    </div>
</div>

<?php 
    if (isset($_GET['error'])) {
        if($_GET['error'] == "campovazio") {
            echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>ERRO!</strong> Preencha todos os campos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ';
        }
        else if($_GET['error'] == "usuarioinvalido") {
            echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>ERRO!</strong> Usuário inválido, verifique.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ';
        }
        else if($_GET['error'] == "emailinvalido") {
            echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>ERRO!</strong> E-mail inválido, verifique.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ';
        }
        else if($_GET['error'] == "senhasdiferentes") {
            echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>ERRO!</strong> Senhas não conferem, insira novamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ';
        }
        else if($_GET['error'] == "usuariojaexiste") {
            echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>ERRO!</strong> Usuário ou e-mail já existem. <a href="login.php">Tente LOGAR</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ';
        }
        else if($_GET['error'] == "none") {
            echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>GG!</strong> Conta criada, seja bem vindo(a)! <a href="login.php">LOGAR.</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ';
        }
    }

?>

<?php include 'includes/footer.php' ?>