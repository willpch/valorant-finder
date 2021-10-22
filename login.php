<?php 

include 'includes/header.php';
include 'conexao.php';

if(isset($_SESSION['usuario'])) {
    header('Location: criar-conta.php');
}

if(isset($_POST['usuario']) || isset($_POST['senha'])) {
    
    if(strlen($_POST['usuario']) == 0) {
        echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Erro!</strong> Preencha seu usuário.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
    } else if(strlen($_POST['senha']) == 0) {
        echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Erro!</strong> Preencha sua senha.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
    } else {

        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM player WHERE usuario = '$usuario' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execucão do codigo SQL");

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {

            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['usuario'] = $usuario['usuario'];

            header("Location: index.php");

        } else {
            echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Eita!</strong> Usuário ou senha inválidos. <a href="#">Esqueceu sua senha?</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }

    }
}

?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,700;1,200;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/login.css">

<div class="principal">
    <div class="login-panel form-group">
        <h1>Login</h1>

        <form method="post">
            
            <div class="txt-field">
                <input type="text" placeholder="Usuário" id="usr" name="usuario" maxlength="10">
                <input type="password" placeholder="Senha" id="pw" name="senha" >
            </div>

            <div class="forgot-pass">
                <a href="#">Esqueceu a senha?</a>
            </div>

            <input type="submit" value="Login" id="btn-submit">

            <div class="signup">
                <a href="#">Criar conta</a>
            </div>

        </form>
    </div>
</div>

<?php include 'includes/footer.php' ?>