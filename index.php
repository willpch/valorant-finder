<?php include_once 'includes/header.php';
      include_once 'conexao.php';

    $jogadores = $mysqli->query("SELECT * FROM jogadores") or die($mysqli->error);
    $mysqli->close();
    
    if (isset($_SESSION['usuario'])) { ?>

        <div>
            <div class="busca">
            <button class="btn btn-success btn-busca-index">Ver todos os times</button><button class="btn btn-warning btn-busca-index">Ver todos os perfis</button>
            </div>
            <div class="row">
            <?php foreach ($jogadores as $jogador) { ?>
                <div class="col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                    <div class="card bg-black text-center">
                        <img class="img-card" src="<?php echo $jogador['imagem'] == NULL ? "assets/img/default-avatar.jpg" : $jogador['imagem'];?>" alt="Card do time">
                        <div class="card-body">
                            <a class="link-geral" href="<?php echo "perfil.php?id=".$jogador["id"] ?>"><h5><?php echo $jogador['usuario'] ?></h5></a>
                            <p class="card-text"><?php echo $jogador['apelido'] ?></p>
                        </div>
                    </div>
                </div>    
                <?php } ?>
            </div>
        </div>

        <div class="clear"></div>

<?php } else { ?>
    <div class="row">
        <div class="col-md-6 col-sm-9">
            <h1 class="apresentacao">Crie seu time<br><span>dos sonhos</span></h1>
        </div>
    </div>
<?php
}

include 'includes/footer.php' ?>