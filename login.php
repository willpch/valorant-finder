<?php include 'includes/header.php' ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,700;1,200;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/login.css">

<div class="principal">
    <div class="login-panel">
        <h1>Login</h1>

        <form method="post">

            <div class="txt-field">
                <input type="text" placeholder="Usuário" id="usr" required>
                <input type="password" placeholder="Senha" id="pw" required>
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