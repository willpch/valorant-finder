<?php 

include 'includes/header.php';

if(isset($_POST['usuario']) || isset($_POST['senha'])) {
    
    if(strlen($_POST['usuario']) == 0) {
        echo "Usuário inválido";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Senha inválida";
    } else {

        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $usuario = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM players WHERE usuario = '$usuario' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execucão do codigo SQL");

    }
}

?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,700;1,200;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/login.css">

<div class="principal">
    <div class="login-panel">
        <h1>Login</h1>

        <form method="post">

            <div class="txt-field">
                <input type="text" placeholder="Usuário" id="usr" name="usuario" >
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