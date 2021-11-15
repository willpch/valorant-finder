<?php include_once 'includes/header.php';
    include_once 'conexao.php';

    if($_POST) {
        $buscar = filter_var($_POST['inp-buscar'], FILTER_SANITIZE_STRING);
        $buscaPerfis = $mysqli->query("SELECT * FROM jogadores WHERE usuario like '%$buscar%' or apelido like '%$buscar%';") or die($mysqli->error);
        $buscaTimes = $mysqli->query("SELECT * FROM times WHERE nome like '%$buscar%' or siglas like '%$buscar%';") or die($mysqli->error);

        $mysqli->close();
    }
?>

        <div>
            <div class="busca mt-5 ms-5">
            
            <p>Resultados para "<?php echo $buscar ?>":</p>
            </div>
            <div class="row">
            <?php foreach ($buscaPerfis as $perfil) { ?>
                <div class="col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                    <div class="card text-center">
                        <img class="img-card" src="<?php echo $perfil['imagem'] == NULL ? "assets/img/default-avatar.jpg" : $perfil['imagem'];?>" alt="Card do Perfil">
                        <div class="card-body">
                            <a class="link-geral" href="<?php echo "perfil.php?id=".$perfil["id"] ?>"><h5><?php echo ucfirst($perfil['usuario']) ?></h5></a>
                            <p class="card-text"><?php echo $perfil['apelido'] ?></p>
                        </div>
                    </div>
                </div>    
            <?php } ?>
            <?php foreach ($buscaTimes as $time) { ?>
                <div class="col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                    <div class="card text-center">
                        <img class="img-card" src="<?php echo $time['logo_time'] == NULL ? "assets/img/default_team_avatar.png" : $time['logo_time'];?>" alt="Card do time">
                        <div class="card-body">
                            <a class="link-geral" href="<?php echo "time.php?id=".$time["id"] ?>"><h5><?php echo ucfirst($time['nome']) ?></h5></a>
                            <p class="card-text"><?php echo strtoupper($time['siglas'])." (Equipe)" ?></p>
                        </div>
                    </div>
                </div>    
            <?php } ?>
            </div>
            
        <div class="clear pb-5 pt-2"></div>
        </div>


<?php include_once 'includes/footer.php' ?>