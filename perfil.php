<?php include_once 'includes/header.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}

?>

<link rel="stylesheet" href="assets/css/perfil.css">

<div class="img-fluid img-thumbnail superior">
    <div class="foto">
        
    </div>
</div>

<div class="container-fluid">
    <div class="row gx-2 gy-2 mt">
        <div class="col-md-8">
            <div>
                <figure class="inline">
                    <img class="foto-user img-thumbnail" src="./assets/img/sp.jpg" alt="Foto jogador">
                </figure>
                <div class="inline">  
                    <p class="user-name">WILL AIRLINES</p> 
                    <p class="user-nick">LpNA</p>
                </div>
                <p class="bio">Instagram.com/ababahdhjsfdsdfsdf</p>
            </div>
        </div>
        <div class="col-md-4 d-md-flex flex-row-reverse">
            <div class="card bg-black text-center" style="width: 15rem;">
                <img src="./assets/img/team-card-pic.jpg" class="card-img-top" alt="Card do time">
                <div class="card-body">
                    <a class="link-geral" href="#"><h5>Turminha Gaming</h5></a>
                    <p class="card-text">TGM</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row gx-2 gy-2 mt">
        <div class="col-md-3">
            <div>
            </div>
        </div>
        <div class="col-md-5">
            <div>
                <p class="bio">
                    <span>Bio: </span>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequuntur in nisi ipsum earum eos ratione, explicabo esse tempore nobis, autem facere quod quo recusandae laborum? Recusandae amet quia rem beatae.
                </p>
            </div>
        </div>
        <div class="col-md-4 d-md-flex flex-row-reverse">
            <div>
                <button class="btn btn-success">Editar perfil</button>
            </div>
        </div>
    </div>
</div>



<div class="clear"></div>

<?php include_once 'includes/footer.php' ?>