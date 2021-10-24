<?php

include 'includes/header.php';
?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,700;1,200;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/criar-conta.css">
    
    <div class="principal">
        <div class="login-panel form-group">
            <h1>Criar conta</h1>

            <form action="includes/criar-conta.inc.php" method="post">
                
                <div class="txt-field">
                    <input type="text" placeholder="Usuário" id="usr" name="usuario" maxlength="10" >
                    <input type="email" placeholder="E-mail" name="email">
                    <input type="text" placeholder="Nick do jogo" name="apelido">
                    <input type="text" placeholder="Rede social / contato" name="contato">
                    <input type="password" placeholder="Senha" id="pw" name="senha">
                    <input type="password" placeholder="Confirmar Senha" id="repsenha" name="repsenha">
                </div>

                <input type="submit" name="submit" value="Criar" id="btn-submit">
                
            </form>
        </div>
    </div>

<?php include 'includes/footer.php' ?>