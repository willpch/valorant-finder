<?php include_once 'includes/header.php'; ?>

<?php 

if(isset($_SESSION['usuario'])) {
    header('Location: index.php');
}

if (isset($_GET['error'])) {
    if($_GET['error'] == "usuarioinexistente") {
        echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>ERRO!</strong> Usuário / E-mail não existe ou incorreto.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
    }
    else if($_GET['error'] == "senhaincorreta") {
        echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>ERRO!</strong> A senha está incorreta.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
    }
    else if($_GET['error'] == "loginvazio") {
        echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>ERRO!</strong> Preencha todos os campos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
    }
}


?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,700;1,200;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/login.css">

<div class="principal">
    <div class="login-panel form-group">
        <h1>Login</h1>

        <form action="includes/login.inc.php" method="post">
            
            <div class="txt-field">
                <input class="form-control" type="text" placeholder="Usuário / E-mail" id="usr" name="usuario" >
                <input class="form-control" type="password" placeholder="Senha" id="pw" name="senha" >
            </div>

            <div class="forgot-pass">
                <a href="#">Esqueceu a senha?</a>
            </div>

            <input type="submit" name="submit" value="Login" id="btn-submit">

            <div class="signup">
                <a href="#">Criar conta</a>
            </div>

        </form>
    </div>
</div>



<?php include 'includes/footer.php' ?>