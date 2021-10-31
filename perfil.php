<?php include_once 'includes/header.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}

?>

<link rel="stylesheet" href="assets/css/perfil.css">

<div class="img-fluid img-thumbnail superior">
    <div class="foto">
        <figure>
            <p><a class="link-editar">Editar perfil</a></p>
            <img class="img-user" src="./assets/img/sp.jpg" alt="Imagem do jogador">
        </figure>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <p>&nbsp</p>
        </div>
        <div class="col-md-4">
            <p>&nbsp</p>
        </div>
        <div class="col-md-4 text-center">
            <p class="user-name">Nick do Jogador</p>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 text-center">
        <p class="bio"><span>Bio: </span>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste, in. Hic ratione consequuntur nihil obcaecati! Soluta, molestiae quasi sit eius, facere rem quae beatae, tempore nisi ullam dignissimos assumenda. Nam?</p>
        </div>
        <div class="col-md-4 text-center">
            <p class="nick-jogo">Nick: Teste#1234</p>
            <p class="bio">Contato: instagram.com/aabbcc</p>
        </div>
        <div class="col-md-4 d-flex justify-content-center">
            <div class="card text-center" style="width: 14rem;">
                <img src="./assets/img/team-card-pic.jpg" class="card-img-top" alt="imagem card time">
                <div class="card-body">
                    <h5 class="card-title">Chicago Bulls</h5>
                    <p class="card-text">ChiBl</p>
                    <a href="#" class="btn btn-primary">Ver/Aplicar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clear"></div>

<?php include_once 'includes/footer.php' ?>