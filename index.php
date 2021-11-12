<?php include_once 'includes/header.php';
    include_once 'conexao.php';

    if (isset($_SESSION['usuario'])) {
    $select = "SELECT * FROM jogadores WHERE id = '{$_SESSION['id']}'";
    $exec = mysqli_query($mysqli, $select);
    $linha = mysqli_fetch_assoc($exec);

    $usuarioId = $linha['id'];
    $usuarioNome = $linha['usuario'];
    $usuarioApelido = $linha['apelido'];
    $usuarioFoto = $linha['imagem'];
    }
    
    if (isset($_SESSION['usuario'])) { ?>
        <link rel="stylesheet" href="assets/css/painel.css">
        <div class="row">
            <div class="col">
            <div>
                <figure class="inline">
                    <img class="foto-user img-thumbnail" src="<?php echo $usuarioFoto == NULL ? "assets/img/default-avatar.jpg" : $usuarioFoto;?>" alt="Foto jogador">
                </figure>
                <div class="inline">  
                    <p class="user-name"><?php echo ucfirst($usuarioNome) ?></p> 
                    <p class="user-nick"><?php echo $usuarioApelido ?></p>
                </div>
            </div>
            </div>
        </div>
        

<?php } else { ?>
    <div class="row">
        <div class="col-md-6 col-sm-9">
            <h1 class="apresentacao">Crie seu time<br><span>dos sonhos</span></h1>
        </div>
    </div>
<?php }

$mysqli->close();
include 'includes/footer.php' ?>