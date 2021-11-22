<?php include_once 'includes/header.php';

include 'conexao.php';



    
if(!isset($_SESSION['tentativa'])) {
    
    $_SESSION['tentativa'] = 1;
}


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
        $_SESSION['tentativa']++;
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

$tentativas = $_SESSION['tentativa'];

?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,700;1,200;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/login.css">

<div class="principal">
    <div class="login-panel form-group">
        <h1>Login</h1>

        <form action="includes/login.inc.php" method="post">
            
            <div class="txt-field">
                <input class="form-control" type="text" placeholder="Usuário / E-mail" id="usr" name="usuario" <?= $tentativas > 3 ? "disabled" : "" ?> >
                <input class="form-control" type="password" placeholder="Senha" id="pw" name="senha" <?= $tentativas > 3 ? "disabled" : "" ?> >
            </div>

            <?php if($tentativas < 4) {
                echo "<span>Tentativas: $tentativas/3</span>";
            } else {
                echo "<span>Acesso Bloqueado</span>";
            }
            
            ?>

            <div class="forgot-pass">
                <a data-bs-toggle="modal" data-bs-target="#troca-senha" href="#">Desbloquear e trocar senha</a>
            </div>

            <input type="submit" name="submit" value="Login" id="btn-submit">

            <div class="signup">
                <a href="criar-conta.php">Criar conta</a>
            </div>

        </form>
    </div>
</div>



<?php include 'includes/footer.php';
      include 'troca-senha.php'
?>