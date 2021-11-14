<?php include_once 'includes/header.php';
    include_once 'conexao.php';

    if (isset($_SESSION['usuario'])) {
    $select = "SELECT * FROM jogadores WHERE id = '$idSessao'";
    $exec = mysqli_query($mysqli, $select);
    $linha = mysqli_fetch_assoc($exec);

    $usuarioId = $linha['id'];
    $usuarioNome = $linha['usuario'];
    $usuarioApelido = $linha['apelido'];
    $usuarioFoto = $linha['imagem'];

    $timePerfil = $mysqli->query("SELECT id_time FROM times_jogadores WHERE id_jogador = '$idSessao';");
    $TimeLogado = $timePerfil->fetch_assoc();
    
    $mysqli->close();
    }
    
    if (isset($_SESSION['usuario'])) { ?>     

        <link rel="stylesheet" href="assets/css/painel.css">
        <div class="row">
            <div class="col-lg-5">
            <div class="mt-5 bg-transp">
                <figure class="inline">
                    <img class="foto-user img-thumbnail" src="<?php echo $usuarioFoto == NULL ? "assets/img/default-avatar.jpg" : $usuarioFoto;?>" alt="Foto jogador">
                </figure>
                <div class="inline">  
                    <p class="user-name"><?php echo ucfirst($usuarioNome) ?></p> 
                    <p class="user-nick"><?php echo $usuarioApelido ?></p>
                </div>
                <div>
                    <a class="btn btn-outline-light" href="<?= "perfil.php?id=".$idSessao ?>" role="button">Meu Perfil</a>
                    <?php if ($TimeLogado) { ?>
                        <a class="btn btn-outline-light" href="<?= "time.php?id=".$TimeLogado['id_time'] ?>" role="button">Meu Time</a>
                    <?php } else { ?>
                        <button class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#cria-time">Criar Time</button>
                    <?php } ?>
                        <button class="btn btn-outline-danger">Trocar senha</button>
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
    include 'modal-painel.php';
    include 'includes/footer.php' 
?>