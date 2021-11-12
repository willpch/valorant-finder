<?php
    include_once 'includes/header.php';
    include_once 'conexao.php';
    
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
    }

    $uid = $_GET['id'];

    $select1 = "SELECT * FROM jogadores WHERE id = '{$uid}'";
    $exec1 = mysqli_query($mysqli, $select1);
    $linha1 = mysqli_fetch_assoc($exec1);

    $usuarioId = $linha1['id'];
    $usuarioNome = $linha1['usuario'];
    $usuarioApelido = $linha1['apelido'];
    $usuarioContato = $linha1['contato'];
    $usuarioBio = $linha1['bio'];
    $usuarioFoto = $linha1['imagem'];

    $select2 = "SELECT * FROM times";
    $exec2 = mysqli_query($mysqli, $select2);
    $linha2 = mysqli_fetch_assoc($exec2);

    $timeId = $linha2['id'];
    $timeNome = $linha2['nome'];
    $timeSiglas = $linha2['siglas'];
    $timeFoto = $linha2['logo_time'];

    $selectJogadoresTime = $mysqli->query("SELECT id, nome, siglas, logo_time 
    FROM times 
    JOIN times_jogadores
    WHERE times_jogadores.id_jogador = '$uid' AND times.id = times_jogadores.id_time") or die($mysqli->error);

    $jogadoresTime = $selectJogadoresTime->fetch_assoc();

    if($usuarioId != $uid) {
        header('Location: 404.php');
    }

    if(!isset($uid)) {
        header('Location: 404.php');
    }

?>

<link rel="stylesheet" href="assets/css/perfil.css">

<div class="img-fluid img-thumbnail superior">
    <div class="foto">
        
    </div>
</div>

<div class="container-fluid">
    <div class="row gx-0 gy-2 mt">
        <div class="col-md-8">
            <div>
                <figure class="inline">
                    <img class="foto-user img-thumbnail" src="<?php echo $usuarioFoto == NULL ? "assets/img/default-avatar.jpg" : $usuarioFoto;?>" alt="Foto jogador">
                </figure>
                <div class="inline">  
                    <p class="user-name"><?php echo ucfirst($usuarioNome) ?></p> 
                    <p class="user-nick"><?php echo $usuarioApelido ?></p>
                </div>
                <p class="bio"><?php echo $usuarioContato ?></p>
            </div>
            <?php if (isset($idSessao) && $idSessao == $uid) { ?>
                <button class="btn btn-success btn-edit-foto" data-bs-toggle="modal" data-bs-target="#foto-edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                    <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z"/>
                    <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                </svg>&ensp;Trocar Foto</button>
            <?php } ?>
        </div>
        <div class="col-md-4 d-flex flex-row-reverse">
            <?php if ($jogadoresTime) { ?>
            <div class="card text-center">
                <img class="img-card" src="<?php echo $jogadoresTime['logo_time'] == NULL ? "assets/img/default_team_avatar.png" : $jogadoresTime['logo_time'];?>" class="card-img-top" alt="Card do time">
                <div class="card-body">
                    <a class="link-geral" href="<?php echo "time.php?id=".$jogadoresTime['id'];?>"><?php echo $jogadoresTime['nome'];?></a>
                    <p class="card-text"><?php echo strtoupper($jogadoresTime['siglas']);?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    
    <div class="row gx-2 gy-2 mt">
        <div class="col-md-3">
            <div>
            
            </div>
        </div>
        <div class="col-md-5">
            <div>
                <p class="bio"><span>Bio: </span><?php echo $usuarioBio ?></p>
            </div>
        </div>
        <div class="col-md-4 d-md-flex flex-row-reverse">
            <div>
            <?php if (isset($idSessao) && $idSessao == $uid) { ?>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#perfil-edit">Editar Perfil</button>
            <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="clear"></div>

<?php
    
    include 'editar-perfil.php';
    include 'includes/footer.php'
?>